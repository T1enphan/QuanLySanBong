<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchThongKebanHangRequest;
use App\Http\Requests\ThongKe\SearchThongKeRequest;
use App\Models\ChiTietHoaDonDichVu;
use App\Models\HoaDonDichVu;
use App\Models\HoaDonThueSan;
use App\Models\San;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function actionThongKeBanHang(Request $request)
    {
        $data   = HoaDonDichVu::join('admins', 'hoa_don_dich_vus.id_nhan_vien', 'admins.id')
                                ->where('trang_thai', 0)
                               ->whereDate('ngay_thanh_toan', '>=', $request->begin)
                               ->whereDate('ngay_thanh_toan', '<=', $request->end)
                               ->select('hoa_don_dich_vus.*','admins.ho_va_ten' )
                               ->get();

        return response()->json([
            'status'    => 1,
            'message'   => 'Đã lấy dữ liệu',
            'data'      => $data,
        ]);
    }

    public function index()
    {
        $data = ChiTietHoaDonDichVu::join('hang_hoas', 'hang_hoas.id', 'chi_tiet_hoa_don_dich_vus.id_hang')
                                ->join('hoa_don_dich_vus', 'hoa_don_dich_vus.id', 'chi_tiet_hoa_don_dich_vus.id_hoa_don_dich_vu')
                                ->select('hang_hoas.ten_hang',
                                        DB::raw('SUM(chi_tiet_hoa_don_dich_vus.so_luong_ban) as so_luong'),
                                    )
                                ->groupBy('hang_hoas.ten_hang')
                                ->get();
        $array_hang_hoa = [];
        $array_so_luong = [];
        foreach ($data as $key => $value) {
            array_push($array_hang_hoa, $value->ten_hang);
            array_push($array_so_luong, $value->so_luong);

        }
        $tu_ngay = Carbon::today()->format("Y-m-d");
        $den_ngay = Carbon::today()->format("Y-m-d");
        return view('admin.page.thong_ke.index', compact('data', 'array_hang_hoa', 'array_so_luong', 'tu_ngay', 'den_ngay'));
    }

    public function search(SearchThongKeRequest $request)
    {


        $data = ChiTietHoaDonDichVu::join('hang_hoas', 'hang_hoas.id', 'chi_tiet_hoa_don_dich_vus.id_hang')
                                ->join('hoa_don_dich_vus', 'hoa_don_dich_vus.id', 'chi_tiet_hoa_don_dich_vus.id_hoa_don_dich_vu')
                                ->whereDate('hoa_don_dich_vus.created_at', '>=', $request->day_begin)
                                ->whereDate('hoa_don_dich_vus.created_at', '<=', $request->day_end)
                                ->select('hang_hoas.ten_hang',
                                        DB::raw('SUM(chi_tiet_hoa_don_dich_vus.so_luong_ban) as so_luong'),
                                    )
                                ->groupBy('hang_hoas.ten_hang')
                                ->get();
        $array_hang_hoa = [];
        $array_so_luong = [];
        foreach ($data as $key => $value) {
            array_push($array_hang_hoa, $value->ten_hang);
            array_push($array_so_luong, $value->so_luong);

        }
        $tu_ngay = Carbon::parse($request->day_begin)->format("Y-m-d");
        $den_ngay = Carbon::parse($request->day_end)->format("Y-m-d");
        return view('admin.page.thong_ke.index', compact('data', 'array_hang_hoa', 'array_so_luong', 'tu_ngay', 'den_ngay'));
    }
    public function getDataDH()
    {
        $data = HoaDonDichVu::join('admins', 'hoa_don_dich_vus.id_nhan_vien', 'admins.id')

                            ->select('hoa_don_dich_vus.*','admins.ho_va_ten' )
                            ->orderBYDESC('hoa_don_dich_vus.id')
                            ->get();

        return response()->json([
            'data'  => $data
        ]);
    }

    public function indexThongKeSanSuDungNhieu()
    {
        $tu_ngay = Carbon::today()->format("Y-m-d");
        $den_ngay = Carbon::today()->format("Y-m-d");
        $data = San::join('hoa_don_thue_sans', 'sans.id', 'hoa_don_thue_sans.id_san')
                            ->where('hoa_don_thue_sans.is_thanh_toan', 1)
                            ->where('hoa_don_thue_sans.tinh_trang', 2)
                            ->whereDate('hoa_don_thue_sans.ngay_thue_san', '>=', $tu_ngay)
                            ->whereDate('hoa_don_thue_sans.ngay_thue_san', '<=', $den_ngay)
                            ->select('sans.id', 'sans.ten_san',
                                        DB::raw('COUNT(hoa_don_thue_sans.id_san) as so_luong'),
                                    )
                            ->orderByDESC('so_luong')
                            ->groupBy('sans.id', 'sans.ten_san')
                            ->get();
        $array_ten_san = [];
        $array_so_luong = [];
        foreach ($data as $key => $value) {
            array_push($array_ten_san, $value->ten_san);
            array_push($array_so_luong, $value->so_luong);
        }

        return view('admin.page.thong_ke.sansudungnhieunhat', compact('data', 'array_ten_san', 'array_so_luong', 'tu_ngay', 'den_ngay'));
    }

    public function searchDataThongKeSanSuDungNhieu(Request $request)
    {
        $data = HoaDonThueSan::join('sans', 'sans.id', 'hoa_don_thue_sans.id_san')
                            ->where('hoa_don_thue_sans.is_thanh_toan', 1)
                            ->where('hoa_don_thue_sans.tinh_trang', 2)
                            ->whereDate('hoa_don_thue_sans.ngay_thue_san', '>=', $request->day_begin)
                            ->whereDate('hoa_don_thue_sans.ngay_thue_san', '<=', $request->day_end)
                            ->select('sans.id', 'sans.ten_san',
                                        DB::raw('COUNT(hoa_don_thue_sans.id_san) as so_luong'),
                                    )
                            ->orderByDESC('so_luong')
                            ->groupBy('sans.id', 'sans.ten_san')
                            ->get();
        $array_ten_san = [];
        $array_so_luong = [];
        foreach ($data as $key => $value) {
            array_push($array_ten_san, $value->ten_san);
            array_push($array_so_luong, $value->so_luong);
        }
        $tu_ngay = Carbon::parse($request->day_begin)->format("Y-m-d");
        $den_ngay = Carbon::parse($request->day_end)->format("Y-m-d");
        return view('admin.page.thong_ke.sansudungnhieunhat', compact('data', 'array_ten_san', 'array_so_luong', 'tu_ngay', 'den_ngay'));
    }

    public function dataChiTietSanSuDungNhieu(Request $request)
    {
        $hoaDonThueSan = HoaDonThueSan::join('khach_hangs', 'khach_hangs.id', 'hoa_don_thue_sans.id_khach_hang')
                                        ->where('id_san', $request->id)
                                        ->where('is_thanh_toan', 1)
                                        ->where('tinh_trang', 2)
                                        ->whereDate('ngay_thue_san', '>=', $request->tu_ngay)
                                        ->whereDate('ngay_thue_san', '<=', $request->den_ngay)
                                        ->select('hoa_don_thue_sans.*', 'khach_hangs.ho_va_ten as ten_khach')
                                        ->get();
        return response()->json([
            'data'    => $hoaDonThueSan,
        ]);
    }
}
