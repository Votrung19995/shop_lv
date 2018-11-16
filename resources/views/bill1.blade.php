<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Thông tin địa chỉ</title>
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
                                <li style="color: blue">Xác nhận địa chỉ</li>
                                <li>Xác nhận đơn hàng</li>
                            </ul>
                            <br>
                           </div>
                        </div>

                        <div class="row">
                                <div class="col-md-6">
                                        <h5>Địa chỉ của bạn (Giai đoạn 2)</h5>
                                        <div class="card" style="margin-top: 5px;border-style: dashed;">
                                                <div class="card-body">
                                                        @php
                                                            $carts = Session::get('cart');
                                                            $size = count($carts);
                                                        @endphp
                                                        @if(!empty($address))
                                                            <b id="adID"> {{$address}}</b>
                                                        @else
                                                            <i>Chưa cập nhật địa chỉ</i>
                                                        @endif
                                                            
                                                </div>
                                        </div>
                                        <br>
                                        <h5 style="color: black"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa địa chỉ này</h5>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                        <div class="card card-body">
                                            <form>
                                                <div class="row">
                                                  <div class="col">
                                                    <label>Tỉnh/Thành Phố</label>
                                                    <select  class="form-control"  @change = "eventProvince" v-model = "keyProvince">
                                                         <option value = "">Chọn Tỉnh/Thành phố  </option>
                                                         <option v-for="province in provinces" :value = "province.provinceid">@{{province.name}}</option>
                                                    </select>
                                                  </div>
                                                  <div class="col">
                                                    <label>Quận/Huyện</label>
                                                    <select  class="form-control" @change = "eventDistrict" v-model = "keyDistrict">
                                                            <option value = "">Chọn Quận/Huyện  </option>
                                                            <option v-for="district in districts" :value = "district.districtid">@{{district.name}}</option>
                                                    </select>
                                                  </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col">
                                                      <label>Phường/Xã</label>
                                                      <select  class="form-control"  @change = "eventWard" v-model = "keyWard">
                                                           <option value = "">Chọn Phường/Xã  </option>
                                                           <option v-for="ward in wards" :value = "ward.wardid">@{{ward.name}}</option>
                                                      </select>
                                                    </div>
                                                    <div class="col">
                                                      <label>Thị trấn/Ấp</label>
                                                      <select  class="form-control" v-model = "keyVillage">
                                                              <option value = "">Chọn Thị trấn/Ấp  </option>
                                                              <option v-for="village in villages" :value = "village.name">@{{village.name}}</option>
                                                      </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col">
                                                      <label>Thông tin chi tiết</label>
                                                      <input type="text" class="form-control" v-model ="addressDetail" placeholder="Số nhà/đường/hẻm">
                                                    </div>
                                                </div>
                                                <br>
                                                <a class="btn btn-danger" style="color: white" @click = "updateAddress">Cập nhật </a>
                                            </form>
                                        </div>
                                </div>
                        </div>
                        <hr>
                        <div class="row">
                             <div class="col-md-12">
                                 <button @click = "goBill2" class="btn btn-success pull-right">Tiếp theo <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
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
                        provinces: {!! json_encode($provinces) !!},
                        keyProvince: '',
                        districts: [],
                        keyDistrict:'',
                        wards: [],
                        keyWard:'',
                        villages: [],
                        keyVillage:'',
                        addressDetail:''
                    },
                    methods: {
                        goBill2() {
                            var address = "{{$address}}";
                            var size = "{{$size}}";
                            if((address != null || address != '') && size > 0) {
                                window.location.href = "{{action('PostController@bill2')}}";
                            }
                            else{
                                toastr.error('Vui lòng cập nhật địa chỉ của bạn!!!');
                            }
                        },
                        eventProvince() {
                                const self = this;
                                var headers = {
                                    'Content-Type': 'application/json'
                                }
                                axios.post("{{url('bill/getDistricts')}}", JSON.stringify({
                                    provinceid: this.keyProvince
                                }), {headers: headers})
                                .then(function (response) {
                                    console.log("JSON SUCESS: "+response.data);
                                    self.districts = response.data;
                                })
                                .catch(function (error) {
                                    console.log('ERRROR: '+ error.response.status);
                                })
                        },
                        eventDistrict (){
                                const self = this;
                                var headers = {
                                    'Content-Type': 'application/json'
                                }
                                axios.post("{{url('bill/getWards')}}", JSON.stringify({
                                    districtid: this.keyDistrict
                                }), {headers: headers})
                                .then(function (response) {
                                    console.log("JSON SUCESS: "+response.data);
                                    self.wards = response.data;
                                })
                                .catch(function (error) {
                                    console.log('ERRROR: '+ error.response.status);
                                })
                        },
                        eventWard (){
                                const self = this;
                                var headers = {
                                    'Content-Type': 'application/json'
                                }
                                axios.post("{{url('bill/getVillages')}}", JSON.stringify({
                                    wardid: this.keyWard
                                }), {headers: headers})
                                .then(function (response) {
                                    console.log("JSON SUCESS: "+response.data);
                                    self.villages = response.data;
                                })
                                .catch(function (error) {
                                    console.log('ERRROR: '+ error.response.status);
                                })
                        },
                        updateAddress (){
                            //get province value:
                            var indexProvince = -1;
                            var provinceText = "";
                            for (i = 0; i < this.provinces.length; i++) { 
                                var province = this.provinces[i];
                                if(this.keyProvince == province.provinceid){
                                    indexProvince = i;
                                }
                            }
                            if(indexProvince != -1){
                                console.log(indexProvince);
                                provinceText = this.provinces[indexProvince].name;
                            }
                            //get district:
                            var indexDistrict = -1;
                            var districtText = "";
                            for (i = 0; i < this.districts.length; i++) { 
                                var district = this.districts[i];
                                if(this.keyDistrict == district.districtid){
                                    indexDistrict = i;
                                }
                            }
                            if(indexDistrict != -1){
                                console.log(indexDistrict);
                                districtText = this.districts[indexDistrict].name;
                            }
                            //get ward:
                            var indexWard = -1;
                            var wardText = "";
                            for (i = 0; i < this.wards.length; i++) { 
                                var ward = this.wards[i];
                                if(this.keyWard == ward.wardid){
                                    indexWard = i;
                                }
                            }
                            if(indexWard != -1){
                                console.log(indexWard);
                                wardText = this.wards[indexWard].name;
                            }
                            //get village:
                            var villageText = "";
                            villageText = this.keyVillage;
                            //excute:
                            var address = "";
                            if(provinceText !== "" && districtText !== "" && wardText !== "" && villageText !== ""){
                                address += villageText + ' - ' + wardText + " - " + districtText + " - " +provinceText;
                                if(this.addressDetail !== ""){
                                    address = this.addressDetail + " - " + address;
                                }
                                //updated address:
                                var headers = {
                                    'Content-Type': 'application/json'
                                }
                                axios.post("{{url('bill/updateAddress')}}", JSON.stringify({
                                    ad: address
                                }), {headers: headers})
                                .then(function (response) {
                                    console.log("JSON SUCESS: "+response.data);
                                    $('#adID').text(address);
                                    toastr.success('Updated address!!');
                                })
                                .catch(function (error) {
                                    console.log('ERRROR: '+ error.response.status);
                                })
                            }
                            else{
                                toastr.error('Tỉnh/Thành Phố hoặc Quận/Huyện hoặc Phường/Xã không được trống!!!');
                            }
                        }
                    },
                    mounted: function () {
                       
                    }
                })
           </script>
            {{-- include modal and <footer></footer> --}}
            @include('modal')
            <br>
            @include('footer')
    </body>
</html>
