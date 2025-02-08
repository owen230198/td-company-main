<?php

namespace App\Imports;

use App\Models\SquareWarehouse;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
class ImportSquareWarehouse implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    static $type = '';
    function __construct($type)
    {
        self::$type = $type;
    }

    public function model(array $row)
    {
        if ($row['so_luong'] <= 0) {
            return null;
        }
        $data = $this->getDataImport($row, self::$type);
        return new SquareWarehouse($data);
    }

    private function getDataImport($row, $type)
    {
        $name = $row['ten_vat_tu'];
        $membrane = getDataByWhere('materals', [['type', '=', $type], ['name', 'like', '%'.$name.'%']]);
        $weight = $row['so_luong'];
        $width = $row['kho_mang'];
        $is_emulsion = $type == 'emulsion';
        $ret =[
            'device' => getIdByFeildValue('SupplyName', [['type', '=', $type], ['name', 'like', '%'.$row['loai_mang'].'%']]),
            'name' => $is_emulsion ? $name : $membrane->name,
            'width' => $is_emulsion ? 64 : $width,
            'qty' => $is_emulsion ? 120 : $this->getQtyByType($membrane->factor, $weight, $width),
            'hank' => $row['so_cuon'],
            'weight' => $weight,
            'type' => $type,
            'supp_price' => $is_emulsion ? '' : $membrane->id,
            'status' => 'imported',
            'note' => 'Nhập từ Misa',
            'act' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => 25
        ];
        return $ret;
    }

    private function getQtyByType($factor, $qty, $width)
    {
        return (int)(($factor * $qty)/$width);
    } 
}

