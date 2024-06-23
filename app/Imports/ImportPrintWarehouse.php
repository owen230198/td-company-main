<?php

namespace App\Imports;

use App\Models\PrintWarehouse;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
class ImportPrintWarehouse implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    static $type = '';
    function __construct($type)
    {
        self::$type = $type;
    }

    public function model(array $row)
    {
        if ($this->isHeaderRow($row) || $row['cuoi_ky'] <= 0 || empty ($row['ma_hang'])) {
            return null;
        }
        $data = $this->getDataImport(self::$type, $row);
        return new PrintWarehouse($data);
    }

    private function getDataImport($type, $row)
    {
        $ret =[
            'name' => '',
            'length' => getSizeByCodeMisa($row['ma_hang'], 'length'),
            'width' => getSizeByCodeMisa($row['ma_hang'], 'width'),
            'qty' => $row['cuoi_ky'],
            'type' => 'paper',
            'status' => 'imported',
            'source' => 1,
            'note' => 'Nhập từ Misa',
            'act' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => 25
        ];
        if ($type == 'decal') {
            $ret['qtv'] = 300;
            $ret['supp_price'] = 34;
        }elseif ($type == 'couches'){
            $ret['qtv'] = getQtvByCodeMisa($row['ma_hang'], 'C');
            $ret['supp_price'] = 12;
        }
        elseif ($type == 'ivory'){
            $ret['qtv'] = getQtvByCodeMisa($row['mam_hang'], 'i');
            $ret['supp_price'] = 13;
        }
        return $ret;
    }

    private function isHeaderRow($row)
    {
        return @$row['tong_hop_ton_kho'] === 'Kho: Kho NVL; Từ ngày 01/6/2024 đến ngày 18/6/2024';
    }
}

