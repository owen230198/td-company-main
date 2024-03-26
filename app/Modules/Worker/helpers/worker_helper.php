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

    if (!function_exists('getStatusWorkerCommand')) {
        function getStatusWorkerCommand($supply)
        {
            return workerCommandIsProcessing($supply) ? 'Đang gia công' : 'Chờ tiếp nhận';
        }
    }

    if (!function_exists('isQtyFormulaBySupply')) {
        function isQtyFormulaBySupply($key)
        {
            return in_array($key, [\TDConst::PRINT, \TDConst::NILON, \TDConst::METALAI, \TDConst::COMPRESS, \TDConst::UV, \TDConst::ELEVATE, \TDConst::FLOAT, \TDConst::CUT]);
        }
    }
}

if (!function_exists('checkFillToFinish')) {
    function checkFillToFinish($supply, $handle, $next_type)
    {
        $where = ['type' => \TDConst::FILL, 'table_supply' => 'fill_finishes','supply' => $supply->id, 'status' => \StatusConst::SUBMITED];
        $table_salary = 'w_salaries';
        $collection = \DB::table($table_salary)->Where($where);
        $command_materal = $collection->pluck('fill_materal')->all();
        $handle_materal = !empty($handle['stage']) ? array_column($handle['stage'], 'materal') : [];
        $bool = true;
        foreach ($handle_materal as $materal) {
            if (!in_array($materal, $command_materal)) {
                $bool = false;
                break;
            }
        }
        $arr_qty = [];
        foreach ($handle_materal as $materal_id) {
            $arr_qty[] = \DB::table($table_salary)->Where($where)->where('fill_materal', $materal_id)->sum('qty');
        }
        $next_where = ['type' => $next_type, 'table_supply' => 'fill_finishes','supply' => $supply->id];
        $min_command = collect($arr_qty)->min();
        $exist_next = \DB::table($table_salary)->Where($next_where)->sum('qty');
        return ['bool' => $bool, 'min_command' => $min_command - $exist_next, 'count_handle' => count($handle_materal)];
    }
}