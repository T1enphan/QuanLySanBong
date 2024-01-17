<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HangHoa extends Model
{
    use HasFactory;

    protected $table = 'hang_hoas';

    protected $fillable = [
        'ten_hang',
        'gia_hang',
        'so_luong',
        'tinh_trang',
        'trang_thai_hang',
        'id_loai_hang'
    ];
}
