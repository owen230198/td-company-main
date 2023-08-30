<?php
namespace App\Modules\Worker\Services;
use App\Services\BaseService;

class WorkerService extends BaseService
{
	function __construct()
	{
		parent::__construct();
	}
    public function getListDataHome($worker)
    {
        $type = @$worker['type'];
        $device = @$worker['device'];
        $where['status'] = $type; 
        $where_machine = ['machine_type' => $device];
        if (checkKeyWorkerExcept($type)) {
            $obj = \DB::table('fill_finishes')->where($where_machine);
            if ($type == \TDConst::FILL) {
                $obj =  $obj->where($where_machine);
            }
            return $obj->get()->map(function($item){
                $item ->table = 'fill_finishes';
                return $item;     
            })->toArray();
        }else{
            $obj_papers = \DB::table('papers')->where($where_machine);
            $obj_supplies = \DB::table('supplies')->where($where_machine);
            return $obj_papers->get()->map(function($item){
                $item ->table = 'pappers';
                return $item;        
            })->toArray() 
            + $obj_supplies->get()->map(function($item){
                $item ->table = 'supplies';
                return $item;     
            })->toArray();
        }
    }
}
