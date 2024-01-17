<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = [
        'id_nguoi_log',
        'noi_dung',
        'type',
    ];

    CONST INSERT    = 0;
    CONST UPDATE    = 1;
    CONST DELETE    = 2;
}
