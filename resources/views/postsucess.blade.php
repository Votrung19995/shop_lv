<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Đăng tin thành công</title>
        <link rel="shortcut icon" href="{{{ asset('resources/images/shopping.png') }}}">
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
                <br><br><br><br><br>
                <div class="row">
                <h1><b style="color: #17D679">{{$ms}}</h1>
                <p>- Hãy đến với chúng tôi để có được những trải nghiệm mua hàng tốt nhất, bạn có thể đăng tin, mua hàng và còn nhiều hơn nữa .. hãy khám phá nào ! </p>
                <br>
                </div>
                <div class="row">
                    <p style="color: teal"><i class="fa fa-chevron-left" aria-hidden="true"></i> <a href="{{url('/')}}">Về trang chủ</a></p>
                </div>
            </div>
          <br><br>
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
           @include('modal')
           @include('footer')
    </body>
</html>
