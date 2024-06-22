<?php

namespace App\Imports;

use App\Models\PrintWarehouse;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

use function PHPUnit\Framework\stringContains;

class ImportPrintWarehouse implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($this->isHeaderRow($row) || $row['cuoi_ky'] <= 0) {
            return null;
        }
        $name = str_contains($row['ma_hang'], 'ALSE') ? 'Đề can ALSE' : 'Đề can giấy';
        $size = getStringAfterSlash($row['ma_hang']);
        $arr_size = explode('x', $size);
        $length = $arr_size[0] > $arr_size[1] ? $arr_size[0] : $arr_size[1];
        $width = $arr_size[0] > $arr_size[1] ? $arr_size[1] : $arr_size[0];
        return new PrintWarehouse([
            'name' => $name,
            'length' => $length,
            'width' => $width,
        ]);
    }

    private function isHeaderRow($row)
    {
        return @$row['tong_hop_ton_kho'] === 'Kho: Kho NVL; Từ ngày 01/6/2024 đến ngày 18/6/2024';
    }
}

