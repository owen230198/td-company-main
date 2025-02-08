<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class SupplyOrigin extends Model
{
    protected $table = 'supply_origins';
    protected $protectFields = false;
}
