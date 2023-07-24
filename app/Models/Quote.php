<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class Quote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quotes';
    protected $protectFields = false;
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
                    ]
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
    public function afterRemove($id)
    {
        $products = Product::where('quote_id', $id)->get('id');
        $childs = Product::$childTable;
        foreach ($products as $product) {
            $remove_pro = Product::where('id', $product['id'])->delete();
            if ($remove_pro) {
                foreach ($childs as $table) {
                    \DB::table($table)->where('product', $product['id'])->delete();
                }
            }        
        }
    } 
}
