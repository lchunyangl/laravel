@extends('layouts.app')
@push('header')
    <link rel="stylesheet" type="text/css" href="{{asset('houtai/css/login.css')}}"/>
@endpush
@section('content')
    @component('components.form',['action'=>'/login','method'=>'post'])
        <div class="bg">
            <div class="login_box">
                <div class="title">
                    <img src="{{asset('houtai/img/login_title.png')}}"/>
                </div>
                <div class="content">
                    <div class="xinxi">
                        <div class="username">
                            <input type="text" name="user_name" id="usename" placeholder="请输入您的帐号" {{ old('email') }}/>
                        </div>
                        <div class="pwd">
                            <input type="password" name="password" id="pwd" placeholder="请输入您的密码"/>
                        </div>
                        <input type="submit" name="login" id="login" value="登陆系统"/>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection
