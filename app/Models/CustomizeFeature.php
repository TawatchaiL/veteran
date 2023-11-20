<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizeFeature extends Model
{
    use HasFactory;
    protected $connection = 'remote_connection';

    protected $table = 'customize_features';

    protected $fillable = [
        'name', 'config', 'value', 'status'
    ];
}
