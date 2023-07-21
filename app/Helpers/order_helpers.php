<?php
    use \App\Models\Order;
    use \App\Models\CSupply;
    if (!function_exists('getOrderNameStageByKey')) {
        function getOrderNameStageByKey($key)
        {
            switch ($key) {
                case Order::NOT_ACCEPTED:
                    return 'Duyệt xuống P. Thiết kế';
                    break;
                case Order::DESIGN_SUBMITED:
                    return 'Duyệt xuống P. Kế hoạch';
                    break;
                case Order::TECH_SUBMITED:
                    return 'Xác nhận xuất khuôn';
                    break;
                default:
                    return '';
                    break;
            }    
        }
    }

    if (!function_exists('getProductElementData')) {
        function getProductElementData($category, $id)
        {
            $ret = isHardBox($category) ? \TDConst::HARD_ELEMENT : \TDConst::PAPER_ELEMENT;
            $where = ['act' => 1, 'product' => $id];
            foreach ($ret as $key => $item) {
                if ($item['table'] == 'supplies') {
                    $where['type'] = $item['pro_field'];
                }
                $ret[$key]['data'] = \DB::table($item['table'])->where($where)->get()->toArray();
                unset($where['type']);
            }
            return $ret;
        }
    }

    if (!function_exists('getHandleSupplyStatus')) {
        function getHandleSupplyStatus($product, $supply, $type)
        {
            $command = \DB::table('c_supplies')->where(['product' => $product, 'supply' => $supply, 'supp_type' => $type])->first();
            if (empty($command)) {
                return CSupply::NOT_HANDLE;
            }
            return @$command->status;
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
?>