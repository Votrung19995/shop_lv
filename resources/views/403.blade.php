<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>403 Access</title>
        <link rel="shortcut icon" href="{{{ asset('img/shopping.png') }}}">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
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
                <br><br>
                    @if (!empty($error))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="position: absolute;top: 12%; right: 10px; z-index: 3"
                            <strong style="color: red">Lỗi: </strong> {{$error}} 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                <br><br><br><br>
                <div class="row" style="height: 250px">
                    <div class="center-block col-md-12" style="text-align: center">
                        <br><br><br>
                        <h1 style="top: 50%;left: 50%"><b style="color: red">403 forbidden</b></h1>
                        <h2 style="top: 50%;left: 50%">Xin lỗi, bạn không thể truy cập trang này.</h2>
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
           {{-- include modal and <footer></footer> --}}
           @include('modal');
           @include('footer');
    </body>
</html>
