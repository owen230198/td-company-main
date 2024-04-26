<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PrintWarehouse extends Model
{
    protected $table = 'print_warehouses';
    protected $protectFields = false;
    static function getFieldSearch()
    {
        $fields = (new \App\Services\AdminService())->getFieldAction('print_warehouses', 'search');
        $fields[0]['other_data'] = '{
            "group_class":"__module_select_ajax_value_child",
            "inject_attr":"link=get-quantitative-inpaper",
            "width":"8",
            "width_child":"6"
        }';

        $fields[0]['child'][0]['attr'] = '{"required":1,"inject_class":"__select_parent"}'; 
        $fields[0]['child'][1]['attr'] = '{"required":1,"disable_field":1,"inject_class":"__select_child"}';
        $fields[0]['child'][1]['type'] = 'select'; 
        $fields[0]['child'][1]['other_data'] = '{"config":{"searchbox":1},"data":{"options":{"":"Chọn định lượng"}}}';
        return $fields;
    }

    static function getRole()
    {
        $role = [
            \GroupUser::WAREHOUSE => [
                'insert' => 1,
                'view' => 1,
                'update' => 1
            ],
            \GroupUser::PLAN_HANDLE => [
                'view' => 1
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    } 
    
    static function insertOverSupply($data, $supply, $size)
    {
        $data_whouse = $data;
        $data_whouse['type'] = $supply->type;
        $data_whouse['supp_price'] = @$size['materal'];
        $data_whouse['qtv'] = @$size['qttv'];
        $data_whouse['status'] = SupplyWarehouse::WAITING;
        $data_whouse['source'] = SupplyWarehouse::OVER;
        (new \BaseService)->configBaseDataAction($data_whouse);
        PrintWarehouse::insert($data_whouse);
    }

    static function getDataJsonLinking($warehouse, $q)
    {
        if (!empty($q)) {
            $warehouse->where(function ($warehouse) use ($q) {
                $warehouse->orWhere('name', 'like', '%'.trim($q).'%');
                if (is_float($q)) {
                    $warehouse->orWhere('width', '>=', $q - 1)->orWhere('length', '>=', $q - 1);
                }
            });
        }
        $data = $warehouse->paginate(50)->all();
        $arr = array_map(function($item){
            return [
                'id' => @$item->id, 
                'label' => self::getLabelLinking($item)];
        }, $data);
        return json_encode($arr);
    }

    static function getStructForPlan($param)
    {
        return ['code' => 200, 'data' => ['inhouse' => $param['supply']->qty]];
    }

    public function afterRemove($id)
    {
        return WarehouseHistory::removeData('print_warehouses', $id);
    }

    static function getLabelLinking($data)
    {
        return !empty($data->supp_price) ? getFieldDataById('name', 'materals', $data->supp_price).' - '.$data->qtv.' - '.$data->length.'x'.$data->width.' / Còn lại : '.$data->qty.' tờ' : '';
    }
}
