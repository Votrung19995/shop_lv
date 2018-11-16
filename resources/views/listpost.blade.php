<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quản lý đăng tin</title>
        <link rel="shortcut icon" href="{{{ asset('resources/images/shopping.png') }}}">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style4.css') }}" rel="stylesheet">
        <link href="{{ asset('css/easy-autocomplete.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/easy-autocomplete.themes.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="{{asset('css/jquery.ui.autocomplete.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css"/>
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></link>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <!-- Using jQuery with a CDN -->
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="{{asset('js/jquery.easy-autocomplete.min.js')}}"></script>
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>
        <!-- #region datatables files -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
        <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
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
          <div class="wrapper" style="margin-0px">
                <!-- Sidebar Holder -->
                <nav id="sidebar" style="margin-bottom: 0px">
                    <ul class="list-unstyled components">
                        <li style="font-weight: bold">
                            <a href="{{url('/')}}">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                Trang chủ
                            </a>
                        </li>
                        <li  style="font-weight: bold">
                            <a href="{{action('PostController@gotoPost')}}">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                Quản lý đăng tin
                            </a>
                        </li>
                        <li class="active" style="font-weight: bold">
                            <a href="#">
                                <i class="fa fa-th-list" aria-hidden="true"></i>
                                Danh sách bài đăng
                            </a>
                        </li>
                        <li style="font-weight: bold">
                                <a href="{{action('PostController@gotoListDH')}}">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    Quản lý đơn hàng
                                </a>
                        </li>
                        <li style="font-weight: bold">
                                <a href="{{action('LoginController@logOut')}}">
                                    <i class="fa fa-power-off" aria-hidden="true"></i>
                                    Đăng xuất
                                </a>
                        </li>
                    </ul>
                </nav>
    
                <!-- Page Content Holder -->
                <div id="content">
                        <nav class="breadcrumb" style="border: 1px solid rgba(0,0,0,.125);border-radius: 0px; background-color: white">
                                <a class="breadcrumb-item" style="color: blue; font-weight: bold" href="{{url('/')}}">Trang chủ</a>
                        <a class="breadcrumb-item active" style="font-weight: bold" href="{{url('/user/list-bai-dang')}}">danh sách bài đăng</a>
                        </nav>
                        {{-- Content --}}
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="card" style="border-radius: 0px">
                                        <div class="card-body">
                                            <table id="myTable" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">Tiêu đề</th>
                                                    <th scope="col">Sản phẩm</th>
                                                    <th scope="col">Ghi chú</th>
                                                    <th scope="col">Trạng thái</th>
                                                    <th scope="col">Action</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach($posts as $index => $post)
                                                       <tr>
                                                            <td scope="row">{{$index + 1}}</td>
                                                            <td>{{$post->title}}</td>
                                                            @php
                                                               $category = $post->category();
                                                               $name = 'Không tồn tại';
                                                               $status = 1;
                                                               if(!empty($category)){
                                                                   $name = $category->name;
                                                                   $status = $category->status;
                                                               }
                                                            @endphp
                                                            <td>{{$name}}</td>
                                                            @if(strlen($post->comment) > 0)
                                                               <td scope="col" style="font-weight: bold">{{$post->comment}}</td>
                                                            @else
                                                               <td scope="col">Không có ghi chú</td>
                                                            @endif
                                                            @if($status == 1)
                                                               <td scope="col" style="font-weight: bold">Đã duyệt</td>
                                                            @else
                                                               <td scope="col">Chưa duyệt</td>
                                                            @endif
                                                            <td><i class="fa fa-trash-o" @click = "deletePost({{$post->postid}})" aria-hidden="true" style="margin-right: 10px"></i> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                                                       </tr>
                                                   @endforeach 
                                                </tbody>
                                              </table>
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
                    $('#myTable').dataTable();
                } );
           </script>
           <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });

            function test(){
                var editorData= CKEDITOR.instances['editor1'].getData();
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
                        window.location.href = "/detail/"+idUI;
                    },
                    minLength: 3,
                    
                });
            });
           </script>

           <script>
               CKEDITOR.replace( 'editor1', {
                filebrowserBrowseUrl: '{{ asset('js/ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('js/ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('js/ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
               } );
           </script>
           {{-- include modal and <footer></footer> --}}

           
           <script>
                var app = new Vue({
                    el: '#content',
                    data: {
                        message: 'Hello Vue!',
                        posts:  {!! json_encode($posts) !!}
                    },
                    methods: {
                        deletePost(postId) {
                            var isDel = confirm('Bạn có muốn xóa bài đăng này ?');
                            if(isDel) {
                                var headers = {
                                    'Content-Type': 'application/json'
                                }
                                axios.post("{{url('user/deletePostUser')}}", JSON.stringify({
                                    postid:postId
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
                    },
                    mounted() {
                        console.log(this.posts);
                    }
                })
           </script>
           @include('modal')
    </body>
</html>
