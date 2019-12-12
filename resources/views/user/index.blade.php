<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{{ config('blog.author') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('blog.title') }}</title>
    <link rel="alternate" type="application/rss+xml" href="{{ url('rss') }}"
          title="RSS Feed {{ config('blog.title') }}">

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('layui/src/css/layui.css') }}">
    @yield('styles')
</head>

<body>
<header class="masthead">

</header>
<div class="main-div">
    <div class="l-div">
        <div class="top-div">
            <div class="info-d">
                <label class="layui-form-label now-user" >@lang("user.User info")</label>
            </div>
            <div class="info-d">
                <label class="layui-form-label">@lang("user.Account"):</label>
                <label class="layui-form-label">{{$user_info['name']}}</label>
            </div>
            <div class="info-d">
                <label class="layui-form-label">@lang("user.Phone"):</label>
                <label class="layui-form-label">{{$user_info['phone']}}</label>
            </div>
            <div class="info-d">
                <label class="layui-form-label">@lang("user.Email"):</label>
                <label class="layui-form-label">{{$user_info['email']}}</label>
            </div>

            <div class="info-d">
                <label class="layui-form-label">@lang("user.Createtime"):</label>
                <label class="layui-form-label" style="white-space: nowrap;">{{$user_info['created_at']}}</label>
            </div>
            <div class="master-edit">
                <a class="layui-btn layui-btn-xs master-edit-btn" data-id="{{$user_info['id']}}" lay-event="edit" style="color: #fff">修改</a>
                <a class="layui-btn layui-btn-xs master-login-out" data-id="{{$user_info['id']}}" style="color: #fff">退出登录</a>
            </div>

        </div>
    </div>

    <div class="r-div">
        <input type="hidden" value="{{$user_info['id']}}">
        <div class="demoTable">
            姓名：
            <div class="layui-inline">
                <input class="layui-input" name="name" id="demoReload" autocomplete="off">
            </div>
            <button class="layui-btn" data-type="reload">搜索</button>
        </div>


        <div class="layui-table-tool">
            <div class="layui-table-tool-temp">
                <span class="user-add" lay-event="add"><i class="layui-icon layui-icon-add-1"></i>添加下级会员</>
            </div>
        </div>
        <table class="layui-hide" id="LAY_table_user" lay-filter="user"></table>
        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-xs" lay-event="edit" style="color: #fff">编辑</a>
            <a class="layui-btn layui-btn-danger btn-del layui-btn-xs" lay-event="del" style="color: #fff">删除</a>
        </script>

        </table>

    </div>
</div>




<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src=" {{ asset('layui/src/layui.js ') }} "></script>
<script src="{{ asset('js/user/user.js') }}"></script>
</body>
</html>