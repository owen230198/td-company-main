<?php
    namespace App\Http\Controllers\COrder;
    use App\Http\Controllers\Controller;
    use App\Models\COrder;
    use Illuminate\Http\Request;

    class COrderController extends Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->table = 'c_orders';
        }

        private function getDataView($action)
        {
            $data = $this->admins->getDataActionView($this->table, $action, $action == 'insert' ? 'Thêm mới' : 'Chi tiết');
            $field_list = $data['field_list'];
            $data['field_type'] = array_slice($field_list, 0, 3);
            $data['field_action'] = array_slice($field_list, 2);
            return $data;
        }

        public function insert($request)
        {
            $table = $this->table;
            if (!$request->isMethod('POST')) {
                $data = $this->getDataView(__FUNCTION__);
                $data['action_url'] = url('insert/'.$table);
                return view('c_orders.view', $data);
            }
        }
    }
?>