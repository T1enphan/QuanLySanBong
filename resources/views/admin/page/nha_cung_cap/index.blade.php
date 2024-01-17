@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
               <h6> Tạo Nhà Cung Cấp</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 mb-2">
                    <label class="form-label">Mã số thuế</label>
                    <input v-model="add.ma_so_thue" type="text" class="form-control">
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label">Tên công ty</label>
                    <input v-model="add.ten_cong_ty" type="text" class="form-control">
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label">Tên người đại diện</label>
                    <input v-model="add.ten_nguoi_dai_dien" type="text" class="form-control">
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label">Số điện thoại</label>
                    <input v-model="add.so_dien_thoai" type="text" class="form-control">
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label">Email</label>
                    <input v-model="add.email" type="email" class="form-control">
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label">Địa chỉ</label>
                    <input v-model="add.dia_chi"  type="text" class="form-control">
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label">Tên gợi nhớ</label>
                    <input v-model="add.ten_goi_nho" type="text" class="form-control">
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label" >Tình Trang</label>
                    <select class="form-control" v-model="add.tinh_trang">
                        <option value="1">Còn Hoạt Động</option>
                        <option value="0">Dừng Hoạt Động</option>

                    </select>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-secondary btn-sm radius-30 px-4" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-sm radius-30 px-4" v-on:click="addNhaCungCap()">Xác nhận</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
               <h6> Danh Sách Nhà Cung Cấp</h6>
            </div>
            <div class="card-body">
                <table class="table mb-0">
                    <thead>
                        <tr >
                            <th class="align-middle text-center text-nowrap">Tìm kiếm</th>
                            <th colspan="1">
                                <input v-model="key_search" v-on:keyup.enter="search()" type="text" class="form-control">
                            </th>
                            <th class=" text-white text-left">
                                <button class="btn btn-primary btn-sm radius-30 px-4" v-on:click="search()">Tìm Kiếm</button>
                            </th>
                        </tr>
                        <tr class="table-light">
                            <th class="text-center">#</th>
                            <th class="text-center">Thông Tin Công Ty</th>
                            <th class="text-center">Thông Tin Liên Hệ</th>
                            <th class="text-center">Tình Trạng</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(value, key) in list">
                            <tr>
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="align-middle">
                                    <table class="table mb-0">
                                        <tr>
                                            <th>Mã số thuế</th>
                                            <td>@{{ value.ma_so_thue }}</td>
                                        </tr>
                                        <tr>
                                            <th>Địa chỉ</th>
                                            <td>@{{ value.dia_chi }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tên công ty</th>
                                            <td>@{{ value.ten_cong_ty }}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="align-middle">
                                    <table class="table mb-0">
                                        <tr>
                                            <th>Người Đại Diện</th>
                                            <td>@{{ value.ten_nguoi_dai_dien }}</td>
                                        </tr>
                                        <tr>
                                            <th>Số điện thoại</th>
                                            <td>@{{ value.so_dien_thoai }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>@{{ value.email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tên gợi nhớ</th>
                                            <td>@{{ value.ten_goi_nho }}</td>
                                        </tr>
                                    </table>
                                </td>
                                {{-- <td class="text-center align-middle">
                                    <template v-if="value.tinh_trang == 1">
                                        <button class="btn btn-primary">Hiển Thị</button>
                                    </template>
                                    <template v-else>
                                        <button class="btn btn-danger">Tạm Tắt</button>
                                    </template>

                                </td> --}}
                                <td class="align-middle text-center text-nowrap">
                                    <button v-on:click="changeStatus(value)" v-if="value.tinh_trang == 1"
                                        class="btn btn-primary btn btn-sm radius-30 px-4">Còn Hoạt Động</button>
                                    <button v-on:click="changeStatus(value)" v-else class="btn btn-white btn-sm radius-30 px-4">Dừng Hoạt Động</button>
                                </td>
                                <td class="text-center text-nowrap align-middle">

                                    <div class="d-flex order-actions  ">
                                        <a v-on:click="edit = value" data-bs-toggle="modal"data-bs-target="#updateModal" ><i class="bx bxs-edit"></i></a>
                                        <a v-on:click="destroy = value"  class="ms-3" data-bs-toggle="modal"data-bs-target="#deleteModal"><i class="bx bxs-trash "></i></a>
                                    </div>
                                </td>
                            </tr>

                        </template>

                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h1 class="modal-title fs-5 " id="exampleModalLabel">Cập nhật</h1>
                            <button type="button" class="btn-close " data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <input v-model="edit.id" name="id" class="form-control mt-1" type="hidden">
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Mã số thuế</label>
                                    <input v-model="edit.ma_so_thue"  type="text" class="form-control">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Tên công ty</label>
                                    <input v-model="edit.ten_cong_ty"  type="text" class="form-control">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Tên người đại diện</label>
                                    <input v-model="edit.ten_nguoi_dai_dien"  type="text" class="form-control">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Số điện thoại</label>
                                    <input v-model="edit.so_dien_thoai" type="text" class="form-control">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Email</label>
                                    <input v-model="edit.email" type="text" class="form-control">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Địa chỉ</label>
                                    <input v-model="edit.dia_chi"  type="text" class="form-control">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Tên gợi nhớ</label>
                                    <input v-model="edit.ten_goi_nho" ntype="text" class="form-control">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label" >Tình Trang</label>
                                    <select class="form-control" v-model="edit.tinh_trang">
                                        <option value="1">Còn Hoạt Động</option>
                                        <option value="0">Dừng Hoạt Động</option>

                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="UpdateNhaCungCap()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h1 class="modal-title fs-5 " id="exampleModalLabel">Xóa </h1>
                            <button type="button" class="btn-close " data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc chắn xóa nhà cung cấp <b>@{{destroy.ten_cong_ty}}</b> không!!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                            data-bs-dismiss="modal">Đóng</button>
                        <button v-on:click="DeleteNhaCungCap()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>


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
        el      :'#app',
        data    :{
            list        :   [],
            add         :   {},
            edit        :   {},
            destroy     :   {},
            key_search : '',

        },
        created()   {
            this.loadData();
        },
        methods :   {
            search() {
                var payload = {
                    'key_search'    :   this.key_search
                }
                axios
                    .post('/admin/nha-cung-cap/search', payload)
                    .then((res) => {
                        this.list = res.data.list;
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },
            addNhaCungCap() {
                axios
                    .post('/admin/nha-cung-cap/create', this.add)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            this.loadData();
                            this.add = {};
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
                    .get('/admin/nha-cung-cap/data')
                    .then((res) => {
                        this.list = res.data.data;
                    });
            },
            UpdateNhaCungCap() {
                axios
                    .post('/admin/nha-cung-cap/update',this.edit)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            this.loadData();
                            $('#updateModal').modal('hide');
                        } else {
                            toastr.error(res.data.message);
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },
            DeleteNhaCungCap() {
                axios
                    .post('/admin/nha-cung-cap/delete', this.destroy)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message);
                            this.loadData();
                            $('#deleteModal').modal('hide');
                        } else {
                            toastr.error(res.data.message);
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },
            changeStatus(v) {
                    axios
                        .post('/admin/nha-cung-cap/doi-trang-thai', v)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            }
                        });
                },

        },
    });

</script>
@endsection
