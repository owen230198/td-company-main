<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';
    protected $protectFields = false;

    const FIELD_UPDATE = [
        ['name' => 'name', 'note' => 'Tên công ty', 'attr' => ['required' => 1]],
        ['name' => 'contacter', 'note' => 'Người liên hệ', 'attr' => ['required' => 1]],
        ['name' => 'phone', 'note' => 'Số di động', 'attr' => ['required' => 1], 'attr' => ['required' => 1, 'placehoder' => 'Viết số liền']],
        ['name' => 'telephone', 'note' => 'Số cố định', 'attr' => ['placehoder' => 'Viết số liền']],
        ['name' => 'email', 'note' => 'Email', 'attr' => ['required' => 1]],
        ['name' => 'address', 'note' => 'Địa chỉ', 'attr' => ['required' => 1]],
        ['name' => 'city', 'type' => 'linking', 'note' => 'Tỉnh/Thành phố', 'attr' => ['required' => 1],
        'other_data' => [
            'config' => ['search' => 1, 'ajax' => 1],
            'data' => ['table' => 'citys', 'where' => ['parent' => 0]] 
            ] 
        ]
    ];

    static function getInsertCode($id)
    {
        Customer::where(['id' => $id])->update(['code' => 'KH-'.sprintf("%08s", $id)]);
    }

    static function getDataJsonLinking($customers, $q)
    {
        if (!empty($q)) {
            $q = '%'.trim($q).'%';
            $customers->where(function ($customers) use ($q) {
                $customers->orWhere('code', 'like', $q)
                            ->orWhere('name', 'like', $q)
                            ->orWhere('contacter', 'like', $q)
                            ->orWhere('phone', 'like', $q)
                            ->orWhere('telephone', 'like', $q)
                            ->orWhere('email', 'like', $q)
                            ->orWhere('address', 'like', $q)
                            ->orWhere('city', 'like', $q)
                            ->orWhere('tax_code', 'like', $q);
            });
        }
        $data = $customers->paginate(50)->all();
        $arr = array_map(function($item){
            return ['id' => @$item->id, 'label' => $item->code.' - '.$item->name];
        }, $data);
        return json_encode($arr);
    }
}