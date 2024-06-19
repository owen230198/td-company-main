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
}
