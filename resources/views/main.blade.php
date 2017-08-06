@extends('layouts.app')
@push('header')
    <link rel="stylesheet" type="text/css" href="{{asset('houtai/css/skin_/index.css')}}"/>
    <script type="text/javascript" src="{{asset('houtai/js/jquery-ui-1.9.2.custom.min.js')}}"></script>
@endpush
@push('footer')
    <script type="text/javascript">
        var minwidth = 282;
        resizeWidth();
        $(top.window).resize(function (e) {
            resizeWidth();
        });
        $(function () {
            $(".content-list").sortable({
                revert: true,
                handle: 'h2'
            });

        });

        function resizeWidth() {
            if ($('#main').width() / 3 < minwidth) {
                $('.content-item').width(($('#main').width() / 2) - 15);
            } else {
                $('.content-item').width(($('#main').width() / 3) - 15);
            }

        }
    </script>
@endpush
@section('content')
    <div id="container">
        <div id="hd">
        </div>
        <div id="bd">
            <div id="main">
                <ul class="nav-list ue-clear">
                    <li class="nav-item desk">
                        <a href="index.html">
                            <p class="icon"></p>
                            <p class="title">财务文档管理1</p>
                        </a>
                    </li>
                    <li class="nav-item news">
                        <a href="index.html">
                            <p class="icon"></p>
                            <p class="title">薪资查询</p>
                        </a>
                    </li>
                    <li class="nav-item notice">
                        <a href="index.html">
                            <p class="icon"></p>
                            <p class="title">经费报销</p>
                        </a>
                    </li>

                    <li class="nav-item plan">
                        <a href="index.html">
                            <p class="icon"></p>
                            <p class="title">资产管理</p>
                        </a>
                    </li>
                    <li class="nav-item contacts">
                        <a href="index.html">
                            <p class="icon"></p>
                            <p class="title">办公耗品管理</p>
                        </a>
                    </li>
                    <li class="nav-item mail">
                        <a href="index.html">
                            <p class="icon"></p>
                            <p class="title">人员设置</p>
                        </a>
                    </li>
                </ul>

                <ul class="content-list">
                    <li class="content-item system">
                        <h2 class="content-hd">
                    	<span class="opt">
                        	<span class="refresh" title="刷新"></span>
                            <span class="setting" title="设置"></span>
                            <span class="report" title="导出"></span>
                            <span class="close" title="关闭"></span>
                        </span>
                            <span class="title">财务文档管理</span>

                        </h2>
                        <div class="content-bd">
                            <img src="{{asset('houtai/img/skin_/pic1.png')}}"/>
                        </div>
                    </li>
                    <li class="content-item dothings">
                        <h2 class="content-hd">
                    	<span class="opt">
                        	<span class="refresh" title="刷新"></span>
                            <span class="setting" title="设置"></span>
                            <span class="report" title="导出"></span>
                            <span class="close" title="关闭"></span>
                        </span>
                            <span class="title">薪资自助查询</span>
                        </h2>
                        <div class="content-bd">
                            <ul class="content-list things">
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录1</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录2</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录3</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录4</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录5</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="content-item richeng">
                        <h2 class="content-hd">
                    	<span class="opt">
                        	<span class="refresh" title="刷新"></span>
                            <span class="setting" title="设置"></span>
                            <span class="report" title="导出"></span>
                            <span class="close" title="关闭"></span>
                        </span>
                            <span class="title">财务经费管理</span>
                        </h2>
                        <div class="content-bd">
                            <ul class="content-list things">
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录1</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录2</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录3</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录4</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录5</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="content-item system">
                        <h2 class="content-hd">
                    	<span class="opt">
                        	<span class="refresh" title="刷新"></span>
                            <span class="setting" title="设置"></span>
                            <span class="report" title="导出"></span>
                            <span class="close" title="关闭"></span>
                        </span>
                            <span class="title">财产编码管理</span>
                        </h2>
                        <div class="content-bd">
                            <ul class="content-list things">
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录1</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录2</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录3</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录4</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录5</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="content-item news">
                        <h2 class="content-hd">
                    	<span class="opt">
                        	<span class="refresh" title="刷新"></span>
                            <span class="setting" title="设置"></span>
                            <span class="report" title="导出"></span>
                            <span class="close" title="关闭"></span>
                        </span>
                            <span class="title">办公耗品管理</span>
                        </h2>
                        <div class="content-bd">
                            <ul class="content-list things">
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录1</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录2</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录3</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录4</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录5</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="content-item news">
                        <h2 class="content-hd">
                    	<span class="opt">
                        	<span class="refresh" title="刷新"></span>
                            <span class="setting" title="设置"></span>
                            <span class="report" title="导出"></span>
                            <span class="close" title="关闭"></span>
                        </span>
                            <span class="title">系统后台管理</span>
                        </h2>
                        <div class="content-bd">
                            <ul class="content-list things">
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录1</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录2</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录3</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录4</a>
                                </li>
                                <li class="content-list-item">
                                    <i class="icon"></i>
                                    <a href="javascript:;">近期操作的记录5</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection