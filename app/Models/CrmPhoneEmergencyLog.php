<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmPhoneEmergencyLog extends Model
{
    use HasFactory;
    protected $fillable = [
         'id',
         'contact_id',
         'emergencyname', 
         'emerrelation', 
         'emerphone', 
         'agent',
         'created_at',
         'updated_at',
         'modifyaction',
         'modifyagent',
         'modifydate',
    ];
}
