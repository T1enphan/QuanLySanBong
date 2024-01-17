<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class KhachHang extends Authenticatable
{
    use HasFactory;

    protected $table = 'khach_hangs';

    protected $fillable = [
        'ho_lot',
        'ten',
        'ho_va_ten',
        'email',
        'password',
        'so_dien_thoai',
        'dia_chi',
        'gioi_tinh',
        'hash',
        'id_loai_khach',
        'is_active'
    ];
}
