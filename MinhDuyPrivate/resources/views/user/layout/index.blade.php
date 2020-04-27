<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{asset('')}}">

    @include('user.layout.css')
    @yield('css')

    <!-- Modernizr js -->
    <script src="user/assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
        .fb-livechat,
        .fb-widget {
            display: none
        }

        .ctrlq.fb-button{
            position: fixed;
            right: 24px;
            cursor: pointer
        }

        .ctrlq.fb-button {
            z-index: 999;
            background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDEyOCAxMjgiIGhlaWdodD0iMTI4cHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxMjggMTI4IiB3aWR0aD0iMTI4cHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnPjxyZWN0IGZpbGw9IiMwMDg0RkYiIGhlaWdodD0iMTI4IiB3aWR0aD0iMTI4Ii8+PC9nPjxwYXRoIGQ9Ik02NCwxNy41MzFjLTI1LjQwNSwwLTQ2LDE5LjI1OS00Niw0My4wMTVjMCwxMy41MTUsNi42NjUsMjUuNTc0LDE3LjA4OSwzMy40NnYxNi40NjIgIGwxNS42OTgtOC43MDdjNC4xODYsMS4xNzEsOC42MjEsMS44LDEzLjIxMywxLjhjMjUuNDA1LDAsNDYtMTkuMjU4LDQ2LTQzLjAxNUMxMTAsMzYuNzksODkuNDA1LDE3LjUzMSw2NCwxNy41MzF6IE02OC44NDUsNzUuMjE0ICBMNTYuOTQ3LDYyLjg1NUwzNC4wMzUsNzUuNTI0bDI1LjEyLTI2LjY1N2wxMS44OTgsMTIuMzU5bDIyLjkxLTEyLjY3TDY4Ljg0NSw3NS4yMTR6IiBmaWxsPSIjRkZGRkZGIiBpZD0iQnViYmxlX1NoYXBlIi8+PC9zdmc+) center no-repeat #0084ff;
            width: 50px;
            height: 50px;
            text-align: center;
            bottom: 10px;
            left: 10px;
            border: 0;
            outline: 0;
            border-radius: 60px;
            -webkit-border-radius: 60px;
            -moz-border-radius: 60px;
            -ms-border-radius: 60px;
            -o-border-radius: 60px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, .06), 0 2px 32px rgba(0, 0, 0, .16);
            -webkit-transition: box-shadow .2s ease;
            background-size: 80%;
            transition: all .2s ease-in-out
        }

        .ctrlq.fb-button:focus,
        .ctrlq.fb-button:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, .09), 0 4px 40px rgba(0, 0, 0, .24)
        }

        .fb-widget {
            background: #fff;
            z-index: 1000;
            position: fixed;
            width: 360px;
            height: 435px;
            overflow: hidden;
            opacity: 0;
            bottom: 0;
            left: 10px;
            border-radius: 6px;
            -o-border-radius: 6px;
            -webkit-border-radius: 6px;
            box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
            -webkit-box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
            -moz-box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
            -o-box-shadow: 0 5px 40px rgba(0, 0, 0, .16)
        }

        .fb-credit {
            text-align: center;
            margin-top: 8px
        }

        .fb-credit a {
            transition: none;
            color: #bec2c9;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 12px;
            text-decoration: none;
            border: 0;
            font-weight: 400
        }

        .ctrlq.fb-overlay {
            z-index: 0;
            position: fixed;
            height: 100vh;
            width: 100vw;
            -webkit-transition: opacity .4s, visibility .4s;
            transition: opacity .4s, visibility .4s;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, .05);
            display: none
        }

        .bubble {
            width: 20px;
            height: 20px;
            background: #c00;
            color: #fff;
            position: absolute;
            z-index: 999999999;
            text-align: center;
            vertical-align: middle;
            top: -2px;
            left: -5px;
            border-radius: 50%;
        }

        .bubble-msg {
            width: 120px;
            left: -140px;
            top: 5px;
            position: relative;
            background: rgba(59, 89, 152, .8);
            color: #fff;
            padding: 5px 8px;
            border-radius: 8px;
            text-align: center;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">
        @include('user.layout.header')

        @yield('content')

        @include('user.layout.footer')
    </div>



    <!-- Body Wrapper End Here -->
    @include('user.layout.js')
    @yield('script')
    <script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            function detectmob() {
                if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
                    return true;
                } else {
                    return false;
                }
            }
            var t = {
                delay: 125,
                overlay: $(".fb-overlay"),
                widget: $(".fb-widget"),
                button: $(".fb-button")
            };
            setTimeout(function() {
                $("div.fb-livechat").fadeIn()
            }, 8 * t.delay);
            if (!detectmob()) {
                $(".ctrlq").on("click", function(e) {
                    e.preventDefault(), t.overlay.is(":visible") ? (t.overlay.fadeOut(t.delay), t.widget.stop().animate({
                        bottom: 0,
                        opacity: 0
                    }, 2 * t.delay, function() {
                        $(this).hide("slow"), t.button.show()
                    })) : t.button.fadeOut("medium", function() {
                        t.widget.stop().show().animate({
                            bottom: "30px",
                            opacity: 1
                        }, 2 * t.delay), t.overlay.fadeIn(t.delay)
                    })
                })
            }
        });
    </script>
    <script>
        function themGioHang(id_san_pham){
            $.ajax({
                type: "get",
                url: 'them-gio-hang/'+id_san_pham,
                success: function( msg ) {
                    $("#so_luong_gio_hang").html(msg[0]);
                    $("#hien_thi_gio_hang").html(msg[1]);
                    Lobibox.notify('success', {
                        size: 'mini',
                        msg: 'Sản phẩm đã được thêm vào giỏ hàng.'
                    });
                }
            });
        }
        function xoaMotGioHang(id_san_pham){
            $.ajax({
                type: "get",
                url: 'xoa-mot-gio-hang/'+id_san_pham,
                success: function( msg ) {
                    $("#so_luong_gio_hang").html(msg[0]);
                    $("#hien_thi_gio_hang").html(msg[1]);
                }
            });
            return false;
        }

        function khongNhapKyTu(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        function themSpYeuThich(id_san_pham){
            $.ajax({
                type: "get",
                url: 'them-yeu-thich/'+id_san_pham,
                success: function( msg ) {
                    if( msg != "exist"){
                        $("#kq-yeu-thich").html(msg);
                        Lobibox.notify('success', {
                            size: 'mini',
                            msg: 'Đã thêm vào danh sách yêu thích.'
                        });
                    }
                    else{
                        Lobibox.notify('warning', {
                            size: 'mini',
                            msg: 'Sản phẩm đã tồn tại trong danh sách.'
                        });
                    }
                }
            });
        }

        function themCoSoLuongModal(id){
            var so_luong = $('#so_luong_sp_dat_hang'+id).val();
            console.log('id'+id+' So luong '+so_luong);
            var check = new RegExp('^(0*)[1-9][0-9]*$');
            if (check.test(so_luong) && (so_luong != '')) {
               $.ajax({
                type: "POST",
                url: 'them-gio-hang-co-so-luong-modal',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id_sp : id,
                    so_luong : so_luong,
                },
                success: function( msg ) {
                   $("#so_luong_gio_hang").html(msg[0]);
                   $("#hien_thi_gio_hang").html(msg[1]);
                   $('#so_luong_sp_dat_hang'+id).val('1');
                   Lobibox.notify('success', {
                       size: 'mini',
                       msg: 'Sản phẩm đã được thêm vào giỏ hàng.'
                   });
               }
           });
           }
           else {
               Lobibox.notify('error', {
                   size: 'mini',
                   msg: 'Số lượng không hợp lệ. Chỉ được nhập vào số!'
               });
               $('#so_luong_sp_dat_hang'+id).val('1');
               return false;
           }
       }
        function clickDangKyNhanMail(){
            if($('#mc-email').val().length < 0){
                Lobibox.notify('error', {
                   size: 'mini',
                   msg: 'Vui lòng cung cấp Email của bạn!'
                });
                return false;
            }
            var email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!$('#mc-email').val().match(email)){
                Lobibox.notify('error', {
                   size: 'mini',
                   msg: 'Email không hợp lệ! Vui lòng kiểm tra lại!'
                });
                return false;
            }
            $.ajax({
                type: "POST",
                url: 'dang-ky-nhan-thong-bao',
                data: $('#subscribe-form').serialize(),
                success: function( msg ) {
                    if(msg == '1'){
                        Lobibox.notify('success', {
                        size: 'mini',
                            msg: 'Bạn sẽ nhận những thông tin mới nhất từ chúng tôi.'
                        });
                        $('#mc-email').val("");
                    }
                    else{
                        Lobibox.notify('error', {
                           size: 'mini',
                           msg: 'Đăng ký thất bại, Email của bạn chưa được đăng ký vui lòng kiểm tra lại!'
                        });
                    }
                }
            });
            return false;
        }
   </script>
</body>

<!-- index30:23-->
</html>
