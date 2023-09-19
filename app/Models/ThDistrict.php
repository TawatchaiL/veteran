<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThDistrict extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'name_th', 'province_id'
    ];
}
