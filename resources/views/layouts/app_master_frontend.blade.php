<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>{{ $title_page ?? "thiếu tiêu đề"}}</title>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link rel="stylesheet" type="text/css" href="https://codeseven.github.io/toastr/build/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@yield('css')




    <link rel="icon" href="" type="image/x-icon"/>	<!--thêm favicon vào thanh title website-->
    <link rel="stylesheet" type="text/css" href="">	<!--thêm favicon vào thanh title website-->




</head>
<body>
@include('frontend.components.header')
@yield('content')
@include('frontend.components.footer')
<script>
    var DEVICE = '{{ device_agent()}}' /*detect phiên bản thiết bị sử dụng*/
</script>
@yield('script')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v7.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Your Chat Plugin code -->

</body>
</html>
