@extends('admin.share.master')
@section('noi_dung')
<div class="container-fuild" id="app">
    <div class="row">
        <div class="col">
            <div class="card  border-bottom border-3 border-0">
                <div class="card-header">
                    <h6>Log Hoạt Động</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped ">
                        <thead>
                            <tr class="table-secondary">
                                <th class="text-nowrap text-center align-middle">#</th>
                                <th class="text-nowrap text-center align-middle">Người thực hiện</th>
                                <th class="text-nowrap text-center align-middle">Nội dung</th>
                                <th class="text-nowrap text-center align-middle">Ngày/giờ thực hiện</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list_log">
                                <tr>
                                    <th class="align-middle text-center">@{{ key + 1 }}</th>
                                    <td class="align-middle">@{{ value.ho_va_ten }}</td>
                                    <td class="align-middle">@{{ value.noi_dung }}</td>
                                    <td class="align-middle text-center">@{{ date_format(value.created_at) }}</td>
                                </tr>
                            </template>

                        </tbody>
                    </table>
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
            list_log: [],
        },
        created() {
            this.loadData();
        },
        methods: {
            date_format(now) {
                return moment(now).format('DD/MM/yyyy HH:mm:ss');
            },
            number_format(number, decimals = 2, dec_point = ",", thousands_sep = ".") {
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
                    .get('/admin/log/data')
                    .then((res) => {
                        this.list_log = res.data.data;
                    });
            },

        }
    });
</script>
@endsection
