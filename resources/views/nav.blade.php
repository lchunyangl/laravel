@extends('layouts.app')
@push('header')
    <link rel="stylesheet" href="{{asset('houtai/css/zTreeStyle/zTreeStyle.css')}}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('houtai/css/skin_/nav.css')}}"/>
@endpush
@push('footer')
    <script type="text/javascript" src="{{asset('houtai/js/nav.js')}}"></script>
    <script type="text/javascript" src="{{asset('houtai/js/Menu.js')}}"></script>
    <script type="text/javascript" src="{{asset('houtai/js/jquery.ztree.core-3.5.js')}}"></script>
    <script type="text/javascript">
        var menu = new Menu({
            defaultSelect: $('.nav').find('li[data-id="1"]')
        });

        // 左侧树结构加载
        var setting = {};

        var zNodes = [
            {
                name: "财务文档管理",
                children: [
                    {name: "新闻视频管理", icon: 'img/skin_/leftlist.png'},
                    {name: "新闻频道管理", icon: 'img/skin_/leftlist.png'},
                    {name: "地方新闻管理", icon: 'img/skin_/leftlist.png'}
                ]
            },
            {
                name: "用户信息设置", open: true,
                children: [
                    {name: "首页", checked: true, icon: 'img/skin_/leftlist.png'},
                    {name: "表单", icon: 'img/skin_/leftlist.png'},
                    {name: "表格", icon: 'img/skin_/leftlist.png'},
                    {name: "自定义设置", icon: 'img/skin_/leftlist.png'}
                ]
            },
            {
                name: "工作安排",
                children: [
                    {name: "工作安排", icon: 'img/skin_/leftlist.png'},
                    {name: "安排管理", icon: 'img/skin_/leftlist.png'},
                    {name: "类型选择", icon: 'img/skin_/leftlist.png'},
                    {name: "自定义设置", icon: 'img/skin_/leftlist.png'}
                ]
            },
            {
                name: "数据管理",
                children: [
                    {name: "工作安排", icon: 'img/skin_/leftlist.png'},
                    {name: "安排管理", icon: 'img/skin_/leftlist.png'},
                    {name: "类型选择", icon: 'img/skin_/leftlist.png'},
                    {name: "自定义设置", icon: 'img/skin_/leftlist.png'}
                ]
            }
        ];

        $.fn.zTree.init($(".tree"), setting, zNodes);

        //切换
        //	$('.sidebar h2').click(function(e) {
        //      $('.tree-list').toggleClass('outwindow');
        //		$('.nav').toggleClass('outwindow');
        //  });

        $(document).click(function (e) {
            if (!$(e.target).is('.tab-more')) {
                $('.tab-more').removeClass('active');
                $('.more-bab-list').hide();
            }
        });
    </script>
