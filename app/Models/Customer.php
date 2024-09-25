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
                            ->orWhere('address', 'like', $q)
                            ->orWhere('tax_code', 'like', $q);
            });
        }
        $data = $customers->paginate(50)->all();
        $arr = array_map(function($item){
            return ['id' => @$item->id, 'label' => $item->code.' - '.$item->name];
        }, $data);
        return json_encode($arr);
    }

    static function getRole()
    {
        $role = [
            \GroupUser::SALE => [
                'insert' => 1,
                'view' => 1,
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
            \GroupUser::ACCOUNTING => [
                'insert' => 1,
                'view' => 1,
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
    public function afterRemove($id)
    {
        Represent::where('customer', $id)->delete();    
    }
}