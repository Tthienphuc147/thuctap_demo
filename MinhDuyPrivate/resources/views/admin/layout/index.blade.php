<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Trang quản trị - Phuc Store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <link rel="shortcut icon" type="image/x-icon" href="user/assets/images/logo.png">
    @include('admin.layout.css')
    @yield('admin_css')
</head>

<body>
    {{--@include('admin.layout.leftmenu')--}}
    @include('admin.layout.leftmenu')
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        {{--@include('admin.layout.header')--}}
        @include('admin.layout.header')
        @yield('admin_content')
    </div>

    @include('admin.layout.script')
    <!-- script trả về khi xóa thành công -->
    @if (session('thongbaoxoathanhcong'))
    <script>
        alertify.set('notifier','position', 'buttom-right');
        alertify.success("Xóa dữ liệu thành công!")
    </script>
    @endif
    <!-- script trả về khi xóa thất bại -->
    @if (session('thongbaoxoathatbai'))
    <script>
        alertify.set('notifier','position', 'buttom-right');
        alertify.error("Xóa dữ liệu thất bại")
    </script>
    @endif

    <!-- script trả về khi Thêm thành công -->
    @if (session('thongbaothemthanhcong'))
    <script>
        alertify.set('notifier','position', 'buttom-right');
        alertify.success("Thêm dữ liệu thành công!")
    </script>
    @endif
    <!-- script trả về khi Thêm thất bại -->
    @if (session('thongbaothemthatbai'))
    <script>
        alertify.set('notifier','position', 'buttom-right');
        alertify.error("Thêm dữ liệu thất bại")
    </script>
    @endif

    <!-- script trả về khi Chỉnh sửa thành công -->
    @if (session('thongbaosuathanhcong'))
    <script>
        alertify.set('notifier','position', 'buttom-right');
        alertify.success("Chỉnh sửa dữ liệu thành công!")
    </script>
    @endif
    @if (session('thongbaosuaquyenthanhcong'))
    <script>
        alertify.set('notifier','position', 'buttom-right');
        alertify.success("Cập nhật quyền cho nhân viên thành công!")
    </script>
    @endif
    <!-- script trả về khi Chỉnh sửa thất bại -->
    @if (session('thongbaosuathatbai'))
    <script>
        alertify.set('notifier','position', 'buttom-right');
        alertify.error("Chỉnh sửa dữ liệu thất bại")
    </script>
    @endif
    @yield('admin_script')
</body>

</html>
