@extends('layouts.app')
@push('header')
    <link rel="stylesheet" type="text/css" href="{{asset('houtai/css/icon.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('houtai/css/kemu.css')}}"/>
    <script type="text/javascript" src="{{asset('houtai/js/Menu.js')}}"></script>
    <script type="text/javascript" src="{{asset('houtai/js/pinying.js')}}"></script>
    <script type="text/javascript" src="{{asset('houtai/js/kemu.js')}}"></script>
@endpush
@section('content')
    <div class="container">
        <div class="left">
            <div class="t-tree-node-el t-tree-node-expand">
                <span class="t-tree-arrow"></span>
                <span class="t-tree-node-icon"></span>
                <a href="javascript:void(0)" class="t-tree-node-link t-tree-node-el-selected" onclick="info(0)">
                    <span>会计科目</span>
                </a>
            </div>
            <ul class="t-tree">
                @foreach($lists as $v)
                    <li class="shouru" data-id="{{$v->bh}}" onclick="info({{$v->kemu_id}})">
                        <div class="t-tree-node-el t-tree-node-collapse">
                            <span class="t-tree-arrow"></span>
                            <span class="t-tree-node-icon"></span>
                            <a href="javascript:void(0)" class="t-tree-node-link">
                                <span>{{$v->kemu_name}}</span>
                            </a>
                        </div>
                        @foreach($v->child as $v1)
                            <ul class="t-tree-ct" style="display: block;">
                                <li>
                                    <span class="t-tree-node-icon-last"></span>
                                    <a href="javascript:void(0)" class="t-tree-node-link"><span
                                                class="last_ct">{{$v1->kemu_name}}</span></a>
                                </li>
                            </ul>
                        @endforeach
                    </li>
                @endforeach
            </ul>
            <ul class="t-tree-ct" id="left">
                @foreach($lists as $v)
                    <li id="li{{$v->bumen_id}}" onclick="info({{$v->bumen_id}})">
                        <span class="t-tree-node-icon"></span><span class="last_ct">{{$v->bumen_name}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="right">
            <div class="title">
                <ul>
                    <li class="xz" parent_id="0" onclick="add_info($(this))">新增</li>
                    <li class="xg">修改</li>
                    <li class="sc">删除</li>
                    <li class="cz">查找</li>
                    <li class="tc">退出</li>
                </ul>
            </div>
            <div id="right">
                <table>
                    <tr>
                        <th class="qx">
                            <input type="checkbox" name="qx" id="qx" value="" class="qx"/>
                        </th>
                        <th class="xh">序号</th>
                        <th class="bm">科目编码</th>
                        <th class="xm">科目名称</th>
                        <th class="lb">科目类别</th>
                        <th class="zjm">助记码</th>
                    </tr>
                    @foreach($result as $v)
                        <tr id="{{$v->kemu_id}}">
                            <td class="td_input">
                                <input type="checkbox" value="{{$v->kemu_id}}"/>
                            </td>
                            <td>{{$v->kemu_id}}</td>
                            <td class="td_bianma">{{$v->bh}}</td>
                            <td class="td_xingming">{{$v->kemu_name}}</td>
                            <td class="td_shuxing">{{$parent_name or ''}}</td>
                            <td class="td_zhujima">{{$v->zjm}}</td>
                        </tr>
                    @endforeach
                </table>
                {{$result->links()}}
            </div>
            <div id="alert_box_add">
                <div class="title">
                    <span>X</span> 会计科目
                </div>
                <div class="content">
                    <div class="ct">
                        <ul>
                            <li>
                                <span>*</span>
                                <span>科目编码</span>
                                <input type="text" id="bh"/>
                            </li>
                            <li>
                                <span>*</span>
                                <span>科目名称</span>
                                <input type="text" id="kemu_name"/>
                            </li>
                            <li>
                                <span>*</span>
                                <span>助记码</span>
                                <input type="text" id="zjm"/>
                            </li>
                        </ul>
                        <div class="bot">
                            <input type="button" name="" class="qd" value="确认">
                            <input type="button" name="" class="qx" value="取消">
                        </div>
                    </div>
                </div>
            </div>
            <div id="chazhao">
                <div class="title">
                    <span>X</span> 查询条件
                </div>
                <ul>
                    <li>
                        <span>职员编码</span>
                        <input type="text" class="bianma"/>
                    </li>
                    <li>
                        <span>助记码</span>
                        <input type="text" class="bianma"/>
                    </li>
                    <li>
                        <span>员工姓名</span>
                        <input type="text" class="bianma"/>
                    </li>
                </ul>
                <div class="bot">
                    <input type="button" name="" class="qd" value="确认"/>
                    <input type="button" name="" class="qx" value="取消"/>
                </div>
            </div>
            <div id="warning">
                <div class="title">
                    <span>X</span> 提示
                </div>
                <div class="text">
                    您确定要删除该数据吗？
                </div>
                <div class="bot">
                    <input type="button" name="" class="qd" value="确认"/>
                    <input type="button" name="" class="qx" value="取消"/>
                </div>
            </div>
            <div id="alert_box_x">
                <div class="title">
                    <span>X</span> 会计科目
                </div>
                <div class="content">
                    <div class="ct">
                        <ul>
                            <li>
                                <span>*</span>
                                <span>科目类别</span>
                                <select name="" class="bumen">
                                    <option value="请选择">请选择</option>
                                    <option value="收入">收入</option>
                                    <option value="支出">支出</option>
                                    <option value="资产">资产</option>
                                    <option value="共同">共同</option>
                                    <option value="负债">负债</option>
                                </select>
                            </li>
                            <li>
                                <span>*</span>
                                <span>科目编码</span>
                                <input type="text" class="bianma"/>
                            </li>
                            <li>
                                <span>*</span>
                                <span>科目名称</span>
                                <input type="text" class="xingming"/>
                            </li>
                            <li>
                                <span>*</span>
                                <span>助记码</span>
                                <input type="text" class="zhuji"/>
                            </li>
                        </ul>
                        <div class="bot">
                            <input type="button" name="" class="qd" value="确认">
                            <input type="button" name="" class="qx" value="取消">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection