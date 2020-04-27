@extends('admin/layout/index')

@section('admin_css')
    <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="admin/css/form/all-type-forms.css">
    <!-- summernote CSS
        ============================================ -->
    <link rel="stylesheet" href="admin/css/summernote/summernote.css">
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
                                            <input type="text" placeholder="Tìm kiếm..." class="search-int form-control">
                                            <a href="#"><i class="fa fa-search"></i></a>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <ul class="breadcome-menu">
                                        <li><a href="quantri/trangchu">Admin</a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><a href="quantri/dichvu/danhsach">Dịch vụ</a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><span class="bread-blod">Thêm</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
         <!-- Loading Start -->
        <div class="data-table-area mg-b-15" id="show-loading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="pt-5" style="min-height: 65vh;">
                                <div class="loading-spinner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Loading End -->
        <!-- Basic Form Start -->
        <div class="basic-form-area mg-b-15" id="hidden-loading" style="display: none;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Thêm dịch vụ</h1>
                                </div>
                                <hr>
                            </div>
                            <div class="sparkline12-graph">
                                <form id="form-them-dich-vu" action="quantri/dichvu/them" method="POST" enctype="multipart/form-data">
                                	@csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Chọn danh mục</label>
                                           <div class="form-select-list">
                                                <select class="form-control custom-select-value" name="id_danh_muc_dich_vu" required="" onchange="changeDanhMuc(this.value)" oninvalid="this.setCustomValidity('Vui lòng chọn danh mục')" oninput="setCustomValidity('')">
                                                        <option value="">Chọn danh mục</option>
                                                    @foreach($danh_muc_dich_vu as $danh_muc)
                                                        <option value="{{$danh_muc->id}}">{{ $danh_muc->ten }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Chọn loại dịch vụ</label>
                                            <div class="form-select-list">
                                                <select class="form-control custom-select-value" name="id_loai_dich_vu" required="" oninvalid="this.setCustomValidity('Vui lòng chọn loại dịch vụ')" oninput="setCustomValidity('')">
                                                        <option value="">Chọn loại</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Tiêu đề</label>
                                            <input type="text" class="form-control" placeholder="Nhập tiêu đề" required="" name="tieu_de" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Mô tả</label>
                                            <textarea class="form-control" placeholder="Mô tả ngắn" rows="4" name="mo_ta" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Chọn hình ảnh</label>
                                            <input class="form-control" type='file' required="" onchange="readURL(this);" id="file" name="file" oninvalid="this.setCustomValidity('Vui lòng chọn hình ảnh')" oninput="setCustomValidity('')" />
                                            <div id="preview"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Nội dung</label>
                                            <div class="responsive-mg-b-30" style="margin-bottom: 30px;">
                                                <textarea id="summernote1" name="noi_dung"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <button type="submit" class="btn btn-success pull-right" name="save">Lưu lại</button>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <button type="button" class="btn btn-danger" name="destroy" onclick="destroyDV()">Hủy bỏ</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('admin_script')
    <!-- summernote JS
        ============================================ -->
    <script src="admin/js/summernote/summernote.min.js"></script>
   <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };

        function destroyDV(){
        	window.location.href="quantri/dichvu/danhsach"
        }

        function changeDanhMuc(str){
            if (str == "") {
                $('#form-them-dich-vu select[name*=id_loai_dich_vu]').html('<option value="">Chọn loại</option>')
                return
            }
            $.ajax({
                type: 'POST',
                url:'quantri/dichvu/changedanhmuc',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id_danh_muc_dich_vu: str
                },
                success: function(response){
                    if(response.status){
                        let str = ''
                        str += '<option value="">Chọn loại</option>'
                        for(let i = 0; i < response.loai_dich_vu.length; i++){
                            str += '<option value="' + response.loai_dich_vu[i].id + '">' + response.loai_dich_vu[i].ten + '</option>'
                        }
                        $('#form-them-dich-vu select[name*=id_loai_dich_vu]').html(str)
                    } else {
                        $('#form-them-dich-vu select[name*=id_loai_dich_vu]').html('<option value="">Chọn loại</option>')
                        Lobibox.notify('error', {
                            size: 'mini',
                            msg: "Lỗi không tìm thấy dữ liệu.\nVui lòng thử lại."
                        });
                    }
                },
                error: (error) => {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: "Lỗi kết nối cơ sở dữ liệu.\nVui lòng thử lại."
                    });
                }
            })
        }

        $(function(){
            $('#summernote1').summernote({
                height: 400,
            });
        })

        function readURL(input) {
            var fileInput = document.getElementById('file');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if(!allowedExtensions.exec(filePath)){
                Lobibox.notify('warning', {
                    size: 'mini',
                    msg: "Vui lòng đăng ảnh với đuôi .jpeg/.jpg/.png."
                });
                fileInput.value = '';
                $('#preview').html('')
            }else{
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $('#preview').html('<img src="' + e.target.result + '" alt="Hình ảnh" style="margin-left: auto; margin-right: auto; margin-top: 20px; max-width: 400px; display: block;" />')
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }
    </script>
@endsection