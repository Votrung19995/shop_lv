<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Giỏ hàng của tôi</title>
        <link rel="shortcut icon" href="{{{ asset('resources/images/shopping.png') }}}">
        <!-- Fonts -->
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
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <!-- development version, includes helpful console warnings -->
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <!-- Using jQuery with a CDN -->
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="{{asset('js/jquery.easy-autocomplete.min.js')}}"></script>
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
         <!-- #region datatables files -->
         <!-- Styles -->
        <style>
            .border-list {
                border-radius: 0px !important;
            }
        </style>
    </head>

    <body>
          @include('navbar') 
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-md-12">
                      <nav class="breadcrumb" style="border: 1px solid rgba(0,0,0,.125);border-radius: 0px; background-color: white">
                          <a class="breadcrumb-item" style="color: blue; font-weight: bold" href="{{url('/')}}">Trang chủ</a>
                          <a class="breadcrumb-item active" style="font-weight: bold">Giỏ hàng của tôi</a>
                      </nav>
                    </div>
                </div>
                <div id = "cart" class="card w-100" style="border-radius: 0px">
                    <div class="card-body">
                        <div class="row">
                                <div class="col-md-9">
                                    @if(count($carts) > 0)
                                        <h5>Bạn đã thêm <b style="color: green">{{count($carts)}}</b> vật phẩm vào giỏ hàng </h5>
                                    @else
                                        <i class="text-muxted"><h5>Giỏ hàng của bạn rỗng.</h5></i>
                                    @endif
                                    <br>
                                    <table class="table table-hover"  style="border-top: none ! important">
                                            <thead>
                                              <tr>
                                                <th>Ảnh sản phẩm</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Tạm tính</th>
                                                <th>Xóa</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($carts as $index => $cart)
                                                    <tr>
                                                        <td>
                                                          <img class="img-fluid" style="height: 70px; width: 100px" src="{{$cart->path}}"/>
                                                        </td>
                                                        <td>
                                                            <br>
                                                            {{$cart->name}}
                                                        </td>
                                                        <td>
                                                            <br>
                                                            <input id="on{{$index}}" @change = "onSelect({{$cart->categoryid}},{{$index}})" style="width: 100px" type="number" value="{{$cart->qty}}" min="1">
                                                        </td>
                                                        <td>
                                                            <br>
                                                            {{$cart->price}} đ
                                                        </td>
                                                        <td>
                                                              @php
                                                                $format_number = number_format(($cart->price)*($cart->qty));
                                                              @endphp
                                                              <br>
                                                              {{$format_number}} đ
                                                        </td>
                                                        <td>
                                                              <br>
                                                              <a @click = "onDelete({{$cart->categoryid}})" style="cursor: pointer" title="xóa mặt hàng này ?"><i class="fa fa-times" aria-hidden="true" style="color: red"></i></a>
                                                        </td>
                                                    </tr>
                                                 @endforeach
                                            </tbody>
                                          </table>
                                          @if(count($carts) > 0)
                                            <br>
                                            <a id="cartbutton" class="btn btn-danger" @click = "deleteAllCart">
                                                <img class="img-fluid" id="loading" style="width: 22px; height: 22px;display: none" src="{{asset('resources/images/loading.gif')}}"/>
                                                <b style="color: white">Xóa tất cả</b>
                                            </a>
                                          @endif
                                </div>
                                <div class="col-md-3">
                                       <h5>Thông tin đặt hàng</h5>
                                       <hr>
                                       <h5>Số lượng sản phẩm: 
                                           @if(count($carts) > 0)
                                             <b style="color: green">x{{count($carts)}}</b>
                                           @else
                                             <b style="color: green">x0</b>
                                           @endif
                                       </h5>
                                       <h5>Tổng tiền: 
                                           @if(count($carts) > 0)
                                             @php
                                                $total = 0;
                                                //foreach:
                                                foreach($carts as $cart){
                                                    $total += (($cart->price)*($cart->qty));
                                                }
                                                $total_format = number_format($total);
                                             @endphp
                                             <b style="color: red">{{$total_format}} đ</b>
                                           @else
                                             <b style="color: red">0 đ</b>
                                           @endif
                                       </h5>
                                       <br>
                                       @if(count($carts) > 0)
                                          <button @click = "addBill" class="btn btn-info btn-block"><b style="color: white"><i class="fa fa-google-wallet" aria-hidden="true"></i> Thanh toán ngay</button></a>
                                       @else
                                          <button disabled class="btn btn-info btn-block"><b style="color: white"><i class="fa fa-google-wallet" aria-hidden="true"></i> Thanh toán ngay</b></button>
                                       @endif
                                </div>
                        </div>
                        @if(count($allcategorys) > 0)
                        <div class="row">
                                <div class="col-md-12">
                                        <br><br>
                                        <h5 style="color: black">Các sản phẩm liên quan</h5>
                                        <br>
                                        <div class="owl-carousel owl-theme">
                                            @foreach($allcategorys as $category)
                                            @php
                                                  $slug = $category->getSlug();
                                            @endphp
                                            <div class="item">
                                               <div @click = "goDetail({{$category->categoryid}}, {{ $slug }})" class="card box1" style="border-radius: 0px">
                                                        <div class="card-body">
                                                        <div style="height: 50px">
                                                          <h6 class="card-title">{{$category->name}}</h6>
                                                        </div>
                                                        <img src="{{ $category->image }}" style="height: 220px; width: 250px" class="img-fluid center-block" alt="New York">
                                                        @php
                                                          $format_number = number_format($category->price);
                                                        @endphp
                                                        <b style="font-size: 20px;color: red;margin-bottom: 15px">{{  $format_number }} đ</b>
                                                        <a  class="btn btn-info center-block" style="margin-top: 10px">Xem chi tiết</a>
                                                        </div>
                                                </div>
                                            </div>                 
                                            @endforeach
                                         </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- Modal --}}
                    <!-- Modal -->
                   <div class="modal fade" id="addbillModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="addbillModalLabel" style="color: black">Vui lòng nhập thông tin hoặc đăng nhập</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-8">
                                        <h6 style="color: black">Nhập vào thông tin</h6>
                                        <br>
                                        <form style="margin-top: 5px">
                                                <div class="form-group">
                                                        <input v-model = "us" name="us" type="text" class="form-control"  placeholder="Nhập vào tên đăng nhập" required>
                                                       
                                                        <a href="" @click = "randUsername" style="font-size: 12px; margin-top: 5px">Tạo ngẫu nhiên tên đăng nhập</a>
                                                </div>
                                                <div class="form-group">
                                                   <input v-model = "emailOrPhone" type="text" class="form-control" name="emailOrPhone" aria-describedby="emailHelp" placeholder="Nhập vào email hoặc số điện thoại" required>
                                                </div>
                                                <div class="form-group">
                                                        <input v-model = "address" type="text" class="form-control" name="address" aria-describedby="emailHelp" placeholder="Nhập vào địa chỉ giao hàng của bạn">
                                                     </div>
                                                <div class="form-group">
                                                    <input v-model = "name" type="text" class="form-control" name="name" id="name" placeholder="Tên của bạn" required>
                                                </div>
                                                <div class="form-group">
                                                  <input v-model = "password" type="password" name="password" class="form-control" id="pasword" placeholder="Mật khẩu" required>
                                                </div>
                                                <button id="addBill" @click = "bill" class="btn btn-info"><img class="img-fluid" id="loading1" style="width: 22px; height: 22px;display: none" src="{{asset('resources/images/loading.gif')}}"/> Thanh toán</button>
                                        </form>
                                </div>
                                <div class="col-sm-4">
                                        <h6 style="color: black">Hoặc đăng nhập</h6>
                                        <br>
                                        <a style="margin-top: 6px;font-weight: bold" href="{{url('dangnhap')}}?case=bill" class="btn btn-success btn-block"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a>
                                        <button style="margin-top: 4px; font-weight: bold; color: white" class="btn btn-danger btn-block"><i class="fa fa-google-plus" aria-hidden="true"></i> Gmail</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
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
                    el: '#cart',
                    data: {
                        message: 'Hello Vue!',
                        datas: {!! json_encode($carts) !!},
                        us: '',
                        name: '',
                        password: '',
                        emailOrPhone:'',
                        address:''
                    },
                    methods: {
                        deleteAllCart() {
                            $('#loading').show();
                            $('#cartbutton').attr("disabled", true);
                            axios.post("{{url('cart/deleteAllCart')}}")
                                .then(function (response) {
                                    console.log("JSON SUCESS: "+response);
                                    $('#cartbutton').attr("disabled", false);
                                    $('#loading').hide();
                                    // Display a success toast, with a title
                                    toastr.success('Xóa tất cả thành công!', 'Success');
                                    setTimeout(function() {
                                        window.location.reload(); 
                                    },0);
                                })
                                .catch(function (error) {
                                    console.log('ERRROR: '+ error.response.status);
                                    // Display a warning toast, with no title
                                    toastr.error('Lỗi: '+ error);
                                    $('#cartbutton').attr("disabled", false);
                                    $('#loading').hide();
                                })
                        },
                        onSelect(id,index) {
                           var value = $('#on'+index).val();
                           var headers = {
                                    'Content-Type': 'application/json'
                                }
                                axios.post("{{url('cart/addQty')}}", JSON.stringify({
                                    index: index,
                                    categoryid:id,
                                    qty:value
                                }), {headers: headers})
                                .then(function (response) {
                                    console.log("JSON SUCESS: "+response);
                                    toastr.success('Updated qty!!');
                                    setTimeout(function() {
                                        window.location.reload(); 
                                    },0);
                                })
                                .catch(function (error) {
                                    console.log('ERRROR: '+ error.response.status);
                                    if(error.response.status == 304){
                                        toastr.error('Số lượng sản phẩm vượt quá kho lưu trữ!!');
                                        setTimeout(function() {
                                            window.location.reload(); 
                                        },500);
                                    }
                                })
                        },
                        onDelete(id) {
                            var con = confirm("Bạn có chắc muốn xóa vật phẩm này ?");
                            if(con){
                                var headers = {
                                    'Content-Type': 'application/json'
                                }
                                axios.post("{{url('cart/deleteCart')}}", JSON.stringify({
                                    categoryid:id
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
                        }
                        ,
                        addBill() {
                            @php
                                $cookie = Cookie::get('username');
                            @endphp
                            var username = "{{$cookie}}";
                            if(username === "" || username === null){
                                $('#addbillModal').modal();
                            }else{
                                var role = "{{$role}}";
                                if(role == 2){
                                    window.location.href = "{{action('PostController@bill')}}";
                                }
                                else{
                                    toastr.error('403: Truy cập bị từ chối');
                                }
                            }
                        },
                        bill(event) {
                            event.preventDefault();
                            $('#loading1').show();
                            $('#addBill').attr("disabled", true);
                            //get value of username and password:
                            if(this.username === '' || this.password === '' | this.name === ''){
                                $('#loading1').hide();
                                $('#addBill').attr("disabled", false);
                                toastr.error('Tên đăng nhập, email or name không được bỏ trống', {timeOut: 2500});
                            }
                            else {
                                var phone = new RegExp(/\d/);
                                var gmail = new RegExp(/^[\w.+\-]+@gmail\.com$/);
                                //check regex:
                                if(phone.test(this.emailOrPhone) || gmail.test(this.emailOrPhone)){
                                    //GO TO ADD USER:
                                    var headers = {
                                        'Content-Type': 'application/json'
                                    }
                                    axios.post("{{url('cart/addUser')}}", JSON.stringify({
                                        username: this.us,
                                        name: this.name,
                                        emailOrPhone: this.emailOrPhone,
                                        password: this.password,
                                        address: this.address
                                    }), {headers: headers})
                                    .then(function (response) {
                                        $('#loading1').hide();
                                        $('#addBill').attr("disabled", false);
                                        console.log("JSON SUCESS: "+response);
                                        window.location.href = "{{action('PostController@bill')}}";
                                    })
                                    .catch(function (error) {
                                        $('#loading1').hide();
                                        $('#addBill').attr("disabled", false);
                                        console.log('ERRROR: '+ error.response.status);
                                        if(error.response.status === 409){
                                            toastr.error('Tên đăng nhập, email, hoặc sđt đã có người đăng ký, vui lòng nhập tên khác.', {timeOut: 2500});
                                        }
                                        else{
                                            toastr.error('Lỗi:'+error);
                                        }
                                    })
                                }else{
                                    $('#loading1').hide();
                                    $('#addBill').attr("disabled", false);
                                    toastr.error('Sai định dạng email hoặc số điện thoại', {timeOut: 2500});
                                }
                            }
                        },
                        randUsername(event) {
                            event.preventDefault();
                            var rand =  Math.floor(Math.random() * (10000 - 0 + 1)) + 0;
                            this.us = "user" + rand;
                        },
                        goDetail (categoryid, slug){
                            var contextPath =  window.location.origin;
                            window.location.href = contextPath + "/detail/" + categoryid + "/" + slug;
                        },
                        addToCart(categoryId, event) {
                            event.preventDefault();
                            var headers = {
                                    'Content-Type': 'application/json'
                                }
                                axios.post("{{url('cart/addToCart')}}", JSON.stringify({
                                    categoryid: categoryId
                                }), {headers: headers})
                                .then(function (response) {
                                    console.log("JSON SUCESS: "+response);
                                    // Display a success toast, with a title
                                    toastr.success('Thêm mặt hàng vào giỏ hàng thành công!', 'Success');
                                    setTimeout(function() {
                                        window.location.reload(); 
                                    },0);
                                })
                                .catch(function (error) {
                                    console.log('ERRROR: '+ error.response.status);
                                    if(error.response.status != 409){
                                        // Display an error toast, with a title
                                        toastr.error('Đã xảy ra lỗi: ' + error , 'Error');
                                    }
                                    // Display a warning toast, with no title
                                    toastr.error('Mặt hàng đã thêm tồn tại, vui lòng xem lại giỏ hàng.');
                                })
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
