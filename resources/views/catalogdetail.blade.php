<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$catalogName}}</title>
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
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <!-- Using jQuery with a CDN -->
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="{{asset('js/jquery.easy-autocomplete.min.js')}}"></script>
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <!-- Styles -->
        <style>
            .border-list {
                border-radius: 0px !important;
            }
        </style>
    </head>

    <body>
          @include('navbar') 
          <br>
          <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <nav class="breadcrumb"  style="border: 1px solid rgba(0,0,0,.125);border-radius: 0px; background-color: white">
                      <a class="breadcrumb-item" style="color: blue;  font-weight: bold" href="{{url('/')}}">Trang chủ</a>
                      <a class="breadcrumb-item active" style="font-weight: bold">{{$catalogName}}</a>
                  </nav>
                </div>
            </div>
            <div style="height: 1750px">
                @foreach($categorys as $category)
                    @php
                       $slug = $category->getSlug();
                    @endphp
                    <div class="row" style="margin-bottom: 20px">
                        <div class="col-md-3">
                            <div class="card box">
                                <div class="card-body">
                                <div style="height: 50px">
                                  <h6 class="card-title">{{$category->name}}</h6>
                                </div>
                                <img src="{{ $category->image }}" style="height: 235px; width: 230px" class="img-fluid center-block" alt="New York">
                                @php
                                  $format_number = number_format($category->price);
                                @endphp
                                <b style="font-size: 20px;color: red;margin-bottom: 15px">{{  $format_number }} đ</b>
                                <a href="{{action('PostController@goDetail', [$category->categoryid, $slug])}}" class="btn btn-info center-block" style="margin-top: 10px">Xem chi tiết</a>
                                </div>
                            </div>                   
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div style="margin-left: 15px">
                        {{ $categorys->links("pagination::bootstrap-4") }}
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
           </script>
           <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });
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
