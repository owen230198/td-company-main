<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WSalary extends Model
{
    protected $table = 'w_salaries';
    protected $protectFields = false;
    function __construct($command = [], $handle = [], $worker = [])
    {
        $this->command = $command;
        $this->handle = $handle;
        $this->worker = $worker;
    }

    static function getHandleDataJson($type, $handle, $get_array = false)
    {
        $arr = [];
        switch ($type) {
            case \TDConst::PRINT:
                $data_print_handle = getPrintInfo($handle['type'], @$handle['color'], $handle['machine']);
                $arr =  [
                    ['name' => 'kiểu in', 'value' => @$data_print_handle['type']],
                    ['name' => 'màu in', 'value' => @$data_print_handle['color']],
                    ['name' => 'Công nghệ in', 'value' => @$data_print_handle['tech']]
                ];
                break;
            case \TDConst::NILON:
                $arr = [
                    ['name' => 'Chất liệu cán', 'value' => getFieldDataById('name', 'materals', @$handle['materal'])],
                    ['name' => 'Số mặt cán', 'value' => @$handle['face']],
                    ['name' => 'Máy cán', 'value' => getFieldDataById('name', 'devices', @$handle['machine'])]
                ];
                break;
            case \TDConst::METALAI:
                $arr =  [
                    ['name' => 'Chất liệu cán', 'value' => getFieldDataById('name', 'materals', @$handle['materal'])],
                    ['name' => 'Số mặt cán', 'value' => @$handle['face']],
                ];
                if (!empty($handle['cover_materal'])) {
                    $arr[] = ['name' => 'Chất liệu cán phủ trên', 'value' => getFieldDataById('name', 'materals', @$handle['cover_materal'])];
                }
                if (!empty($handle['cover_face'])) {
                    $arr[] = ['name' => 'Số mặt cán phủ trên', 'value' => @$handle['cover_face']];
                }
                $arr[] = ['name' => 'Máy cán metalai', 'value' => getFieldDataById('name', 'devices', @$handle['machine'])];
                break;
            case \TDConst::UV:
                $arr = [
                    ['name' => 'Mực in', 'value' => getFieldDataById('name', 'materals', @$handle['materal'])],
                    ['name' => 'Số mặt in', 'value' => @$handle['face']],
                    ['name' => 'Máy in', 'value' => getFieldDataById('name', 'devices', @$handle['machine'])]
                ];
                break;
            case \TDConst::FINISH:
                if (!empty($handle['stage'])) {
                    foreach ($handle['stage'] as $key => $stage) {
                        $num = (int) $key + 1;
                        $arr[] = ['name' => 'Công đoạn '.$num, 'value' => getFieldDataById('name', 'devices', @$stage['materal'])];   
                    }
                }
                break;
            default:
                $arr =  @$handle['machine'] ? [['name' => 'Thiết bị máy', 'value' => getFieldDataById('name', 'devices', $handle['machine'])]] : [];
                break;
        }
        return $get_array ? $arr : json_encode($arr);
    }

    private function getBaseData()
    {
        $data['submited_at'] = \Carbon\Carbon::now();
        $data['handle'] = self::getHandleDataJson($this->worker['type'], $this->handle);
        return $data;
    }

    private function getBaseDatDevice()
    {
        $device = !empty($this->handle['machine']) ? $this->handle['machine'] : 0;
        $data_device = Device::find($device);
        $work_price = !empty($data_device['w_work_price']) ? (float) $data_device['w_work_price'] : 0;
        $shape_price = !empty($data_device['w_shape_price']) ? (float) $data_device['w_shape_price'] : 0;
        $data = $this->getBaseData();
        $data['work_price'] = $work_price;
        $data['shape_price'] = $shape_price;
        $data['factor'] = !empty($this->handle['factor']) ? (int) $this->handle['factor'] : 1;
        $data['handle'] = self::getHandleDataJson($this->worker['type'], $this->handle);
        return $data;
    }
    
    public function getPrintSalary($paper_qty)
    {
        $printer = !empty($this->handle['printer']) ? $this->handle['printer'] : [];
        $data_printer = Printer::find($printer);
        $work_price = !empty($data_printer['w_work_price']) ? (float) $data_printer['w_work_price'] : 0;
        $shape_price = !empty($data_printer['w_shape_price']) ? (float) $data_printer['w_shape_price'] : 0;
        $data = $this->getBaseData();
        $data['work_price'] = $work_price;
        $data['shape_price'] = $shape_price;
        $data['total'] = Paper::getPrintFormula(@$this->handle['type'], $paper_qty, $this->handle['color'], $work_price, $shape_price, 0, true);
        return $data;
    }

    public function getNilonSalary($paper_qty)
    {
        $data = $this->getBaseDatDevice();
        $face_num = (int) @$this->handle['face'];
        $data['total'] = Paper::getNilonMetalaiFormula($paper_qty, $data['work_price'], $face_num, $data['shape_price']);
        return $data;
    }
    public function getMetalaiSalary($paper_qty)
    {
        $data = $this->getBaseDatDevice();
        $face_num = (int) @$this->handle['face'];
        $cover_face_num = (int) @$this->handle['cover_face'];
        $metalai = Paper::getNilonMetalaiFormula($paper_qty, $data['work_price'], $face_num, $data['shape_price']);
        $cover = Paper::getNilonMetalaiFormula($paper_qty, $data['work_price'], $cover_face_num, $data['shape_price']);
        $data['total'] = $metalai + $cover;
        return $data;
    }

    public function getBaseSalaryPaper($qty_paper)
    {
        $data = $this->getBaseDatDevice();
        $data['total'] = $qty_paper * $data['work_price'] + $data['shape_price'];
        return $data;
    }

    public function getBaseSalaryProduct($product_qty)
    {
        $data = $this->getBaseDatDevice();
        $data['total'] = $product_qty * $data['work_price'] * $data['factor'] + $data['shape_price'];
        return $data;   
    }
    public function getFinishSalary($product_qty)
    {
        $data = $this->getBaseData();
        $data['work_price'] = 0;
        $data['shape_price'] = 0;
        $data['handle'] = self::getHandleDataJson($this->worker['type'], $this->handle);
        $data['total'] = 0;
        $stages = !empty($this->handle['stage']) ? $this->handle['stage'] : [];
        if (!empty($this->handle['stage'])) {
            foreach ($stages as $stage) {
                $device = !empty($stage['materal']) ? $stage['materal'] : 0;
                $data_device = Device::find($device);
                $work_price = !empty($data_device['w_work_price']) ? (float) $data_device['w_work_price'] : 0;
                $shape_price = !empty($data_device['w_shape_price']) ? (float) $data_device['w_shape_price'] : 0;
                $data['work_price'] += $work_price;
                $data['shape_price'] += $shape_price;
                $data['total'] += $product_qty * $work_price + $shape_price;
            }
        }
        return $data;
    }
    
    static function commandStarted($code, $data_command, $table_supply, $supply)
    {
        $insert_command = $data_command;
        $insert_command['command'] = $code;
        $insert_command['table_supply'] = $table_supply;
        $insert_command['supply'] = $supply->id;
        $insert_command['product'] = $supply->product;
        $insert_command['qty'] = !empty($data_command['qty']) ? $data_command['qty'] : (int) @$data_command['handle']['handle_qty'];
        if (!empty($data_command['handle'])) {
            $insert_command['handle'] = is_array($data_command['handle']) ? 
            WSalary::getHandleDataJson($insert_command['type'], $data_command['handle']) : 
            $data_command['handle'];
            $insert_command['factor'] = !empty($data_command['handle']['factor']) ? (int) $data_command['handle']['factor'] : 1;
        }
        $insert_command['status'] = Order::NOT_ACCEPTED;
        (new \BaseService)->configBaseDataAction($insert_command);
        return WSalary::insert($insert_command);  
    }

    static function checkStatusUpdate($table, $id, $status)
    {
        $list_command = WSalary::where(['table_supply' => $table, 'supply' => $id])->get();
        $bool = true;
        foreach ($list_command as $command) {
            if (@$command->status != $status) {
                $bool = false;
                break;
            }
        }
        if ($bool) {
            $supply_obj = getModelByTable($table)->where('id', $id);
            $arr_update = ['status' => $status, 'updated_at' => date('Y-m-d H:i:s', Time())];
            $update_supply = $supply_obj->update($arr_update);
            if ($update_supply) {
                $data_supply = $supply_obj->first();
                if (!empty($data_supply->product) && WSalary::where('product', $data_supply->id)->where('status', '!=', $status)->count() == 0) {
                    $update = Product::where('id', $data_supply->product)->update($arr_update);
                    if ($update) {
                        $data_product = Product::find($data_supply->product);
                        if (checkUpdateOrderStatus($data_product->order, $status)) {
                            Order::where('id', $data_product->order)->update($arr_update);
                        }
                    }
                }
            }
        }
        return true;
    }
}
