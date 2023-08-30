<?php
    namespace App\Modules\Worker\Controllers;
    use App\Http\Controllers\Controller;
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
    }  
?>