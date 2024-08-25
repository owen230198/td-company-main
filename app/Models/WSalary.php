<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function totalhandle($qty, $type)
    {
        switch ($type) {
            case \TDConst::PRINT:
                $data_update = $this->getPrintSalary($qty);
                break;
            case \TDConst::NILON:
                $data_update = $this->getNilonSalary($qty);
                break;
            case \TDConst::METALAI:
                $data_update = $this->getMetalaiSalary($qty);
                break;
            case \TDConst::FINISH:
                $data_update = $this->getFinishSalary($qty);
                break;
            case \TDConst::ELEVATE:
                // $handle_elevate = !empty($supply->handle_elevate) ? json_decode($supply->handle_elevate, true) : [];
                // $elevate_num = !empty($handle_elevate['num']) ? (int) $handle_elevate['num'] : 1;
                $data_update = $this->getBaseSalaryPaper($qty);
                if (!empty($data_handle['float']['act'])) {
                    $data_update['total'] += (float) getDataConfig('QuoteConfig', 'ELEV_FLOAT_PRICE');
                }
                break;
            case !isQtyFormulaBySupply($type):
                $data_update = $this->getBaseSalaryProduct($qty);
                break;
            default:
                $data_update = $this->getBaseSalaryPaper($qty);
                break;
        }
        return $data_update;
    }

    static function getRole()
    {
        $role = [
            \GroupUser::TECH_APPLY => [
                'view' => 1,
            ],
            \GroupUser::PLAN_HANDLE => [
                'view' => 1
            ],
            \GroupUser::ACCOUNTING => [
                'view' => 1,
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    } 

    static function getHandleDataJson($type, $handle, $get_array = false, $get_extra = false)
    {
        $arr = [];
        switch ($type) {
            case \TDConst::SIZE:
                $arr =  [
                    ['name' => 'Chất liệu giấy', 'value' => getFieldDataById('name', 'materals', @$handle['materal'])],
                    ['name' => 'Định lượng', 'value' => @$handle['qttv']],
                    ['name' => 'KT khổ giấy', 'value' => @$handle['length'] . ' x '.$handle['width']]
                ];
                 break;
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
                    ['id' => @$handle['machine'], 'name' => 'Máy cán', 'value' => getFieldDataById('name', 'devices', @$handle['machine'])]
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
                $arr[] = ['id' => @$handle['machine'], 'name' => 'Máy cán metalai', 'value' => getFieldDataById('name', 'devices', @$handle['machine'])];
                break;
            case \TDConst::COMPRESS:
                $arr = [
                    ['name' => 'Giá Ép Nhũ/1 Sản Phẩm', 'value' => @$handle['price']],
                ];
                if ($get_extra) {
                    $arr[] = ['name' => 'Tiền khuôn/bát sản phẩm', 'value' => @$handle['shape_price']];
                    $arr[] = ['id' => @$handle['machine'], 'name' => 'Máy ép nhũ', 'value' => getFieldDataById('name', 'devices', @$handle['machine'])];
                }
                break;
            case \TDConst::UV:
                $arr = [
                    ['name' => 'Mực in', 'value' => getFieldDataById('name', 'materals', @$handle['materal'])],
                    ['name' => 'Số mặt in', 'value' => @$handle['face']],
                    ['id' => @$handle['machine'], 'name' => 'Máy in', 'value' => getFieldDataById('name', 'devices', @$handle['machine'])]
                ];
                break;
            case \TDConst::ELEVATE:
                $arr = [
                    ['name' => 'Thêm Giá Cho Khuôn Phức Tạp', 'value' => @$handle['ext_price']],
                    ['id' => @$handle['machine'], 'name' => 'Máy bế', 'value' => getFieldDataById('name', 'devices', @$handle['machine'])]
                ];
                if (!empty($handle['float']['act'])) {
                    $arr[] = ['name' => 'Thúc Nổi', 'value' => 'Có'];
                    if ($get_extra) {
                        $arr[] = ['name' => 'Giá Tiền Thúc Nổi 1 Sp', 'value' => @$handle['ext_price']];
                        $arr[] = ['name' => 'Tiền khuôn/ bát sản phẩm', 'value' => @$handle['shape_price']];
                    }
                }
                break;
            case \TDConst::PEEL:
                $arr = [
                    ['name' => 'Số bát lề', 'value' => @$handle['nqty']],
                    ['id' => @$handle['machine'], 'name' => 'máy bóc lề', 'value' => getFieldDataById('name', 'devices', @$handle['machine'])]
                ];
                break;
            case \TDConst::EXT_PRICE:
                $arr = [
                    ['name' => 'Chi phí tem', 'value' => @$handle['temp_price']],
                    ['name' => 'Chi phí toa', 'value' => @$handle['prescript_price']],
                    ['name' => 'Chi phí vật tư khác', 'value' => @$handle['supp_price']],
                ];
                break;
            case \TDConst::FILL:
                if (!empty($handle['stage'])) {
                    foreach ($handle['stage'] as $key => $stage) {
                        $num = (int) $key + 1;
                        $arr[] = [
                            'id' => @$stage['machine'], 
                            'name' => 'Công đoạn bồi hộp '.$num, 
                            'value' => 'KT: '.$stage['length'] . ' x ' . $stage['width'] 
                            .', CL: '.getFieldDataById('name', 'materals', @$stage['materal'])
                            .', TB: '.getFieldDataById('name', 'devices', @$stage['machine'])
                        ];   
                    }
                }
                if ($get_extra) {
                    $arr[] = ['name' => 'Phát sinh chi tiết bồi khó', 'value' => @$handle['ext_price']];
                }
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
                $arr =  @$handle['machine'] ? [['id' => $handle['machine'], 'name' => 'Thiết bị máy', 'value' => getFieldDataById('name', 'devices', @$handle['machine'])]] : [];
                break;
        }
        if ($get_extra && !empty($handle['note'])) {
            $arr[] = ['name' => 'Ghi chú', 'value' => $handle['note']];
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
        $printer = !empty($this->handle['printer']) ? $this->handle['printer'] : 0;
        $data_printer = Printer::find($printer);
        $work_price = !empty($data_printer['w_work_price']) ? (float) $data_printer['w_work_price'] : 0;
        $shape_price = !empty($data_printer['w_shape_price']) ? (float) $data_printer['w_shape_price'] : 0;
        $data = $this->getBaseData();
        $data['work_price'] = $work_price;
        $data['shape_price'] = $shape_price;
        $factor = !empty($this->handle['factor']) ? $this->handle['factor'] : ($this->handle['color'] > 2 && $this->handle['color'] < 5 && @$data_printer['print_length'] == 72 ? 2 : 1);
        $data['factor'] = $factor;
        $data['total'] = Paper::getPrintFormula(@$this->handle['type'], $paper_qty, $this->handle['color'], $work_price, $shape_price, 0, true, $factor);
        return $data;
    }

    public function getNilonSalary($paper_qty)
    {
        $data = $this->getBaseDatDevice();
        $face_num = (int) @$this->handle['face'];
        $factor = @$data['factor'] ?? 1;
        $data['total'] = Paper::getNilonMetalaiFormula($paper_qty, $data['work_price'], $face_num, $data['shape_price'], $factor);
        return $data;
    }
    public function getMetalaiSalary($paper_qty)
    {
        $data = $this->getBaseDatDevice();
        $face_num = (int) @$this->handle['face'];
        $cover_face_num = (int) @$this->handle['cover_face'];
        $metalai = Paper::getNilonMetalaiFormula($paper_qty, $data['work_price'], $face_num, $data['shape_price'], $data['factor']);
        $cover = Paper::getNilonMetalaiFormula($paper_qty, $data['work_price'], $cover_face_num, $data['shape_price'], $data['factor']);
        $data['total'] = $metalai + $cover;
        return $data;
    }

    public function getBaseSalaryPaper($qty_paper)
    {
        $data = $this->getBaseDatDevice();
        $data['total'] = $qty_paper * $data['work_price'] * $data['factor'] + $data['shape_price'];
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
        $factor = @$this->handle['factor'] ?? 1;
        if (!empty($this->handle['factor'])) {
            foreach ($stages as $stage) {
                $device = !empty($stage['materal']) ? $stage['materal'] : 0;
                $data_device = Device::find($device);
                $work_price = !empty($data_device['w_work_price']) ? (float) $data_device['w_work_price'] : 0;
                $shape_price = !empty($data_device['w_shape_price']) ? (float) $data_device['w_shape_price'] : 0;
                $data['work_price'] += $work_price;
                $data['shape_price'] += $shape_price;
                $data['total'] += $product_qty * $work_price * $factor + $shape_price;
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

    static function checkSubmitedProduct($product_id)
    {
        $status = \StatusConst::SUBMITED;
        $arr_update = ['status' => $status, 'updated_at' => \Carbon\Carbon::now()];
        $update = Product::where('id', $product_id)->update($arr_update);
        if ($update) {
            $data_product = Product::find($product_id);
            if (!empty($data_product->order)) {
                if (checkUpdateOrderStatus($data_product->order, $status)) {
                    Order::where('id', $data_product->order)->update($arr_update);
                }
            }
        }
    }

    static function checkStatusUpdate($table, $supply_id, $status)
    {
        $supply_obj = getModelByTable($table)->find($supply_id);
        $list_command = WSalary::where(['table_supply' => $table, 'supply' => $supply_id])->get();
        $bool = true;
        foreach ($list_command as $command) {
            if (@$command->status != $status) {
                $bool = false;
                break;
            }
        }
        if ($bool && !empty($supply_obj)) {
            $supply_obj->status = $status;
            $supply_obj->updated_at = \Carbon\Carbon::now();
            $supply_obj->save();
            if ($table =='papers' && @$supply_obj->is_join == 1) {
                $paper_childs = Paper::where('parent', $supply_id)->get();
                foreach ($paper_childs as $paper_child) {
                    self::checkStatusUpdate('papers', $paper_child->id, $status);
                }
            }
            $product_bool = true;
            $product_id =  $supply_obj->product;
            foreach (Product::$childTable as $table) {
                if (getModelByTable($table)::where('product', $product_id)->where('status', '!=', $status)->count() > 0) {
                    $product_bool = false;
                    break;
                }
            }
            if ($product_bool) {
                self::checkSubmitedProduct($product_id);
            }
        }
        return true;
    }
}
