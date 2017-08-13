<!DOCTYPE html>
<html lang="zh_cn">
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('houtai/css/style.css')}}"/>
    <script type="text/javascript" src="{{asset('houtai/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('houtai/js/global.js')}}"></script>
    <script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>
    <title>蓝色企业数字办公后台管理模板</title>
    @stack('header')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {

                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

            },
            type: 'post',
        });
    </script>
</head>
<body>
@yield('content')
</body>
@stack('footer')
</html>