<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Trang chủ</title>
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
    </head>
    

    <body>
          @include('navbar') 
          <div class="container">
                <br>
                <div class="row">
                    <div class="col-md-2">
                            <div class="category">
                                <ul>
                                    <li style="background-color: #00CC00">
                                         <a href="/" class="title">DANH MỤC SẢN PHẨM
                                            <i class="fa fa-list-ol" aria-hidden="true"></i>
                                         </a>
                                    </li>	
                                    @foreach($catalogs as $catalog)
                                    <li style="background-color: #FF6600">
                                      <a href="{{action('PostController@detail',$catalog->catalogid)}}">
                                       {{$catalog->name}}
                                     </a>
                                     {{-- check sub catalog: --}}
                                     <!-- <ul class="ul-sub">
                                      @foreach($subcatalogs as $sub)
                                      @if($catalog->catalogid == $sub->catalogid)
                                      <li class="sub-category" style="background-color: #FF6600">
                                       <a href="{{action('PostController@detail',$sub->catalogid)}}">
                                         {{$sub->name}}
                                       </a>
                                     </li>
                                     <li role="separator" class="divider"></li>
                                     @endif
                                     @endforeach
                                   </ul> -->
                                 </li>	
                                    <li role="separator" class="divider"></li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>

                    <div class="col-md-8" style="padding-right: 6px">
                           <div id="demo" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ul class="carousel-indicators">
                                      <li data-target="#demo" data-slide-to="0" class="active"></li>
                                      <li data-target="#demo" data-slide-to="1"></li>
                                      <li data-target="#demo" data-slide-to="2"></li>
                                      <li data-target="#demo" data-slide-to="3"></li>
                                    </ul>
                                  
                                    <!-- The slideshow -->
                                    <div class="carousel-inner myCarousel">
                                      <div class="carousel-item active">
                                        <img src="https://scontent.fvca1-1.fna.fbcdn.net/v/t1.0-9/12439336_1497970560509616_1311537699142367141_n.jpg?_nc_cat=106&oh=b171b156c4d1ccac242870c81bfd54fe&oe=5C1635C6" class="img-fluid center-block" alt="Chicago">
                                            <div class="carousel-caption d-none d-md-block">
                                                    
                                            </div>
                                      </div>

                                      <div class="carousel-item">
                                        <img src="http://antoanthucphamhd.vn/upload/crop/750_341/images/hang_nong_san.jpg" class="img-fluid center-block" alt="Chicago">
                                            <div class="carousel-caption d-none d-md-block">
                                                    
                                            </div>
                                      </div>
                                      <div class="carousel-item">
                                        <img src="https://scontent.fvca1-2.fna.fbcdn.net/v/t1.0-9/23519138_1735196790120324_6715804534014618729_n.jpg?_nc_cat=100&oh=5b3df961fa02d92a12c9036ef258928f&oe=5C6182BD" class="img-fluid center-block" alt="Los Angeles">
                                            <div class="carousel-caption d-none d-md-block">
                                                    
                                            </div>
                                      </div>
                                      <div class="carousel-item">
                                        <img src="https://scontent.fvca1-1.fna.fbcdn.net/v/t1.0-9/28277437_1775551066084896_3788277997283434850_n.jpg?_nc_cat=103&oh=5031b4d64cdacdc0b1b56e89f4dfb639&oe=5C4F646E" class="img-fluid center-block" alt="New York">
                                        <div class="carousel-caption d-none d-md-block">
                                                <!-- <h3>Cánh đồng lúa</h3> -->
                                        </div>
                                      </div>
                                      
                                    </div>
                                  
                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                      <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#demo" data-slide="next">
                                      <span class="carousel-control-next-icon"></span>
                                    </a>
                            </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 0px;">
                       <div>
                        <img src="{{asset('resources/images/banner.jpg')}}" class="img-fluid center-block" style="height: 328px" alt="New York">
                       </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-4">
                        <h4>Sản phẩm mới <img style="margin-bottom: 3px;height: 30px;width: 30px" src="http://home.iitk.ac.in/~basker/images/NewAlt.gif"/></h4>
                        </div>
                </div>
                <div class="row">
                        <div class="owl-carousel owl-theme col-md-12">
                                @foreach($categorys as $category)
                                    @php
                                       $slug = $category->getSlug();
                                    @endphp
                                    <div class="item">
                                            <div class="card" style="margin-bottom: 10px">
                                                <div class="card-body">
                                                        <img src="{{ $category->image }}" style="height: 200px; width: 230px" class="img-fluid center-block" alt="New York">
                                                        <div class="overlay">
                                                          <a href="{{action('PostController@goDetail',[$category->categoryid, $slug])}}" class="btn btn-danger btn-sm text" role="button" aria-pressed="true"><i class="fa fa-eye" aria-hidden="true"></i> Xem chi tiết</a>
                                                        </div>
                                                        <br>
                                                        <div style="height: 40px">
                                                            <h6 class="card-title">{{$category->name}}</h6>
                                                        </div>
                                                        @php
                                                          $format_number = number_format($category->price);
                                                        @endphp
                                                        <b style="font-size: 18px;color: red">{{  $format_number }} đ</b>
                                                </div>
                                            </div>
                                    </div>
                                @endforeach
                        </div>
                        <script>
                            $('.owl-carousel').owlCarousel({
                                loop:true,
                                margin:3,
                                nav:true,
                                responsive:{
                                    0:{
                                        items:1
                                    },
                                    600:{
                                        items:3
                                    },
                                    1000:{
                                        items:5
                                    }
                                }
                            })
                        </script> 
                </div>
                <div class="row">
                    <div class="col-md-4">
                      <h4>Chăn nuôi</h4>
                    </div>
                    <div class="col-md-8">
                      <a href="{{action('PostController@detail',1)}}" style="float: right">Xem tất cả</a>
                    </div>
                </div>
                <div class="row">
                        @foreach($sp1s as $sp1)
                         @php
                           $slug = $sp1->getSlug();
                         @endphp
                         <div class="col-sm-3">
                            <div class="card" style="margin-bottom: 10px">
                              <div class="card-body">
                                  <img src="{{ $sp1->image }}" class="img-fluid center-block" style="height: 240px; width: 233px" alt="New York">
                                  <div class="overlay">
                                      <a href="{{action('PostController@goDetail', [$sp1->categoryid, $slug])}}" class="btn btn-danger btn-sm text" role="button" aria-pressed="true"><i class="fa fa-eye" aria-hidden="true"></i> Xem chi tiết</a>
                                  </div>
                                  <br>
                                  <div style="height: 40px">
                                        <h6 class="card-title">{{$sp1->name}}</h6>
                                    </div>
                                  @php
                                    $format_number = number_format($sp1->price);
                                  @endphp
                                  <b style="font-size: 18px;color: red">{{  $format_number }} đ</b>
                              </div>
                            </div>
                         </div>
                        @endforeach
                </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                          <h4>Hoa-Cây cảnh</h4>
                        </div>
                        <div class="col-md-8">
                                <a href="{{action('PostController@detail',2)}}" style="float: right">Xem tất cả</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($sp2s as $sp2)
                        @php
                           $slug = $sp2->getSlug();
                        @endphp
                        <div class="col-sm-3">
                           <div class="card" style="margin-bottom: 10px">
                             <div class="card-body">
                                 <img src="{{ $sp2->image }}" class="img-fluid center-block" style="height: 240px; width: 233px" alt="New York">
                                 <div class="overlay">
                                     <a href="{{action('PostController@goDetail', [$sp2->categoryid, $slug])}}" class="btn btn-danger btn-sm text" role="button" aria-pressed="true"><i class="fa fa-eye" aria-hidden="true"></i> Xem chi tiết</a>
                                 </div>
                                 <br>
                                 <div style="height: 40px">
                                        <h6 class="card-title">{{$sp2->name}}</h6>
                                 </div>
                                 @php
                                   $format_number = number_format($sp2->price);
                                 @endphp
                                 <b style="font-size: 18px;color: red">{{  $format_number }} đ</b>
                             </div>
                           </div>
                        </div>
                       @endforeach
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-4">
                           <h4>Hạt giống/ Cây cảnh</h4>
                        </div>
                        <div class="col-md-8">
                                <a href="{{action('PostController@detail',2)}}" style="float: right">Xem tất cả</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($sp3s as $sp3)
                        @php
                           $slug = $sp3->getSlug();
                        @endphp
                        <div class="col-sm-3">
                           <div class="card" style="margin-bottom: 10px">
                             <div class="card-body">
                                 <img src="{{ $sp3->image }}" class="img-fluid center-block" style="height: 240px; width: 233px" alt="New York">
                                 <div class="overlay">
                                     <a href="{{action('PostController@goDetail', [$sp3->categoryid, $slug])}}" class="btn btn-danger btn-sm text" role="button" aria-pressed="true"><i class="fa fa-eye" aria-hidden="true"></i> Xem chi tiết</a>
                                 </div>
                                 <br>
                                 <div style="height: 40px">
                                        <h6 class="card-title">{{$sp3->name}}</h6>
                                </div>
                                 @php
                                   $format_number = number_format($sp3->price);
                                 @endphp
                                 <b style="font-size: 18px;color: red">{{  $format_number }} đ</b>
                             </div>
                           </div>
                        </div>
                       @endforeach
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                           <h4>Sản phẩm trái cây</h4>
                        </div>
                        <div class="col-md-8">
                                <a href="{{action('PostController@detail',4)}}" style="float: right">Xem tất cả</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($sp4s as $sp4)
                        @php
                            $slug = $sp4->getSlug();
                        @endphp
                        <div class="col-sm-3">
                           <div class="card" style="margin-bottom: 10px">
                             <div class="card-body">
                                 <img src="{{ $sp4->image }}" class="img-fluid center-block" style="height: 240px; width: 233px" alt="New York">
                                 <div class="overlay">
                                     <a href="{{action('PostController@goDetail',[$sp4->categoryid, $slug])}}" class="btn btn-danger btn-sm text" role="button" aria-pressed="true"><i class="fa fa-eye" aria-hidden="true"></i> Xem chi tiết</a>
                                 </div>
                                 <br>
                                 <div style="height: 40px">
                                        <h6 class="card-title">{{$sp4->name}}</h6>
                                </div>
                                 @php
                                   $format_number = number_format($sp4->price);
                                 @endphp
                                 <b style="font-size: 18px;color: red">{{  $format_number }} đ</b>
                             </div>
                           </div>
                        </div>
                       @endforeach
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                           <h4>Sản phẩm cây công nghiệp</h4>
                        </div>
                        <div class="col-md-8">
                                <a href="{{action('PostController@detail',5)}}" style="float: right">Xem tất cả</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($sp5s as $sp5)
                        @php
                            $slug = $sp5->getSlug();
                        @endphp
                        <div class="col-sm-3">
                           <div class="card" style="margin-bottom: 10px">
                             <div class="card-body">
                                 <img src="{{ $sp5->image }}" class="img-fluid center-block" style="height: 240px; width: 233px" alt="New York">
                                 <div class="overlay">
                                     <a href="{{action('PostController@goDetail',[$sp5->categoryid, $slug])}}" class="btn btn-danger btn-sm text" role="button" aria-pressed="true"><i class="fa fa-eye" aria-hidden="true"></i> Xem chi tiết</a>
                                 </div>
                                 <br>
                                 <div style="height: 40px">
                                        <h6 class="card-title">{{$sp5->name}}</h6>
                                </div>
                                 @php
                                   $format_number = number_format($sp5->price);
                                 @endphp
                                 <b style="font-size: 18px;color: red">{{  $format_number }} đ</b>
                             </div>
                           </div>
                        </div>
                       @endforeach
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                           <h4>Sản phẩm chế biến</h4>
                        </div>
                        <div class="col-md-8">
                                <a href="{{action('PostController@detail',6)}}" style="float: right">Xem tất cả</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($sp6s as $sp6)
                        @php
                            $slug = $sp6->getSlug();
                        @endphp
                        <div class="col-sm-3">
                           <div class="card" style="margin-bottom: 10px">
                             <div class="card-body">
                                 <img src="{{ $sp6->image }}" class="img-fluid center-block" style="height: 240px; width: 233px" alt="New York">
                                 <div class="overlay">
                                     <a href="{{action('PostController@goDetail', [$sp6->categoryid, $slug])}}" class="btn btn-danger btn-sm text" role="button" aria-pressed="true"><i class="fa fa-eye" aria-hidden="true"></i> Xem chi tiết</a>
                                 </div>
                                 <br>
                                 <div style="height: 40px">
                                        <h6 class="card-title">{{$sp6->name}}</h6>
                                </div>
                                 @php
                                   $format_number = number_format($sp6->price);
                                 @endphp
                                 <b style="font-size: 18px;color: red">{{  $format_number }} đ</b>
                             </div>
                           </div>
                        </div>
                       @endforeach
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                           <h4>Sản phẩm hoa màu</h4>
                        </div>
                        <div class="col-md-8">
                                <a href="{{action('PostController@detail',7)}}" style="float: right">Xem tất cả</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($sp7s as $sp7)
                        @php
                            $slug = $sp7->getSlug();
                        @endphp
                        <div class="col-sm-3">
                           <div class="card" style="margin-bottom: 10px">
                             <div class="card-body">
                                 <img src="{{ $sp7->image }}" class="img-fluid center-block" style="height: 240px; width: 233px" alt="New York">
                                 <div class="overlay">
                                     <a href="{{action('PostController@goDetail',[$sp7->categoryid, $slug])}}" class="btn btn-danger btn-sm text" role="button" aria-pressed="true"><i class="fa fa-eye" aria-hidden="true"></i> Xem chi tiết</a>
                                 </div>
                                 <br>
                                 <div style="height: 40px">
                                        <h6 class="card-title">{{$sp7->name}}</h6>
                                </div>
                                 @php
                                   $format_number = number_format($sp7->price);
                                 @endphp
                                 <b style="font-size: 18px;color: red">{{  $format_number }} đ</b>
                             </div>
                           </div>
                        </div>
                       @endforeach
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                           <h4>Sản phẩm cây lương thực</h4>
                        </div>
                        <div class="col-md-8">
                                <a href="{{action('PostController@detail',8)}}" style="float: right">Xem tất cả</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($sp8s as $sp8)
                        @php
                            $slug = $sp8->getSlug();
                        @endphp
                        <div class="col-sm-3">
                           <div class="card" style="margin-bottom: 10px">
                             <div class="card-body">
                                 <img src="{{ $sp8->image }}" class="img-fluid center-block" style="height: 240px; width: 233px" alt="New York">
                                 <div class="overlay">
                                     <a href="{{action('PostController@goDetail', [$sp8->categoryid, $slug])}}" class="btn btn-danger btn-sm text" role="button" aria-pressed="true"><i class="fa fa-eye" aria-hidden="true"></i> Xem chi tiết</a>
                                 </div>
                                 <br>
                                 <div style="height: 40px">
                                        <h6 class="card-title">{{$sp8->name}}</h6>
                                </div>
                                 @php
                                   $format_number = number_format($sp8->price);
                                 @endphp
                                 <b style="font-size: 18px;color: red">{{  $format_number }} đ</b>
                             </div>
                           </div>
                        </div>
                       @endforeach
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
          <br>
          @include('modal')
          @include('footer')
    </body>
</html>
