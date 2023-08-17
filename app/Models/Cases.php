<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_id', 'telno', 'casetype1', 'tranferstatus', 'casedetail', 'casestatus', 'agent'
    ];
}
