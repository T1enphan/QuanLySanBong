<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDonDichVu;
use App\Models\HangHoa;
use App\Models\HoaDonDichVu;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PHPViet\NumberToWords\Transformer;

class HoaDonDichVuController extends Controller
{

    public function index()
    {
        return view('admin.page.dich_vu.index');
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
    public function search(Request $request)
    {

        $list = HangHoa::where('hang_hoas.ten_hang', 'like', '%' . $request->key_search . '%')

                        ->get();
        return response()->json([
            'list'  => $list
        ]);
    }
    public function themSanPhamBan(Request $request)
    {
        if($request->so_luong == 0){
            return response()->json([
                'status' => 0,
                'message'=> 'Không còn hàng trong kho!',
            ]);
        }

        $hangHoa  = HangHoa::find($request->id);
        $hoaDonBanHang = ChiTietHoaDonDichVu::where('id_hang', $hangHoa->id)
                                               ->where('id_hoa_don_dich_vu', 0)
                                               ->where('trang_thai', 0)
                                               ->first();

        if($hoaDonBanHang){
            $hang_hoa = HangHoa::find($hoaDonBanHang->id_hang);
            if($hoaDonBanHang->so_luong_ban + 1 > $hang_hoa->so_luong){
                return response()->json([
                    'status' => 0,
                    'message'=> 'Số lượng ' . $hang_hoa->ten_hang . ' chỉ còn ' . $hang_hoa->so_luong,
                ]);
            }else{
                $hoaDonBanHang->so_luong_ban  = $hoaDonBanHang->so_luong_ban + 1;
                $hoaDonBanHang->thanh_tien   = $hoaDonBanHang->so_luong_ban * $hoaDonBanHang->don_gia_ban;
                $hoaDonBanHang->save();
                return response()->json([
                    'status' => 1,
                    'message'=> 'Thêm hàng hóa vào hóa đơn bán hàng thành công!'
                ]);
            }
        } else {
            ChiTietHoaDonDichVu::create([
                'id_hang'               => $hangHoa->id,
                'ten_hang'              => $hangHoa->ten_hang,
                'so_luong_ban'         => 1,
                'don_gia_ban'          => $hangHoa->gia_hang,
                'thanh_tien'            => $hangHoa->gia_hang * 1,
                'id_hoa_don_dich_vu'  => 0,
            ]);
        }

        return response()->json([
            'status' => true,
            'message'=> "Thêm hàng hóa vào hóa đơn bán hàng thành công!"
        ]);
    }
    public function getHangHoa(Request $request)
    {
        if($request->id == 0)
        {
            $dsHang = HangHoa::get();
        }else{
            $dsHang = HangHoa::leftjoin('loai_hang_hoas', 'loai_hang_hoas.id', 'hang_hoas.id_loai_hang')
            ->where('hang_hoas.id_loai_hang', $request->id)
            ->where('hang_hoas.tinh_trang', 1)
            ->select('hang_hoas.*')
            ->get();
        }


        return response()->json([
            'data'    => $dsHang,
        ]);
    }
    public function getData()
    {

        $data =  ChiTietHoaDonDichVu::where('id_hoa_don_dich_vu', 0)
                                      ->where('trang_thai', 0)
                                      ->select('chi_tiet_hoa_don_dich_vus.*')
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
    public function deleteHangHoaNhapHang(Request $request)
    {
        $chiTietHoaDon = ChiTietHoaDonDichVu::find($request->id);

        $chiTietHoaDon->delete();

        return response()->json([
            'status' => true,
            'message' => "Đã xóa thành công!"
        ]);
    }

    public function updateChiTietHoaDonBan(Request $request)
    {
        $chiTietHoaDonBan = ChiTietHoaDonDichVu::find($request->id);
        if($chiTietHoaDonBan->id_hoa_don_dich_vu == 0 && $chiTietHoaDonBan->trang_thai == 0) {
            $hang_hoa = HangHoa::find($chiTietHoaDonBan->id_hang);
            if($hang_hoa){
                if($hang_hoa->so_luong < $request->so_luong_ban){
                    return response()->json([
                        'status'    => 0,
                        'message'   => 'Số lượng chỉ còn ' . $hang_hoa->so_luong .' trong kho!',
                    ]);
                }
            }
            $chiTietHoaDonBan->update([
                'so_luong_ban'  => $request->so_luong_ban,
                'don_gia_ban'  => $request->don_gia_ban,
                'thanh_tien'    => $request->don_gia_ban * $request->so_luong_ban,
            ]);

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật thành công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Có lỗi!',
            ]);
        }
    }

