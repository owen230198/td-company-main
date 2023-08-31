<?php
if (!function_exists('checkKeyWorkerExcept')) {
    function checkKeyWorkerExcept($key)
    {
        return in_array($key, [\TDConst::FILL, \TDConst::FINISH]);
    }
}

if (!function_exists('getTextMachineType')) {
    function getTextMachineType($type, $machine){
        $arr_device = getDeviceByKeyType($type);
        return @$arr_device[$machine];
    }
}

if (!function_exists('workerCommandIsProcessing')) {
    function workerCommandIsProcessing($supply)
    {
        return $supply->status == \StatusConst::PROCESSING && !empty($supply->worker_process);
    }
}

if (!function_exists('getDataWorkerCommand')) {
    function getDataWorkerCommand($type, $where, $get_count = false)
    {
        if (checkKeyWorkerExcept($type)) {
            $obj = \DB::table('fill_finishes')->where($where);
            if ($get_count) {
                return $obj->count();
            }else{
                return $obj->get()->map(function($item){
                    $item ->table = 'fill_finishes';
                    return $item;     
                })->toArray();
            }
        }else{
            $obj_papers = \DB::table('papers')->where($where);
            $obj_supplies = \DB::table('supplies')->where($where);
            if ($get_count) {
                return $obj_papers->count() + $obj_supplies->count();
            }else{
                return $obj_papers->get()->map(function($item){
                    $item ->table = 'papers';
                    return $item;        
                })->toArray() 
                + $obj_supplies->get()->map(function($item){
                    $item ->table = 'supplies';
                    return $item;     
                })->toArray();
            }
        }
    }

    if (!function_exists('getStatusWorkerCommand')) {
        function getStatusWorkerCommand($supply)
        {
            return workerCommandIsProcessing($supply) ? 'Đang gia công' : 'Chờ tiếp nhận';
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
}