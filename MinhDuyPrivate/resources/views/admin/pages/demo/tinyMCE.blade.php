@extends('admin/layout/index')

@section('admin_css')
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
                                            <input type="text" placeholder="Search..." class="search-int form-control">
                                            <a href="#"><i class="fa fa-search"></i></a>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <ul class="breadcome-menu">
                                        <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><span class="bread-blod">Data Table</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tinymce Start-->
        <div class="tinymce-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="tinymce-single responsive-mg-b-30">
                            <div class="alert-title">
                                <h2>Basic Summernote WYSIWYG editor</h2>
                                <p>The fastest way to get Summernote WYSIWYG editor is powerfull JavaScript plugin. you can easily maintance typography system.</p>
                            </div>
                            <div id="summernote1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tinymce End-->
@endsection

@section('admin_script')
    <!-- summernote JS
        ============================================ -->
    <script src="admin/js/summernote/summernote.min.js"></script>
    <script src="admin/js/summernote/summernote-active.js"></script>
@endsection