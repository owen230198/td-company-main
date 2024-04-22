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

    if (!function_exists('isNoQuantativeSupply')) {
        function isNoQuantativeSupply($type)
        {
            return in_array($type, [\TDConst::DECAL, \TDConst::SILK]);
        }
    }

    if (!function_exists('getTitleSupplyByType')) {
        function getTitleSupplyByType($type, $item){
            $size = !empty($item->size) ? json_decode($item->size, true) : [];
            switch ($type) {
                case $type == \TDConst::CARTON :
                    return getFieldDataById('name', 'supply_names', @$item->name). ' - ' .getFieldDataById('name', 'supply_types', @$size['supply_type']);
                    break;
                case isNoQuantativeSupply($type) :
                    return getFieldDataById('name', 'materals', @$size['supply_price']);
                    break;
                case $type == \TDConst::PAPER :
                    return @$item->name;
                    break;
                default:
                    return getFieldDataById('name', 'supply_types', @$size['supply_type']);
                    break;
            }
        }
    }

    if (!function_exists('configCloneDataElementObj')) {
        function configCloneDataElementObj(&$data_obj, $table){
            foreach ($data_obj as $value) {
                unset($value['id']);
                if ($table == 'papers') {
                    $value['name'] = $value['name'].' (Sản xuất lại do lỗi kỹ thuật)';
                }
                $value['product_qty'] = 0;
                $value['base_supp_qty'] = 0;
                $value['compent_percent'] = 0;
                $value['compent_plus'] = 0;
                $value['supp_qty'] = 0;
            }
        }
    }

    if (!function_exists('getProductElementData')) {
        function getProductElementData($category, $id, $exc_paper = false, $check_magnet = false, $empty_obj = false, $clone_data = false)
        {
            $ret = isHardBox($category) ? \TDConst::HARD_ELEMENT : \TDConst::PAPER_ELEMENT;
            $where = [];
            foreach ($ret as $key => $item) {
                $where = ['act' => 1, 'product' => $id];
                if ($item['table'] == 'supplies') {
                    $where['type'] = $item['pro_field'];
                }
                if ($exc_paper && $item['table'] =='papers') {
                    $where['handle_type'] = \TDConst::MADE_BY_OWN;
                }
                $data_obj = getModelByTable($item['table'])->where($where)->get();
                if ($check_magnet && $item['table'] =='fill_finishes') {
                    $magnet_compent = (float) getDataConfig('QuoteConfig', 'MAGNET_COMPEN_PERCENT');
                    foreach ($data_obj as $key_magnet => $magnet) {
                        $data_magnet = !empty($magnet->magnet) ? json_decode($magnet->magnet, true) : [];
                        if (!empty($data_magnet['type']) && !empty($data_magnet['qty'])) {
                            $magnet_qty = (int) $data_magnet['qty'] * (int) $magnet->product_qty;
                            $magnet->product_qty = calValuePercentPlus($magnet_qty, $magnet_qty, $magnet_compent);
                            $ret[$key]['data'][$key_magnet] = $magnet;
                        }
                    }
                }else{
                    if ($clone_data) {
                        configCloneDataElementObj($data_obj, $item['table']);
                    }
                    if (!$exc_paper && $item['table'] =='papers') {
                        $product_outside = \DB::table('products')->where('parent', $id)->get();
                        $ret[$key]['data'] = $product_outside->isNotEmpty() ? $data_obj->concat($product_outside) : $data_obj;
                    }else{
                        $ret[$key]['data'] = $data_obj;
                    }
                    if ($empty_obj && $data_obj->isEmpty()) {
                        unset($ret[$key]);
                    }
                }
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
            $size = $product->length;
            if (!empty($product->width)) {
                $size .= ' x '.$product->width;
            }
            return $size.' x '.$product->height;
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
            if (empty($category)) {
                return \TDConst::BASE_HANDLE_STAGE;
            }
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
        function getTableWarehouseByType($param = new \stdClass())
        {
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

    if (!function_exists('getUnitSupply')) {
        function getUnitSupply($type) {
            switch ($type) {
                case in_array($type, [\TDConst::CARTON, \TDConst::RUBBER, \TDConst::STYRO, \TDConst::MICA]):
                    return 'plate';
                    break;
                case in_array($type, [\TDConst::PAPER]):
                    return 'sheet';
                    break;
                case in_array($type, [\TDConst::MAGNET]):
                    return 'unit';
                    break;
                default:
                    return 'square';
                    break;
            }    
        }
    }

    if (!function_exists('checkUpdateOrderStatus')) {
        function checkUpdateOrderStatus($id, $status)
        {
            if (empty($id)) {
                return false;
            }
            return getCountDataTable('products', ['order' => $id]) == getCountDataTable('products', ['order' => $id, 'status' => $status]);
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
                    return [\TDConst::MILL,
                            \TDConst::ELEVATE, 
                            \TDConst::PEEL, 
                            \TDConst::CUT];
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
        function getStageActiveStartHandle($table, $id, $except = ''){
            $arr_select = getArrHandleField($table);
            if (!empty($except)) {
                $slice = (int) array_search($except, $arr_select) + 1;
                $arr_select = array_slice($arr_select,$slice);
            }
            $ret['type'] = \StatusConst::SUBMITED;
            $data = !empty($arr_select) ? \DB::table($table)->select($arr_select)->find($id) : [];
            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    $data_value = json_decode($value, true);
                    if (@$data_value['act'] == 1) {
                        $ret['type'] = $key;
                        $ret['handle'] = $data_value;
                        if (!empty($data_value['machine'])) {
                            $ret['machine_type'] = $key == \TDConst::PRINT ? $data_value['machine'] : getFieldDataById('type', 'devices', $data_value['machine']); 
                        }
                        return $ret;
                        break;
                    }
                }
            }
            return $ret;
        }
    }

    if (!function_exists('isQtyFormulaBySupply')) {
        function isQtyFormulaBySupply($key)
        {
            return in_array($key, [\TDConst::PRINT, \TDConst::NILON, \TDConst::METALAI, \TDConst::COMPRESS, \TDConst::UV, \TDConst::ELEVATE, \TDConst::FLOAT, \TDConst::CUT]);
        }
    }

    if (!function_exists('getSupplyNameByKey')) {
        function getSupplyNameByKey($key) {
            switch ($key) {
                case \TDConst::PAPER:
                    return 'Giấy in';
                    break;
                case \TDConst::NILON:
                    return 'Màng nilon';
                    break;
                case \TDConst::METALAI:
                    return 'Màng metalai';
                    break;
                case \TDConst::COVER:
                    return 'Màng phủ trên';
                    break;
                case \TDConst::CARTON:
                    return 'Vật tư carton';
                    break;
                case \TDConst::RUBBER:
                    return 'Cao su non';
                    break;
                case \TDConst::STYRO:
                    return 'Mút xốp';
                    break;
                case \TDConst::DECAL:
                    return 'Đề can nhung';
                    break;
                case \TDConst::SILK:
                    return 'Vải lụa';
                    break;
                case \TDConst::MICA:
                    return 'Vật tư mica';
                    break;
                case \TDConst::MAGNET:
                    return 'Nam châm';
                    break;
                default:
                    return "";
                    break;
            }
        }
    }

    if (!function_exists('getIconByStageHandle')) {
        function getIconByStageHandle($status)
        {
            switch ($status) {
                case 1:
                    return ['icon' => 'spinner', 'color' => 'main'];
                    break;
                case 2:
                    return ['icon' => 'check', 'color' => 'green'];
                    break;
                default:
                    return ['icon' => 'times', 'color' => 'red'];
                    break;
            }     
        }
    }

    if (!function_exists('getPrintInfo')) {
        function getPrintInfo($type, $color, $tech)
        {
            return [
                'type' => \TDConst::PRINT_TYPE[$type], 
                'color' => \TDConst::PRINT_COLOR[$color],
                'tech' => \TDConst::PRINT_TECH[$tech]
            ];
        }
    }

    if (!function_exists('getNameCommandWorker')) {
        function getNameCommandWorker($supply, $product_name)
        {
            $ext_name = !empty($supply->name) ? getFieldDataById('name', 'supply_names', $supply->name) : getTextSupply(@$supply->type);
            if (@$supply->type == \TDConst::CARTON) {
                return $product_name.'('.$ext_name.')';
            }
            if (@$supply->name) {
                return @$supply->name;
            }else{
                return $product_name;
            }
        }
    }

    if (!function_exists('getTextSupply')) {
        function getTextSupply($type)
        {
            return @\TDConst::ALL_SUPPLY[$type];
        }
    }

    if (!function_exists('getBaseNeedQtySquareSupply')) {
		function getBaseNeedQtySquareSupply($base_supp_qty, $supply_size)
		{
			$data_length = (float) @$supply_size['width'] < (float) @$supply_size['length'] ? (float) @$supply_size['width'] : (float) @$supply_size['length'];
			return $base_supp_qty * ($data_length/10);
		}
	}