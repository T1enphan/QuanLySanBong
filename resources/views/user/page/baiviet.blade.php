@extends('user.share.master')
@section('body')
<section class="row page_intro">
    <div class="row m0 inner">
        <div class="container">
            <div class="row">
                <h5>blog new</h5>
                <h2>What’s new in medicalpro</h2>
            </div>
        </div>
    </div>
</section>
<section class="row content_section">
    <div class="container" id="app">
        <div class="row">
            <div class="col-sm-12 col-md-8 blog_list">
                <template v-for="(value, key) in list_bai_viet">
                    <div class="media blog">
                        <div class="media-left">
                            <a href="single-post.html"><img v-bind:src="value.hinh_anh_bai_viet" alt="" class="img-reponsive"></a>
                        </div>
                        <div class="media-body">
                            <a href="single-post.html"><h3>@{{ value.tieu_de_bai_viet }}</h3></a>
                            <div class="row m0 meta">By : <a href="#">John Doe</a> on : <a href="#">29th June 2015</a> comments: (<a href="single-post.html" class="comment_amount">25</a>)</div>
                            <p>@{{ value.mo_ta_ngan_bai_viet }}</p>

                            <a href="single-post.html" class="view_all">Xem Thêm</a>
                        </div>
                    </div> <!--single blog-->
                </template>
            </div>
            <div class="col-sm-12 col-md-4 sidebar">
                <form action="#" class="row m0 search_form widget">
                    <h5 class="widget_heading">Tìm Kiếm</h5>
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search here">
                        <span class="input-group-addon"><button type="submit">go</button></span>
                    </div>
                </form>
                <div class="row m0 widget recent_posts">
                    <h5 class="widget_heading">Bài Viết Liên Quan</h5>
                    <template v-for="(value, key) in list_bai_viet">
                        <div class="media recent_post">
                            <div class="media-left">
                                <a href="single-post.html"><img v-bind:src="value.hinh_anh_bai_viet" alt=""></a>
                            </div>
                            <div class="media-body">
                                <a href="single-post.html"><h5>@{{ value.tieu_de_bai_viet }}</h5></a>
                                <p>on: <a href="single-post.html">29th june 2015</a></p>
                            </div>
                        </div>
                    </template>
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
            list_bai_viet : []
        },
        created()   {
            this.loadBaiViet();
        },
        methods :   {
            loadBaiViet(){
                axios
                    .get('/get-bai-viet')
                    .then((res) => {
                        this.list_bai_viet = res.data.data;
                        console.log(this.list_bai_viet);
                    });
            }
        },
    });
</script>
@endsection
