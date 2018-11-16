<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Preview {{$categoryName}}</title>
        <link rel="shortcut icon" href="{{{ asset('resources/images/shopping.png') }}}">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/easy-autocomplete.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/easy-autocomplete.themes.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/jquery.ui.autocomplete.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link href="{{ asset('css/zoomimage.css') }}" rel="stylesheet">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <!-- Using jQuery with a CDN -->
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="{{ asset('js/modernizr-2.8.3.min.js') }}"></script>
        <script src="{{asset('js/jquery.easy-autocomplete.min.js')}}"></script>
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <!-- Styles -->
         <!-- #region datatables files -->
         <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
         <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
         <!-- development version, includes helpful console warnings -->
         <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
         <script src="http//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
         <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
         <!-- Styles -->
        <style>
            .border-list {
                border-radius: 0px !important;
            }

            .fixtop {
                position: fixed;
                top: 40px;
                left: 0;
                z-index: 1100;
            }

            .fixbottom {
                position: fixed;
                bottom: 0px;
                left: 0px;
                z-index: 1200;
            }

            .rotated {
                    transform: rotate(-30deg) ! important; /* Equal to rotateZ(45deg) */
             }
        </style>
    </head>

    <body>
          @include('navbar') 
            <div class="container" id="content">
                <br>
                <div class="row">
                    <div class="col-md-12">
                      <nav class="breadcrumb" style="border: 1px solid rgba(0,0,0,.125);border-radius: 0px; background-color: white">
                          <a class="breadcrumb-item" style="color: blue; font-weight: bold" href="{{url('/')}}">Trang chủ</a>
                          <a class="breadcrumb-item active" style="font-weight: bold">{{$categoryName}}</a>
                      </nav>
                    </div>
                </div>
                <div class="card w-100" style="border-radius: 0px">
                    <div class="card-body">
                            <img src="{{asset('resources/images/preview.png')}}" style="width: 300px; height: 100px" class="fixtop rotated"/>
                            <div class="btn-group mr-2 fixbottom" role="group" aria-label="First group">
                                    <button @click = "openModal({{$category->postid}})" style="border-radius: 0px" type="button" class="btn btn-primary btn active"><i class="fa fa-globe" aria-hidden="true"></i> Duyệt bài ngay</button>
                                    <button style="border-radius: 0px" type="button" @click = "goQuanLy" class="btn btn-success btn active"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Về trang quản lý</button>
                            </div>
                            {{-- <a @click = "openModal({{$category->postid}})" class="btn btn-primary btn active fixbottom" style="border-radius: 0px" role="button" aria-pressed="true"> <i class="fa fa-globe" aria-hidden="true"></i> Duyệt bài ngay</a> --}}
                        <div class="row">
                                <div class="col-md-5">
                                        <div class="card" style="margin-bottom: 10px;border-radius: 0px">
                                            <div class="card-body">
                                                    <ul id="glasscase" class="gc-start">
                                                           @foreach($images as $img)
                                                              <li><img src="{{$img}}"/></li>
                                                           @endforeach
                                                    </ul>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-4">
                                        <h5 class="card-title" style="color: #2D83E4">{{$post->title}}</h5>
                                        <h6 class="card-title" style="font-weight: bold; font-size: 20px">Sẩn phẩm: {{$category->name}}</h6>
                                        @php
                                          $format_number = number_format($category->price);
                                        @endphp
                                        <h2 class="card-title"><b style="color: red">{{$format_number}} đ</b></h2>
                                        <h6 class="card-title">Số lượng bán: <b>{{$post->number}}</b></h6>
                                        <h6 class="card-title">Tình trạng: 
                                            @if($post->number <= 0)
                                               <b style="color: red">Đã hết hàng</b>
                                            @else
                                               <b style="color: #0CB21B">Còn hàng</b>
                                            @endif
                                        </h6>
                                        <h6 class="card-title">Người đăng bán: <b><a href="#">{{$user->username}}</a></b></h6>
                                        <h6 class="card-title">Email: <a href="#">{{$user->email}}</a></h6>
                                        <h6 class="card-title">Ngày đăng: <b>{{$category->created}}</b></h6>
                                        <h6 class="card-title">Khu vực bán: <b>{{$location->name}}</b></h6>
                                        <hr>
                                        <div class="btn-group" style="margin-bottom: 5px" role="group" aria-label="Basic example">
                                            @if($post->number > 0)
                                                 <button disabled type="button" class="btn btn-info" style="border-radius: 0px">Mua ngay</button>
                                                 <button disabled id="cartbutton" style="margin-left: 5px; border-radius: 0px" @click= "addToCart({{$category->categoryid}})" type="button" class="btn btn-success">
                                                    <img class="img-fluid" id="loading" style="width: 22px; height: 22px; display: none" src="{{asset('resources/images/loading.gif')}}"/>
                                                    Thêm vào giỏ hàng</button>
                                            @else
                                                 <button disabled type="button" class="btn btn-info" style="border-radius: 0px">Mua ngay</button>
                                                 <button disabled id="cartbutton" style="margin-left: 5px; border-radius: 0px" @click= "addToCart({{$category->categoryid}})" type="button" class="btn btn-success">
                                                    <img class="img-fluid" id="loading" style="width: 22px; height: 22px; display: none" src="{{asset('resources/images/loading.gif')}}"/>
                                                    Thêm vào giỏ hàng</button>
                                            @endif
                                        </div>
                                </div>

                                <div class="col-md-3">
                                        <h5 class="card-title">Tùy chọn giao hàng</h5>
                                        <h6><i class="fa fa-map-marker text-muted" aria-hidden="true"></i> Phường Xuân Khánh, Quận Ninh Kiều, TP.Cần Thơ</h6>
                                        <hr>
                                        <h6><i class="fa fa-rocket text-muted" aria-hidden="true"></i> Thời gian giao hàng</h6>
                                        <small id="emailHelp" class="text-muted">Tất cả các ngày trong tuần(trừ chủ nhật và ngày lễ)</small>
                                        <hr>
                                        <h6><i class="fa fa-google-wallet text-muted" aria-hidden="true"></i> Thanh toán khi nhận hàng</h6>
                                        <small id="emailHelp" class="text-muted">Thanh toán sao khi nhận hàng, có thể đổi trả</small>
                                        <hr>
                                        <h6><i class="fa fa-external-link text-muted" aria-hidden="true"></i> 7 ngày đổi trả dễ dàng</h6>
                                        <small id="emailHelp" class="text-muted">Không được đổi trả với lí do "Không vừa ý"</small>
                                        <hr>
                                        <h6><i class="fa fa-gift text-muted" aria-hidden="true"></i> Nhận giao hàng qua sđt </h6>
                                        <small style="font-size: 15px;font-weight: bold;" id="emailHelp">{{$user->phone}}</small>
                                </div>
                        </div>
                        <div class="row" style="margin-bottom: 15px">
                            <div class="col-md">
                                    <br><br>
                                    <h5 class="card-title">Các sản phẩm liên quan</h5>
                            </div>
                        </div>
                        <div class="row">
                             <div class="owl-carousel owl-theme">
                                @foreach($allcategorys as $category)
                                @php
                                      $slug = $category->getSlug();
                                @endphp
                                <div class="item">
                                   <div class="card box1" style="border-radius: 0px">
                                            <div class="card-body">
                                            <div style="height: 50px">
                                              <h6 class="card-title">{{$category->name}}</h6>
                                            </div>
                                            <img src="{{ $category->image }}" style="height: 220px; width: 250px" class="img-fluid center-block" alt="New York">
                                            @php
                                              $format_number = number_format($category->price);
                                            @endphp
                                            <b style="font-size: 20px;color: red;margin-bottom: 15px">{{  $format_number }} đ</b>
                                            <a aria-disabled="true" href="{{action('PostController@goDetail', [$category->categoryid, $slug])}}" onclick="return false;" class="btn btn-info center-block" style="margin-top: 10px">Xem chi tiết</a>
                                            </div>
                                    </div>
                                </div>                 
                                @endforeach
                             </div>
                        </div>
                        <div class="row" style="margin-bottom: 15px">
                                <div class="col-md">
                                        <br>
                                        <h5 class="card-title">Bình luận về sản phẩm</h5>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7" style="margin-bottom: 60px">
                                   <div class="card" style="padding:10px; border-radius: 0px">
                                        <form action="{{action('CommentController@comment')}}" method="POST"  accept-charset="UTF-8">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="cateid" value="{{$sp}}"/>
                                            <div class="form-group">
                                                <label for="exampleTextarea">Nhập vào nội dung bình luận</label>
                                                <textarea id="content" name="content" class="form-control" id="exampleTextarea" rows="3"></textarea>
                                             </div>
                                            <button disabled onclick="return false;" id="cm" type="submit" class="btn btn-success">Bình luận</button>
                                        </form>
                                        {{-- //get all comment --}}
                                        @if(count($comments) > 0)
                                            <hr>
                                            @foreach($comments as $comment)
                                               <p style="margin-bottom: 0px"><b><a href="#">{{$comment->username}}</a></b>: {{$comment->content}}</p>
                                               <small class="text-muted" style="margin-top: 0px; margin-bottom: 5px;">{{$comment->created}}</small>
                                            @endforeach
                                            <div style="margin-top: 10px">
                                                    {{ $comments->links("pagination::bootstrap-4") }}
                                            </div>
                                        @else
                                            <hr>
                                            <small class="text-muted" style="font-size: 15px;font-weight: initial" id="emailHelp">Chưa có bình luận nào cho mục này.</small>
                                        @endif
                                   </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                 <div class="modal fade" id="exampleMD" tabindex="-1"  v role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Duyệt bài đăng user</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                    <form>
                                            <div class="form-group">
                                                    <input type="hidden" v-model = "numPost"/>
                                                    <input type="radio" id="one" value="1" v-model="picked">
                                                    <label for="1">Duyệt bài</label>
                                                    <br>
                                                    <input type="radio" id="two" value="0" v-model="picked">
                                                    <label for="two">Không duyệt</label>
                                                    <br>
                                                    <label for="exampleFormControlTextarea1">Comment</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model = "comment"></textarea>
                                            </div>
                                    </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button @click = "updateStatus" type="button" class="btn btn-primary">Cập nhật</button>
                            </div>
                    </div>
                </div>
            </div>
            </div>
           {{-- check user is login: --}}
           <script>
                function checkUser(event){
                  var cookie = '<?php echo request()->cookie('username'); ?>';
                  if(cookie === undefined || cookie.length === 0){
                     $("#exampleModal").modal()
                     event.preventDefault();
                  }
                }

                $(document).ready( function () {
                    //If your <ul> has the id "glasscase"
                    $('#glasscase').glassCase({ 'thumbsPosition': 'bottom', 'widthDisplay' : 560});
                });

                $(document).ready( function () {
                    var cookie = '<?php echo request()->cookie('username'); ?>';
                    if(cookie === undefined || cookie.length === 0){
                        $('#cm').prop('disabled', true);
                    }
                    else{
                        $('#cm').prop('disabled', false);
                    }
                });
           </script>
           <script>
                $('.owl-carousel').owlCarousel({
                    loop:true,
                    margin:35,
                    nav:true,
                    responsiveClass: true,
                    responsive:{
                        0:{
                            items:1,
                            nav: true
                        },
                        600:{
                            items:2,
                            nav: true
                        },
                        1000:{
                            items:4,
                            nav: true
                        }
                    }
                })
            </script>
            {{-- Autocomplete --}}
            <script>
                $(document).ready(function() {
                  src = "{{ route('searchajax') }}";
                  $("#search_text").autocomplete({
                     source: function(request, response) {
                         $.ajax({
                             url: src,
                             dataType: "json",
                             data: {
                                 term : request.term
                             },
                             success: function(data) {
                                 response(data);
                                
                             }
                         });
                     },
                     select: function(event, ui) {
                         var idUI = ui.item.id;
                         var slug = ui.item.slug;
                         window.location.href = "/detail/"+idUI+"/"+slug;
                     },
                     minLength: 3,
                    
                 });
             });
            </script>
            <script>
                var app = new Vue({
                    el: '#content',
                    data: {
                        message: 'Hello Vue!',
                        key: '',
                        comment:'',
                        check1:'',
                        check2:'',
                        picked:'',
                        numPost:''
                    },
                    methods: {
                        deletePost(postId) {
                            var isDel = confirm('Bạn có muốn xóa bài đăng này ?');
                            if(isDel) {
                                //alert(postId);
                            }
                        },
                        eventChange() {
                           console.log(this.key);
                           window.location.href = "{{url('/admin/quan-ly-bai-dang')}}" + "?" + "username=" + this.key;
                        },
                        openModal(index) {
                            $("#exampleMD").modal();
                            this.numPost = index;
                            axios.get("{{url('admin/post')}}" + "/" + index)
                                .then((response)  =>  {
                                    console.log(response);
                                    var status = response.data.status;
                                    this.picked = status;
                                    console.log("PICKKKK: "+this.picked);
                                    this.comment = response.data.comment;
                                }, (error)  =>  {
                                    //401:
                                    console.log(error);
                            })
                        },
                        updateStatus() {
                            console.log('STATUS: '+this.picked);
                            var headers = {
                                    'Content-Type': 'application/json'
                                }
                                axios.post("{{url('admin/post/updateStatus')}}", JSON.stringify({
                                    postid: this.numPost,
                                    status: this.picked,
                                    comment: this.comment
                                }), {headers: headers})
                                .then(function (response) {
                                    console.log("JSON SUCESS: "+response.data);
                                    toastr.success('Đã cập nhật trạng thái bài đăng!');
                                })
                                .catch(function (error) {
                                    console.log('ERRROR: '+ error);
                                    toastr.error('Lỗi cập nhật trạng thái!'+error);
                                })
                          },
                          deletPostUser(postId) {
                              var con = confirm('Bạn chắc muốn xóa bài đăng này ?');
                              if(con){
                                var headers = {
                                    'Content-Type': 'application/json'
                                }
                                axios.post("{{url('user/deletePostUser')}}", JSON.stringify({
                                    postid:postId
                                }), {headers: headers})
                                .then(function (response) {
                                    console.log("JSON SUCESS: "+response);
                                    toastr.success('Đã xóa!');
                                    setTimeout(function() {
                                        window.location.reload(); 
                                    },0);
                                })
                                .catch(function (error) {
                                    console.log('ERRROR: '+ error.response.status);
                                    toastr.error('Lỗi xóa!!'+error);
                                })
                              }
                          },
                          goQuanLy () {
                              window.location.href ="{{action('AdminController@goSetting')}}";
                          }
                        }
                })
           </script>
            {{-- include modal and <footer></footer> --}}
            @include('modal')
            <br>
            @include('footer')
    </body>
</html>