@endpush
@section('content')
    <div id="container">
        <div id="bd">
            <div class="sidebar">
                <div class="sidebar-bg"></div>
                <i class="sidebar-hide"></i>
                <h2><a href="javascript:;"><i class="h2-icon" title="切换到树型结构"></i><span>菜单管理</span></a></h2>
                <ul class="nav">
                    <li class="nav-li">
                        <a href="javascript:;" class="ue-clear"><i class="nav-ivon"></i><span
                                    class="nav-text">财务文档管理</span></a>
                        <ul class="subnav">
                            <li class="subnav-li" href="{{route('main')}}" data-id="8"><a href="javascript:;"
                                                                                          class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">财务文档管理1</span></a></li>
                            <li class="subnav-li" href="form.html" data-id="9"><a href="javascript:;"
                                                                                  class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">财务文档管理2</span></a></li>
                            <li class="subnav-li" href="table.html" data-id="10"><a href="javascript:;"
                                                                                    class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">财务文档管理3</span></a></li>
                            <li class="subnav-li" data-id="11"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">自定义设置1</span></a></li>

                        </ul>
                    </li>
                    <li class="nav-li">
                        <a href="javascript:;" class="ue-clear"><i class="nav-ivon"></i><span
                                    class="nav-text">薪资自助查询</span></a>
                        <ul class="subnav">
                            <li class="subnav-li" href="index.html" data-id="1111"><a href="javascript:;"
                                                                                      class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">薪资自助查询1</span></a></li>
                            <li class="subnav-li" href="form.html" data-id="2"><a href="javascript:;"
                                                                                  class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">薪资自助查询2</span></a></li>
                            <li class="subnav-li" href="table.html" data-id="3"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">薪资自助查询3</span></a></li>
                            <li class="subnav-li" data-id="4"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">自定义设置2</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-li">
                        <a href="javascript:;" class="ue-clear"><i class="nav-ivon"></i><span
                                    class="nav-text">财务经费管理</span></a>
                        <ul class="subnav">
                            <li class="subnav-li" data-id="5" href="jingfeibaoxiao.html"><a href="javascript:;"
                                                                                            class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">经费报销</span></a></li>
                            <li class="subnav-li" data-id="6"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">报销单管理</span></a></li>
                            <li class="subnav-li" data-id="7"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">经费报销查询</span></a></li>
                            <li class="subnav-li" data-id="21"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">包干经费查询</span></a></li>
                            <li class="subnav-li" data-id="20"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">办案专项经费查询</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-li last-nav-li">
                        <a href="javascript:;" class="ue-clear"><i class="nav-ivon"></i><span
                                    class="nav-text">资产编码管理</span></a>
                        <ul class="subnav">
                            <li class="subnav-li" data-id="22"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">资产编码管理1</span></a></li>
                            <li class="subnav-li" data-id="23"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">资产编码管理2</span></a></li>
                            <li class="subnav-li" data-id="24"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">资产编码管理3</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-li last-nav-li">
                        <a href="javascript:;" class="ue-clear"><i class="nav-ivon"></i><span
                                    class="nav-text">办公耗品管理</span></a>
                        <ul class="subnav">
                            <li class="subnav-li" data-id="25"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">办公低耗品管理1</span></a></li>
                            <li class="subnav-li" data-id="26"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">办公低耗品管理2</span></a></li>
                            <li class="subnav-li" data-id="27"><a href="javascript:;" class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">办公低耗品管理3</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-li last-nav-li">
                        <a href="javascript:;" class="ue-clear"><i class="nav-ivon"></i><span
                                    class="nav-text">系统后台管理</span></a>
                        <ul class="subnav">
                            <li class="subnav-li" data-id="28" href="{{route('bumen.index')}}"><a href="javascript:;"
                                                                                                  class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">部门设置</span></a></li>
                            <li class="subnav-li" data-id="29" href="quanxian.html"><a href="javascript:;"
                                                                                       class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">权限管理</span></a></li>
                            <li class="subnav-li" data-id="30" href="{{route('renyuan.index')}}"><a href="javascript:;"
                                                                                                    class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">人员设置</span></a></li>
                            <li class="subnav-li" data-id="31" href="{{route('baoxiaolx.index')}}"><a href="javascript:;"
                                                                                             class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">报销类型</span></a></li>
                            <li class="subnav-li" data-id="32" href="{{route('kemu.index')}}"><a href="javascript:;"
                                                                                                 class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">会计科目</span></a></li>
                            <li class="subnav-li" data-id="33" href="zhuanxiangjingfei.html"><a href="javascript:;"
                                                                                                class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">专项经费</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-li last-nav-li" style="display: none;">
                        <a href="javascript:;" class="ue-clear"><i class="nav-ivon"></i><span
                                    class="nav-text">系统后台管理</span></a>
                        <ul class="subnav">
                            <li class="subnav-li" data-id="1" href="{{route('main')}}"><a href="javascript:;"
                                                                                          class="ue-clear"><i
                                            class="subnav-icon"></i><span class="subnav-text">便捷操作</span></a></li>
                        </ul>
                    </li>
                </ul>
                <!--切换-->
                <!--<div class="tree-list outwindow">
                    <div class="tree ztree"></div>
                </div>-->
            </div>
            <div class="main">
                <div class="title">
                    <i class="sidebar-show"></i>
                    <ul class="tab ue-clear">

                    </ul>
                    <i class="tab-more"></i>
                    <i class="tab-close"></i>
                </div>
                <div class="content">
                </div>
            </div>
        </div>
    </div>
@endsection