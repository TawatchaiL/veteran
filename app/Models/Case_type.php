<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Case_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'email',
        'address',
        'postcode',
        'telephone',
        'customer',
        'supplier',
    ];
}
