<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProviderPrice extends Model
{
    protected $table = 'provider_prices';
    protected $protectFields = false;
    protected $guarded = [];

    static function getLabelLinking($data)
    {
        if (empty($data)) {
            return '';
        }
        return getFieldDataById('name', 'warehouse_providers', $data->provider);
    }

    static function afterProcess($id, $data)
    {
        ProviderPrice::where('id', $id)->update(['name' => getFieldDataById('name', 'warehouse_providers', $data['provider'])]);
    }
}
