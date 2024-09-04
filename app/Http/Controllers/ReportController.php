<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(Request $request, $method)
    {
        if(!$method || !method_exists($this, $method)){
            return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
        }else{
            return $this->$method($request);
        }
    }

    public function orderSale($request)
    {
        $is_ajax = !empty($request->input('is_ajax'));
        $table = 'orders';
        if (\GroupUser::isAdmin()) {
            $inputs = $request->except(['is_ajax', 'view_style']);
            $data = $this->admins->getBaseTable($table);
            $data['title'] = 'Báo cáo & thông kê đơn hàng';
            $data['data_search'] = $inputs;
            $where = [];
            $this->admins->arrayToCondition($table, $inputs, $where);
            $obj = getDataTable($table, $where, [], true);
            $data['data_tables'] = $obj->paginate(50);
            $data['field_searchs'] = $this->admins->getFieldAction($table, 'rp_search');
            $data['total_amount'] = $obj->sum('total_amount');
            $data['link_search'] = url('report/orderSale');
            $data['chart_buttons'] = [
                ['name' => 'created_by', 'text' => 'kinh doanh', 'icon' => 'user-circle-o'],
                ['name' => 'customer', 'text' => 'khách hàng', 'icon' => 'id-card-o'],
            ];
            $data = $data +  $this->admins->getFieldAction($table, 'rp_view');
            return view('reports.tables.view', $data);
        }else{
            return customReturnMessage(false, $is_ajax, ['message' => 'Bạn không có quyền truy cập dữ liệu !']);
        }
    }

    public function viewChart($request)
    {
        $is_ajax = !empty($request->input('is_ajax'));
        $table = $request->input('table');
        if (\GroupUser::isAdmin()) {
            $inputs = $request->except(['table', 'field', 'field_by', 'nosidebar']);
            $data = $this->admins->getBaseTable($table);
            $data['title'] = 'Biểu đồ thống kê '.$data['tableItem']['note'];
            $where = [];
            $this->admins->arrayToCondition($table, $inputs, $where);
            // $where[] = ['key' => 'created_by', 'compare' => '!=', 'value' => 1];
            $field = $request->input('field');
            $obj_top = getDataTable($table, $where, ['select' => [$field, \DB::raw('SUM('.$request->input('field_by').') as total_value')]], true)->orderBy('total_value', 'desc')->groupBy($field)
            ->orderBy('total_value', 'desc')->take(10)->get();
            $obj_other = getDataTable($table, $where, ['select' => [$field, \DB::raw('SUM('.$request->input('field_by').') as total_value')]], true)->whereNotIn($field, $obj_top->pluck($field))->get();
            $obj_other->map(function ($obj) use ($field) {
                $obj->{$field} = 'other';
                return $obj;
            });
            $list_data = $obj_other->isEmpty() ? $obj_top : $obj_top->concat($obj_other);
            $totalValue = $list_data->sum('total_value');
            $table_map = $field == 'created_by' ? 'n_users' : 'customers';
            $label = $field == 'created_by' ? 'kinh doanh' : 'khách hàng';
            $value_label = $field == 'created_by' ? 'Doanh số' : 'Tổng đơn';
            $list_data = $list_data->filter(
                function ($obj) {
                    return (float) $obj->total_value > 0;
                }
            )->map(function ($obj) use ($totalValue, $field, $table_map, $label, $value_label) {
                $percent =  round(($obj->total_value / $totalValue) * 100, 5);
                $obj->name = $obj->{$field} == 'other' ? 'Các '.$label.' khác' : getFieldDataById('name', $table_map, $obj->{$field});
                $obj->name .= ' - '.$value_label.': '.number_format($obj->total_value).' Chiếm: '.$percent.'%';
                $obj->total_value = $obj->total_value;
                return $obj;
            });
            $data['value_label'] = $value_label;
            $data['totalValue'] = number_format($totalValue);
            $data['nosidebar'] = 1;
            $data['labels'] = $list_data->pluck('name')->toArray();
            $data['values'] = $list_data->pluck('total_value')->toArray();
            return view('reports.charts.view', $data);
        }else{
            return customReturnMessage(false, $is_ajax, ['message' => 'Bạn không có quyền truy cập dữ liệu !']);
        }   
    }
}

