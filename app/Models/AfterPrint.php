<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AfterPrint extends Model
{
    protected $table = 'after_prints';
    protected $protectFields = false;
    static function getRole()
    {
        $role = [
            \GroupUser::KCS => [
                'view' => 
                [
                    'with' => ['key' => 'status', 'value' => \StatusConst::PROCESSING],
                ],
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }

    static function getFields($obj, $base_supp_qty)
    {
        return [
            [
                'name' => '',
                'note' => 'Số lượng tốt cần',
                'attr' => ['readonly' => 1],
                'value' => @$base_supp_qty,
                
            ],
            [
                'name' => '',
                'note' => 'Tên lệnh',
                'attr' => ['readonly' => 1],
                'value' => $obj->name,
            ],
            [
                'name' => '',
                'note' => 'Công nhân phụ trách',
                'attr' => ['readonly' => 1],
                'value' => getFieldDataById('name', 'w_users', $obj->worker),
            ],
            [
                'name' => '',
                'note' => 'Thợ in xác nhận tốt cần thực tế',
                'attr' => ['readonly' => 1],
                'value' => $obj->qty,
            ],
            [
                'name' => 'qty',
                'note' => 'KCS xác nhận (tốt cần)',
                'attr' => ['type_input' => 'number'],
                'value' => $obj->qty,
            ],
            [
                'name' => 'demo_qty',
                'note' => 'SL loại B (thử máy)',
                'attr' => ['type_input' => 'number'],
            ]
        ];
    }

    static function getInsertCode($id)
    {
        AfterPrint::where(['id' => $id])->update(['code' => 'QC-'.sprintf("%08s", $id)]);
    }
}
