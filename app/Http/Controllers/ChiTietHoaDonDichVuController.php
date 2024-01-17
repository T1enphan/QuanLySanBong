<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDonDichVu;
use Illuminate\Http\Request;

class ChiTietHoaDonDichVuController extends Controller
{
    public function chiTietHoaDon($id)
    {
        $data = ChiTietHoaDonDichVu::where('id_hoa_don_dich_vu', $id)
                                    ->join('hang_hoas', 'chi_tiet_hoa_don_dich_vus.id_hang', 'hang_hoas.id')
                                    ->join('hoa_don_dich_vus', 'chi_tiet_hoa_don_dich_vus.id_hoa_don_dich_vu', 'hoa_don_dich_vus.id')
                                    ->select('chi_tiet_hoa_don_dich_vus.*', 'hang_hoas.ten_hang', 'hang_hoas.gia_hang', 'hang_hoas.so_luong','hoa_don_dich_vus.tong_tien')
                                    ->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
