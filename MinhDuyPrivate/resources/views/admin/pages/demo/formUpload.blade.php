@extends('admin/layout/index')

@section('admin_css')
    <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="admin/css/form/all-type-forms.css">
@endsection
 
@section('admin_content')
        <div class="breadcome-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcome-list single-page-breadcome" style="margin-top: 60px;     margin-bottom: 6px;">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="breadcome-heading">
                                        <form role="search" class="sr-input-func">
                                            <input type="text" placeholder="Search..." class="search-int form-control">
                                            <a href="#"><i class="fa fa-search"></i></a>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <ul class="breadcome-menu">
                                        <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><span class="bread-blod">{{ changeTitle("Trần Quang Tân") }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic Form Start -->
        <div class="basic-form-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Thêm ...</h1>
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                 <div class="row">
                                    <form>
                                        <div class="form-row col-md-12">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Email</label>
                                                <div class="file-upload-inner ts-forms">
                                                    <div class="input prepend-big-btn">
                                                        <label class="icon-right">
                                                                <i class="fa fa-download"></i>
                                                            </label>
                                                        <div class="file-button">
                                                            Chọn file
                                                            <input type="file" onchange="readURL(this);">
                                                        </div>
                                                        <input type="text" id="prepend-big-btn" placeholder="Chưa có file">
                                                        <div id="preview"></div>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Password</label>
                                                <input type="password" class="form-control" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <button type="submit" class="btn btn-primary pull-right ">Lưu lại</button>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <button type="button" class="btn btn-danger">Hủy bỏ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('admin_script')
   <script>
        function readURL(input) {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            
            if(!allowedExtensions.exec(input.value)){
                alertify.set('notifier','position', 'buttom-right');
                alertify.error('Vui lòng đăng ảnh với đuôi .jpeg/.jpg/.png');
                document.getElementById('prepend-big-btn').value = "";
                document.getElementById('preview').innerHTML = ""
            }else{
                document.getElementById('prepend-big-btn').value = input.value;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        // $('#preview').attr('src', e.target.result);
                        document.getElementById('preview').innerHTML = '<img src="'+e.target.result+ '"' + ' />';
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
        }
   </script>
@endsection