    public function inBill($id)
    {
        $chiTiet     = ChiTietHoaDonDichVu::where('id_hoa_don_dich_vu', $id)->get();
        $tong_tien   = 0;

        foreach($chiTiet as $key => $value) {
            $tong_tien += $value->thanh_tien;
        }
        $transformer = new Transformer();

        $hoaDon      = HoaDonDichVu::find($id);

        $tt_chu      = $transformer->toCurrency($tong_tien);
        $TamTinh     =  'HÓA ĐƠN TẠM TÍNH';

        return view('admin.page.dich_vu.bill', compact('chiTiet','tong_tien','TamTinh','tt_chu'));
    }

    public function inBillThanhToan($id)
    {
        $chiTiet     = ChiTietHoaDonDichVu::where('id_hoa_don_dich_vu', $id)->get();
        $tong_tien   = 0;

        foreach($chiTiet as $key => $value) {
            $tong_tien += $value->thanh_tien;
        }
        $transformer = new Transformer();

        $hoaDon      = HoaDonDichVu::find($id);

        $tt_chu      = $transformer->toCurrency($tong_tien);
        $TamTinh     =  'HÓA ĐƠN THANH TOÁN';

        return view('admin.page.dich_vu.bill_thanh_toan', compact('chiTiet','tong_tien','TamTinh','tt_chu'));
    }

    public function ThanhToan(Request $request)
    {

        $data = $request->all();
        $mahd = HoaDonDichVu::latest()->first();
        if($mahd){
            $data['ma_hoa_don'] = 'HDBH' . (1000 + $mahd->id);
        }else{
            $data['ma_hoa_don'] = 'HDBH' . 1000;
        }
        $data['ngay_thanh_toan']         = Carbon::now();

        $chiTietBan = ChiTietHoaDonDichVu::where('id_hoa_don_dich_vu', 0)
                                                ->where('trang_thai', 0)
                                                ->get();
        if(count($chiTietBan) > 0){
            $data['trang_thai'] = 1;
            $data['id_nhan_vien'] = Auth::guard('admin')->user()->id;
            $BanHang = HoaDonDichVu::create($data);

            if($BanHang){
                foreach($chiTietBan as $key => $value){
                    $value->id_hoa_don_dich_vu = $BanHang->id;
                    $value->trang_thai = 1;
                    $value->save();
                    $hangHoa = HangHoa::find($value->id_hang);
                    $hangHoa->so_luong = $hangHoa->so_luong - $value->so_luong_ban;
                    $hangHoa->save();
                }
                $admin = Auth::guard('admin')->user();
                $noi_dung = $admin->ho_va_ten . ' đã thanh toán đơn hàng có mã hóa đơn: ' . $BanHang->ma_hoa_don;
                $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
                return response()->json([
                    'status'    => 1,
                    'banHang'  => $BanHang,
                    'message'   => 'Đã thanh toán!',
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
                'message'   => 'Hóa đơn đã được thanh toán!',
            ]);
        }
    }

    public function viewHD()
    {
        return view('admin.page.dich_vu.hoa_don_ban');
    }
    public function getDataDH()
    {
        $data = HoaDonDichVu::join('admins', 'hoa_don_dich_vus.id_nhan_vien', 'admins.id')

                            ->select('hoa_don_dich_vus.*','admins.ho_va_ten' )
                            ->get();

        return response()->json([
            'data'  => $data
        ]);
    }




}
