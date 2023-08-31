<?php
    namespace App\Modules\Worker\Controllers;
    use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

    class WorkerController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->services = new \App\Modules\Worker\Services\WorkerService;
        }
        
        public function index()
        {
            $worker = \Worker::getCurrent(); 
            $data['title'] = 'Chấm công '.getDeviceGroupName($worker['type'], $worker['device']);
            $data['list_data'] = $this->services->getListDataHome($worker);
            $data['worker'] = $worker;
            $data['item_command'] =  checkKeyWorkerExcept($worker['type']) ? $worker['type'] : 'base';
            return view('Worker::main', $data);
        }

        public function actionCommand(Request $request, $action) {
            $table = $request->input('table');
            $id = $request->input('id');
            $obj_command = \DB::table($table)->where('id', $id);
            $data_command = $obj_command->first();
            $worker  = \Worker::getCurrent();
            $is_ajax = $request->isMethod('POST');
            if (empty($table) || empty($id) || empty($data_command)) {
                return customReturnMessage(false, $is_ajax, ['message' => 'Dữ liệu không hợp lệ !']);
            }
            switch ($action) {
                case 'receive':
                    return $this->services->receiveCommad($obj_command, $data_command, $worker);
                    break;
                case 'detail':
                    $data_command->table = $table;
                    return $this->services->detailCommand($data_command, $worker);
                    break;
                case 'submit':
                    return $this->services->submitCommand($obj_command, $data_command, $worker);
                    break;
                default:
                    return customReturnMessage(false, $is_ajax, ['message' => 'Thao tác không hợp lệ !']);
                    break;
            }
        }
    }  
?>