<?php

namespace App\Http\Controllers\SupplyBuying;
use App\Http\Controllers\Controller;
use App\Models\SupplyBuying;
use Illuminate\Http\Request;

class SupplyBuyingController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function ProcessData(&$data)
    {
        $data['code'] = 'CT-'.getCodeInsertTable('supply_buyings');
        $data['status'] = \StatusConst::NOT_ACCEPTED;
        $data['supply'] = json_encode($data['supply']);
    }
    
    public function insert($request)
    {
        $table = 'supply_buyings';
        if (!$request->isMethod('POST')) {
            $data = $this->admins->getDataActionView($table, __FUNCTION__, 'Thêm mới');
            $data['action_url'] = url('insert/'.$table);
            return view('action.view', $data);
        }else{
            $data = $request->except('_token');
            $this->processData($data);
            $this->admins->configBaseDataAction($data);
            $insert = SupplyBuying::insert($data);
            if ($insert) {
                $back_routes = @session()->get('back_url') ?? url('view/'.$table);
                logActionUserData(__FUNCTION__, $table, $insert, $data);
                return returnMessageAjax(200, 'Thêm dữ liệu thành công!', $back_routes);
            }else {
                return returnMessageAjax(100, 'Lỗi không xác định !');
            }
        }
    }

    public function update($request, $id)
    {
        $table = 'supply_buyings';
        $dataItem = getModelByTable($table)->find($id);
        if (!$request->isMethod('POST')) {
            $data = $this->admins->getDataActionView($table, __FUNCTION__, 'Chi tiết');
            $data['dataItem'] = $dataItem;
            $data['action_url'] = url('update/'.$table.'/'.$id);
            return view('action.view', $data);
        }else{
            $data = $request->except('_token');
            $this->processData($data);
            $this->admins->configBaseDataAction($data);
            $update = SupplyBuying::where('id', $id)->update($data);
            if ($update) {
                $back_routes = @session()->get('back_url') ?? url('view/'.$table);
                logActionUserData(__FUNCTION__, $table, $id, $dataItem);
                return returnMessageAjax(200, 'Cập nhật dữ liệu thành công!', $back_routes);
            }else {
                return returnMessageAjax(100, 'Lỗi không xác định !');
            }
        }    
    }

    public function addSupplyBuying(Request $request)
    {
        return view('supply_buyings.supply_item', ['index' => (int) $request->input('index')]);
    }
}
