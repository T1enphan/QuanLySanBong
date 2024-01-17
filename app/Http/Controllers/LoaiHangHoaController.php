<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoaiHangHoa\CreateLoaiHangRequest;
use App\Http\Requests\LoaiHangHoa\DeleteLoaiHangRequest;
use App\Http\Requests\LoaiHangHoa\UpdateLoaiHangRequest;
use App\Models\LoaiHangHoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoaiHangHoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page.loai_hang_hoa.index');
    }

    public function store(CreateLoaiHangRequest $request)
    {
        $data = $request->all();

        $LoaiHangHoa = LoaiHangHoa::create($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã thêm mới loại hàng có tên: ' . $LoaiHangHoa->ten_loai_hang;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới thành công!',
        ]);
    }
    public function getData()
    {
        $data = LoaiHangHoa::get();

        return response()->json([
            'data'  => $data
        ]);
    }
    public function changeStatus(Request $request)
    {
        $LoaiHangHoa = LoaiHangHoa::find($request->id);

        if($LoaiHangHoa) {
            $LoaiHangHoa->tinh_trang = !$LoaiHangHoa->tinh_trang;
            $LoaiHangHoa->save();
            $admin = Auth::guard('admin')->user();
            $trang_thai = $LoaiHangHoa->tinh_trang == 1 ? 'còn kinh doanh' : 'dừng kinh doanh';
            $noi_dung = $admin->ho_va_ten . ' đã cập nhật trạng thái thành ' . $trang_thai . ' của loại sân có tên: ' . $LoaiHangHoa->ten_loai_hang;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        }
    }
    public function update(UpdateLoaiHangRequest $request)
    {
        $LoaiHangHoa = LoaiHangHoa::where('id', $request->id)->first();

        $data = $request->all();

        $LoaiHangHoa->update($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã cập nhật loại sân có tên: ' . $LoaiHangHoa->ten_loai_san;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }
    public function destroy(DeleteLoaiHangRequest $request)
    {
        $LoaiHangHoa = LoaiHangHoa::find($request->id);

        if($LoaiHangHoa) {
            $LoaiHangHoa->delete();
            $admin = Auth::guard('admin')->user();
            $noi_dung = $admin->ho_va_ten . ' đã xóa loại hàng có tên: ' . $LoaiHangHoa->ten_loai_hang;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::DELETE);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã xóa  thành công!'
            ]);
        }
    }
}
