@extends('admin.share.master')
@section('noi_dung')
<div id="app">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h5>Thông Tin Bảng Giải Đấu - {{ $giaiDau->ten_giai_dau }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    @foreach ($data as $key => $value)
                    <tr>
                        <th class="text-center align-middle" style="width: 255px;padding-right: 0px;">{{ $value['ten_bang'] }}</th>
                        <td class="align-middle">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="align-middle text-center">Tên Đội</th>
                                    <th class="align-middle text-center">Điểm Số</th>
                                </tr>
                                @foreach ($value['list_doi'] as $key => $value)
                                <tr class="text-center">
                                    <td>{{ $value->ten_doi_bong }}</td>
                                    <td>{{ $value->diem_so }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h5>Danh Sách Trận Đấu</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">#</th>
                                <th class="text-center align-middle">Đội 1</th>
                                <th class="text-center align-middle">Lịch Đấu</th>
                                <th class="text-center align-middle">Đội 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soTran as $key => $value)
                            <tr>
                                <th class="align-middle text-center">{{ $key + 1 }}</th>
                                <td class="align-middle text-center">
                                    @if ($value->id_doi_bong_giai_1 != null)
                                        @foreach ($soDoi as $k => $v)
                                            @if ($v->id == $value->id_doi_bong_giai_1)
                                            <span v-on:click="tran_dau = {{ $value }}" data-bs-toggle="modal" data-bs-target="#chonDoi1Modal">{{ $v->ten_doi_bong }}</span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span v-on:click="tran_dau = {{ $value }}" data-bs-toggle="modal" data-bs-target="#chonDoi1Modal">Chọn Đội</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    @if ($value->ngay_thue_san == null)
                                    <button class="btn btn-warning text-white">Chọn Lịch Đấu</button>
                                    @else
                                    {{ $value->ten_san }} Ngày: {{ $value->ngay_thue_san }}
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    @if ($value->id_doi_bong_giai_2 != null)
                                        @foreach ($soDoi as $k => $v)
                                            @if ($v->id == $value->id_doi_bong_giai_2)
                                            <span v-on:click="tran_dau = {{ $value }}" data-bs-toggle="modal" data-bs-target="#chonDoi2Modal">{{ $v->ten_doi_bong }}</span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span v-on:click="tran_dau = {{ $value }}" data-bs-toggle="modal" data-bs-target="#chonDoi2Modal">Chọn Đội</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- chọn đội 1 --}}
            <div class="modal fade" id="chonDoi1Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Chọn Đội 1</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <select class="form-control" v-model="tran_dau.id_doi_bong_giai_1">
                        @foreach ($soDoi as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->ten_doi_bong }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                      <button type="button" class="btn btn-primary" v-on:click="saveDoiBong()">Lưu</button>
                    </div>
                  </div>
                </div>
            </div>
            {{-- chọn đội 2 --}}
            <div class="modal fade" id="chonDoi2Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Chọn Đội 2</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select class="form-control" v-model="tran_dau.id_doi_bong_giai_2">
                            @foreach ($soDoi as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->ten_doi_bong }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                      <button type="button" class="btn btn-primary" v-on:click="saveDoiBong()">Lưu</button>
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
            tran_dau  : {},
        },
        created()   {

        },
        methods :   {
            saveDoiBong(){
                axios
                    .post('/admin/giai-dau/chon-doi-tran-dau-giai', this.tran_dau)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message)
                            var modalDoi1 = $("#chonDoi1Modal").attr("class");
                            if(modalDoi1 === "modal fade show"){
                                $("#chonDoi1Modal").modal('hide');
                            }else{
                                $("#chonDoi2Modal").modal('hide');
                            }
                            setTimeout(() => {
                                location.reload();
                            }, 500);
                        } else {
                            toastr.error(res.data.message)
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
