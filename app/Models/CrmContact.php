<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmContact extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'hn',
        'adddate',
        'tname',
        'fname',
        'lname',
        'sex',
        'birthday',
        'age',
        'bloodgroup',
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
        'agent',
    ];
}
