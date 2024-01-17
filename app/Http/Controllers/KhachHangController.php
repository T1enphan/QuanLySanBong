<?php

namespace App\Http\Controllers;

use App\Http\Requests\KhachHang\CreateKhachHangRequest;
use App\Http\Requests\KhachHang\DeleteKhachHangRequest;
use App\Http\Requests\KhachHang\UpdateKhachHangRequest;
use App\Models\KhachHang;
use App\Models\LoaiKhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class KhachHangController extends Controller
{
    public function index()
    {
        return view('admin.page.khach_hang.index');
    }
    public function store(CreateKhachHangRequest $request)
    {
        $data = $request->all();
        $data['ho_va_ten'] = $data['ho_lot'] . " " . $data['ten'];
        $data['hash'] = Str::uuid();
        $data['password']  = bcrypt('123456');
        $data['is_active'] = 1;
        $khachHang = KhachHang::create($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã thêm mới khách hàng có tên: ' . $khachHang->ho_va_ten;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới thành công!',
        ]);
    }
    public function getData()
    {
        $list = KhachHang::join('loai_khach_hangs', 'khach_hangs.id_loai_khach', 'loai_khach_hangs.id')
                ->select('khach_hangs.*','loai_khach_hangs.ten_loai_khach','loai_khach_hangs.phan_tram_giam')
                ->orderBy('loai_khach_hangs.id')
                ->get();

        return response()->json([
            'data'  => $list
        ]);
    }
    public function update(UpdateKhachHangRequest $request)
    {
        // dd($request->all());
        $khachHang = KhachHang::where('id', $request->id)->first();
        // dd($request->id);
        $data = $request->all();
        $khachHang->update($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã cập nhật khách hàng có tên: ' . $khachHang->ho_va_ten;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }
    public function destroy(DeleteKhachHangRequest $request)
    {
        $khachHang = KhachHang::find($request->id);

        if($khachHang) {
            $khachHang->delete();
            $admin = Auth::guard('admin')->user();
            $noi_dung = $admin->ho_va_ten . ' đã xóa khách hàng có tên: ' . $khachHang->ho_va_ten;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã xóa  thành công!'
            ]);
        }
    }
    public function search(Request $request)
    {
        $list = KhachHang::join('loai_khach_hangs', 'loai_khach_hangs.id', 'khach_hangs.id_loai_khach')
                        ->select('khach_hangs.*', 'loai_khach_hangs.ten_loai_khach')
                        ->where('khach_hangs.ten', 'like', '%' . $request->key_search . '%')
                        ->orWhere('khach_hangs.ho_va_ten', 'like', '%' . $request->key_search . '%')
                        ->orWhere('khach_hangs.ho_lot', 'like', '%' . $request->key_search . '%')
                        ->orWhere('khach_hangs.so_dien_thoai', 'like', '%' . $request->key_search . '%')
                        ->orWhere('khach_hangs.email', 'like', '%' . $request->key_search . '%')
                        ->get();

        return response()->json([
            'list'  => $list
        ]);
    }
    public function getDataLKH()
    {
        $data =  LoaiKhachHang::where('tinh_trang', 1)
                                ->select('loai_khach_hangs.*')
                                ->get();

        return response()->json([
            'data'  => $data
        ]);
    }

    public function doiTrangThai(Request $request)
    {
        $khachHang = KhachHang::find($request->id);

        if($khachHang){
            $khachHang->is_active = !$khachHang->is_active;
            $khachHang->save();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã đổi trạng thái thành công!',
            ]);
        }
    }

}
