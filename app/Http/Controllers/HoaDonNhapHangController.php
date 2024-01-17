<?php

namespace App\Http\Controllers;

use App\Http\Requests\NhapHang\KiemTraIdNhapHangRequest;
use App\Http\Requests\NhapHang\UpdateChiTietHoaDonNhapHangRequest;
use App\Models\ChiTietHoaDonNhapHang;
use App\Models\HangHoa;
use App\Models\HoaDonNhapHang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPViet\NumberToWords\Transformer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HoaDonNhapHangController extends Controller
{

    public function index()
    {
        return view('admin.page.nhap_hang.index');
    }

    public function dataHangHoa()
    {
        $data =  HangHoa::where('tinh_trang', 1)
                        ->select('hang_hoas.*')
                        ->get();
        return response()->json([
            'data'  => $data
        ]);
    }

    public function getData()
    {

        $data =  ChiTietHoaDonNhapHang::where('id_hoa_don_nhap_hang', 0)
                                      ->where('trang_thai', 0)
                                      ->select('chi_tiet_hoa_don_nhap_hangs.*')
                                      ->get();
        $tong_tien = 0;
        foreach ($data as $key => $value) {
            $tong_tien = $tong_tien + $value->thanh_tien;
        }
        $transformer = new Transformer();

        return response()->json([
            'data'      => $data,
            'tong_tien' => $tong_tien,
            'tien_chu'  => $transformer->toCurrency($tong_tien),
        ]);
    }


    public function addSanPhamNhapHang(Request $request)
    {

        $hangHoa  = HangHoa::find($request->id);
        $hoaDonNhapHang = ChiTietHoaDonNhapHang::where('id_hang', $hangHoa->id)
                                               ->where('id_hoa_don_nhap_hang', 0)
                                               ->where('trang_thai', 0)
                                               ->first();
        if($hoaDonNhapHang) {
            $hoaDonNhapHang->so_luong_nhap  = $hoaDonNhapHang->so_luong_nhap + 1;
            $hoaDonNhapHang->thanh_tien   = $hoaDonNhapHang->so_luong_nhap * $hoaDonNhapHang->don_gia_nhap;
            $hoaDonNhapHang->save();
        } else {
            ChiTietHoaDonNhapHang::create([
                'id_hang'               => $hangHoa->id,
                'ten_hang'              => $hangHoa->ten_hang,
                'so_luong_nhap'         => 1,
                'don_gia_nhap'          => $hangHoa->gia_hang,
                'thanh_tien'            => $hangHoa->gia_hang * 1,
                'id_hoa_don_nhap_hang'  => 0,
            ]);
        }

        return response()->json([
            'status' => true,
            'message'=> "Thêm mới hàng hóa vào hóa đơn nhập hàng thành công!"
        ]);
    }

    public function deleteHangHoaNhapHang(KiemTraIdNhapHangRequest $request)
    {
        $chiTietHoaDonNhap = ChiTietHoaDonNhapHang::find($request->id);

        $chiTietHoaDonNhap->delete();

        return response()->json([
            'status' => true,
            'message' => "Xóa hàng khỏi hóa đơn nhập thành công!"
        ]);
    }

    public function updateChiTietHoaDonNhap(UpdateChiTietHoaDonNhapHangRequest $request)
    {
        $chiTietHoaDonNhap = ChiTietHoaDonNhapHang::find($request->id);

        if($chiTietHoaDonNhap->id_hoa_don_nhap_hang == 0 && $chiTietHoaDonNhap->trang_thai == 0) {
            $chiTietHoaDonNhap->update([
                'so_luong_nhap' => $request->so_luong_nhap,
                'don_gia_nhap'  => $request->don_gia_nhap,
                'thanh_tien'    => $request->don_gia_nhap * $request->so_luong_nhap,
                'ghi_chu'       => $request->ghi_chu
            ]);

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật hàng hóa thành công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Có lỗi không mong muốn xảy ra!',
            ]);
        }
    }

    public function nhapHang(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if($request->id_nha_cung_cap <= 0){
            return response()->json([
                'status'    => 0,
                'message'   => 'Nhà cung cấp bắt buộc phải chọn!',
            ]);
        }
        $data = $request->all();
        $mahd = HoaDonNhapHang::latest()->first();
        if($mahd){
            $data['ma_hoa_don_nhap_hang'] = 'HDNH' . (1000 + $mahd->id);
        }else{
            $data['ma_hoa_don_nhap_hang'] = 'HDNH' . 1000;
        }
        $data['ngay_nhap_hang']         = Carbon::now();

        $chiTietNhapHang = ChiTietHoaDonNhapHang::where('id_hoa_don_nhap_hang', 0)
                                                ->where('trang_thai', 0)
                                                ->get();
        if(count($chiTietNhapHang) > 0){
            $data['id_nhan_vien'] = $admin->id;
            $nhapHang = HoaDonNhapHang::create($data);

            if($nhapHang){
                foreach($chiTietNhapHang as $key => $value){
                    $value->id_hoa_don_nhap_hang = $nhapHang->id;
                    $value->trang_thai = 1;
                    $value->save();
                    $hangHoa = HangHoa::find($value->id_hang);
                    $hangHoa->so_luong = $hangHoa->so_luong + $value->so_luong_nhap;
                    $hangHoa->save();
                }
                $noi_dung = $admin->ho_va_ten . ' đã nhập đơn hàng có mã hóa đơn: ' . $nhapHang->ma_hoa_don_nhap_hang;
                $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
                return response()->json([
                    'status'    => 1,
                    'nhapHang'  => $nhapHang,
                    'message'   => 'Đã nhập hàng thành công!',
                ]);
            }else{
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Đã có lỗi hệ thống!',
                ]);
            }
        }else{
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn hàng này đã được người khác nhập!',
            ]);
        }
    }

    public function viewHD()
    {
        return view('admin.page.nhap_hang.hoa_don');
    }

    public function getDataDH()
    {
        $data = HoaDonNhapHang::join('nha_cung_caps', 'hoa_don_nhap_hangs.id_nha_cung_cap', 'nha_cung_caps.id')
                            ->join('admins', 'hoa_don_nhap_hangs.id_nhan_vien', 'admins.id')
                            ->select('hoa_don_nhap_hangs.*','admins.ho_va_ten','nha_cung_caps.ten_cong_ty' )
                            ->get();

        return response()->json([
            'data'  => $data
        ]);
    }

    public function search(Request $request)
    {

        $list = HangHoa::where('hang_hoas.ten_hang', 'like', '%' . $request->key_search . '%')

                        ->get();
        return response()->json([
            'list'  => $list
        ]);
    }

}
