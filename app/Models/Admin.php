<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'ho_va_ten',
        'so_dien_thoai',
        'email',
        'ngay_sinh',
        'password',
        'dia_chi',
        'id_quyen',
        'anh_dai_dien',
        'hash',
    ];
}
