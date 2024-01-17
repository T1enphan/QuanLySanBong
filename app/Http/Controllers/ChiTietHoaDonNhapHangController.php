<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDonNhapHang;
use Illuminate\Http\Request;

class ChiTietHoaDonNhapHangController extends Controller
{
    public function chiTietHoaDon($id)
    {
        $data = ChiTietHoaDonNhapHang::where('id_hoa_don_nhap_hang', $id)
                                    ->join('hang_hoas', 'chi_tiet_hoa_don_nhap_hangs.id_hang', 'hang_hoas.id')
                                    ->select('chi_tiet_hoa_don_nhap_hangs.*', 'hang_hoas.ten_hang', 'hang_hoas.gia_hang', 'hang_hoas.so_luong')
                                    ->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
