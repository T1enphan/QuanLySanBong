@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col">
            <div class="card  border-bottom border-3 border-0">
                <div class="card-header">
                    <h6>Hóa Đơn Nhập Hàng</h6>
                </div>
                <div class="card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr class="table-light">
                                <th class="text-center">#</th>
                                <th class="text-center">Mã Hóa Đơn</th>
                                <th class="text-center">Nhà Cung Cấp</th>
                                <th class="text-center">Tổng Tiền Nhập</th>
                                <th class="text-center">Ngày Nhập Hàng</th>
                                <th class="text-center">Nhân Viên Nhập</th>
                                <th class="text-center">Chi Tiết Hóa Đơn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class="text-center align-middle">@{{ key + 1 }}</th>
                                    <td class="align-middle text-center">@{{ value.ma_hoa_don_nhap_hang }}</td>
                                    <td class="align-middle ">@{{ value.ten_cong_ty }}</td>
                                    <td class="align-middle text-center">@{{ number_format(value.tong_tien_nhap) }} đ</td>
                                    <td class="align-middle text-center">@{{ date_format(value.ngay_nhap_hang) }}</td>
                                    <td class="align-middle text-center">@{{ value.ho_va_ten }}</td>
                                    <td class="align-middle text-center">
                                        <button class="btn btn-secondary btn-sm radius-30 px-4"  v-on:click="chiTietHoaDon(value.id)" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-circle-info" style="padding-left: 4px;"></i></button>
                                    </td>
                                </tr>
                            </template>

                        </tbody>
                    </table>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h1 class="modal-title fs-5 " id="exampleModalLabel">Chi Tiết Hóa Đơn</h1>
                                    <button type="button" class="btn-close " data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr class="table-light">
                                                <th class="align-middle ">#</th>
                                                <th class="align-middle ">Tên Hàng</th>
                                                <th class="align-middle ">Số Lượng</th>
                                                <th class="align-middle ">Giá Gàng</th>
                                                <th class="align-middle ">Thành Tiền</th>
                                                <th class="align-middle ">Ghi Chú</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(value, key) in list_chi_tiet">
                                                <th class=" align-middle">@{{ key + 1 }}</th>
                                                <td class="align-middle ">@{{value.ten_hang}}</td>
                                                <td class="align-middle ">@{{value.so_luong_nhap}}</td>
                                                <td class="align-middle">@{{number_format(value.don_gia_nhap)}} đ</td>
                                                <td class="align-middle">@{{number_format(value.thanh_tien)}} đ</td>
                                                <td class="align-middle ">@{{value.ghi_chu}}</td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm radius-30 px-4" data-bs-dismiss="modal">Close</button>
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
                list: [],
                list_chi_tiet: [],

            },
            created() {
                this.loadData();
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
                loadData() {
                    axios
                        .get('/admin/hoa-don-nhap-hang/data-HD')
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
                chiTietHoaDon(id) {
                    axios
                        .get('/admin/hoa-don-nhap-hang/chi-tiet/' + id)
                        .then((res) => {
                            this.list_chi_tiet = res.data.data;
                        });
                },


            }
        });
    </script>
@endsection
