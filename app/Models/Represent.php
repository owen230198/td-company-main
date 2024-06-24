<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Represent extends Model
{
    protected $table = 'represents';
    protected $protectFields = false;
    const FIELD_UPDATE = [
        ['name' => 'name', 'note' => 'Người liên hệ', 'attr' => ['required' => 1]],
        ['name' => 'phone', 'note' => 'Số di động', 'attr' => ['required' => 1], 'attr' => ['required' => 1, 'placehoder' => 'Viết số liền']],
        ['name' => 'telephone', 'note' => 'Số cố định', 'attr' => ['placehoder' => 'Viết số liền']],
        ['name' => 'email', 'note' => 'Email', 'attr' => ['required' => 1]],
    ];

    static function getCustomer($id, $field = null)
    {
        $represent = Represent::find($id);
        if (!empty($represent->customer)) {
            $customer = Customer::find($represent->customer);
            return !empty($field) ? @$customer->{$field} : $customer;
        }else{
            return '';
        }
    }

    static function getRole()
    {
        $role = [
            \GroupUser::SALE => [
                'insert' => 1,
                'view' => 
                    [
                        'with' => ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                    ],
                'update' => 
                    [
                        'with' => [[
                            'type' => 'group',
                            'query' => [
                                ['key' => 'created_by', 'value' => \User::getCurrent('id')]
                            ]
                        ]]
                    ]
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }

    static function getFieldUpdateLinking()
    {
        return [
            [
                'name' => 'name',
                'attr' => ['required' => 1],
                'note' => 'Tên người đại diện',
                'type' => 'text'
            ],
            [
                'name' => 'phone',
                'attr' => ['required' => 1], 
                'note' => 'SĐT',
                'type' => 'text'
            ],
            [
                'name' => 'telephone', 
                'note' => 'SĐT cố định',
                'type' => 'text'
            ],
            [
                'name' => 'email', 
                'note' => 'Email',
                'type' => 'text'
            ]
        ];
    }
}
