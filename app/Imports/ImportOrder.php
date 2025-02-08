<?php
namespace App\Imports;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToArray;
class ImportOrder implements ToModel, WithHeadingRow, SkipsEmptyRows, ToArray
{

    public function model(array $row)
    {
        $this->process($row);
    }

    private function process($row)
    {
        
    }
    public function array(array $array)
    {
        return $array[0];
    }
}

