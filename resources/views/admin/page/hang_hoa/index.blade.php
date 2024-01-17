@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                   <h6> Tạo Hàng Hóa</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Hàng</label>
                        <input v-model="add.ten_hang"type="text" class="form-control"
                            placeholder="Nhập vào tên hàng *">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá Hàng</label>
                        <input v-model="add.gia_hang"type="number" class="form-control"
                            placeholder="Nhập vào giá hàng *">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tình Trạng</label>
                        <select v-model="add.tinh_trang" class="form-control" placeholder="Vui lòng chọn tình trạng *">
                            <option value="1">Còn Kinh Doanh</option>
                            <option value="0">Dừng Kinh Doanh</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loai Hàng Hóa</label>
                        <select v-model="add.id_loai_hang" class="form-control">
                            <template v-for="(value, key) in listLoaiHang">
                                <option v-bind:value="value.id">@{{value.ten_loai_hang}}</option>
                            </template>

                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-secondary btn-sm radius-30 px-4" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btn-sm radius-30 px-4" v-on:click="createHangHoa()">Xác nhận</button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-bottom border-3 border-0">
                <div class="card-header">
                    <h6>Danh Sách Hàng Hóa</h6>
                </div>
                <div class="card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr class="table-light">
                                <th >#</th>
                                <th >Tên Hàng</th>
                                <th >Giá Hàng</th>
                                <th >Số Lượng Hàng</th>
                                <th >Loại Hàng</th>
                                <th >Tình Trạng</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class=" align-middle">@{{ key + 1 }}</th>
                                    <td class="align-middle">@{{ value.ten_hang }}</td>
                                    <td class="align-middle ">@{{ number_format(value.gia_hang) }}đ</td>
                                    <td class="align-middle ">@{{ value.so_luong }}</td>
                                    <td class="align-middle ">@{{ value.ten_loai_hang }}</td>
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
                            </template>

                        </tbody>
                    </table>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h1 class="modal-title fs-5 e" id="exampleModalLabel">Cập nhật</h1>
                                    <button type="button" class="btn-close " data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tên Hàng</label>
                                        <input v-model="edit.ten_hang"type="text" class="form-control"
                                            placeholder="Nhập vào tên hàng *">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Giá Hàng</label>
                                        <input v-model="edit.gia_hang"type="number" class="form-control"
                                            placeholder="Nhập vào giá hàng *">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tình Trạng</label>
                                        <select v-model="edit.tinh_trang" class="form-control" placeholder="Vui lòng chọn tình trạng *">
                                            <option value="1">Còn Kinh Doanh</option>
                                            <option value="0">Dừng Kinh Doanh</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Loai Hàng Hóa</label>
                                        <select v-model="edit.id_loai_hang" class="form-control">
                                            <template v-for="(value, key) in listLoaiHang">
                                                <option v-bind:value="value.id">@{{value.ten_loai_hang}}</option>
                                            </template>

                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                    data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="updateHangHoa()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h1 class="modal-title fs-5 e" id="exampleModalLabel">Xóa </h1>
                                    <button type="button" class="btn-close " data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        Bạn có chắc chắn muốn xóa <b
                                            class=" text-uppercase">@{{ del.ten_hang }}</b> không?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                    data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="delHangHoa()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>


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
                add   : {},
                list  : [],
                edit  : {},
                del   : {},
                listLoaiHang      : [],


            },
            created() {
                this.loadData();
                this.loadDataLoaiHang();
            },
            methods: {
                date_format(now) {
                    return moment(now).format('DD/MM/yyyy');
                },
                number_format(number, decimals = 0, dec_point = ",", thousands_sep = ".") {
                    var n = number,
                    c = isNaN((decimals = Math.abs(decimals))) ? 2 : decimals;
                    var d = dec_point == undefined ? "," : dec_point;
                    var t = thousands_sep == undefined ? "." : thousands_sep,
                        s = n < 0 ? "-" : "";
                    var i = parseInt((n = Math.abs(+n || 0).toFixed(c))) + "",
                        j = (j = i.length) > 3 ? j % 3 : 0;

                    return (s +(j ? i.substr(0, j) + t : "") +i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) +(c? d +
                            Math.abs(n - i)
                                .toFixed(c)
                                .slice(2)
                            : "")
                    );
                },
                createHangHoa() {

                    axios
                        .post('/admin/hang-hoa/create', this.add)
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
                loadDataLoaiHang() {
                    axios
                        .get('/admin/hang-hoa/data-lhh')
                        .then((res) => {
                            this.listLoaiHang  =  res.data.data;

                        });
                },
                loadData() {
                    axios
                        .get('/admin/hang-hoa/data')
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
                changeStatus(v) {
                    axios
                        .post('/admin/hang-hoa/changestatus', v)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                            }else{
                                toastr.error(res.data.message);
                            }
                        });
                },
                updateHangHoa() {
                    axios
                        .post('/admin/hang-hoa/update', this.edit)
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
                delHangHoa() {
                    axios
                        .post('/admin/hang-hoa/delete', this.del)
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

            }
        });
    </script>
@endsection
