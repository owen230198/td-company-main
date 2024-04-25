<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PrintWarehouse extends Model
{
    protected $table = 'print_warehouses';
    protected $protectFields = false;
    const FIELD_SEARCH = [
        [
            'name' => 'supp_price',
            'note' => 'Loại giấy',
            'type' => 'linking',
            'attr' => '{"class_on_search":"__supp_price_warehouse_search __search_input_warehouse"}',
            'other_data' => '{
                "config":{
                    "search":1
                },
                "data":{
                    "table":"materals",
                    "where_default":{"type":"type"}
                }
            }',
            'parent' => 'group_paper'
        ],
        [
            'name' => 'qtv',
            'note' => 'Định lượng',
            'type' => 'select',
            'attr' => '{"class_on_search":"__qtv_warehouse_search __search_input_warehouse","disable_field":"1"}',
            'other_data' => '{
                "config":{
                    "search":1
                },
                "data":{
                    "options":{"":"Chọn định lượng"}
                }
            }',
            'parent' => 'group_paper'
        ],
        [
            'id' => 'group_paper',
            'type' => 'group',
            'other_data' => '{
                "group_class":"__module_select_ajax_value_child",
                "inject_attr":"get-list-quantative-paper",
                "width":"8",
                "width_child":"6"
            }'
        ],
        [
            'name' => 'length',
            'note' => 'KT dài',
            'type' => 'text',
            'attr' => '{"class_on_search":"__search_input_warehouse"}',
        ],
        [
            'name' => 'width',
            'note' => 'KT rộng',
            'type' => 'text',
            'attr' => '{"class_on_search":"__search_input_warehouse"}',
        ]
    ];

    public function getFieldSearch()
    {
        $fields = self::FIELD_SEARCH;
        NDetailTable::handleField($fields, 'search');
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
