<?php

namespace App\Http\Controllers;

use App\Http\Requests\KhuVuc\CreateKhuVuc;
use App\Http\Requests\KhuVuc\DeleteKhuVuc;
use App\Http\Requests\KhuVuc\UpdateKhuVuc;
use App\Models\KhuVuc;
use App\Models\San;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhuVucController extends Controller
{

    public function index()
    {
        $check = $this->checkRule_get(1);
        if (!$check) {
            toastr()->error('Bạn không có quyền truy cập chức năng này!');
            return redirect('/admin/thong-ke');
        }
        return view('admin.page.khu_vuc.index');
    }

    public function store(CreateKhuVuc $request)
    {
        $check = $this->checkRule_post(2);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $data = $request->all();
        $khu_vuc = KhuVuc::create($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã thêm mới khu vực có tên: ' . $khu_vuc->ten_khu_vuc;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới thành công!',
        ]);
    }

    public function getData()
    {
        $data = KhuVuc::get();

        return response()->json([
            'data'  => $data
        ]);
    }
    public function changeStatus(Request $request)
    {
        $check = $this->checkRule_post(5);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $khuVuc = KhuVuc::find($request->id);

        if($khuVuc) {
            $khuVuc->tinh_trang = !$khuVuc->tinh_trang;
            $khuVuc->save();
            $admin = Auth::guard('admin')->user();
            $trang_thai = $khuVuc->tinh_trang == 1 ? 'Còn Kinh Doanh' : 'Dừng Kinh Doanh';
            $noi_dung = $admin->ho_va_ten . ' đã cập nhật trạng thái thành '. $trang_thai .' khu vực có tên: ' . $khuVuc->ten_khu_vuc;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        }
    }
    public function update(UpdateKhuVuc $request)
    {
        $check = $this->checkRule_post(3);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $khuVuc = KhuVuc::where('id', $request->id)->first();

        $data = $request->all();

        $khuVuc->update($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã cập nhật khu vực có tên: ' . $khuVuc->ten_khu_vuc;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }

    public function destroy(DeleteKhuVuc $request)
    {
        $check = $this->checkRule_post(4);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $khuVuc = KhuVuc::find($request->id);

        if($khuVuc) {
            $ban = San::where('id_khu_vuc', $request->id)->first();

            if($ban) {
                return response()->json([
                    'status'    => 2,
                    'message'   => 'Khu vực này đang có sân, bạn không thể xóa!'
                ]);
            } else {
                $khuVuc->delete();
                $admin = Auth::guard('admin')->user();
                $noi_dung = $admin->ho_va_ten . ' đã xóa khu vực có tên: ' . $khuVuc->ten_khu_vuc;
                $this->createLog($admin->id, $noi_dung, \App\Models\Log::DELETE);
                return response()->json([
                    'status'    => true,
                    'message'   => 'Đã xóa khu vực thành công!'
                ]);
            }
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Khu vực không tồn tại!'
            ]);
        }
    }
    public function checkSlug(Request $request)
    {
        if(isset($request->id)) {
            $check = KhuVuc::where('slug_khu', $request->slug_khu)
                            ->where('id', '<>', $request->id)
                            ->first();
        } else {
            $check = KhuVuc::where('slug_khu', $request->slug_khu)->first();
        }

        if($check) {
            return response()->json([
                'status'    => false,
                'message'   => 'Tên khu đã tồn tại!',
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Tên khu có thể sử dụng!',
            ]);
        }
    }


}
