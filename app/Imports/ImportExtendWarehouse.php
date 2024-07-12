<?php

namespace App\Imports;

use App\Models\ExtendWarehouse;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
class ImportExtendWarehouse implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    static $type = '';
    function __construct($type)
    {
        self::$type = $type;
    }

    public function model(array $row)
    {
        if ($row['so_luong_kiem_thuc'] <= 0 || empty ($row['ten_hang'])) {
            return null;
        }
        $data = $this->getDataImport(self::$type, $row);
        return new ExtendWarehouse($data);
    }

    private function getDataImport($type, $row)
    {
        $ret =[
            'type' => $type,
            'name' => $row['ten_hang'],
            'qty' => $row['so_luong_kiem_thuc'],
            'unit' => getKeyUnitKeyWarehouse($row['dvt']),
            'status' => 'imported',
            'note' => 'Nhập từ Misa',
            'act' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => 25
        ];
        return $ret;
    }
}

