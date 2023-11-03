<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmCase extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_id',
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
    ];
}
