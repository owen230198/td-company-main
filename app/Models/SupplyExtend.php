<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class SupplyExtend extends Model
    {
        protected $table = 'supply_extends';
        protected $protectFields = false;
        static function getRole()
        {
            $role = [
                \GroupUser::WAREHOUSE => [
                    'view' => 1,
                    // 'insert' => 1,
                    // 'update' => 1,
                ],
                \GroupUser::PRODUCT_WAREHOUSE => [
                    'view' => 1,
                    'insert' => 1,
                ],
                \GroupUser::PLAN_HANDLE => [
                    'insert' => 1,
                    'update' => 1,
                    'view' => 1
                ],
                \GroupUser::ACCOUNTING => [
                    'view' => 1,
                ]
            ];
            return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
        } 
    }


