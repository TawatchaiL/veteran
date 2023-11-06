<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callsurvey extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'max_score',
        'set_default',
        'wellcome_sound',
        'thankyou_sound',
        'timeout_sound',
        'invalid_sound',
        'timeout_sound_retry',
        'invalid_sound_retry',
    ];
}
