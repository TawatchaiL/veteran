<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmCaseType extends Model
{
    use HasFactory;
    protected $table = 'crm_case_types';
    protected $fillable = [
        'parent_id',
        'name',
        'crmlev',
        'crmlist',
        'status',
    ];
}
