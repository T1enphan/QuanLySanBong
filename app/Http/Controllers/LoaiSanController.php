<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoaiSan\CreateLoaiSan;
use App\Http\Requests\LoaiSan\DeleteLoaiSan;
use App\Http\Requests\LoaiSan\UpdateLoaiSan;
use App\Models\LoaiSan;
use App\Models\San;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoaiSanController extends Controller
{
    public function index()
    {
        return view('admin.page.loai_san.index');
    }

    public function store(CreateLoaiSan $request)
    {
        $data = $request->all();

        $LoaiSan = LoaiSan::create($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã thêm mới loại sân có tên: ' . $LoaiSan->loai_san;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới thành công!',
        ]);
    }
    public function getData()
    {
        $data = LoaiSan::get();

        return response()->json([
            'data'  => $data
        ]);
    }
    public function changeStatus(Request $request)
    {
        $LoaiSan = LoaiSan::find($request->id);

        if($LoaiSan) {
            $LoaiSan->tinh_trang = !$LoaiSan->tinh_trang;
            $LoaiSan->save();
            $admin = Auth::guard('admin')->user();
            $trang_thai = $LoaiSan->tinh_trang == 1 ? 'còn kinh doanh' : 'dừng kinh doanh';
            $noi_dung = $admin->ho_va_ten . ' đã cập nhật trạng thái thành ' . $trang_thai . ' của loại sân có tên: ' . $LoaiSan->loai_san;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        }
    }
    public function update(UpdateLoaiSan $request)
    {
        $LoaiSan = LoaiSan::where('id', $request->id)->first();

        $data = $request->all();

        $LoaiSan->update($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã cập nhật loại sân có tên: ' . $LoaiSan->loai_san;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }
    public function destroy(DeleteLoaiSan $request)
    {
        $LoaiSan = LoaiSan::find($request->id);

        if($LoaiSan) {
            $san = San::where('id_loai_san', $request->id)->first();

            if($san) {
                return response()->json([
                    'status'    => 2,
                    'message'   => 'Loại sân này đang có sân, bạn không thể xóa!'
                ]);
            } else {
                $LoaiSan->delete();
                $admin = Auth::guard('admin')->user();
                $noi_dung = $admin->ho_va_ten . ' đã xóa loại sân có tên: ' . $LoaiSan->loai_san;
                $this->createLog($admin->id, $noi_dung, \App\Models\Log::DELETE);
                return response()->json([
                    'status'    => true,
                    'message'   => 'Đã xóa sân thành công!'
                ]);
            }
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Sân không tồn tại!'
            ]);
        }
    }

}
