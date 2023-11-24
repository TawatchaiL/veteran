<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_job extends Model
{
    use HasFactory;

    protected $connection = 'remote_connection';

    protected $table = 'project_jobs';

    protected $primaryKey = 'job_id';

    protected $fillable = [
        'job_code_id',
        'job_create_date',
        'job_file',
        'job_admin',
        'job_agent',
        'job_status',
        'job_process',
        'job_auto',
    ];
}
