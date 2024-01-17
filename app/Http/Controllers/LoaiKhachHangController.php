<?php

namespace App\Http\Controllers;

use App\Http\Requests\KhachHang\DeleteKhachHangRequest;
use App\Http\Requests\KhachHang\UpdateKhachHangRequest;
use App\Http\Requests\LoaiKhachHang\CreateLoaiKhachHangRequest;
use App\Http\Requests\LoaiKhachHang\DeleteLoaiKhachHangRequest;
use App\Http\Requests\LoaiKhachHang\UpdateLoaiKhachHangRequest;
use App\Models\LoaiKhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoaiKhachHangController extends Controller
{
    public function index()
    {
        return view('admin.page.loai_khach_hang.index');
    }

    public function store(CreateLoaiKhachHangRequest $request)
    {
        $data = $request->all();

        $LoaiKhachHang = LoaiKhachHang::create($data);

        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã thêm mới loại khách hàng có tên: ' . $LoaiKhachHang->ten_loai_khach;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới thành công!',
        ]);
    }
    public function getData()
    {
        $list = LoaiKhachHang::get();

        return response()->json([
            'data'  => $list
        ]);
    }


    public function update(UpdateLoaiKhachHangRequest $request)
    {
        // dd($request->all());
        $LoaiKhachHang = LoaiKhachHang::where('id', $request->id)->first();
        // dd($request->id);
        $data = $request->all();
        $LoaiKhachHang->update($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã cập nhật loại khách hàng có tên: ' . $LoaiKhachHang->ten_loai_khach;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }
    public function destroy(DeleteLoaiKhachHangRequest $request)
    {
        $LoaiKhachHang = LoaiKhachHang::find($request->id);

        if($LoaiKhachHang) {
            $LoaiKhachHang->delete();
            $admin = Auth::guard('admin')->user();
            $noi_dung = $admin->ho_va_ten . ' đã xóa loại khách hàng có tên: ' . $LoaiKhachHang->ten_loai_khach;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::DELETE);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã xóa  thành công!'
            ]);
        }
    }
    public function changeStatus(Request $request)
    {
        $loai_khach_hang = LoaiKhachHang::find($request->id);

        if($loai_khach_hang) {
            $loai_khach_hang->tinh_trang = !$loai_khach_hang->tinh_trang;
            $loai_khach_hang->save();
            $tinh_trang = $loai_khach_hang->tinh_trang == 1 ? 'còn hoạt động' : 'dừng hoạt động';
            $admin = Auth::guard('admin')->user();
            $noi_dung = $admin->ho_va_ten . ' đã cập nhật trạng thái thành ' . $tinh_trang . ' của loại khách hàng có tên: ' . $loai_khach_hang->ten_loai_khach;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        }
    }
}
