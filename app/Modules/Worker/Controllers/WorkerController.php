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
        
        public function index(Request $request)
        {
            $worker = \Worker::getCurrent(); 
            $data['title'] = 'Chấm công '.getDeviceGroupName($worker['type'], $worker['device']);
            $obj = $this->services->getListDataHome($worker);
            $q = trim($request->input('q'));
            if ($q != '') {
                $obj = $obj->where('command', 'like', '%'.$q.'%');
                $data['q'] = $q;
            }
            $data['list_data'] = $obj->paginate(20);
            $data['worker'] = $worker;
            $worker_type = $worker['type'];
            $list_my_command = getDataWorkerCommand(['status' => \StatusConst::PROCESSING, 'worker' => $worker['id']]);
            $data['my_command'] = !empty($list_my_command[0]) ? $list_my_command[0] : '';
            $data['item_command'] =  checkKeyWorkerExcept($worker_type) ? $worker_type : 'base';
            return view('Worker::main', $data);
        }

        public function actionCommand(Request $request, $action) {
            $id = $request->input('id');
            $obj_command = \DB::table('w_salaries')->where('id', $id);
            $data_command = $obj_command->find($id);
            $worker  = \Worker::getCurrent();
            $is_ajax = $request->isMethod('POST');
            if (empty($data_command)) {
                return customReturnMessage(false, $is_ajax, ['message' => 'Dữ liệu không hợp lệ !']);
            }
            $supply = \DB::table(@$data_command->table_supply)->find(@$data_command->supply);
            switch ($action) {
                case 'receive':
                    return $this->services->receiveCommad($obj_command, $data_command, $worker);
                    break;
                case 'detail':
                    return $this->services->detailCommand($data_command, $worker, $supply);
                    break;
                case 'submit':
                    return $this->services->submitCommand($obj_command, $data_command, $worker, $supply, (int) $request->input('qty'));
                    break;
                default:
                    return customReturnMessage(false, $is_ajax, ['message' => 'Thao tác không hợp lệ !']);
                    break;
            }
        }

        public function myTableSalary()
        {
            $data['title'] = 'Bảng lương tháng '.\Carbon\Carbon::now()->month;
            $table = 'w_salaries';
            $worker = \Worker::getCurrent('id');
            $where = [
                ['key' => 'worker', 'value' => $worker],
                ['key' => 'submited_at','compare' => 'month', 'value' => 'this_month']
            ];
            $data['list_data'] = getDataTable($table, $where);
            $data['summary'] = \DB::table($table)->where(['worker' => $worker, 'status' => \StatusConst::LAST_SUBMITED])
            ->whereMonth('submited_at', \Carbon\Carbon::now()->month)->sum('total');
            return view('Worker::salaries.view', $data);
        }
    }  
?>