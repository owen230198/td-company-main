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
        $width = $this->getWidthByName($row['ten_hang']);
        $data = $this->getDataImport($type, $width, $row);
        return new SquareWarehouse($data);
    }

    private function getDataImport($type, $width, $row)
    {
        $ret =[
            'name' => $row['ten_hang'],
            'width' => $width,
            'qty' => (int) $this->getQtyByType($row['ten_hang'], $row['so_luong_kiem_thuc'], $width),
            'convert_unit' => $this->getConvertUnit($type),
            'type' => $type,
            'supp_price' => self::getSuppPrice($row['ten_hang']),
            'status' => 'imported',
            'note' => 'Nhập từ Misa',
            'act' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => 25
        ];
        return $ret;
    }

    static function getSuppPrice($name, $get_type = false)
    {
        if (stripos($name, 'Màng bóng') !== false) {
            return $get_type ? 'nilon' : 8;
        }elseif (stripos($name, 'Màng mờ') !== false){
            return $get_type ? 'nilon' : 9;
        }elseif(stripos($name, 'Màng metalai') !== false){
            return $get_type ? 'metalai' : 36;
        }
    }

    private function getWidthByName($name)
    {
        $arr_width = preg_split('/khổ/i', $name);
        return $arr_width[1];
    }

    private function getQtyByType($name, $qty, $width)
    {
        $factor = $this->getConvertUnit($name);
        return ($factor * $qty)/$width;
    }

    private function getConvertUnit($name)
    {
        if (self::getSuppPrice($name) == 8) {
            return 757600;
        }elseif (self::getSuppPrice($name) == 9) {
            return 735300;
        }elseif (self::getSuppPrice($name) == 36){
            return 400000;  
        }
    }    
}

