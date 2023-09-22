<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Quote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quotes';
    protected $protectFields = false;
    const ORDER_CREATED = 'order_created';
    static $tableChild = array('q_papers', 'q_cartons', 'q_foams', 'q_silks', 'q_finishes');
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
                        'with' => 
                            [
                                ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                ['con'=> 'or', 'key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                            ]
                    ],
                'clone' => 1
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
    public function afterRemove($id)
    {
        $products = Product::where('quote_id', $id)->get();
        $childs = Product::$childTable;
        foreach ($products as $product) {
            $feild_file = Product::FEILD_FILE;
            foreach ($feild_file as $key => $feild_file) {
                if (!empty($product[$key])) {
                    removeFileData($product[$key]);
                }
            }
            (new \App\Services\AdminService)->removeDataTable('products', $product['id']);       
        }
    } 
}
