@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
               <h6> Tạo Loại Khách Hàng</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Loại Khách Hàng</label>
                    <input v-model="ten_loai_khach" v-on:keyup="chuyenThanhSlug()" type="text" class="form-control" placeholder="Nhập vào loại khách hàng *">
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug Loại Khách Hàng</label>
                    <input disabled v-model="slug_loai_khach" type="text" class="form-control" placeholder="Nhập vào slug khách hàng *">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phần Trăm Giảm</label>
                    <input v-model="add.phan_tram_giam"  type="number" class="form-control" placeholder="Nhập vào phần trăm giảm *">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tình Trạng</label>
                    <select v-model="add.tinh_trang" class="form-control" placeholder="Vui lòng chọn tình trạng *">
                        <option value="1">Đang Hoạt Động</option>
                        <option value="0">Dừng Hoạt Động</option>
                    </select>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-secondary btn-sm radius-30 px-4" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-sm radius-30 px-4" v-on:click="createLoaiKhach()">Xác nhận</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card  border-bottom border-3 border-0">
            <div class="card-header">
                <h6>Danh Sách Loại Khách</h6>
            </div>
            <div class="card-body">
                <table class="table mb-0">
                    <thead>
                        <tr class="table-light">
                            <th >#</th>
                            <th >Loại Khách Hàng</th>
                            <th >Phần Trăm Giảm</th>
                            <th >Tình Trạng</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(value, key) in list">
                            <tr>
                                <th class=" align-middle">@{{ key + 1 }}</th>
                                <td class="align-middle">@{{ value.ten_loai_khach }}</td>
                                <td class="align-middle ">@{{ value.phan_tram_giam }}%</td>
                                <td class="align-middle ">
                                    <button v-on:click="changeStatus(value)" v-if="value.tinh_trang == 1"
                                    class="btn btn-primary btn btn-sm radius-30 px-4">Đang Hoạt Động</button>
                                <button v-on:click="changeStatus(value)" v-else class="btn btn-white btn-sm radius-30 px-4">Dừng Hoạt Động</button>

                                </td>
                                <td class="align-middle ">
                                   <div class="d-flex order-actions  ">
                                        <a v-on:click="edit = value" data-bs-toggle="modal"data-bs-target="#updateModal" ><i class="bx bxs-edit"></i></a>
                                        <a v-on:click="del = value"  class="ms-3" data-bs-toggle="modal"data-bs-target="#deleteModal"><i class="bx bxs-trash "></i></a>
                                    </div>
                                </td>
                            </tr>
                        </template>

                    </tbody>
                </table>
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h1 class="modal-title fs-5 " id="exampleModalLabel">Cập nhật</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Loại Khách Hàng</label>
                                <input v-model="edit.ten_loai_khach" v-on:keyup="chuyenThanhSlugEdit()"type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug Loại Khách Hàng</label>
                                <input disabled v-model="edit.slug_loai_khach" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phần Trăm Giảm</label>
                                <input v-model="edit.phan_tram_giam"  type="number" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tình Trạng</label>
                                <select v-model="edit.tinh_trang" class="form-control" placeholder="Vui lòng chọn tình trạng *">
                                    <option value="1">Đang Hoạt Động</option>
                                    <option value="0">Dừng Hoạt Động</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                            data-bs-dismiss="modal">Đóng</button>
                        <button v-on:click="updateLoaiKhach()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>


                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h1 class="modal-title fs-5 " id="exampleModalLabel">Xóa</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        <div class="modal-body">
                            <div >
                                Bạn có chắc chắn muốn xóa <b class=" text-uppercase">@{{ del.ten_loai_khach }}</b> này không?
                            </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="delLoaiKhach()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    new Vue({
        el : "#app",
            data : {
                add              : { phan_tram_giam : 0},
                list             : [],
                edit             : {},
                del              : {},
                slug_loai_khach  : '',
                ten_loai_khach   : '',

            },
            created() {
                this.loadData();
            },
            methods : {
                createLoaiKhach() {
                        this.add.slug_loai_khach = this.slug_loai_khach;
                        this.add.ten_loai_khach = this.ten_loai_khach;
                    axios
                        .post('/admin/loai-khach-hang/create', this.add)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                                $('#exampleModal').modal('hide');
                            }else{
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })

                        });
                },
                loadData() {
                    axios
                        .get('/admin/loai-khach-hang/data')
                        .then((res) => {
                            this.list  =  res.data.data;
                        });
                },
                updateLoaiKhach() {
                    axios
                        .post('/admin/loai-khach-hang/update', this.edit)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                                $('#updateModal').modal('hide');
                            }else{
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })
                        });
                },
                delLoaiKhach() {
                    axios
                        .post('/admin/loai-khach-hang/delete', this.del)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                this.loadData();
                                $('#deleteModal').modal('hide');
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message);
                            } else if (res.data.status == 2) {
                                toastr.warning(res.data.message);
                            }
                        });
                },
                toSlug(str) {
                    str = str.toLowerCase();
                    str = str
                        .normalize('NFD')
                        .replace(/[\u0300-\u036f]/g, '');
                    str = str.replace(/[đĐ]/g, 'd');
                    str = str.replace(/([^0-9a-z-\s])/g, '');
                    str = str.replace(/(\s+)/g, '-');
                    str = str.replace(/-+/g, '-');
                    str = str.replace(/^-+|-+$/g, '');

                    return str;
                },
                changeStatus(v) {
                    axios
                        .post('/admin/loai-khach-hang/changestatus', v)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                            }else{
                                toastr.error(res.data.message);
                            }
                        });
                },

                chuyenThanhSlug(){
                    this.slug_loai_khach = this.toSlug(this.ten_loai_khach);
                },

                chuyenThanhSlugEdit(){
                    this.edit.slug_loai_khach = this.toSlug(this.edit.ten_loai_khach);
                },

            }
    });
</script>
@endsection
