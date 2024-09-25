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
    function workerCommandIsProcessing($command)
    {
        return $command->status == \StatusConst::PROCESSING && !empty($command->worker);
    }
}

if (!function_exists('getDataWorkerCommand')) {
    function getDataWorkerCommand($where = [], $get_obj = false, $get_count = false, $paginate = 50)
    {
        $obj = \DB::table('w_salaries')->where($where)->orderBy('id', 'DESC');
        if ($get_obj) {
            return $obj;
        }
        if ($get_count) {
            return $obj->count();
        }else{
            if (!$paginate) {
                return $obj->paginate($paginate);
            }else{
                return $obj->get()->toArray();
            }
        }
    }
}

if (!function_exists('getStatusWorkerCommand')) {
    function getStatusWorkerCommand($supply)
    {
        return workerCommandIsProcessing($supply) ? 'Đang gia công' : 'Chờ tiếp nhận';
    }
}