@extends('admin.share.master')
@section('noi_dung')
    <div id="app">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6>THỐNG KÊ SỐ LẦN SÂN ĐÃ ĐƯỢC THUÊ</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card border-bottom border-3 border-0">
                                    <div class="card-body">
                                        <form action="/admin/thong-ke/san-duoc-su-dung-nhieu" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label for="exampleDataList" class="form-label">Từ Ngày</label>
                                                    <input class="form-control" name="day_begin" type="date" placeholder="Type to search..." value="{{ $tu_ngay }}">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="exampleDataList" class="form-label">Đến Ngày</label>
                                                    <input class="form-control" name="day_end" type="date" placeholder="Type to search..." value="{{ $den_ngay }}">
                                                </div>
                                                <div class="col-md-2 mt-2">
                                                    <label for="exampleDataList" class="form-label"></label>
                                                    <button class="btn btn-primary btn-sm radius-30 px-4" type="submit" style="width: 100%"><i class="fa-solid fa-magnifying-glass"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="card border-primary border-bottom border-3 border-0">
                                    <div class="card-header">
                                        Chart Thống Kê
                                    </div>
                                    <div class="card-body">
                                        <canvas id="myyChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border-primary border-bottom border-3 border-0">
                    <div class="card-header">
                        <h6>Danh Sách Thống Kê</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-midlle">#</th>
                                        <th class="text-center align-midlle">Tên Sân</th>
                                        <th class="text-center align-midlle">Số Lượng</th>
                                        <th class="text-center align-midlle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $value)
                                        <tr>
                                            <th class="text-center align-middle">{{ $key + 1 }}</th>
                                            <td class="text-center align-middle">{{ $value->ten_san }}</td>
                                            <td class="text-center align-middle">{{ $value->so_luong }}</td>
                                            <td class="text-center align-middle">
                                                <button class="btn btn-outline-primary btn-sm radius-30 px-4" data-bs-toggle="modal" data-bs-target="#chitietmodal" v-on:click="chi_tiet = {{ $value }}, chiTiet()">
                                                    <i class="fa-solid fa-info" style="padding-left: 4px;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="chitietmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Chi Tiết @{{ chi_tiet.ten_san }} Từ ({{ $tu_ngay }} - {{ $den_ngay }})</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle text-center">#</th>
                                                    <th class="align-middle text-center">Mã Hóa Đơn</th>
                                                    <th class="align-middle text-center">Khách Hàng</th>
                                                    <th class="align-middle text-center">Ngày Thuê</th>
                                                    <th class="align-middle text-center">Giờ Bắt Đầu</th>
                                                    <th class="align-middle text-center">Giờ Kết Thúc</th>
                                                    <th class="align-middle text-center">Phần Trăm Giảm</th>
                                                    <th class="align-middle text-center">Tổng Tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template v-for="(value, key) in list_chi_tiet_san">
                                                    <tr>
                                                        <th class="text-center align-middle text-nowrap">@{{ key + 1 }}</th>
                                                        <td class="align-middle text-nowrap">@{{ value.ma_hoa_don }}</td>
                                                        <td class="align-middle text-nowrap">@{{ value.ten_khach }}</td>
                                                        <td class="align-middle text-nowrap">@{{ date_format(value.ngay_thue_san) }}</td>
                                                        <td class="align-middle text-nowrap">@{{ value.gio_bat_dau }}</td>
                                                        <td class="align-middle text-nowrap">@{{ value.gio_ket_thuc }}</td>
                                                        <td class="align-middle text-nowrap text-center">@{{ value.phan_tram_giam }}%</td>
                                                        <td class="align-middle text-nowrap">@{{  number_format(value.tien_da_giam) }} đ</td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                </div>
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
        el      :   '#app',
        data    :   {
            chi_tiet : {},
            list_chi_tiet_san : [],
            tu_ngay : '{{ $tu_ngay }}',
            den_ngay : '{{ $den_ngay }}'
        },
        created()   {

        },
        methods :   {
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
            chiTiet(){
                var payload = {
                    'id'        : this.chi_tiet.id,
                    'tu_ngay'   : this.tu_ngay,
                    'den_ngay'  : this.den_ngay
                }
                console.log(payload);
                axios
                    .post('/admin/thong-ke/chi-tiet-san-su-dung-nhieu', payload)
                    .then((res) => {
                        this.list_chi_tiet_san = res.data.data;
                        console.log(this.list_chi_tiet_san);
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myyChart');
    var lables = {!! json_encode($array_ten_san) !!};
    var datas = {!! json_encode($array_so_luong) !!};
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: lables,
        datasets: [{
          label: 'Số lần',
          data: datas,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

@endsection
