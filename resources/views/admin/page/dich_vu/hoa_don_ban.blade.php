@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-12">
            <div class="card card border-bottom border-3 border-0s">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <h5 class="card-title">Hóa Đơn</h5>
                        </div>
                        <div class="col-5">

                        </div>
                        <div class="col-2">
                            <h6>Từ Ngày</h6>
                            <input v-model="thong_ke.begin" type="date" class="form-control">
                        </div>
                        <div class="col-2">
                            <h6>Đến Ngày</h6>
                            <input v-model="thong_ke.end" type="date" class="form-control">
                        </div>
                        <div class="col-1 mt-4">
                            <button v-on:click="thongKeBanHang()" class="btn btn-secondary btn-sm radius-30 px-4">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>

                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr class="table-secondary">
                                <th class="align-middle text-center">#</th>
                                <th class="align-middle text-center">Mã Hóa Đơn</th>
                                <th class="align-middle text-center">Tổng Tiền</th>
                                <th class="align-middle text-center">Ngày Thanh Toán</th>
                                <th class="align-middle text-center">Trạng Thái</th>
                                <th class="align-middle text-center">Nhân Viên</th>
                            </tr>
                        </thead>
                    </table>
                    <template v-for="(value, key) in list">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">

                                        <button v-on:click="chiTietHoaDon(value.id)" class="accordion-button collapsed text-dark" type="button"
                                            data-bs-toggle="collapse"  v-bind:data-bs-target="'#collapseOne' + key" aria-expanded="false"
                                            aria-controls="collapseOne">
                                            <table class="table ">

                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">@{{ key + 1 }}</td>
                                                        <td class="text-center">@{{ value.ma_hoa_don }}</td>
                                                        <td class="text-end">@{{ number_format(value.tong_tien) }}đ</td>
                                                        <td class="text-end">@{{ date_format(value.ngay_thanh_toan )}}</td>
                                                        <td class="text-end">
                                                            <div v-if="value.trang_thai == 1" class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Đã thanh toán
                                                            </div>
                                                        </td>
                                                        <td class="text-end">@{{ value.ho_va_ten }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </button>

                                </h2>
                                <div v-bind:id="'collapseOne' + key" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        <div class="card card border-bottom border-3 border-0s">
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="table-secondary">
                                                            <th class="align-middle text-center">#</th>
                                                            <th class="align-middle text-center">Tên Hàng</th>
                                                            <th class="align-middle text-center">Số Lượng</th>
                                                            <th class="align-middle text-center">Giá Hàng</th>
                                                            <th class="align-middle text-center">Thành Tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <template v-for="(v, k) in list_chi_tiet">
                                                            <tr >
                                                                <td class="text-center">@{{ k + 1 }}</td>
                                                                <td class="text-center">@{{ v.ten_hang }}</td>
                                                                <td class="text-center">@{{ v.so_luong_ban }}</td>
                                                                <td class="text-center">@{{ number_format(v.don_gia_ban) }}đ</td>
                                                                <td class="text-center">@{{ number_format(v.thanh_tien) }}đ</td>
                                                            </tr>
                                                        </template>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer text-end">
                                                <div class="row">
                                                    <div class="col-8">

                                                    </div>
                                                    <div class="col-2">
                                                        <span>Tổng Tiền: @{{ number_format(value.tong_tien) }}đ</span>
                                                    </div>
                                                    <div class="col-2 text-center">
                                                        <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Đã thanh toán
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
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
            thong_ke :   {},
        },
        created() {
            this.loadData();
        },
        methods: {
            date_format(now) {
            return moment(now).format('DD/MM/yyyy HH:mm:ss');
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
            thongKeBanHang()  {
                axios
                    .post('/admin/thong-ke/thong-ke-dich-vu', this.thong_ke)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            this.list = res.data.data;
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
            loadData() {
                axios
                    .get('/admin/hoa-don-ban/data-HD')
                    .then((res) => {
                        this.list = res.data.data;
                    });
            },
            chiTietHoaDon(id) {
                axios
                    .get('/admin/hoa-don-ban/chi-tiet/' + id)
                    .then((res) => {
                        this.list_chi_tiet = res.data.data;
                    });
            },


        }
    });
</script>
@endsection
