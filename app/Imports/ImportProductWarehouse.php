<?php

namespace App\Imports;
use App\Models\ProductWarehouse;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToArray;
class ImportProductWarehouse implements ToModel, WithHeadingRow, SkipsEmptyRows, ToArray
{
    static $warehouse_tye = '';
    function __construct($warehouse_tye)
    {
        self::$warehouse_tye = $warehouse_tye;
    }

    public function model(array $row)
    {
        if ($this->isHeaderRow($row) || $row['qty'] <= 0 || empty ($row['name'])) {
            return null;
        }
        // $data = $this->getDataImport(self::$warehouse_tye, $row);
        // return new ProductWarehouse($data);
    }

    private function getDataImport($type, $row)
    {
        $ret =$row;
        $ret['warehouse_type'] = $type;
        $ret['category'] = getIdByFeildValue('ProductCategory', ['name' => $row['category']]);
        $ret['style'] = getIdByFeildValue('ProductStyle', ['name' => $row['style']]);
        $ret['note'] = 'kiểm kho thực tế';
        $ret['made_by'] = 1;
        $ret['act'] = 1;
        $ret['created_at'] = Carbon::now();
        $ret['updated_at'] = Carbon::now();
        $ret['created_by'] = 25;
        return $ret;
    }

    private function isHeaderRow($row)
    {
        
    }

    public function array(array $array)
    {
        return $array[0];
    }
}

