<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <LINK rel="Bookmark" href="/favicon.ico">
    <LINK rel="Shortcut Icon" href="/favicon.ico"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{path('lib/html5.js')}}"></script>
    <script type="text/javascript" src="{{path('lib/respond.min.js')}}"></script>
    <script type="text/javascript" src="{{path('lib/PIE_IE678.js')}}"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{path('static/h-ui/css/H-ui.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{path('static/h-ui.admin/css/H-ui.admin.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{path('lib/Hui-iconfont/1.0.7/iconfont.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{path('lib/icheck/icheck.css')}}"/>
    {{--<link rel="stylesheet" type="text/css" href="{{path('static/h-ui.admin/skin/default/skin.css')}}" id="skin" />--}}
    {{--<link rel="stylesheet" type="text/css" href="{{path('static/h-ui.admin/css/style.css')}}" />--}}
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>合纵医药后台管理系统</title>
    <meta name="keywords" content="合纵药易购管理系统">
    <meta name="description" content="合纵药易购管理系统">
    <meta http-equiv="Content-Security-Policy" content="
    img-src 'unsafe-inline' 'unsafe-eval' 'self'  *.hezongyy.com *.cnzz.com;
    script-src 'unsafe-inline' 'unsafe-eval' 'self'  *.hezongyy.com *.cnzz.com;
    style-src 'unsafe-inline' 'unsafe-eval' 'self'  *.hezongyy.com *.cnzz.com;
    connect-src 'unsafe-inline' 'unsafe-eval' 'self'  *.hezongyy.com *.cnzz.com;
    object-src 'unsafe-inline' 'unsafe-eval' 'self'  *.hezongyy.com *.cnzz.com;
    child-src 'unsafe-inline' 'unsafe-eval' 'self'  *.hezongyy.com *.cnzz.com;
    media-src 'unsafe-inline' 'unsafe-eval' 'self'  *.hezongyy.com *.cnzz.com;">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript" src="{{path('lib/jquery/1.9.1/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{path('lib/layer/2.1/layer.js')}}"></script>
    <script type="text/javascript" src="{{path('lib/jquery.contextmenu/jquery.contextmenu.r2.js')}}"></script>
    @include('common.huijs')
    @yield('links')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            beforeSend: function () {
                layer.load(1, {
                    shade: [0.1, '#fff'] //0.1透明度的白色背景
                });
            },
            complete: function () {
                layer.closeAll('loading');
            },
        });
    </script>
    <style>
        body, td, th {
            font-family: "宋体"
        }

        ::-webkit-input-placeholder { /* WebKit browsers */
            color: black;
            opacity: 0.6;
        }

        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
            color: black;
            opacity: 0.6;
        }

        ::-moz-placeholder { /* Mozilla Firefox 19+ */
            color: black;
            opacity: 0.6;
        }

        :-ms-input-placeholder { /* Internet Explorer 10+ */
            color: black;
            opacity: 0.6;
        }

        td.xtb {
            padding-left: 5px;
            padding-right: 8px;
        }

        td.xtb a {
            margin-left: 5px;
        }

        #search_form input {
            color: #1869c4;
        }

        select option {
            color: #333;
        }

        .page-container {
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>
<body style="padding-bottom: 50px;">

<div id="pjax-full-1">
    @yield('content')
</div>


<script type="text/javascript">
    //    $(function(){
    //        $(".Hui-tabNav-wp").contextMenu('myMenu1', {
    //            bindings: {
    //                'open': function(t) {
    //                    alert('Trigger was '+t.id+'\nAction was Open');
    //                },
    //                'email': function(t) {
    //                    alert('Trigger was '+t.id+'\nAction was Email');
    //                },
    //                'save': function(t) {
    //                    alert('Trigger was '+t.id+'\nAction was Save');
    //                },
    //                'delete': function(t) {
    //                    alert('Trigger was '+t.id+'\nAction was Delete')
    //                }
    //            }
    //        });
    //    });
    function check_all(obj) {
        $('.id_check').prop("checked", obj.prop('checked'));
    }
    function is_check(obj, id) {
        var subBox = $("." + obj);
        $("#" + id).prop("checked", subBox.length == $("." + obj + ":checked").length ? true : false);
    }
    /*资讯-添加*/
    function article_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-添加*/
    function picture_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*产品-添加*/
    function product_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*用户-添加*/
    function member_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }

    /*管理员-角色-删除*/
    function delete_cz(obj, url) {
        var msg = $(obj).attr('title');
        var method = $(obj).attr('method');
        layer.confirm(msg, function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $('.layui-layer-btn1').click();
            $.ajax({
                url: url,
                type: method,
                dataType: 'json',
                success: function (data) {
                    if (data.error == 0) {
                        $(obj).parents("tr").remove();
                    }
                    layer.msg(data.msg, {icon: parseInt(data.error) + 1, time: 1000});
                }
            });
        });
    }
    function create_a(url, title) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    function create_b(url, title, w, h) {
        layer_show(title, url, w, h);
    }
    function check_search_form(max_num) {
        $('#search_form input').each(function () {
            var val = $(this).val();
            var text = $(this).attr('placeholder');
            if (val == text) {
                $(this).val('');
            }
        });
        var page_num = parseInt($("#page_num").val());
        max_num = '{{$max_num or 50}}';
        if (page_num > max_num) {
            $("#page_num").val(max_num);
            page_num = max_num;
        }
        return true;
    }
    function up_yes_no(obj, url) {
        $.ajax({
            url: url,
            type: 'put',
            dataType: 'json',
            success: function (data) {
                if (data.error == 0) {
                    obj.html(data.html);
                }
                layer.msg(data.msg, {icon: parseInt(data.error) + 1, time: 1000});
            }
        });
    }
    function shuaxin(url) {
        if (url == '') {
            location.replace(location.href);
        } else {
            location.href = url;
//            $.pjax({
//                url: url,
//                container: '#pjax-full-2',
//            })
        }
    }
    function zhengchu(x, y) {//x是被除数,y是除数
        var status = 0;
        var z = x / y;
        z = parseInt(z);
        if (z * y != x) {
            status = 1;
        }
        return status;
    }
    $(document).keydown(function (event) {
        if (event.keyCode == 13) { //绑定回车
            $('#search-submit').click();
        }
    });
    $('select').change(function () {
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).css('color', '#333')
        } else {
            $(this).css('color', '#1869c4')
        }
    })
    $('input').focus(function () {
        var text = $(this).attr('placeholder');
        var old_text = $(this).attr('old_placeholder');
        if (text != '' || old_text != '') {
            $(this).attr('old_placeholder', text);
            $(this).attr('placeholder', '');
        }
        $(this).select();
    })
    $('input').blur(function () {
        var text = $(this).attr('placeholder');
        var old_text = $(this).attr('old_placeholder');
        if (text != '' || old_text != '') {
            $(this).attr('placeholder', old_text);
            $(this).attr('old_placeholder', '');
        }
    })
    var system = {};
    var p = navigator.platform;
    system.win = p.indexOf("Win") == 0;
    system.mac = p.indexOf("Mac") == 0;
    system.x11 = (p == "x11") || (p.indexOf("Linux") == 0);
    if (system.win || system.mac || system.x11) {
    } else {
        $('.page-container').css('height', '1200px')
        $('.page-container').css('overflow-y', 'auto')
    }

    supportPlaceholder = 'placeholder' in document.createElement('input'),
        placeholder = function (input) {

            var text = input.attr('placeholder'),
                defaultValue = input.defaultValue;

            if (!defaultValue) {

                input.val(text).addClass("phcolor");
            }

            input.focus(function () {

                if (input.val() == text) {

                    $(this).val("");
                }
            });


            input.blur(function () {

                if (input.val() == "") {

                    $(this).val(text).addClass("phcolor");
                }
            });
            //输入的字符不为灰色
            input.keydown(function () {

                $(this).removeClass("phcolor");
            });
        };

    //当浏览器不支持placeholder属性时，调用placeholder函数
    if (!supportPlaceholder) {

        $('#search_form input').each(function () {

            text = $(this).attr("placeholder");

            if ($(this).attr("type") == "text") {

                placeholder($(this));
            }
        });
    }

</script>
{{--定义自己的js--}}
@yield('my-js')
</body>
</html>