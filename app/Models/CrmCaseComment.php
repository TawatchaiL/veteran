<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmCaseComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'case_id',
        'comment',
        'agent',
    ];
}
