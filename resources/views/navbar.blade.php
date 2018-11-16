<div>
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
      </head>
      <div class="jumbotron" style="margin-top:0px;margin-bottom:0px;width:auto;border-radius:5px;height:30px;position:initial; background: #E4FBFB">
      
          <div class="row" style="margin-top: -50px;">
              <div class="col-sm-3 col-lg-3">
               <h1> <a href="#"><img src="https://images.cooltext.com/5188707.gif" width="225" height="76" alt="Nông sản VN" /></a>
               </h1>
           </div>
           <div class="col-sm-6 col-lg-6">
              <h4 class="text-muted" style="font-size: 15px; text-shadow: 2px 2px 2px #00ff00;">
                  CÔNG TY CP SẢN XUẤT VÀ KINH DOANH NÔNG SẢN SẠCH MIỀN NAM VIỆT NAM 
              </h4>
      
              <!-- <marquee><b style="color:#0099CC">Sống hết mình vì sự ổn định và phát triển của nhân loại !</b></marquee> -->
          </div>
              <!-- <div class="col-sm-3 col-lg-3" style="text-align:center">
                  <h1 class="text-muted">
                      <span class="fa fa-clock-o" style="color:greenyellow"></span> Giờ làm việc
                  </h1>
                  <h4 style="color:black"> 8h-22h</h4>
                  <h4 style="color:blue"> Từ thứ 2 đến thứ bảy</h4>
      
              </div> -->
              <!-- <div class="pull-right" >
                  <a href="login" style="color: green; position: absolute;
                  right: 100px; top: 0px">
                  <i><u>Đăng nhập</u></i>
              </a>
              
              <a href="register" style="color: red; position: absolute;
              right: 20px; top: 0px">
              <i><u>Đăng ký</u></i>
          </a> -->
      </div>
      
      </div>
      
      </div>
      
      <nav class="navbar navbar-expand-md navbar-light success sticky-top" style="background-color: #33CC33">
        <a class="navbar-brand" style="color: white" href="{{url('/')}}">Nông sản VN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link white-nav" style="color: white" href="{{url('/')}}" title="Về trang chủ"><i class="fa fa-home"></i> Trang chủ <span class="sr-only">(current)</span></a>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link white-nav" style="color: white" href="{{url('/')}}" title="Về trang chủ"></i> Giới thiệu</a>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link white-nav" style="color: white" href="{{url('/')}}" title="Về trang chủ">Sản phẩm</a>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link white-nav" style="color: white" href="{{url('/')}}" title="Về trang chủ">Tin tức</a>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link white-nav" style="color: white" href="{{url('/')}}" title="Về trang chủ">Liên hệ</a>
            </li>
      
            <form class="form-inline mt-3 mt-md-0" action="{{ action('AutoCompleteController@searchCategory') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input id="search_text" name="search_text" class="form-control mr-sm-3" style="width: 280px;" type="text" placeholder="Tìm kiếm" aria-label="Search">
            <!-- <button class="btn btn-outline-success my-3 my-sm-0" type="submit">Tìm kiếm</button> -->
          </form>
      
            <li class="nav-item">
              <a class="nav-link" id ="dangtin" style="color: white" href="{{action('PostController@gotoPost')}}" onclick="checkUser(event)" title="Đăng tin sản phẩm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Đăng bài</a>
            </li>
      
            <li class="nav-item" style="margin-left: 2px">
                <button type="button" class="btn btn-success" onclick="gotoCart()">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng
                  @if(!empty(Session::get('cart')))
                    <span class="badge badge-light">{{count(Session::get('cart'))}}</span>
                  @else
                     <span class="badge badge-light">0</span>
                  @endif
                </button>
            </li>
          </ul>
          
          {{-- set user cokkie: --}}
          @if(!empty(request()->cookie('username')))
          <div class="dropdown">
            <a data-toggle="dropdown" class="nav-link white-nav" style="color: white" href=""><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ request()->cookie('username') }}<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#" class="nav-link white-nav" style="color: black">Thông tin</a></li>
              <li><a href="{{action('AdminController@goSetting')}}" class="nav-link white-nav" style="color: black">Quản lý</a></li>
              <li><a href="{{url('dangxuat')}}" class="nav-link white-nav" style="color: black">Đăng xuất</a></li>
            </ul>
          </div>
          @else
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link white-nav" style="color: white" href="{{url('dangnhap')}}">Đăng nhập <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color: white" href="{{url('dangky')}}">Đăng ký</a>
            </li>
          </ul>
          @endif
        </div>
        <script>
           function gotoCart() {
              window.location.href = "{{action('PostController@detailCart')}}";
           }
        </script>
      </nav>
</div>