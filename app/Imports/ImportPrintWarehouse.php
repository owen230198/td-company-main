<?php

namespace App\Imports;

use App\Models\PrintWarehouse;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithMappedCells;
class ImportPrintWarehouse implements ToModel, WithHeadingRow, SkipsEmptyRows, WithMappedCells
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
        dd($row);
        return new PrintWarehouse([
            'name' => $row['name'],
            'length' => @$row['length'],
            'width' => @$row['width'],
        ]);
    }

    public function map($row): array
    {
        $size = getSizeByCodeMisa($row['ma_hang']);
        $row['name'] = str_contains($row['ma_hang'], 'ALSE') ? 'Đề can ALSE' : 'Đề can giấy';
        $row['length'] = @$size['length'];
        $row['width'] = @$size['width'];
        dd($row);
        return $row;
    }

    public function mapping(): array
    {
        return [
            
        ];
    }

    private function isHeaderRow($row)
    {
        return @$row['tong_hop_ton_kho'] === 'Kho: Kho NVL; Từ ngày 01/6/2024 đến ngày 18/6/2024';
    }
}

