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
        $type = $this->getSuppPrice($row['ten_hang'], true);
        if ($row['so_luong_kiem_thuc'] <= 0 || empty ($row['ma_hang'])) {
            return null;
        }
        $data = $this->getDataImport($type, $row);
        return new SquareWarehouse($data);
    }

    private function getDataImport($type, $row)
    {
        $ret =[
            'name' => '',
            'width' => $this->getWidthByName($row['ten_hang']),
            'qty' => $this->getQtyByType($type, $row['so_luong_kiem_thuc']),
            'convert_unit' => $this->getConvertUnit($type),
            'type' => $type,
            'supp_price' => $this->getSuppPrice($row['ten_hang']),
            'status' => 'imported',
            'note' => 'Nhập từ Misa',
            'act' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => 25
        ];
        return $ret;
    }

    private function getSuppPrice($name, $get_type = false)
    {
        if (stripos('Màng bóng', $name)) {
            return $get_type ? 'nilon' : 8;
        }elseif (stripos('Màng mờ', $name)){
            return $get_type ? 'nilon' : 9;
        }elseif(stripos('Màng metalai', $name)){
            return $get_type ? 'metalai' : 36;
        }
    }

    private function getWidthByName($name)
    {
        $arr_width = preg_split('/khổ/i', $name);
        return $arr_width[1];
    }

    private function getQtyByType($type, $qty)
    {
        $factor = $this->getConvertUnit($type);
    }

    
}

