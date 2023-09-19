<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'hn',
        'fname',
        'lname',
        'homeno',
        'moo',
        'road',
        'soi',
        'city',
        'district',
        'subdistrict',
        'postcode',
        'phoneno',
        'telhome',
        'workno',
    ];
}
