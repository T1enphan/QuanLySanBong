@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                   <h6> Tạo Khu Vực</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Khu Vực</label>
                        <input v-model="ten_khu_vuc"type="text" v-on:keyup="chuyenThanhSlug()" class="form-control"
                            placeholder="Nhập vào tên khu vực *">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug Khu Vực</label>
                        <input disabled v-model="slug_khu_vuc" type="text" class="form-control"
                            placeholder="Nhập vào slug khu vực *">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tình Trạng</label>
                        <select v-model="add.tinh_trang" class="form-control" placeholder="Vui lòng chọn tình trạng *">
                            <option value="1">Còn Kinh Doanh</option>
                            <option value="0">Dừng Kinh Doanh</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-secondary btn-sm radius-30 px-4" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btn-sm radius-30 px-4" v-on:click="createKhuVuc()">Xác nhận</button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-bottom border-3 border-0">
                <div class="card-header">
                    <h6>Danh Sách Khu Vực</h6>
                </div>
                <div class="card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr class="table-light">
                                <th >#</th>
                                <th >Tên Khu Vực</th>
                                <th >Tình Trạng</th>
                                <th >Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class="text-center align-middle">@{{ key + 1 }}</th>
                                    <td class="align-middle">@{{ value.ten_khu_vuc }}</td>
                                    <td class="align-middle">
                                        <button v-on:click="changeStatus(value)" v-if="value.tinh_trang == 1"
                                            class="btn btn-primary btn btn-sm radius-30 px-4">Còn Kinh Doanh</button>
                                        <button v-on:click="changeStatus(value)" v-else class="btn btn-white btn-sm radius-30 px-4">Dừng Kinh
                                            Doanh</button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex order-actions  ">
                                            <a v-on:click="edit = value" data-bs-toggle="modal"data-bs-target="#updateModal" ><i class="bx bxs-edit"></i></a>
                                            <a v-on:click="del = value"  class="ms-3" data-bs-toggle="modal"data-bs-target="#deleteModal"><i class="bx bxs-trash "></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </template>

                        </tbody>
                    </table>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title fs-5" id="exampleModalLabel">Cập nhật</h6>
                                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tên Khu Vực</label>
                                        <input v-model="edit.ten_khu_vuc" v-on:keyup="chuyenThanhSlugEdit()"
                                            type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Slug Khu Vực</label>
                                        <input disabled v-model="edit.slug_khu_vuc" type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tình Trạng</label>
                                        <select v-model="edit.tinh_trang" class="form-control">
                                            <option value="1">Còn Kinh Doanh</option>
                                            <option value="0">Dừng Kinh Doanh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="updateKhuVuc()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h6 class="modal-title fs-5 " id="exampleModalLabel">Xóa</h6>
                                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        Bạn có chắc chắn muốn xóa <b
                                            class=" text-uppercase">@{{ del.ten_khu_vuc }}</b> này không?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class=" btn btn-secondary btn-sm radius-30 px-4"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-primary btn-sm radius-30 px-4" v-on:click="delKhuVuc()"
                                        data-bs-dismiss="modal">Xác nhận</button>
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
            el: "#app",
            data: {
                add: {},
                list: [],
                edit: {},
                del: {},
                slug_khu_vuc: '',
                ten_khu_vuc: '',

            },
            created() {
                this.loadData();
            },
            methods: {

                createKhuVuc() {
                    this.add.slug_khu_vuc = this.slug_khu_vuc;
                    this.add.ten_khu_vuc = this.ten_khu_vuc;
                    axios
                        .post('/admin/khu-vuc/create', this.add)
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
                        .get('/admin/khu-vuc/data')
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
                changeStatus(v) {
                    axios
                        .post('/admin/khu-vuc/changestatus', v)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                            }else{
                                toastr.error(res.data.message);
                            }
                        });
                },
                updateKhuVuc() {
                    axios
                        .post('/admin/khu-vuc/update', this.edit)
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
                delKhuVuc() {
                    axios
                        .post('/admin/khu-vuc/delete', this.del)
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

                chuyenThanhSlug() {
                    this.slug_khu_vuc = this.toSlug(this.ten_khu_vuc);
                },

                chuyenThanhSlugEdit() {
                    this.edit.slug_khu_vuc = this.toSlug(this.edit.ten_khu_vuc);
                },

            }
        });
    </script>
@endsection
