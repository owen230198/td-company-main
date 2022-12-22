<?php
    use \App\Constants\OrderConstant;
    if (!function_exists('getPaymentStatus')) {
        function getPaymentStatus($advanceCost, $totalCost)
        {
            if ($advanceCost == 0) {
                return OrderConstant::ORD_NOT_PAYMENT;   
            }elseif ($advanceCost>0&&$advanceCost<$totalCost) {
                return OrderConstant::ORD_ADVANCE_PAYMENT;
            }elseif ($advanceCost>0&&$advanceCost==$totalCost) {
                return OrderConstant::ORD_PAID_PAYMENT;
            }else{
                return '';
            }
        }
    }

    if (!function_exists('getProductCategoryOption')) {
        function getProductCategoryOption()
        {
            $arr['listTypeProcate'] = OrderConstant::PRO_CATE_TYPE;
            $arr['listProCate'] = getDataTable('product_categories', '*', 
            [['key'=>'act', 'compare'=>'=', 'value'=>1]], 0, 'name', 'asc', true);
            $arr['listPaperSubs'] = getDataTable('p_substances', ['id', 'name'],[['key'=>'act', 'compare'=>'=', 'value'=>1]], 0, 'name', 'asc', true);
            return $arr;
        }
    }

    if (!function_exists('getCountDataNotAcceptedTable')) {
        function getCountDataNotAcceptedTable($table)
        {
            return 200;
        }
    }
?>