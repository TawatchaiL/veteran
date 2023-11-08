<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holidays extends Model
{
    use HasFactory;

    protected $connection = 'remote_connection';

    protected $table = 'holidays';

    protected $fillable = ['name', 'start_datetime', 'end_datetime', 'holiday_sound', 'thankyou_sound', 'status'];
}
