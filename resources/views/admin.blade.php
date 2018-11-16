<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin quản lý user</title>
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
                        <li class = 'active'  style="font-weight: bold">
                            <a href="{{action('PostController@gotoPost')}}">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                Quản lý users
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
                                <a class="breadcrumb-item active" style="font-weight: bold" href="{{url('/user/list-bai-dang')}}">quản lý bài đăng user</a>
                        </nav>
                        {{-- Content --}}
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="card" style="border-radius: 0px">
                                        <div class="card-body">
                                            <h4>Danh sách users - bài đăng</h4>
                                            <hr>
                                            <h6>Vui lòng chọn user:
                                               @if(count($users) > 0)
                                                <select @change = "eventChange" v-model = "key">
                                                       <option  value = "">{{$firstUser}}</option>
                                                       @foreach($users as $user)
                                                            <option value="{{$user->username}}">{{$user->username}}</option>
                                                       @endforeach
                                                </select>
                                               @else
                                                 <b>Không tồn tại user</b>
                                               @endif
                                            </h6>
                                            <br>
                                            <table id="myTable" class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th scope="col">STT</th>
                                                        <th scope="col">Tiêu đề</th>
                                                        <th scope="col">Sản phẩm</th>
                                                        <th scope="col">Preview</th>
                                                        <th scope="col">Duyệt bài</th>
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
                                                                   $category = $post->category();
                                                                @endphp
                                                                <td>{{$name}}</td>
                                                                <td><a href="{{action('AdminController@goPreview', [$category->categoryid, $post->slug])}}" style="color: blue"><i class="fa fa-link" aria-hidden="true"></i> xem bài</a></td>
                                                                <td scope="col" style="text-align: center"><button @click = "openModal({{$post->postid}})" type="button" class="btn btn-info">Duyệt bài</button></td>
                                                                @if($status == 1)
                                                                   <td scope="col" style="font-weight: bold">Đã duyệt</td>
                                                                @else
                                                                   <td scope="col">Chưa duyệt</td>
                                                                @endif
                                                                <td style="text-align: center"><i style="cursor: pointer" @click = "deletPostUser({{$post->postid}})" class="fa fa-trash-o"  aria-hidden="true" style="margin-right: 10px"></i></td>
                                                           </tr>
                                                       @endforeach 
                                                    </tbody>
                                                  </table>
                                           {{-- MODAL --}}
                                           <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"  v role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Duyệt bài đăng user</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                                <form>
                                                                        <div class="form-group">
                                                                                <input type="hidden" v-model = "numPost"/>
                                                                                <input type="radio" id="one" value="1" v-model="picked">
                                                                                <label for="1">Duyệt bài</label>
                                                                                <br>
                                                                                <input type="radio" id="two" value="0" v-model="picked">
                                                                                <label for="two">Không duyệt</label>
                                                                                <br>
                                                                                <label for="exampleFormControlTextarea1">Comment</label>
                                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model = "comment"></textarea>
                                                                        </div>
                                                                </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                        <button @click = "updateStatus" type="button" class="btn btn-primary">Cập nhật</button>
                                                        </div>
                                                </div>
                                            </div>
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
                        key: '',
                        comment:'',
                        check1:'',
                        check2:'',
                        picked:'',
                        numPost:''
                    },
                    methods: {
                        deletePost(postId) {
                            var isDel = confirm('Bạn có muốn xóa bài đăng này ?');
                            if(isDel) {
                                //alert(postId);
                            }
                        },
                        eventChange() {
                           console.log(this.key);
                           window.location.href = "{{url('/admin/quan-ly-bai-dang')}}" + "?" + "username=" + this.key;
                        },
                        openModal(index) {
                            $("#exampleModal").modal();
                            this.numPost = index;
                            axios.get("{{url('admin/post')}}" + "/" + index)
                                .then((response)  =>  {
                                    console.log(response);
                                    var status = response.data.status;
                                    this.picked = status;
                                    this.comment = response.data.comment;
                                }, (error)  =>  {
                                    //401:
                                    console.log(error);
                            })
                        },
                        updateStatus() {
                            console.log('STATUS: '+this.picked);
                            var headers = {
                                    'Content-Type': 'application/json'
                                }
                                axios.post("{{url('admin/post/updateStatus')}}", JSON.stringify({
                                    postid: this.numPost,
                                    status: this.picked,
                                    comment: this.comment
                                }), {headers: headers})
                                .then(function (response) {
                                    console.log("JSON SUCESS: "+response.data);
                                    toastr.success('Đã cập nhật trạng thái bài đăng!');
                                    window.location.reload();
                                })
                                .catch(function (error) {
                                    console.log('ERRROR: '+ error);
                                    toastr.error('Lỗi!'+error);
                                })
                          },
                          deletPostUser(postId) {
                              var con = confirm('Bạn chắc muốn xóa bài đăng này ?');
                              if(con){
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
                        }
                })
           </script>
           @include('modal')
    </body>
</html>
