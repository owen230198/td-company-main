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
}
