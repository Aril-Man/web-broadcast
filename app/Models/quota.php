<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quota extends Model
{
    use HasFactory;

    protected $table = 'quotas';
    protected $fillable = [
        'client_id',
        'quota'
    ];
}
