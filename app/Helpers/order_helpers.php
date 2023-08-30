<?php
    if (!function_exists('getOrderNameStageByKey')) {
        function getOrderNameStageByKey($key)
        {
            switch ($key) {
                case \App\Models\Order::NOT_ACCEPTED:
                    return 'Duyệt xuống P. Thiết kế';
                    break;
                case \App\Models\Order::DESIGN_SUBMITED:
                    return 'Duyệt xuống P. Kế hoạch';
                    break;
                // case \App\Models\Order::TECH_SUBMITED:
                //     return 'Xác nhận xuất khuôn';
                //     break;
                default:
                    return '';
                    break;
            }    
        }
    }

    if (!function_exists('getProductElementData')) {
        function getProductElementData($category, $id, $exc_paper = false)
        {
            $ret = isHardBox($category) ? \TDConst::HARD_ELEMENT : \TDConst::PAPER_ELEMENT;
            $where = ['act' => 1, 'product' => $id];
            foreach ($ret as $key => $item) {
                if ($item['table'] == 'supplies') {
                    $where['type'] = $item['pro_field'];
                }
                if ($exc_paper && $item['table'] =='papers') {
                    $where['except_handle'] = 0;
                }
                $ret[$key]['data'] = \DB::table($item['table'])->where($where)->get()->toArray();
                unset($where['type'], $where['except_handle']);
            }
            return $ret;
        }
    }

    if (!function_exists('getHandleSupplyStatus')) {
        function getHandleSupplyStatus($product, $supply, $type)
        {
            if ($type == \TDConst::PAPER) {
                $arr_supp_key = [\TDConst::PAPER, \TDConst::NILON, \TDConst::METALAI, \TDConst::COVER];
                $commands = \DB::table('c_supplies')
                ->where(['product' => $product, 'supply' => $supply])
                ->whereIn('supp_type', $arr_supp_key)->get();
            }else{
                $commands = \DB::table('c_supplies')->where(['product' => $product, 'supply' => $supply, 'supp_type' => $type])->get();
            }
            if ($commands->isEmpty()) {
                return \App\Models\CSupply::NOT_HANDLE;
            }
            $ret = \App\Models\CSupply::HANDLED;
            foreach ($commands as $c_supp) {
                if (@$c_supp->status == \App\Models\CSupply::HANDLING) {
                    $ret = \App\Models\CSupply::HANDLING;
                    break;
                }
            }
            return $ret;
        }
    }

    if (!function_exists('getSizeTitleProduct')) {
        function getSizeTitleProduct($product)
        {
            return @$product['length'].' x '. @$product['width'].' x '.@$product['height'];
        }
    }

    if (!function_exists('getCeilSupplyQuantity')) {
        function getCeilSupplyQuantity($product_qty, $nqty)
        {
            if ($nqty == 0) {
                return 0;
            }
            return ceil($product_qty/$nqty);
        }
    }

    if (!function_exists('getAfterPrintStageByCate')) {
        function getAfterPrintStageByCate($category)
        {
            switch ($category) {
                case \App\Models\ProductCategory::PAPER_BOX:
                    return \TDConst::HANDLE_STAGE;
                    break;

                case \App\Models\ProductCategory::HARD_BOX:
                    return \TDConst::HANDLE_STAGE_HARD;
                    break;

                case \App\Models\ProductCategory::PAPER_BAG:
                    return \TDConst::HANDLE_STAGE_BAG;
                    break;

                case \App\Models\ProductCategory::STAMP:
                    return \TDConst::HANDLE_STAGE_STAMP;
                    break;

                case \App\Models\ProductCategory::LABEL_STAMP:
                    return \TDConst::HANDLE_STAGE_LABEL;
                    break;

                case \App\Models\ProductCategory::LEAFLET:
                    return \TDConst::HANDLE_STAGE_LEAFLET;
                    break;

                default:
                    return \TDConst::HANDLE_STAGE;
                    break;
            }
        }
    }

    if (!function_exists('isBox')) {
        function isNotBox($category)
        {
            $arr_box = [
                \App\Models\ProductCategory::PAPER_BOX,
                \App\Models\ProductCategory::HARD_BOX,
                \App\Models\ProductCategory::PAPER_BAG
            ];
            return !in_array($category, $arr_box);
        }
    }

    if (!function_exists('getDeviceByKeyType')) {
        function getDeviceByKeyType($key)
        {
            return $key == \TDConst::PRINT ? \TDConst::PRINT_TECH : 
            [\App\Models\Device::AUTO_DEVICE => 'Thiết bị tự động', \App\Models\Device::SEMI_AUTO_DEVICE => 'Thiết bị bán tự động'];
        }
    }

    if (!function_exists('getDeviceGroupName')) {
        function getDeviceGroupName($type, $device)
        {
            $arr_type = \TDConst::ALL_DEVICE_KEY;
            $arr_device = getDeviceByKeyType($type);
            return 'Tổ '.mb_strtolower(@$arr_type[$type]. ' - '.@$arr_device[$device]);
        }
    }

    if (!function_exists('getTableWarehouseByType')) {
        function getTableWarehouseByType($param = []){
            $type = !empty($param->supp_type) ? $param->supp_type : '';
            switch ($type) {
                case in_array($type, [\TDConst::CARTON, \TDConst::RUBBER, \TDConst::STYRO, \TDConst::MICA]):
                    return 'supply_warehouses';
                    break;
                case in_array($type, [\TDConst::PAPER]):
                    return 'print_warehouses';
                    break;
                case in_array($type, [\TDConst::MAGNET]):
                    return 'other_warehouses';
                    break;
                default:
                    return 'square_warehouses';
                    break;
            }
        }
    }

    if (!function_exists('checkUpdateeOrderStatus')) {
        function checkUpdateeOrderStatus($id, $status)
        {
            $a = getCountDataTable('products', ['order' => $id]);
            $b = getCountDataTable('products', ['order' => $id, 'status' => $status]);
            return $a == $b;
        }
    }

    if (!function_exists('getArrHandleField')) {
        function getArrHandleField($table)
        {
            switch ($table) {
                case 'papers':
                    return [\TDConst::PRINT, 
                            \TDConst::NILON, 
                            \TDConst::METALAI, 
                            \TDConst::COMPRESS, 
                            \TDConst::UV, 
                            \TDConst::ELEVATE,
                            \TDConst::FLOAT,
                            \TDConst::PEEL,
                            \TDConst::BOX_PASTE,
                            \TDConst::BAG_PASTE,
                            \TDConst::CUT,
                            \TDConst::FOLD];
                    break;
                case 'supplies':
                    return [\TDConst::ELEVATE, 
                            \TDConst::PEEL, 
                            \TDConst::CUT,
                            \TDConst::MILL];
                    break;
                case 'fill_finishes':
                    return [\TDConst::FILL, 
                            \TDConst::FINISH];
                    break;
                default:
                    return '*';
                    break;
            }
        }
    }

    if (!function_exists('getStageActiveStartHandle')) {
        function getStageActiveStartHandle($table, $id){
            $arr_select = getArrHandleField($table);
            $data = \DB::table($table)->select($arr_select)->find($id);
            foreach ($data as $key => $value) {
                $data_value = json_decode($value, true);
                if (@$data_value['act'] == 1) {
                    $ret['status'] = $key;
                    if (!empty($data_value['machine'])) {
                        $ret['machine_type'] = $key == \TDConst::PRINT ? $data_value['machine'] : getFieldDataById('type', 'devices', $data_value['machine']); 
                    }
                    return $ret;
                    break;
                }
            }
        }
    }