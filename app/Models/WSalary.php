<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WSalary extends Model
{
    protected $table = 'w_salaries';
    protected $protectFields = false;
    function __construct($command, $handle, $worker)
    {
        $this->command = $command;
        $this->handle = $handle;
        $this->worker = $worker;
    }
    
    public function getPrintSalary($paper_qty)
    {
        $printer = !empty($this->handle['printer']) ? $this->handle['printer'] : [];
        $data_printer = Printer::find($printer);
        $work_price = !empty($data_printer['w_work_price']) ? (float) $data_printer['w_work_price'] : 0;
        $shape_price = !empty($data_printer['w_shape_price']) ? (float) $data_printer['w_shape_price'] : 0;
        $data['work_price'] = $work_price;
        $data['shape_price'] = $shape_price;
        $print_type = @$this->handle['type'];
        $print_tech = @$this->handle['machine'];
        $data_print_handle = getPrintInfo($print_type, @$this->handle['color'], $print_tech);
        $print_color = @$this->handle['color'] == \TDConst::APLA_PRINT_COLOR ? 1 : $this->handle['color'];
        $arr_handle = [
            ['name' => 'kiểu in', 'value' => $data_print_handle['type']],
            ['name' => 'màu in', 'value' => $data_print_handle['color']],
            ['name' => 'Công nghệ in', 'value' => $data_print_handle['tech']]
        ];
        $data['handle'] = json_encode($arr_handle);
        $data['supp_type'] = @$this->command->name;
        $data['total'] = Paper::getPrintFormula(@$this->handle['type'], $paper_qty, $print_color, $work_price, $shape_price);
        return $data;
    }
}
