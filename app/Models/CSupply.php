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
                    'view' => ['with' => 
                        [
                            'type' => 'group',
                            'query' => [
                                ['key' => 'supp_type', 'compare' => 'in', 'value' => \User::getSupplyRole()],
                                ['key' => 'status', 'value' => self::HANDLING]
                            ]
                        ],
                    ]
                ],
                \GroupUser::PLAN_HANDLE => [
                    'insert' => 1,
                    'view' => ['with' => 
                        [
                            'type' => 'group',
                            'query' => [
                                ['key' => 'created_by', 'value' => \User::getCurrent('id')]
                            ]
                        ],
                    ],
                    'update' => 
                    [
                        'with' => [[
                            'type' => 'group',
                            'query' => [
                                ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                ['key' => 'status', 'value' => self::HANDLING]
                            ]
                        ]]
                    ]
                ]
            ];
            return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
        }


        static function insertCommand($data, $supply)
        {
            $type = $supply->type;
            $data_command['name'] = getFieldDataById('name', 'supply_warehouses', $data['size_type']); 
            $data_command['size_type'] = $data['size_type'];
            $data_command['qty'] = $data['qty']; 
            $data_command['product'] = $supply->product;
            $data_command['supply'] = $supply->id;
            $data_command['supp_type'] = $type;
            $data_command['status'] = CSupply::HANDLING;
            (new \BaseService)->configBaseDataAction($data_command);
            $id = CSupply::insertGetId($data_command);
            self::getInsertCode($id);
            return 1;
        }

        static function getInsertCode($id)
        {
            CSupply::where(['id' => $id])->update(['code' => 'XVT-'.sprintf("%08s", $id)]);
        }

        static function getFieldConfirm($obj)
        {
            return [

            ];
        }
    }

?>