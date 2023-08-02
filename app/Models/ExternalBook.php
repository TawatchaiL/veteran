<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'priorities_id',
        'doc_receive_number',
        'doc_number',
        'signdate',
        'doc_to',
        'doc_from',
        'subject',
        'doc_receive',
        'stampx', 
        'stampy',
        'sstampx',
        'sstampy',
        'signature'
    ];
}
