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
        return !empty($supply->worker_process);
    }
}