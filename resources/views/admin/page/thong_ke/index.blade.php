@extends('admin.share.master')
@section('noi_dung')
    <div id="app">
        <div class="row">
            <div class="col-10">
                <div class="row">
                    <div class="col-12">
                        <div class="card border-primary border-bottom border-3 border-0">
                            <div class="card-body">
                                <form action="/admin/thong-ke" method="post">
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
                    <div class="col-md-6">
                        <div class="card border-primary border-bottom border-3 border-0">
                            <div class="card-header">
                                Bảng Thống Kê
                            </div>
                            <div class="card-body">
                                <div class="table-responsive"  style="max-height: 320px">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Tên Hàng</th>
                                                <th>Số Lượng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $value)
                                                <tr>
                                                    <th class="text-center align-middle">{{ $key + 1 }}</th>
                                                    <td class="align-middle">{{ $value->ten_hang }}</td>
                                                    <td class="text-center align-middle">{{ $value->so_luong }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-primary border-bottom border-3 border-0">
                            <div class="card-header">
                                Chart Thống Kê
                            </div>
                            <div class="card-body">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card border-primary border-bottom border-3 border-0">
                    <div class="card-header ml-2">
                       <h6 >CÁC HOẠT ĐỘNG GẦN ĐÂY</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive"  style="max-height: 750px">
                            <table class="table table-striped " >
                                <thead>
                                    <template v-for="(value, key) in list">
                                        <tr>
                                            <td class="text-wrap"><b>@{{ value.ho_va_ten }}</b> vừa bán đơn hàng với trị giá <b>@{{ number_format(value.tong_tien) }}đ</b></td>
                                        </tr>
                                    </template>

                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
<script>
    new Vue({
        el: "#app",
        data: {
            list: [],
        },
        created() {
            this.loadData();
            setInterval(() => {
                this.loadData();
            }, 10000);

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
            loadData() {
                axios
                    .get('/admin/thong-ke/data-HD')
                    .then((res) => {
                        this.list = res.data.data;
                    });
            },



        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    var lables = {!! json_encode($array_hang_hoa) !!};
    var datas = {!! json_encode($array_so_luong) !!};
    new Chart(ctx, {
    type: 'bar',
    data: {
      labels: lables,
      datasets: [{
        label: 'Hàng Hóa',
        backgroundColor: 'rgb(102, 194, 255)',
        borderColor: 'sl(204, 100%, 70%)',
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
