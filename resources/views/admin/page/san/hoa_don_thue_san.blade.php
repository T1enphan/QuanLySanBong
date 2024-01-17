@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-12">
        <div class="card card  border-bottom border-3 border-0s">
            <div class="card-body">
                {{-- <div class="row">
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
                        <button v-on:click="thongKeBanHang()" class="btn btn-dark">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div> --}}

                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr class="table-secondary">
                            <th class="align-middle text-center">#</th>
                            <th class="align-middle text-center">Mã Hóa Đơn</th>
                            <th class="align-middle text-center">Tổng Tiền</th>
                            <th class="align-middle text-center">Giảm Giá</th>
                            <th class="align-middle text-center">Tiền khách trả</th>
                            <th class="align-middle ">Ngày Thanh Toán</th>
                            <th class="align-middle text-start">Trạng Thái</th>
                        </tr>
                    </thead>
                </table>
                <template v-for="(value, key) in list_hd">
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
                                                <td class="text-center">@{{ number_format(value.tong_tien_thanh_toan) }}đ</td>
                                                <td></td>
                                                <td class="text-center">@{{ value.phan_tram_giam }}%</td>
                                                <td class="text-end">@{{ number_format(value.tien_da_giam) }}đ</td>
                                                <td class="text-end">@{{ date_format(value.updated_at )}}</td>
                                                <td></td>
                                                <td class="text-center">
                                                    <div v-if="value.tinh_trang == 2" class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Đã thanh toán
                                                    </div>

                                            </td>

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
                                            <table class="table ">
                                                <thead>
                                                    <tr class="table">
                                                        <td class="text-start">
                                                            <h6>Thông Tin</h6>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="align-middle">
                                                            <table class="table">
                                                                <tr>
                                                                    <th>Mã hóa đơn</th>
                                                                    <td>@{{ value.ma_hoa_don }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Ngày thuê sân</th>
                                                                    <td>@{{ date_format(value.ngay_thue_san) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Giờ bắt đầu</th>
                                                                    <td>@{{ value.gio_bat_dau }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Giờ kết thúc</th>
                                                                    <td>@{{ value.gio_ket_thuc }}</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="align-middle">
                                                            <table class="table">
                                                                <tr>
                                                                    <th>Khách hàng</th>
                                                                    <td>@{{ value.ten_khach_hang == null ? '...' : value.ten_khach_hang }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Số phút</th>
                                                                    <td>@{{ value.so_phut_thue }} phút</td>
                                                                </tr>

                                                                <tr>
                                                                    <th>Người tạo</th>
                                                                    <td>@{{ value.ho_va_ten }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Phần trăm giảm</th>
                                                                    <td>@{{ value.phan_tram_giam }}%</td>
                                                                </tr>
                                                            </table>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <table class="table table-">
                                                            <thead>
                                                                <tr class="table-secondary">
                                                                    <th class="text-center">#</th>
                                                                    <th class="text-center">Tên hàng</th>
                                                                    <th class="text-center">Số lượng</th>
                                                                    <th class="text-center">Giá bán</th>
                                                                    <th class="text-center">Thành tiền</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th class="text-center">1</th>
                                                                    <td class="text-center" >@{{ value.ten_san }}</td>
                                                                    <td class="text-center">@{{ value.so_phut_thue }} phút (Từ @{{value.gio_bat_dau }} đến @{{value.gio_ket_thuc }})</td>
                                                                    <td class="text-center">@{{ number_format(value.so_tien) }}đ</td>
                                                                    <td class="text-center">@{{ number_format(value.so_tien) }}đ</td>

                                                                </tr>
                                                                <template v-for="(v, k) in list_chi_tiet">
                                                                    <tr >
                                                                        <th class="text-center">@{{ k + 2 }}</th>
                                                                        <td class="text-center" >@{{ v.ten_hang }}</td>
                                                                        <td class="text-center">@{{ v.so_luong_ban }}</td>
                                                                        <td class="text-center">@{{ number_format(v.don_gia_ban) }}đ</td>
                                                                        <td class="text-center">@{{ number_format(v.thanh_tien) }}đ</td>

                                                                    </tr>
                                                                </template>
                                                            </tbody>
                                                        </table>
                                                          <div class="card-footer text-end">
                                                            <div class="row">
                                                                <div class="col-8">

                                                                </div>
                                                                <div class="col-2">
                                                                    <span>Tổng tiền: @{{ number_format(value.tien_da_giam) }}đ</span>
                                                                </div>
                                                                {{-- <div class="col-2 text-center">
                                                                    <button style="padding-left: 6px;" class="btn btn-dark"><i class="fa-solid fa-print"></i>In</button>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </tr>
                                                </tbody>
                                            </table>


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
            list_hd : [],
            list_chi_tiet : [],
        },
        created() {
            this.loadData();
        },
        methods: {
            date_format(now) {
                console.log(now);
                return moment(now).format('DD/MM/yyyy');
            },
            gio_format(now) {
            return moment(now).format('HH:mm');
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

            loadData(){
                axios
                    .get('/admin/san/data-hoa-don-thue-san')
                    .then((res) => {
                        this.list_hd = res.data.data;
                    });
            },

            chiTietHoaDon(id){
                axios
                    .get('/admin/san/hoa-don-thue-san/chi-tiet/' + id)
                    .then((res) => {
                        this.list_chi_tiet = res.data.data;
                    });
            },

        }
    });
</script>
@endsection
