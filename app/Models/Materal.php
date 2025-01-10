<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Materal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'materals';
    protected $protectFields = false;
    
    static function getDataJsonLinking($materal, $q)
    {
        if (!empty($q)) {
            $materal->where(function ($materal) use ($q) {
                $materal->orWhere('name', 'like', '%'.trim($q).'%');
            });
        }
        $data = $materal->paginate(50)->all();
        $arr = array_map(function($item){
            return [
                'id' => @$item->id, 
                'label' => $item->name
            ];
        }, $data);
        $arr[] = ['id' => SupplyBuying::OTHER, 'label' => 'Loại khác'];
        return json_encode($arr);
    }
}