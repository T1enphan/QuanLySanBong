 v-on:click="updateTrangThaiGiai(v)"@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h6>Danh Sách Giải Đấu</h6>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#themMoiModal">Thêm Mới</button>
                </div>
            </div>
            {{-- Modal thêm mới giải đấu --}}
            <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tạo Mới Giải Đấu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label>Tên Giải Đấu</label>
                                    <input v-model="add.ten_giai_dau" type="text" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2 ">
                                    <label>Số Đội</label>
                                    <input v-model="add.so_doi" type="number" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2 ">
                                    <label>Số Bảng Đấu</label>
                                    <input v-model="add.so_bang_dau" type="number" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2 ">
                                    <label>Số Trận</label>
                                    <input v-model="add.so_tran" type="number" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2 ">
                                    <label>Số Giải Thưởng</label>
                                    <input v-model="add.so_giai_thuong" type="number" class="form-control">
                                </div>
                                <div class="col-md-12 mt-2 ">
                                    <label>Thông Tin Giải Đấu</label>
                                    <textarea v-model="add.thong_tin_giai_dau" class="form-control" cols="30" rows="7"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" v-on:click="themMoiGiaiDau()">Xác Nhận</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="table-light">
                                <th class="text-center align-middle">#</th>
                                <th class="text-center align-middle">Tên Giải Đấu</th>
                                <th class="text-center align-middle">Số Đội</th>
                                <th class="text-center align-middle">Số Bảng Đấu</th>
                                <th class="text-center align-middle">Số Trận</th>
                                <th class="text-center align-middle">Thông Tin Giải Đấu</th>
                                <th class="text-center align-middle">Tình Trạng</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(v, k) in list_giai_dau">
                                <tr>
                                    <th class="text-center align-middle">@{{ k + 1 }}</th>
                                    <td class="align-middle">@{{ v.ten_giai_dau }}</td>
                                    <td class="text-center align-middle">@{{ v.so_doi }}</td>
                                    <td class="text-center align-middle">@{{ v.so_bang_dau }}</td>
                                    <td class="text-center align-middle">@{{ v.so_tran }}</td>
                                    <td class="text-center align-middle">
                                        <i class="fa-solid fa-circle-info text-primary fa-2x" v-on:click="ghi_chu = v.thong_tin_giai_dau" data-bs-toggle="modal" data-bs-target="#thongtinModal"></i>
                                    </td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-warning" style="width: 140px;" v-on:click="updateTrangThaiGiai(v)" v-if="v.tinh_trang == 0">Chưa Bắt Đầu</button>
                                        <button class="btn btn-success" style="width: 140px;" v-on:click="updateTrangThaiGiai(v)" v-else-if="v.tinh_trang == 1">Đang Diễn Ra</button>
                                        <button class="btn btn-danger" style="width: 140px;" v-on:click="updateTrangThaiGiai(v)" v-else>Đã Kết Thúc</button>
                                    </td>
                                    <td class="text-center align-middle">
                                        <i class="fa-solid fa-rectangle-list fa-2x text-primary" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" v-on:click="update = v" data-bs-toggle="modal" data-bs-target="#updateModal">Cập Nhật Giải Đấu</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" v-on:click="update = v, getDoiBongCuaGiai()" data-bs-toggle="modal" data-bs-target="#updateDoiBongModal">Cập Nhật Đội Bóng</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" target="_blank" v-bind:href="'/admin/giai-dau/chi-tiet-giai/' + v.id">Chi Tiết Giải Đấu</a></li>
                                        </ul>
                                        <i class="fa-solid fa-trash text-danger fa-2x" v-on:click="del = v" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- modal thông tin giải đấu --}}
            <div class="modal fade" id="thongtinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Giải Đấu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @{{ ghi_chu }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" v-on:click="capNhatGiaiDau()">Xác Nhận</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal cập nhật giải đấu --}}
            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Giải Đấu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label>Tên Giải Đấu</label>
                                    <input v-model="update.ten_giai_dau" type="text" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2 ">
                                    <label>Số Đội</label>
                                    <input v-model="update.so_doi" type="number" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2 ">
                                    <label>Số Bảng Đấu</label>
                                    <input v-model="update.so_bang_dau" type="number" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2 ">
                                    <label>Số Giải Thưởng</label>
                                    <input v-model="update.so_giai_thuong" type="number" class="form-control">
                                </div>
                                <div class="col-md-12 mt-2 ">
                                    <label>Thông Tin Giải Đấu</label>
                                    <textarea v-model="update.thong_tin_giai_dau" class="form-control" cols="30" rows="7"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" v-on:click="capNhatGiaiDau()">Xác Nhận</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal xóa giải đấu --}}
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Giải Đấu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Bạn đang xóa giải đấu - @{{ del.ten_giai_dau }}
                            <p>Mọi dữ liệu sẽ mất sau khi <b>XÁC NHẬN</b></p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-danger" v-on:click="delGiaiDau()">Xác Nhận</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal cập nhật đội bóng cho giải --}}
            <div class="modal fade" id="updateDoiBongModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Danh Sách Đội Bóng Cho Giải - @{{ update.ten_giai_dau }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr class="table-light">
                                        <th class="text-center align-middle text-nowrap">#</th>
                                        <th class="text-center align-middle text-nowrap">Tên Đội Bóng</th>
                                        <th class="text-center align-middle text-nowrap">Số Lượng Cầu Thủ</th>
                                        <th class="text-center align-middle text-nowrap">Điểm Số</th>
                                        <th class="text-center align-middle text-nowrap">Bảng Giải Đấu</th>
                                        <th class="text-center align-middle text-nowrap">Tình Trạng Giải Đấu</th>
                                        <th class="text-center align-middle text-nowrap">Kết Quả Giải Đấu</th>
                                        <th class="text-center align-middle text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(v, k) in list_ds_doi_bong">
                                        <tr>
                                            <th class="text-center align-middle">@{{ k + 1 }}</th>
                                            <td class="text-center align-middle">
                                                <input type="text" v-if="update.tinh_trang > 0" disabled v-model="v.ten_doi_bong" class="form-control">
                                                <input type="text" v-else v-on:change="updateDoiBongGiaiDau(v)" v-model="v.ten_doi_bong" class="form-control">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="number" v-if="update.tinh_trang > 0" disabled v-model="v.so_luong_cau_thu" class="form-control">
                                                <input type="number" v-else v-on:change="updateDoiBongGiaiDau(v)" v-model="v.so_luong_cau_thu" class="form-control">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="number" v-if="update.tinh_trang < 2" v-on:change="updateDoiBongGiaiDau(v)" v-model="v.diem_so" class="form-control">
                                                <input type="number" v-else disabled v-model="v.diem_so" class="form-control">
                                            </td>
                                            <td class="text-center align-middle">
                                                <select v-if="update.tinh_trang > 0" disabled v-model="v.bang_giai_dau" v-on:change="updateDoiBongGiaiDau(v)" class="form-control">
                                                    <template v-for="(value, key) in update.so_bang_dau">
                                                        <option v-bind:value="(key + 1)">Bảng - @{{ key + 1 }}</option>
                                                    </template>
                                                </select>
                                                <select v-else v-model="v.bang_giai_dau" v-on:change="updateDoiBongGiaiDau(v)" class="form-control">
                                                    <template v-for="(value, key) in update.so_bang_dau">
                                                        <option v-bind:value="(key + 1)">Bảng - @{{ key + 1 }}</option>
                                                    </template>
                                                </select>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button class="btn btn-success" v-on:click="v.tinh_trang_giai_dau = 0, updateDoiBongGiaiDau(v)" v-if="v.tinh_trang_giai_dau == 1">Hoạt Động</button>
                                                <button class="btn btn-danger" v-on:click="v.tinh_trang_giai_dau = 1, updateDoiBongGiaiDau(v)" v-else>Bị Loại</button>
                                            </td>
                                            <td class="text-center align-middle">
                                                ...
                                            </td>
                                            <td class="text-center align-middle">
                                                <button class="btn btn-danger" v-on:click="xoaDoiBong(v)">Xóa</button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
            el: '#app',
            data: {
                add                 : {},
                update              : {},
                del                 : {},
                list_giai_dau       : [],
                list_ds_doi_bong    : [],
                ghi_chu             : ''
            },
            created() {
                this.loadData();
            },
            methods: {
                loadData(){
                    axios
                        .get('/admin/giai-dau/data')
                        .then((res) => {
                            this.list_giai_dau = res.data.data;
                        });
                },

                themMoiGiaiDau(){
                    axios
                        .post('/admin/giai-dau/create', this.add)
                        .then((res) => {
                            if(res.data.status){
                                toastr.success(res.data.message);
                                $('#themMoiModal').modal('hide');
                                this.loadData();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },

                capNhatGiaiDau(){
                    axios
                        .post('/admin/giai-dau/update', this.update)
                        .then((res) => {
                            if(res.data.status){
                                toastr.success(res.data.message);
                                $('#updateModal').modal('hide');
                                this.loadData();
                            }else{
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },

                getDoiBongCuaGiai(){
                    axios
                        .post('/admin/giai-dau/get-doi-bong-cua-giai', this.update)
                        .then((res) => {
                            this.list_ds_doi_bong = res.data.data;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },

                updateDoiBongGiaiDau(v){
                    axios
                        .post('/admin/giai-dau/update-doi-bong-cua-giai', v)
                        .then((res) => {
                            if(res.data.status){
                                toastr.success(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },

                xoaDoiBong(v){
                    axios
                        .post('/admin/giai-dau/delete-doi-bong-cua-giai', v)
                        .then((res) => {
                            if(res.data.status){
                                toastr.success(res.data.message);
                                this.getDoiBongCuaGiai();
                                this.loadData();
                            }else{
                                toastr.error(res.data.message);
                                this.getDoiBongCuaGiai();
                                this.loadData();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },

                delGiaiDau(){
                    axios
                        .post('/admin/giai-dau/delete', this.del)
                        .then((res) => {
                            if(res.data.status){
                                toastr.success(res.data.message);
                                $('#deleteModal').modal('hide');
                                this.loadData();
                            }else{
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },

                updateTrangThaiGiai(v){
                    axios
                        .post('/admin/giai-dau/trang-thai', v)
                        .then((res) => {
                            if(res.data.status){
                                toastr.success(res.data.message);
                                this.loadData();
                            }else{
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                }
            },
        });
    </script>
@endsection
