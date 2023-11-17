<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiceBackup extends Model
{
    use HasFactory;
    protected $fillable = [
        'export_name',
        'export_start',
        'export_end',
        'export_src',
        'export_dst',
        'export_ctype',
        'export_status',
        'export_progress',
        'export_filename',
    ];
}
