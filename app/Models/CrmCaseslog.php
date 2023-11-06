<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmCaseslog extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'contact_id',
        'adddate',
        'uniqid',
        'telno',
        'casetype1',
        'caseid1',
        'casetype2',
        'caseid2',
        'casetype3',
        'caseid3',
        'casetype4',
        'caseid4',
        'casetype5',
        'caseid5',
        'casetype6',
        'caseid6',
        'tranferstatus',
        'casedetail',
        'casestatus',
        'agent',
        'created_at',
        'updated_at',
        'modifyaction',
        'modifyagent',
        'modifydate',
    ];
}
