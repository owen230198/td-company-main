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
}

?>