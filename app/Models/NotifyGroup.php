<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifyGroup extends Model
{
    use HasFactory;

    protected $connection = 'remote_connection';

    protected $table = 'notify_groups';

    protected $fillable = [
        'group_name',
        'group_start',
        'group_end',
        'group_start_th',
        'group_end_th',
        'group_sat',
        'group_sun',
        'group_extension',
        'misscall',
        'line_token',
        'email',
        'status',
    ];
}
