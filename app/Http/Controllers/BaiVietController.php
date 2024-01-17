<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaiViet\CreateBaiVietRequest;
use App\Models\BaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaiVietController extends Controller
{
    public function index()
    {
        return view('admin.page.bai_viet.index');
    }
    public function store(CreateBaiVietRequest $request)
    {
        $data = $request->all();

        $BaiViet = BaiViet::create($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã thêm mới bài viết có tên: ' . $BaiViet->tieu_de_bai_viet;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới thành công!',
        ]);
    }
    public function getData()
    {
        $data = BaiViet::get();

        return response()->json([
            'data'  => $data
        ]);
    }
    public function changestatus(Request $request)
    {
        $BaiViet = BaiViet::find($request->id);
        if ($BaiViet) {
            $BaiViet->trang_thai = !$BaiViet->trang_thai;
            $BaiViet->save();
            $admin = Auth::guard('admin')->user();
            $trang_thai = $BaiViet->trang_thai == 1 ? 'Hiển Thị' : 'Tạm Tắt';
            $noi_dung = $admin->ho_va_ten . ' đã cập nhật trạng thái thành ' . $trang_thai . ' của bài viết có tên: ' . $BaiViet->tieu_de_bai_viet;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        }
    }
    public function update(CreateBaiVietRequest $request)
    {
        $BaiViet = BaiViet::where('id', $request->id)->first();

        $data = $request->all();

        $BaiViet->update($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã cập nhật bài viết có tên: ' . $BaiViet->tieu_de_bai_viet;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được bài viết!',
        ]);
    }
    public function destroy(Request $request)
    {
        $BaiViet = BaiViet::where('id', $request->id)->first();
        $BaiViet->delete();
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã xóa bài viêt có tên: ' . $BaiViet->tieu_de_bai_viet;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::DELETE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa thành công!',
        ]);
    }
    public function search(Request $request)
    {
        $list = BaiViet::select('bai_viets.*')
            ->where('bai_viets.tieu_de_bai_viet', 'like', '%' . $request->key_search . '%')
            ->orWhere('bai_viets.mo_ta_ngan_bai_viet', 'like', '%' . $request->key_search . '%')
            ->orWhere('bai_viets.mo_ta_chi_tiet_bai_viet', 'like', '%' . $request->key_search . '%')
            ->orWhere('bai_viets.the_loai', 'like', '%' . $request->key_search . '%')
            ->get();
        return response()->json([
            'list'  => $list
        ]);
    }
}
