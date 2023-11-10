<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify2Group extends Model
{
    use HasFactory;

    protected $connection = 'remote_connection';

    protected $table = 'notify_groups';

    protected $fillable = [
        'gid',
        'extension',
        'name',
    ];

    public function notifyGroup()
    {
        return $this->belongsTo(NotifyGroup::class, 'gid', 'group_id');
    }
}
