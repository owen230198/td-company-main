<?php

namespace App\Imports;

use App\Models\ExtendWarehouse;
use App\Models\SupplyExtend;
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
        if ($row['so_luong'] <= 0 || empty ($row['ten'])) {
            return null;
        }
        $data = $this->getDataImport(self::$type, $row);
        return new ExtendWarehouse($data);
    }

    private function getDataImport($type, $row)
    {
        $type_data = $row['loai'];
        $supp_extend = SupplyExtend::where('name', $type_data)->get()->first();
        $type = !empty($supp_extend->id) ? $supp_extend->id : insertGetIdData('supply_extends', ['name' => $type_data]);
        $ret =[
            'type' => $type,
            'name' => $row['ten'],
            'ver' => @$row['ban'],
            'qty' => $row['so_luong'],
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

