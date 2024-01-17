<?php

namespace App\Http\Controllers;

use App\Http\Requests\San\CreateMoSanRealRequest;
use App\Http\Requests\San\DatSanRequest;
use App\Models\ChiTietHoaDonDichVu;
use App\Models\HangHoa;
use App\Models\HoaDonThueSan;
use App\Models\KhachHang;
use App\Models\KhuVuc;
use App\Models\LoaiSan;
use App\Models\San;
use App\Models\TmpDatSan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use PHPViet\NumberToWords\Transformer;

class SanController extends Controller
{
    public function index()
    {
        return view('admin.page.san.index');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $san = San::create($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã thêm mới sân có tên: ' . $san->ten_san;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
        return response()->json([
            'status' => true,
            'message' => 'Đã tạo mới thành công!',
        ]);
    }
    public function getData()
    {
        $list = San::join('khu_vucs', 'sans.id_khu_vuc', 'khu_vucs.id')
            ->join('loai_sans', 'sans.id_loai_san', 'loai_sans.id')
            ->select('sans.*', 'khu_vucs.ten_khu_vuc', 'loai_sans.loai_san')
            ->orderBy('sans.id')
            ->get();

        return response()->json([
            'data' => $list
        ]);
    }
    public function changeStatus(Request $request)
    {
        $san = San::find($request->id);

        if ($san) {
            $san->tinh_trang = !$san->tinh_trang;
            $san->save();
            $tinh_trang = $san->tinh_trang == 1 ? 'còn kinh doanh' : 'dừng kinh doanh';
            $admin = Auth::guard('admin')->user();
            $noi_dung = $admin->ho_va_ten . ' đã cập nhật trạng thái thành ' . $tinh_trang . ' của sân có tên: ' . $san->ten_san;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
            return response()->json([
                'status' => true,
                'message' => 'Đã đổi trạng thái thành công!'
            ]);
        }
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $San = San::where('id', $request->id)->first();
        // dd($request->id);
        $data = $request->all();
        $San->update($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã cập nhật sân có tên: ' . $San->ten_san;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật được thông tin!',
        ]);
    }
    public function destroy(Request $request)
    {
        $San = San::find($request->id);

        if ($San) {
            $San->delete();
            $admin = Auth::guard('admin')->user();
            $noi_dung = $admin->ho_va_ten . ' đã xóa sân có tên: ' . $San->ten_san;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::DELETE);
            return response()->json([
                'status' => true,
                'message' => 'Đã xóa sân thành công!'
            ]);
        }
    }

    public function getDataKV()
    {
        $data = KhuVuc::where('tinh_trang', 1)
            ->select('khu_vucs.*')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function getDataLS()
    {
        $data = LoaiSan::where('tinh_trang', 1)
            ->select('loai_sans.*')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function indexDsSan()
    {
        return view('admin.page.san.danhsachsan');
    }


    public function getDanhSachSanHD(Request $request)
    {
        if ($request->id == 0) {
            $dsSan = San::join('hoa_don_thue_sans', 'hoa_don_thue_sans.id_san', 'sans.id')
                ->leftjoin('khach_hangs', 'khach_hangs.id', 'hoa_don_thue_sans.id_khach_hang')
                ->where('sans.tinh_trang', 1)
                ->where('hoa_don_thue_sans.tinh_trang', '<>', 2)
                ->select('sans.*', 'khach_hangs.ho_va_ten as ten_khach_hang', 'khach_hangs.so_dien_thoai', 'hoa_don_thue_sans.id_khach_hang', 'hoa_don_thue_sans.tinh_trang as tinh_trang_thue', 'hoa_don_thue_sans.gio_ket_thuc', 'hoa_don_thue_sans.gio_bat_dau', 'hoa_don_thue_sans.ngay_thue_san','hoa_don_thue_sans.id as hoa_don_id')
                ->get();
        } else {
            $dsSan = San::join('hoa_don_thue_sans', 'hoa_don_thue_sans.id_san', 'sans.id')
                ->leftjoin('khach_hangs', 'khach_hangs.id', 'hoa_don_thue_sans.id_khach_hang')
                ->where('sans.id_loai_san', $request->id)
                ->where('sans.tinh_trang', 1)
                ->where('hoa_don_thue_sans.tinh_trang', '<>', 2)
                ->select('sans.*', 'khach_hangs.ho_va_ten as ten_khach_hang', 'khach_hangs.so_dien_thoai', 'hoa_don_thue_sans.tinh_trang as tinh_trang_thue', 'hoa_don_thue_sans.gio_ket_thuc', 'hoa_don_thue_sans.gio_bat_dau', 'hoa_don_thue_sans.ngay_thue_san', 'hoa_don_thue_sans.id as hoa_don_id')
                ->get();
        }

        // dd($dsSan->toArray());
        // foreach($dsSan as $key => $value){
        //     $thoi_gian_con_lai = strtotime($value->gio_ket_thuc) - strtotime($value->gio_bat_dau);
        //     $gio  = floor($thoi_gian_con_lai / 3600); // Số giờ
        //     $phut = floor(($thoi_gian_con_lai % 3600) / 60); // Số phút
        //     $giay = $thoi_gian_con_lai % 60;
        //     $value->thoi_gian_thue = sprintf("%02d:%02d:%02d", $gio, $phut, $giay);
        // }
        return response()->json([
            'data' => $dsSan,
        ]);
    }

    public function getDanhSachSan(Request $request)
    {
        $dsSan = San::where('id_loai_san', $request->id)
            ->where('tinh_trang', 1)
            ->get();

        // $dsSan = San::leftjoin('hoa_don_thue_sans', 'hoa_don_thue_sans.id_san', 'sans.id')
        // ->where('sans.id_loai_san', $request->id)
        // ->where('sans.tinh_trang', 1)
        // ->select('sans.*', 'hoa_don_thue_sans.is_open', 'hoa_don_thue_sans.tinh_trang as tinh_trang_thue', 'hoa_don_thue_sans.gio_ket_thuc', 'hoa_don_thue_sans.gio_bat_dau')
        // ->get();
        // foreach($dsSan as $key => $value){
        //     $thoi_gian_con_lai = strtotime($value->gio_ket_thuc) - strtotime($value->gio_bat_dau);
        //     $gio  = floor($thoi_gian_con_lai / 3600); // Số giờ
        //     $phut = floor(($thoi_gian_con_lai % 3600) / 60); // Số phút
        //     $giay = $thoi_gian_con_lai % 60;
        //     $value->thoi_gian_thue = sprintf("%02d:%02d:%02d", $gio, $phut, $giay);
        // }
        return response()->json([
            'data' => $dsSan,
        ]);
    }

    public function moSan(Request $request)
    {
        $timHDSan = HoaDonThueSan::where('id_san', $request->id_san)
            ->where('id', $request->hoa_don_id)
            ->first();
        if ($timHDSan) {
            return response()->json([
                'dataSanDangMo' => $timHDSan,
                'status' => 1,
                'id_thue_san' => $timHDSan->id,
                // 'message'        => 'Đang mở sân'
            ]);
        }
        // else{
        //     $data = $request->all();
        //     dd($data);
        //     $data['id_nguoi_tao'] = Auth::guard('admin')->user()->id;
        //     $thueSan = HoaDonThueSan::create($data);

        //     return response()->json([
        //         'id_thue_san'    => $thueSan->id,
        //         'trang_thai'     => 1,
        //         // 'message'        => 'Đang mở sân'
        //     ]);
        // }
    }

    public function huyMoSan(Request $request)
    {
        $timHDSan = HoaDonThueSan::where('id_san', $request->id_hoa_don_thue)
            ->where('tinh_trang', '>', 0)
            ->first();
        if ($timHDSan) {
            return response()->json([
                'status' => 2,
            ]);
        } else {
            $data = $request->all();
            $data['id_nguoi_tao'] = Auth::guard('admin')->user()->id;
            $thueSan = HoaDonThueSan::where('id', $request->id_hoa_don_thue)
                ->where('tinh_trang', null)
                ->where('id_nguoi_tao', $data['id_nguoi_tao'])
                ->first();
            $thueSan->delete();

            $chiTietHoaDonDichVu = ChiTietHoaDonDichVu::where('id_thue_san', $request->id_hoa_don_thue)
                ->where('trang_thai', 0)
                ->get();
            foreach ($chiTietHoaDonDichVu as $key => $value) {
                $value->delete();
            }

            return response()->json([
                'status' => 1,
                // 'messages' => 'Đã đ'
            ]);
        }
    }

    public function moSanReal(CreateMoSanRealRequest $request)
    {
        $data = $request->all();
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $ngay_gio_bat_dau = $data['ngay_thue_san'] . ' ' . $data['gio_bat_dau'];
        if($ngay_gio_bat_dau < $now){
            return response()->json([
                'status' => 0,
                'message' => 'Giờ bắt đầu phải lớn hơn hiện tại!'
            ]);
        }

        // $hoaDonThueSan = HoaDonThueSan::where('id_san', $data['id_san'])
        //     ->where('tinh_trang', 1)
        //     ->first();
        // if ($hoaDonThueSan) {
        //     return response()->json([
        //         'status' => 0,
        //         'message' => 'Sân Hiện Đang Hoạt Động!'
        //     ]);
        // }
        if (isset($data['id_khach_hang'])) {
            $khachHang = KhachHang::where('khach_hangs.id', $data['id_khach_hang'])
                ->join('loai_khach_hangs', 'loai_khach_hangs.id', 'khach_hangs.id_loai_khach')
                ->select('loai_khach_hangs.phan_tram_giam')
                ->first();

            if ($khachHang) {
                $data['phan_tram_giam'] = $khachHang->phan_tram_giam;
            } else {
                $data['phan_tram_giam'] = 0;
            }
        }
        $data['phan_tram_giam'] = 0;
        // $now = Carbon::now()->format('H:i');
        $data['id_nguoi_tao'] = Auth::guard('admin')->user()->id;

        // if($data['gio_bat_dau'] < $now){
        //     return response()->json([
        //         'status' => 0,
        //         'message' => 'Giờ bắt đầu phải lớn hơn hiện tại!'
        //     ]);
        // }
        // if($data['gio_ket_thuc'] < $now || $data['gio_ket_thuc'] < $data['gio_bat_dau']){
        //     return response()->json([
        //         'status' => 0,
        //         'message' => 'Giờ kết thúc phải lớn hơn hiện tại và giờ bắt đầu!'
        //     ]);
        // }
        $data['tinh_trang'] = 3;
        HoaDonThueSan::create($data);
        $noi_dung_telegram = 'Nhân viên ' . Auth::guard('admin')->user()->ho_va_ten . ' đã mở sân '
            . San::find($data['id_san'])->ten_san . ' thời gian từ ' . $data['gio_bat_dau'] . ' đến ' . $data['gio_ket_thuc'] . ' với số tiền là: ' . $data['so_tien'];
        $this->sendTele($noi_dung_telegram);
        return response()->json([
            'status' => 1,
            'message' => 'Mở sân thành công'
        ]);
    }

    public function updateMoSan(Request $request)
    {

        $data = $request->all();
        // $now = Carbon::now()->format('Y-m-d H:i:s');
        // $ngay_gio_bat_dau = $data['ngay_thue_san'] . ' ' . $data['gio_bat_dau'];
        // if($ngay_gio_bat_dau < $now){
        //     return response()->json([
        //         'status' => 0,
        //         'message' => 'Giờ bắt đầu phải lớn hơn hiện tại!'
        //     ]);
        // }
        if($data['id_khach_hang'] == -1){
            $data['id_khach_hang'] = null;
        }
        $khachHang = KhachHang::where('khach_hangs.id', $data['id_khach_hang'])
            ->join('loai_khach_hangs', 'loai_khach_hangs.id', 'khach_hangs.id_loai_khach')
            ->select('loai_khach_hangs.phan_tram_giam')
            ->first();

        if ($khachHang) {
            $data['phan_tram_giam'] = $khachHang->phan_tram_giam;
        } else {
            $data['phan_tram_giam'] = 0;
        }
        $thueSan = HoaDonThueSan::find($data['id_hoa_don_thue']);

        if ($thueSan) {
            $updateThueSan = $thueSan->update($data);

            return response()->json([
                'status' => 1,
                'message' => 'Cập nhật sân thành công',
            ]);
        } else {
            $hoaDonThueSan = HoaDonThueSan::where('id_san', $data['id_san'])
                ->where('tinh_trang', 1)
                ->first();
            if ($hoaDonThueSan) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Sân Hiện Đang Hoạt Động!'
                ]);
            }
            // $now = Carbon::now()->format('H:i');
            $data['id_nguoi_tao'] = Auth::guard('admin')->user()->id;

            // if($data['gio_bat_dau'] < $now){
            //     return response()->json([
            //         'status' => 0,
            //         'message' => 'Giờ bắt đầu phải lớn hơn hiện tại!'
            //     ]);
            // }
            // if($data['gio_ket_thuc'] < $now || $data['gio_ket_thuc'] < $data['gio_bat_dau']){
            //     return response()->json([
            //         'status' => 0,
            //         'message' => 'Giờ kết thúc phải lớn hơn hiện tại và giờ bắt đầu!'
            //     ]);
            // }
            $data['ngay_thue_san'] = Carbon::today();
            $data['tinh_trang'] = 1;
            HoaDonThueSan::create($data);
            return response()->json([
                'status' => 1,
                'message' => 'Mở sân thành công'
            ]);
        }
    }

    public function dataKhachHang()
    {
        $data = KhachHang::get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getDataHangHoa()
    {
        $hang_hoa = HangHoa::where('tinh_trang', 1)->get();

        return response()->json([
            'data' => $hang_hoa,
        ]);
    }

    public function addHang(Request $request)
    {
        if ($request->so_luong == 0) {
            return response()->json([
                'status' => 0,
                'message' => 'Không còn hàng trong kho!',
            ]);
        }
        $chiTietHoaDonDichVu = ChiTietHoaDonDichVu::where('id_thue_san', $request->id_hoa_don_thue)
            ->where('id_hang', $request->id)
            ->first();
        if ($chiTietHoaDonDichVu) {
            $hang_hoa = HangHoa::find($chiTietHoaDonDichVu->id_hang);
            if ($chiTietHoaDonDichVu->so_luong_ban + 1 > $hang_hoa->so_luong) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Số lượng ' . $hang_hoa->ten_hang . ' chỉ còn ' . $hang_hoa->so_luong,
                ]);
            } else {
                $chiTietHoaDonDichVu->so_luong_ban = $chiTietHoaDonDichVu->so_luong_ban + 1;
                $chiTietHoaDonDichVu->thanh_tien = $chiTietHoaDonDichVu->so_luong_ban * $chiTietHoaDonDichVu->don_gia_ban;
                $chiTietHoaDonDichVu->save();
                return response()->json([
                    'status' => 1,
                    'message' => 'Thêm dịch vụ thành công'
                ]);
            }
        } else {
            $data['id_hang'] = $request->id;
            $data['ten_hang'] = $request->ten_hang;
            $data['id_thue_san'] = $request->id_hoa_don_thue;
            $data['so_luong_ban'] = 1;
            $data['don_gia_ban'] = $request->gia_hang;
            $data['thanh_tien'] = $data['so_luong_ban'] * $request->gia_hang;

            ChiTietHoaDonDichVu::create($data);

            return response()->json([
                'status' => 1,
                'message' => 'Thêm dịch vụ thành công'
            ]);
        }

    }

    public function getAddHang($id_thue_san)
    {
        $data = ChiTietHoaDonDichVu::where('trang_thai', 0)
            ->where('id_thue_san', $id_thue_san)
            ->get();
        $hoaDonThueSan = HoaDonThueSan::find($id_thue_san);

        $tong_tien = $hoaDonThueSan->so_tien;

        foreach ($data as $key => $value) {
            $tong_tien = $tong_tien + $value->thanh_tien;
        }
        if ($hoaDonThueSan->phan_tram_giam == 0) {
            $tien_da_giam = $tong_tien;
            $hoaDonThueSan->tien_da_giam = $tien_da_giam;
            $hoaDonThueSan->save();
        } else {
            $tien_da_giam = $tong_tien * ((100 - $hoaDonThueSan->phan_tram_giam) / 100);
            $hoaDonThueSan->tien_da_giam = $tien_da_giam;
            $hoaDonThueSan->save();
        }

        return response()->json([
            'data' => $data,
            'tong_tien' => $tong_tien,
            'phan_tram_giam' => $hoaDonThueSan->phan_tram_giam,
            'tien_da_giam' => $tien_da_giam
        ]);
    }

    public function updateHang(Request $request)
    {
        $data = $request->all();
        $hang_hoa = HangHoa::find($data['id_hang']);
        if ($data['so_luong_ban'] > $hang_hoa->so_luong) {
            return response()->json([
                'status' => 0,
                'message' => 'Số lượng ' . $hang_hoa->ten_hang . ' chỉ còn ' . $hang_hoa->so_luong,
            ]);
        }
        $chiTietHoaDonDichVu = ChiTietHoaDonDichVu::find($request->id);

        $chiTietHoaDonDichVu->so_luong_ban = $data['so_luong_ban'];
        $chiTietHoaDonDichVu->don_gia_ban = $data['don_gia_ban'];
        $chiTietHoaDonDichVu->thanh_tien = $data['don_gia_ban'] * $data['so_luong_ban'];
        $chiTietHoaDonDichVu->save();

        return response()->json([
            'status' => 1,
            'message' => 'Cập nhật thành công'
        ]);
    }

    public function deleteHang(Request $request)
    {
        $chiTietHoaDonDichVu = ChiTietHoaDonDichVu::find($request->id);

        $chiTietHoaDonDichVu->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Xóa hàng hóa thành công'
        ]);
    }

    public function billThueSan($id_thue_san)
    {
        $hoaDonThueSan = HoaDonThueSan::join('sans', 'sans.id', 'hoa_don_thue_sans.id_san')
            ->where('hoa_don_thue_sans.id', $id_thue_san)
            ->select('sans.ten_san', 'hoa_don_thue_sans.*')
            ->first();
        $hoaDonThueSan->so_phut_thue = (strtotime($hoaDonThueSan->gio_ket_thuc) - strtotime($hoaDonThueSan->gio_bat_dau)) / 60;
        $chiTietHoaDonDichVu = ChiTietHoaDonDichVu::where('id_thue_san', $id_thue_san)
            ->where('trang_thai', 0)
            ->get();
        $tong_tien = $hoaDonThueSan->so_tien;
        $transformer = new Transformer();
        foreach ($chiTietHoaDonDichVu as $key => $value) {
            $tong_tien = $tong_tien + $value->thanh_tien;
        }
        $TamTinh = 'HÓA ĐƠN TẠM TÍNH';
        $phanTramGiam = $hoaDonThueSan->phan_tram_giam;
        $tien_da_giam = $tien_da_giam = $tong_tien * ((100 - $hoaDonThueSan->phan_tram_giam) / 100);
        $tt_chu = $transformer->toCurrency($tien_da_giam);

        return view('admin.page.san.bill', compact('hoaDonThueSan', 'chiTietHoaDonDichVu', 'tong_tien', 'tt_chu', 'TamTinh', 'phanTramGiam', 'tien_da_giam'));
    }

    public function billThanhToan($id_thue_san)
    {
        $hoaDonThueSan = HoaDonThueSan::join('sans', 'sans.id', 'hoa_don_thue_sans.id_san')
            ->where('hoa_don_thue_sans.id', $id_thue_san)
            ->select('sans.ten_san', 'hoa_don_thue_sans.*')
            ->first();
        $hoaDonThueSan->so_phut_thue = (strtotime($hoaDonThueSan->gio_ket_thuc) - strtotime($hoaDonThueSan->gio_bat_dau)) / 60;
        $chiTietHoaDonDichVu = ChiTietHoaDonDichVu::where('id_thue_san', $id_thue_san)
            ->where('trang_thai', 1)
            ->get();
        $tong_tien = $hoaDonThueSan->so_tien;
        $transformer = new Transformer();
        foreach ($chiTietHoaDonDichVu as $key => $value) {
            $tong_tien = $tong_tien + $value->thanh_tien;
        }
        $thanhToan = 'HÓA ĐƠN THANH TOÁN';
        $phanTramGiam = $hoaDonThueSan->phan_tram_giam;
        $tien_tra_truoc = $hoaDonThueSan->tien_tra_truoc;
        $tien_da_giam = ($tong_tien * ((100 - $hoaDonThueSan->phan_tram_giam) / 100)) - $tien_tra_truoc;
        $tt_chu = $transformer->toCurrency($tien_da_giam);
        return view('admin.page.san.bill_thanh_toan', compact('hoaDonThueSan', 'chiTietHoaDonDichVu', 'tong_tien', 'tt_chu', 'thanhToan', 'phanTramGiam', 'tien_da_giam', 'tien_tra_truoc'));
    }

    public function thanhToanSan(Request $request)
    {
        $hoaDonThueSan = HoaDonThueSan::where('id', $request->id_hoa_don_thue)
            ->where('tinh_trang', 1)
            ->first();
        if ($hoaDonThueSan) {
            $hoaDonThueSan->tong_tien_thanh_toan = $request->tong_thanh_toan - $hoaDonThueSan->tien_tra_truoc;
            $hoaDonThueSan->tien_da_giam = $request->tien_da_giam;
            $hoaDonThueSan->tinh_trang = 2;
            $hoaDonThueSan->is_thanh_toan = 1;
            $hoaDonThueSan->ma_hoa_don = 'HDTT' . (100000 + $hoaDonThueSan->id);
            $hoaDonThueSan->save();
            $chiTietHoaDonDichVu = ChiTietHoaDonDichVu::where('id_thue_san', $request->id_hoa_don_thue)
                ->where('trang_thai', 0)
                ->get();
            foreach ($chiTietHoaDonDichVu as $key => $value) {
                $value->trang_thai = 1;
                $value->save();
                $hang_hoa = HangHoa::where('id', $value->id_hang)->first();
                $hang_hoa->so_luong = $hang_hoa->so_luong - $value->so_luong_ban;
                $hang_hoa->save();
            }

            $ten_san = San::where('id', $hoaDonThueSan->id_san)
                ->select('ten_san')
                ->first();

            $noi_dung_telegram = 'Đã thanh toán sân ' . $ten_san->ten_san . ' có mã hóa đơn ' . $hoaDonThueSan->ma_hoa_don . ' tổng thanh toán ' . $request->tong_thanh_toan
                . ', phần trăm giảm ' . $hoaDonThueSan->phan_tram_giam . ', tiền phải trả ' . $request->tien_da_giam;

            $this->sendTele($noi_dung_telegram);

            return response()->json([
                'status' => 1,
                'message' => 'Đã thanh toán thành công'
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'message' => 'Sân chưa hoạt động không thể thanh toán!'
            ]);
        }
    }

    public function hoaDonThueSan()
    {
        return view('admin.page.san.hoa_don_thue_san');
    }

    public function dataHoaDonThueSan()
    {
        $data = HoaDonThueSan::join('admins', 'admins.id', 'hoa_don_thue_sans.id_nguoi_tao')
            ->join('sans', 'sans.id', 'hoa_don_thue_sans.id_san')
            ->leftjoin('khach_hangs', 'khach_hangs.id', 'hoa_don_thue_sans.id_khach_hang')
            ->where('hoa_don_thue_sans.tinh_trang', 2)
            ->select('hoa_don_thue_sans.*', 'admins.ho_va_ten', 'khach_hangs.ho_va_ten as ten_khach_hang', 'sans.ten_san')
            ->get();
        // dd($data->toArray());
        foreach ($data as $key => $value) {
            $value->so_phut_thue = (strtotime($value->gio_ket_thuc) - strtotime($value->gio_bat_dau)) / 60;
        }
        return response()->json([
            'data' => $data,
        ]);
    }

    public function chiTietHoaDonThueSan($id)
    {
        $data = ChiTietHoaDonDichVu::where('id_thue_san', $id)
            ->where('trang_thai', 1)
            ->get();
        //    dd($data->toArray());

        return response()->json([
            'data' => $data,
        ]);
    }

    public function datSan(DatSanRequest $request)
    {
        $data = $request->validated();
        $khachHang = KhachHang::where('khach_hangs.id', $data['id_khach_hang'])
            ->join('loai_khach_hangs', 'loai_khach_hangs.id', 'khach_hangs.id_loai_khach')
            ->select('loai_khach_hangs.phan_tram_giam')
            ->first();

        $data['phan_tram_giam'] = $khachHang->phan_tram_giam;
        $data['ngay_thue_san'] = $data['ngay'];
        $tien_giam = $data['so_tien'] * $data['phan_tram_giam'] / 100;
        $data['tong_tien_thanh_toan'] = $data['so_tien'] - $tien_giam;
        $tmpSan = TmpDatSan::latest()->first();
        if($tmpSan){
            $data['ma_thanh_toan'] = 'HDTT' . (100000 + ($tmpSan->id + 1));
        }else{
            $data['ma_thanh_toan'] = 'HDTT' . 100001;
        }
        $link_img_qr = "https://api.vietqr.io/image/970422-0936734440-unGAuBa.jpg?accountName=TRUONG%20CONG%20THACH&amount=". $data['tong_tien_thanh_toan'] ."&addInfo=" . $data['ma_thanh_toan'];
        $data['img_qr'] = $link_img_qr;
        $hd = TmpDatSan::create($data);
        // $tienCoc = $data['tong_tien_thanh_toan'] * 0.4;
        $noi_dung_telegram = 'Khách hàng ' . $khachHang->ho_va_ten . ' đã đặt sân ' . San::find($data['id_san'])->ten_san . ' thời gian từ ' . $data['gio_bat_dau'] . ' đến ' . $data['gio_ket_thuc'];
        $this->sendTele($noi_dung_telegram);
        return response()->json([
            'status' => 1,
            'message' => 'Đã đặt sân vui lòng thanh toán',
            'data' => [
                'id_hoa_don' => $hd->id,
                // 'so_tien_thanh_toan_truoc' => $tienCoc,
            ]
        ]);
    }

    public function thanhToanTienCoc($request)
    {

    }

    public function getExtraFee(Request $request){
        $extraFee = 1;
        $time = Carbon::createFromTimeString($request->query('time'));
        $earlyMorningStart = Carbon::create($time->year, $time->month, $time->day, 5, 0, 0); //set time to 08:00
        $earlyMorningEnd = Carbon::create($time->year, $time->month, $time->day, 8, 0, 0); //set time to 08:00
        $afternoonStart = Carbon::create($time->year, $time->month, $time->day, 15, 0, 0); //set time to 08:00
        $afternoonEnd = Carbon::create($time->year, $time->month, $time->day, 21, 0, 0); //set time to 08:00

        if($time->between($earlyMorningStart, $earlyMorningEnd, true) || $time->between($afternoonStart, $afternoonEnd, true)) {
            $extraFee = 1.3; // 30%
        }
        return response()->json(
            ['extra_fee' => $extraFee],
            Response::HTTP_OK
        );
    }

    public function checkGioSanDa()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $danhSachHoaDonSan = HoaDonThueSan::where('tinh_trang', '!=', 2)->get();
        foreach ($danhSachHoaDonSan as $key => $value) {
            $thoi_gian_bat_dau_san = $value->ngay_thue_san . ' ' . $value->gio_bat_dau;
            if($thoi_gian_bat_dau_san < $now){
                $value->tinh_trang = 1;
                $value->save();
            }else{
                $value->tinh_trang = 3;
                $value->save();
            }
        }

        return response()->json([
            'status'    => true,
        ]);
    }
}
