<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Đăng nhập</title>
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
                                toastr.error('{{$error}}', 'Lỗi đăng nhập', {timeOut: 3500})
                        </script>
                    @endif
                <br><br><br>
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                            <div class="card">
                                    <div class="card-header">
                                      Đăng nhập
                                    </div>
                                    <div class="card-body">
                                            <form id="login" method="POST" action="{{action('LoginController@login')}}" accept-charset="UTF-8">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" placeholder="Tên đăng nhập, email hoặc SĐT" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                            <div class="col-sm-12">
                                                              <input type="password" minlength="6" name="password" value="{{$user->password}}" class="form-control" id="inputPassword3" placeholder="Mật khẩu" required>
                                                            </div>
                                                    </div>
                                                    <input type="hidden" name="casetext" value="{{$case}}">
                                                    <div class="form-group row">
                                                      <div class="col-sm-12">
                                                        <br>
                                                        <button type="submit" class="btn btn-info btn-block">Đăng nhập</button>
                                                        <br>
                                                        <a href="{{url('dangky')}}">Chưa có tài khoản, đăng ký ngay.</a>
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
           {{-- include modal and <footer></footer> --}}
           @include('modal')
           @include('footer')
    </body>
</html>
