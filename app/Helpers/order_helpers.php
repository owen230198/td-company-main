<?php
    use \App\Models\Order;
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

    
?>