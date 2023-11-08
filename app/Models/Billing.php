<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $connection = 'remote_connection';

    protected $table = 'rate';

    protected $fillable = [
        'trunk', 'prefix', 'price', 'per', 'note'
    ];
}
