<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Xác nhận đơn hàng</title>
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
        <script src="{{ asset('js/progressStep.js') }}"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"> </script>
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

            .progressbar {
                counter-reset: step;
            }
            .progressbar li {
                list-style: none;
                display: inline-block;
                width: 30.33%;
                position: relative;
                text-align: center;
                cursor: pointer;
            }
            .progressbar li:before {
                content: counter(step);
                counter-increment: step;
                width: 50px;
                height: 50px;
                line-height : 50px;
                border: 2px solid #ddd;
                border-radius: 100%;
                display: block;
                text-align: center;
                margin: 0 auto 10px auto;
                background-color: #fff;
            }
            .progressbar li:after {
                content: "";
                position: absolute;
                width: 100%;
                height: 1px;
                background-color: #ddd;
                top: 15px;
                left: -50%;
                z-index : -1;
            }
            .progressbar li:first-child:after {
                content: none;
            }
            .progressbar li.active {
                color: green ! important;
            }
            .progressbar li.active:before {
                border-color: green;
            } 
            .progressbar li.active + li:after {
                background-color: green;
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
                          <a class="breadcrumb-item active" style="font-weight: bold">Xác nhận thông tin địa chỉ</a>
                      </nav>
                    </div>
                </div>
                <div id = "cart" class="card w-100" style="border-radius: 0px">
                    <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                            <h5>Giai đoạn xử lý</h5>
                            <br>
                            <ul class="progressbar">
                                <li class="active"><i class="fa fa-check" aria-hidden="true"></i> Đăng nhập</li>
                                <li class="active"><i class="fa fa-check" aria-hidden="true"></i> Xác nhận địa chỉ</li>
                                <li style="color: blue">Xác nhận đơn hàng</li>
                            </ul>
                            <br>
                           </div>
                        </div>

                        <div class="row">
                                <div class="col-md-6">
                                        <h5>Xác nhận thông tin đơn hàng (Giai đoạn 3)</h5>
                                        <b>1. Hình thức giao hàng</b>
                                        <div class="card" style="margin-top: 10px;border-style: dashed;">
                                                <div class="card-body">
                                                    <form style="margin-top: 15px">
                                                        <div class="form-group">
                                                                <input type="hidden" v-model = "numPost"/>
                                                                <input type="radio" id="one" value="1" v-model="picked">
                                                                <label for="1"><i class="fa fa-truck" aria-hidden="true"></i> Giao hàng tiêu chuẩn</label>
                                                                <br>
                                                                <input type="radio" id="two" value="0" v-model="picked">
                                                                <label for="two"><i class="fa fa-rocket" aria-hidden="true"></i> Giao hàng nhanh</label>
                                                        </div>
                                                     </form>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                        <h5 style="color: white">zzzz</h5>
                                        <b>2. Địa chỉ của bạn</b>
                                        <div class="card" style="margin-top: 10px;border-style: dashed;">
                                                <div class="card-body" style="height: 134px">
                                                        @if(!empty($address))
                                                        <b> {{$address}}</b>
                                                        @else
                                                            <i>Chưa cập nhật địa chỉ</i>
                                                        @endif
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <br>
                                    <b>3. Hình thức thanh toán</b>
                                    <div class="card" style="margin-top: 10px;border-style: dashed;">
                                            <div class="card-body">
                                                <form style="margin-top: 15px">
                                                    <div class="form-group">
                                                            <input type="hidden" v-model = "numPost1"/>
                                                            <input type="radio" id="one" value="1" v-model="picked1">
                                                            <label for="1"><i class="fa fa-google-wallet" aria-hidden="true"></i> Thanh toán khi nhận hàng</label>
                                                            <br>
                                                            <input type="radio" id="two" value="0" v-model="picked1">
                                                            <label for="two"><i class="fa fa-cc-visa" aria-hidden="true"></i> Thanh toán bằng thẻ visa</label>
                                                    </div>
                                                 </form>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <br>
                                    <b>4. Tất cả sản phẩm </b>
                                    <div class="card" style="margin-top: 10px;border-style: dashed;">
                                            <div class="card-body" style="height: 134px">
                                                   <ul style="list-style: none;height: 70px;overflow:auto">
                                                      @foreach($carts as $index => $cart)
                                                         <li>{{$index + 1}}. {{$cart->name}}: x{{$cart->qty}}</li>
                                                      @endforeach
                                                   </ul>
                                                   @if(count($carts) > 0)
                                                        @php
                                                            $total = 0;
                                                            $total_format = 0;
                                                            //foreach:
                                                            foreach($carts as $cart){
                                                                $total += (($cart->price)*($cart->qty));
                                                            }
                                                            $total_format = number_format($total);
                                                        @endphp
                                                    @else
                                                        @php
                                                            $total_format = 0;
                                                        @endphp
                                                    @endif
                                                   <h5>Tổng tiền:  <b style="color: red">{{$total_format}} đ</b></h5>
                                            </div>
                                    </div>
                            </div>
                       </div>
                        <hr>
                        <div class="row">
                             <div class="col-md-12">
                                 <a href="{{action('PostController@bill')}}" class="btn btn-secondary pull-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Trở về trang trước</a>
                                 <button id="cartdh" @click = "createdBill" class="btn btn-info pull-right">
                                        <img class="img-fluid" id="loading" style="width: 22px; height: 22px;display: none " src="{{asset('resources/images/loading.gif')}}"/>
                                        Thanh toán</button>
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

                var $progressDiv = $("#progressBar");
                var $progressBar = $progressDiv.progressStep();
                $progressBar.addStep("Name");
                $progressBar.addStep("Source");
                $progressBar.addStep("Fields");
                $progressBar.addStep("Filter");
                $progressBar.addStep("Schedule");
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
                        datas: '',
                        us: '',
                        name: '',
                        password: '',
                        emailOrPhone:'',
                        address:'',
                        picked:1,
                        numPost:'',
                        picked1:1,
                        numPost1:''
                    },
                    methods: {
                        createdBill(){
                            var size = "{{count(Session::get('cart'))}}";
                            $('#cartdh').attr("disabled", true);
                            $('#loading').show();
                            if(size > 0 || size != undefined){
                                var headers = {
                                'Content-Type': 'application/json'
                                }
                                axios.post("{{url('bill/createBill')}}", JSON.stringify({
                                    transfer: this.picked,
                                    pay: this.picked1
                                }), {headers: headers})
                                .then(function (response) {
                                    console.log("JSON SUCESS: "+response);
                                    $('#cartdh').attr("disabled", false);
                                    $('#loading').hide();
                                    var billId = response.data.comment;
                                    window.location.href = "{{url('bill/success')}}" + "?bill="+ billId;
                                })
                                .catch(function (error) {
                                    console.log('ERRROR: '+ error.response.status);
                                    toastr.error('Lỗi thanh toán!!'+error);
                                    $('#cartdh').attr("disabled", false);
                                    $('#loading').hide();
                                })
                            }else{
                                toastr.error('Lỗi thanh toán!!');
                                $('#cartdh').attr("disabled", false);
                                $('#loading').hide();
                            }
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
