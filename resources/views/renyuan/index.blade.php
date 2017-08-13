@extends('layouts.app')
@push('header')
    <link rel="stylesheet" type="text/css" href="{{asset('houtai/css/icon.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('houtai/css/renyuan.css')}}"/>
    <script type="text/javascript" src="{{asset('houtai/js/Menu.js')}}"></script>
    <script type="text/javascript" src="{{asset('houtai/js/pinying.js')}}"></script>
    <script type="text/javascript" src="{{asset('houtai/js/renyuan.js')}}"></script>
@endpush
@section('content')
    <div class="container">
        <div class="left">
            <div class="t-tree-node-el t-tree-node-expand">
                <span class="t-tree-arrow"></span>
                <span class="t-tree-node-icon"></span>
                <a href="javascript:void(0)" class="t-tree-node-link t-tree-node-el-selected" onclick="info(0)">
                    <span>部门</span>
                </a>
            </div>
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
                    <li class="xz">新增</li>
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
                        <th class="bm">职员编码</th>
                        <th class="xm">职员姓名</th>
                        <th class="bmen">所属部门</th>
                        <th class="sx">职员属性</th>
                        <th class="zt">职员状态</th>
                        <th class="zjm">助记码</th>
                    </tr>
                    @foreach($result as $v)
                        <tr id="{{$v->renyuan_id}}">
                            <td class="td_input">
                                <input type="checkbox" value="{{$v->renyuan_id}}"/>
                            </td>
                            <td>1</td>
                            <td class="td_bianma">{{$v->bh}}</td>
                            <td class="td_xingming">{{$v->renyuan_name}}</td>
                            <td class="td_bumen">{{$v->bumen->bumen_name or ''}}</td>
                            <td class="td_shuxing">{{trans('models/renyuan.type')[$v->type]}}</td>
                            <td class="td_zhuangtai">{{trans('models/renyuan.status')[$v->status]}}</td>
                            <td class="td_zhujima">{{$v->zjm}}</td>
                        </tr>
                    @endforeach
                </table>
                {{$result->links()}}
            </div>
            <div id="alert_box">
                <div class="title">
                    <span>X</span> 职员
                </div>
                <div class="content">
                    <div class="caozuo">
                        <ul>
                            <li class="prev">上张</li>
                            <li class="next">下张</li>
                            <li class="baocun">保存</li>
                            <li class="out">退出</li>
                        </ul>
                    </div>
                    <div class="ct">
                        <ul>
                            <li>
                                <span>*</span>
                                <span>职员编码</span>
                                <input type="text" id="bh"/>
                            </li>
                            <li>
                                <span>*</span>
                                <span>职员姓名</span>
                                <input type="text" id="renyuan_name" onKeyUp="query()"/>
                            </li>
                            <li class="">
                                <span>*</span>
                                <span>助记码</span>
                                <input type="text" id="zjm"/>
                            </li>
                            <li>
                                <span>*</span>
                                <span>所属部门</span>
                                <select name="" id="bumen_id">
                                    <option value="">请选择</option>
                                    @foreach($lists as $v)
                                        <option value="{{$v->bumen_id}}">{{$v->bumen_name}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                <span>*</span>
                                <span>职员属性</span>
                                <select name="" id="type">
                                    <option value="请选择">请选择</option>
                                    @foreach(trans('models/renyuan.type') as $k=>$v)
                                        <option value="{{$k}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                <span>*</span>
                                <span>职员状态</span>
                                <select name="" id="status">
                                    <option value="">请选择</option>
                                    @foreach(trans('models/renyuan.status') as $k=>$v)
                                        <option value="{{$k}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </li>
                        </ul>
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
        </div>
    </div>
@endsection