<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CSupply extends Model
{
    protected $table = 'c_supplies';
    protected $protectFields = false;
    //status
    const NOT_HANDLE = 'not_handle';
    const HANDLING = 'handling'; 
    const HANDLED= 'handled';

    //type
    const IMPORT = 1;
    const EXPORT = 2;
    
    static function getRole()
    {
        $role = [
            \GroupUser::WAREHOUSE => [
                'view' => ['with' => ['key' => 'status', 'value' => self::HANDLING]]
            ],
            \GroupUser::PLAN_HANDLE => [
                'view' => ['with' => 
                    [
                        'type' => 'group',
                        'query' => [
                            ['key' => 'status', 'value' => self::HANDLING],
                            ['key' => 'created_by', 'value' => \User::getCurrent('id')]
                        ]
                    ],
                ]
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }

    static function insertCommand($data, $supply)
    {
        $data_command = $data;
        $data_command['code'] = 'XVT-'.getCodeInsertTable('c_supplies');
        $data_command['name'] = getFieldDataById('name', 'products', $supply->product); 
        $data_command['product'] = $supply->product;
        $data_command['supply'] = $supply->id;
        $data_command['supp_type'] = $supply->type;
        $data_command['status'] = CSupply::HANDLING;
        (new \BaseService)->configBaseDataAction($data_command);
        return CSupply::insert($data_command);
    }
}

?>