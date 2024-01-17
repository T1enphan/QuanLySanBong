@extends('user.share.master')
@section('body')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <img src="/assets_user/images/slider/homepage1/everyday.png" style="height: 450px; width: 1150px;">
        </div>
    </div>
</div>
<section class="row contact_form_row">
    <div class="container" id="app">
        <div class="row">
            <div class="col-sm-12 contact_form_area">
                <h3 class="contact_section_title">Danh Sách Sân Đặt</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="vertical-align-middle text-center">#</th>
                            <th class="vertical-align-middle text-center">Tên Sân</th>
                            <th class="vertical-align-middle text-center">Ngày Đặt</th>
                            <th class="vertical-align-middle text-center">Thời Gian Bắt Đầu</th>
                            <th class="vertical-align-middle text-center">Thời Gian Kết Thúc</th>
                            <th class="vertical-align-middle text-center">Tông Tiền Thanh Toán</th>
                            <th class="vertical-align-middle text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(value, key) in list_dat_san">
                            <tr>
                                <th class="vertical-align-middle text-center">@{{ key + 1 }}</th>
                                <td class="vertical-align-middle text-center">@{{ value.ten_san }}</td>
                                <td class="vertical-align-middle text-center">@{{ value.ngay_thue_san }}</td>
                                <td class="vertical-align-middle text-center">@{{ value.gio_bat_dau }}</td>
                                <td class="vertical-align-middle text-center">@{{ value.gio_ket_thuc }}</td>
                                <td class="vertical-align-middle text-center">@{{ value.tong_tien_thanh_toan }}</td>
                                <td class="vertical-align-middle text-center">
                                    <button v-on:click="chiTietDatSan = value" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#myModal">Thanh Toán</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Thanh Toán Đặt Sân</h4>
                    </div>
                    <div class="modal-body">
                      Bạn vui lòng chuyển khoản để thanh toán sân <b>@{{ chiTietDatSan.ten_san }}</b> thuê vào thời gian <b>@{{ chiTietDatSan.gio_bat_dau }} - @{{ chiTietDatSan.gio_ket_thuc }} - @{{ chiTietDatSan.ngay_thue_san }}</b>
                      <b>THÔNG TIN CHUYỂN KHOẢN</b>
                      <p>Ngân hàng: <b>MBBANK</b></p>
                      <p>STK: <b>0936734440</b></p>
                      <p>Chủ tài khoản: <b>TRUONG CONG THACH</b></p>
                      <p>Số tiền: <b>@{{ chiTietDatSan.tong_tien_thanh_toan }}</b></p>
                      <p>Nội dung chuyển khoản (Yêu cầu chính xác nội dung): <b>@{{ chiTietDatSan.ma_thanh_toan }}</b></p>
                      <img v-bind:src="chiTietDatSan.img_qr">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>
    new Vue({
        el      :   '#app',
        data    :   {
            list_dat_san : [],
            chiTietDatSan: {}
        },
        created()   {
            this.loadDatSan();
        },
        methods :   {
            loadDatSan(){
                axios
                    .get('/data-danh-sach-san-dat')
                    .then((res) => {
                        this.list_dat_san = res.data.data;
                    });
            }
        },
    });
</script>
@endsection
