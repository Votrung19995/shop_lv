<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Đăng ký thành viên</title>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css"/>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <!-- Using jQuery with a CDN -->
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="{{asset('js/jquery.easy-autocomplete.min.js')}}"></script>
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
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
        </style>
    </head>

    <body>
          @include('navbar') 
            <div class="container">
                @if (!empty($error))
                    <script>
                     // Override global options
                     toastr.error('{{$error}}', 'Lỗi đăng ký', {timeOut: 3500})
                    </script>
                @endif
                <br><br><br>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div id="cart" class="card">
                            <div class="card-header">
                              Đăng ký thành viên
                          </div>
                          <div class="card-body">
                            <form id="register" method="POST" action="{{action('RegisterController@register')}}" accept-charset="UTF-8">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group row">
                                    <label for="username" class="col-sm-4 col-form-label">Tên đăng nhập <b style="color: red">*</b></label>
                                    <div class="col-sm-8">
                                       <input type="text" style="margin-bottom: 5px" class="form-control" id="username" name="username" value="{{$user->username}}" placeholder="Tên đăng nhập" required>
                                       <a href="" @click = "randUsername">Tạo ngẫu nhiên tên đăng nhập</a>
                                   </div>
                               </div>

                               <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">Tên của bạn <b style="color: red">*</b></label>
                                    <div class="col-sm-8">
                                       <input type="text" style="margin-bottom: 5px" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="Tên của bạn" required>
                                       
                                   </div>
                               </div>

                               <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label">Mật khẩu <b style="color: red">*</b></label>
                                <div class="col-sm-8">
                                  <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Mật khẩu" required>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label">Số điện thoại <b style="color: red">*</b></label>
                            <div class="col-sm-8">
                                <input type="number" name="phone" class="form-control" value="{{$user->phone}}" id="phone" placeholder="Số điện thoại" required>
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="email" class="col-sm-4 col-form-label">Email</label>
                          <div class="col-sm-8">
                            <input type="email" name="email" value="{{$user->email}}" class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="address" class="col-sm-4 col-form-label">Địa chỉ</label>
                        <div class="col-sm-8">
                           <input type="address" name="address" value="{{$user->address}}" class="form-control" id="address" placeholder="Địa chỉ">
                       </div>
                   </div>
                   <div class="form-group row">
                      <div class="col-sm-12">
                        <br>
                        <button type="submit" class="btn btn-info btn-block">Đăng ký ngay</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
            </div>
          <br><br><br>
          {{-- check user is login: --}}
          <script>
                function checkUser(event){
                  var cookie = '<?php echo request()->cookie('username'); ?>';
                  if(cookie === undefined || cookie.length === 0){
                     $("#exampleModal").modal()
                     event.preventDefault();
                  }
                }
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
                        message: 'Hello Vue!'
                    },
                    methods: {
                        randUsername(event) {
                            event.preventDefault();
                            var rand =  Math.floor(Math.random() * (10000 - 0 + 1)) + 0;
                            $('#username').val('user'+rand);
                        }
                    }
                })
           </script>
           {{-- include modal and <footer></footer> --}}
           @include('modal')
           @include('footer')
    </body>
</html>
