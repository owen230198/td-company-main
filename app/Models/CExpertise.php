<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CExpertise extends Model
{
    protected $table = 'c_expertises';
    protected $protectFields = false;
    //Status Expertise
    const FULL = 'full';
    const PROBLEM = 'prob';
    //Handle problem product
    const REWORK = 'rework';
    const NOT_REWORK = 'not_rework';

    static function getRole()
    {
        $role = [
            \GroupUser::KCS => [
                'view' => 
                    [
                        'with' => [
                            'type' => 'group',
                            'query' => [
                                ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED],
                                ['key' => 'created_by', 'value' => \User::getCurrent()]
                            ]
                        ]
                    ]
            ],
            \GroupUser::PRODUCT_WAREHOUSE => [
                'view' => [
                    'with' => ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                ]
                ],
                \GroupUser::ACCOUNTING => [
                    'view' => [
                        'with' => ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                    ]
                ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
}
