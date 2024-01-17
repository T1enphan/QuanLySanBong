<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhanQuyen\CreatePhanQuyenRequest;
use App\Http\Requests\PhanQuyen\UpdatePhanQuyenRequest;
use App\Models\Action;
use App\Models\PhanQuyen;
use Illuminate\Http\Request;

class PhanQuyenController extends Controller
{
    public function index()
    {
        return view('admin.page.phan_quyen.index');
    }
    public function Data()
    {
        $data = PhanQuyen::where('is_master', '!=', 1)
                        ->get();
        return response()->json([
            'data'   => $data,
        ]);
    }
    public function create(Request $request)
    {
        $data = $request->all();
        PhanQuyen::create($data);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã thêm mới thành công',
        ]);
    }
    public function delete(Request $request)
    {
        $phanQuyen = PhanQuyen::where('id', $request->id)->first();
        {
            if($phanQuyen)
            {
                $phanQuyen->delete();
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã Xóa Phân Quyền Thành Công',
                ]);
            }else{
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Phân Quyền Không TỒn Tại',
                ]);
            }
        }
    }
    public function update(Request $request)
    {
        $phanQuyen =PhanQuyen::where('id',$request->id)->first();
        if($phanQuyen)
        {
            $phanQuyen->update([
                'ten_quyen'   => $request->ten_quyen,
                'tinh_trang'   => $request->tinh_trang,
            ]);
            return response()->json([
                'status'    =>  1,
                'message'   => 'Cập Nhật Thành Công',
            ]);
        }else{
            return response()->json([
                'status'    => 0,
                'message'   => 'Quyền Không Tồn Tại',
            ]);
        }
    }

    public function status(Request $request)
    {
        $phanQuyen = PhanQuyen::where('id',$request->id)->first();
        if($phanQuyen){
            $phanQuyen->tinh_trang = !$phanQuyen->tinh_trang;
            $phanQuyen->save();
            return response()->json([
                'status'    =>  1 ,
                'message'   => 'Đổi trạng Thái Thành Công',
            ]);
        }
    }

    public function DataAction()
    {
        $data = Action::get();

        return response()->json([
            'data'    => $data,
        ]);
    }
    public function updateAction(Request $request){
        $quyen = PhanQuyen::find($request->id_quyen);
        $quyen->update([
            'list_rule' => $request->list_rule
        ]);

        return response()->json([
            'status' => true,
            'message' => "Cập Nhập Phân Quyền Thành Công!",
        ]);
    }
}
