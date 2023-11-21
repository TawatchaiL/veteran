<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_job_number extends Model
{
    use HasFactory;

    protected $connection = 'remote_connection';

    protected $table = 'project_job_numbers';

    protected $primaryKey = 'job_number_id';

    protected $fillable = [
        'cdr_uniqueid',
        'project_job_id',
        'create_date',
        'call_number',
        'dial_agent',
        'dial_number',
        'call_status',
        'dial_status',
        'duration',
        'realmin',
        'call_date',
        'sound'
    ];

    public function projectJob()
    {
        return $this->belongsTo(ProjectJob::class, 'project_job_id', 'job_id');
    }
}
