<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThSubDistrict extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'zip_code', 'name_th', 'district_id'
    ];
}
