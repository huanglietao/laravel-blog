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
    <link rel="stylesheet" href="{{ asset('layui/src/css/layui.css') }}">
    @yield('styles')
</head>

<body>
<header class="masthead">

</header>

<div class="container" >
    <div class="row" style="margin-top: 100px">
        <div class="col-lg-8 col-md-10 mx-auto">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul style="color:red;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form name="sentMessage" action="/add" method="post" id="addForm" class="layui-form">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="pid" value="{{ $user_id}}">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>@lang('user.Account')</label>
                        <input type="text" name="name" class="form-control" placeholder="@lang('user.input your account')" id="name" value="" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>@lang('user.Password')</label>
                        <input type="password" name="password" class="form-control" placeholder="@lang('user.input your password')" id="password"  value="" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>@lang('user.RePassword')</label>
                        <input type="password" name="repassword" class="form-control" placeholder="@lang('user.input your repassword')"  id="repassword" value="" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>@lang('user.Email')</label>
                        <input type="email" name="email" class="form-control" placeholder="@lang('user.input your email')" id="email" value="">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>@lang('user.Phone')</label>
                        <input type="tel" name="phone" class="form-control" placeholder="@lang('user.input your phone')" id="phone" value="">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>@lang('user.Message')</label>
                        <textarea rows="5" name="message" class="form-control" placeholder="@lang('user.input your message')" id="message" value=""></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="sendMessageButton" lay-submit lay-filter="formDemo">@lang('user.Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src=" {{ asset('layui/src/layui.js ') }} "></script>
<script src="{{ asset('js/user/add.js') }}"></script>
</body>
</html>