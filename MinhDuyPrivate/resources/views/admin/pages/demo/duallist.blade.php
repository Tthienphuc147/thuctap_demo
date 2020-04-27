@extends('admin/layout/index')

@section('admin_css')
    <!-- duallistbox CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/duallistbox/bootstrap-duallistbox.min.css">
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
                                        <li><span class="bread-blod">Danh mục sản phẩm</span>
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

        <!-- dual list Start -->
        <div class="dual-list-box-area mg-b-15" id="hidden-loading" style="display: none;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline10-list">
                            <div class="sparkline10-hd">
                                <div class="main-sparkline10-hd">
                                    <h1>Dual List box</h1>
                                </div>
                            </div>
                            <div class="sparkline10-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="dual-list-box-inner">
                                                <form id="form" action="#" class="wizard-big">
                                                    <select class="form-control dual_select" multiple>
														<option value="United States">United States</option>
														<option value="United Kingdom">United Kingdom</option>
														<option value="Australia">Australia</option>
														<option selected value="Austria">Austria</option>
														<option selected value="Bahamas">Bahamas</option>
														<option value="Barbados">Barbados</option>
														<option value="Belgium">Belgium</option>
														<option value="Bermuda">Bermuda</option>
														<option value="Brazil">Brazil</option>
														<option value="Bulgaria">Bulgaria</option>
														<option value="Cameroon">Cameroon</option>
														<option value="Canada">Canada</option>
													</select>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- dual list End-->
@endsection

@section('admin_script')
	<!-- duallistbox JS
		============================================ -->
    <script src="admin/js/duallistbox/jquery.bootstrap-duallistbox.js"></script>
    
    <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };
    </script>
    <script>
    	(function ($) {
			"use strict";
			 
				$('.dual_select').bootstrapDualListbox({
						selectorMinimalHeight: 160
					});

		 
		})(jQuery); 
    </script>
@endsection