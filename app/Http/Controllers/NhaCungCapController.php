<?php

namespace App\Http\Controllers;

use App\Http\Requests\NhaCungCap\CreateNhaCungCapRequest;
use App\Http\Requests\NhaCungCap\DeleteNhaCungCapRequest;
use App\Http\Requests\NhaCungCap\UpdateNhaCungCapRequest;
use App\Models\NhaCungCap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NhaCungCapController extends Controller
{
    public function  index()
    {
        return view('admin.page.nha_cung_cap.index');
    }

    public function store(CreateNhaCungCapRequest $request)
    {
        $data = $request->all();

        $nhaCungCap = NhaCungCap::create($data);


        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã thêm mới nhà cung cấp viên có tên: ' . $nhaCungCap->ten_cong_ty;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới nhà cung cấp thành công!',
        ]);
    }

    public function data()
    {
        $data = NhaCungCap::all();

        return response()->json([
            'data'  => $data,
        ]);
    }

    public function update(UpdateNhaCungCapRequest $request)
    {

        $data    = $request->all();
        $nhaCungCap = NhaCungCap::find($request->id);
        $nhaCungCap->update($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã cập nhật nhà cung cấp có tên: ' . $nhaCungCap->ten_cong_ty;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật thành công nhà cung cấp!',
        ]);
    }

    public function destroy(DeleteNhaCungCapRequest $request)
    {
        $nhaCungCap = NhaCungCap::where('id', $request->id)->first();
        $nhaCungCap->delete();
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã xóa nhà cung cấp có tên: ' . $nhaCungCap->ten_cong_ty;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::DELETE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa thành công nhà cung cấp!',
        ]);
    }

    public function doiTrangThai(Request $request)
    {
        $nhaCungCap = NhaCungCap::find($request->id);

        if($nhaCungCap) {
            $nhaCungCap->tinh_trang = !$nhaCungCap->tinh_trang;
            $nhaCungCap->save();
            $trang_thai = $nhaCungCap->tinh_trang == 1 ? 'hiển thị' : 'tạm tắt';
            $admin = Auth::guard('admin')->user();
            $noi_dung = $admin->ho_va_ten . ' đã đổi trạng thái thành ' . $trang_thai . ' của nhà cung cấp có tên: ' . $nhaCungCap->ten_cong_ty;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Nhà cung cấp không tồn tại!'
            ]);
        }
    }
    public function search(Request $request)
    {
        $list = NhaCungCap::where('nha_cung_caps.ma_so_thue', 'like', '%' . $request->key_search . '%')
                        ->orWhere('nha_cung_caps.ten_cong_ty', 'like', '%' . $request->key_search . '%')
                        ->orWhere('nha_cung_caps.ten_nguoi_dai_dien', 'like', '%' . $request->key_search . '%')
                        ->orWhere('nha_cung_caps.so_dien_thoai', 'like', '%' . $request->key_search . '%')
                        ->orWhere('nha_cung_caps.email', 'like', '%' . $request->key_search . '%')
                        ->orWhere('nha_cung_caps.ten_goi_nho', 'like', '%' . $request->key_search . '%')
                        ->get();

        return response()->json([
            'list'  => $list
        ]);
    }
}
