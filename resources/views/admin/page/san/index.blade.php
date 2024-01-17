@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
               <h6> Tạo Sân</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Tên Sân</label>
                    <input v-model="ten_san"  v-on:keyup="chuyenThanhSlug()"type="text" class="form-control" placeholder="Nhập vào tên sân *">
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug Sân</label>
                    <input disabled v-model="slug_ten_san" type="text" class="form-control" placeholder="Nhập vào slug sân *">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tiền</label>
                    <input v-model="tien_goc" type="number" class="form-control" placeholder="Nhập vào tiền theo giờ*">
                </div>
                <div class="mb-3">
                    <label class="form-label">Loại Sân</label>
                    <select v-model="add.id_loai_san" class="form-control">
                        <template v-for="(value, key) in listLSan">
                            <option v-bind:value="value.id">@{{value.loai_san}}</option>
                        </template>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Khu Vực</label>
                    <select v-model="add.id_khu_vuc" class="form-control">
                        <template v-for="(value, key) in listLKhuVuc">
                            <option v-bind:value="value.id">@{{value.ten_khu_vuc}}</option>
                        </template>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tình Trạng</label>
                    <select v-model="add.tinh_trang" class="form-control">
                        <option value="1">Còn Kinh Doanh</option>
                        <option value="0">Dừng Kinh Doanh</option>
                    </select>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-secondary btn-sm radius-30 px-4" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-sm radius-30 px-4" v-on:click="createSan()">Xác nhận</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-bottom border-3 border-0">
            <div class="card-header">
                <h5>Danh Sách Sân</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr class="table-light">
                                <th>#</th>
                                <th>Tên Sân</th>
                                <th>Loại Sân</th>
                                <th>Khu Vực</th>
                                <th>Tiền</th>
                                <th>Tình Trạng</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class=" align-middle">@{{ key + 1 }}</th>
                                    <td class="align-middle">@{{ value.ten_san }}</td>
                                    <td class="align-middle">@{{ value.loai_san }}</td>
                                    <td class="align-middle">@{{ value.ten_khu_vuc }} </td>
                                    <td class="align-middle">@{{ value.tien_goc }} VNĐ</td>
                                    <td class="align-middle ">
                                        <button v-on:click="changeStatus(value)" v-if="value.tinh_trang == 1"
                                        class="btn btn-primary btn btn-sm radius-30 px-4">Còn Kinh Doanh</button>
                                    <button v-on:click="changeStatus(value)" v-else class="btn btn-white btn-sm radius-30 px-4">Dừng Kinh
                                        Doanh</button>
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
                </div>

                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header ">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật</h1>
                            <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Tên Sân</label>
                                <input v-model="edit.ten_san" v-on:keyup="chuyenThanhSlugEdit()" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug Sân</label>
                                <input disabled v-model="edit.slug_ten_san" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tiền</label>
                                <input v-model="edit.tien_goc" type="number" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Loại Sân</label>
                                <select v-model="edit.id_loai_san" class="form-control">
                                    <template v-for="(value, key) in listLSan">
                                        <option v-bind:value="value.id">@{{value.loai_san}}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Khu Vực</label>
                                <select v-model="edit.id_khu_vuc" class="form-control">
                                    <template v-for="(value, key) in listLKhuVuc">
                                        <option v-bind:value="value.id">@{{value.ten_khu_vuc}}</option>
                                    </template>
                                </select>
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
                        <button v-on:click="updateSan()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>

                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h1 class="modal-title fs-5 " id="exampleModalLabel">Xóa </h1>
                                <button type="button" class="btn-close  " data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        <div class="modal-body">
                            <div >
                                Bạn có chắc chắn muốn xóa <b class=" text-uppercase">@{{ del.ten_san }}</b> này không?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                            data-bs-dismiss="modal">Đóng</button>
                        <button v-on:click="delSan()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>

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
                add            : {},
                listLSan       : [],
                listLKhuVuc    : [],
                list           : [],
                edit           : {},
                del            : {},
                slug_ten_san   : '',
                ten_san        : '',
                tien_goc       : '',
            },
            created() {
                this.loadDataLoaiSan();
                this.loadDataKhuVuc();
                this.loadData();
            },
            methods : {

                createSan() {
                        this.add.slug_ten_san = this.slug_ten_san;
                        this.add.ten_san = this.ten_san;
                        this.add.tien_goc = this.tien_goc
                    axios
                        .post('/admin/san/create', this.add)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                                $('#exampleModal').modal('hide');
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })

                        });
                },
                loadDataLoaiSan() {
                    axios
                        .get('/admin/san/data-ls')
                        .then((res) => {
                            this.listLSan  =  res.data.data;
                        });
                },
                loadDataKhuVuc() {
                    axios
                        .get('/admin/san/data-kv')
                        .then((res) => {
                            this.listLKhuVuc  =  res.data.data;
                        });
                },
                loadData() {
                    axios
                        .get('/admin/san/data')
                        .then((res) => {
                            this.list  =  res.data.data;

                        });
                },
                changeStatus(v) {
                    axios
                        .post('/admin/san/changestatus',v)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                            }
                        });
                },
                updateSan() {

                    axios
                        .post('/admin/san/update', this.edit)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                                $('#updateModal').modal('hide');
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })
                        });
                },
                delSan() {
                    axios
                        .post('/admin/san/delete', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                                $('#deleteModal').modal('hide');
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

                chuyenThanhSlug(){
                    this.slug_ten_san = this.toSlug(this.ten_san);
                },

                chuyenThanhSlugEdit(){
                    this.edit.slug_ten_san = this.toSlug(this.edit.ten_san);
                },

            }
    });
</script>
@endsection
