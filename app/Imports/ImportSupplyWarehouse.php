<?php

namespace App\Imports;

use App\Models\SupplyWarehouse;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
class ImportSupplyWarehouse implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    static $type = '';
    function __construct($type)
    {
        self::$type = $type;
    }

    public function model(array $row)
    {
        if ($row['so_luong_kiem_thuc'] <= 0 || empty ($row['ma_hang']) || str_contains('_', $row['ma_hang'])) {
            return null;
        }
        $data = $this->getDataImport(self::$type, $row);
        return new SupplyWarehouse($data);
    }

    private function getDataImport($type, $row)
    {
        $ret =[
            'name' => $row['ten_hang'],
            'length' => getSizeByCodeMisa($row['ma_hang'], 'length'),
            'width' => getSizeByCodeMisa($row['ma_hang'], 'width'),
            'qty' => $row['so_luong_kiem_thuc'],
            'type' => $type,
            'supp_type' => $this->getTypeSupply($type, $row['ma_hang']),
            'supp_price' => $this->getSuppPrice($type, $row['ma_hang']),
            'status' => 'imported',
            'source' => 1,
            'note' => 'Nhập từ Misa',
            'act' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => 25
        ];
        return $ret;
    }

    static function isMN($code)
    {
        return str_contains($code, 'BM') || str_contains($code, 'BN');
    }
    
    static function get_type_supply_carton($code)
    {
        if (self::isMN($code)) {
            return 21;
        }elseif(str_contains($code, 'BT')){
            return 5;
        }
    }

    public function getTypeSupply($type, $code)
    {
        $method = "get_type_supply_$type";
        return self::$method($code);
    }

    static function get_supp_price_carton($code)
    {
        if (self::isMN($code)) {
            if (str_contains($code, '1.6') || str_contains($code, '1.5')) {
                return 117;
            }elseif (str_contains($code, '0.8') || str_contains($code, '0.9')){
                return 105;
            }elseif (str_contains($code, '1_') || str_contains($code, '1.0')){
                return 115;
            }elseif (str_contains($code, '1.2')){
                return 116;
            }elseif (str_contains($code, '1.8')){
                return 118;
            }elseif (str_contains($code, '2_') || str_contains($code, '2.0')){
                return 119;
            }elseif (str_contains($code, '2.2')){
                return 120;
            }elseif (str_contains($code, '2.5')){
                return 121;
            }elseif (str_contains($code, '3_')){
                return 122;
            }else{
                dd($code);
            }
        }else{
            if (str_contains($code, '1.6') || str_contains($code, '1.5')) {
                return 125;
            }elseif (str_contains($code, '0.8') || str_contains($code, '0.9')){
                return 106;
            }elseif (str_contains($code, '1_') || str_contains($code, '1.0')){
                return 123;
            }elseif (str_contains($code, '1.2')){
                return 124;
            }elseif (str_contains($code, '1.8')){
                return 126;
            }elseif (str_contains($code, '2_') || str_contains($code, '2.0')){
                return 127;
            }elseif (str_contains($code, '2.2')){
                return 128;
            }elseif (str_contains($code, '2.5')){
                return 129;
            }elseif (str_contains($code, '3_')){
                return 131;
            }else{
                dd($code);
            }  
        }
    }

    public function getSuppPrice($type, $code)
    {
        $method = "get_supp_price_$type";
        return self::$method($code);
    }
}

