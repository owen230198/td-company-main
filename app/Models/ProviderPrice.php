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
        return getFieldDataById('name', 'warehouse_providers', $data->provider). ' - ĐG: '.price_format($data->price).'đ';
    }
}
