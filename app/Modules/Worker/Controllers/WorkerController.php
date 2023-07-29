<?php
    namespace App\Modules\Worker\Controllers;
    use App\Http\Controllers\Controller;
    class WorkerController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            $data['title'] = 'Chấm công';
            return view('Worker::main', $data);
        }
    }  
?>