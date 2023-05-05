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
            
        }
    }

    
?>