<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xác thực</title>
</head>
<body>
<p>Xin chào, <b>{{ $TenND }}</b> </p>
<p>Bạn vui lòng click vào link sau để tiếp tục xử dụng dịch vụ của chúng tôi:</p>
<a href="{{ url('user/activation', $link)}}">{{ url('user/activation', $link)}}</a>
<p>Xin chân thành cảm ơn!</p>
<p>Bookstore</p>
</body>
</html>