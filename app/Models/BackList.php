<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackList extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'description',
        'created_by',
        'updated_by',
    ];
}
