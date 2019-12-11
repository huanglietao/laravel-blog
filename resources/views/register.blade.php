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
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/register.js') }}"></script>
    @yield('styles')
</head>

<body>
<header class="masthead">

</header>

<div class="container" >


    <div class="row" style="margin-top: 100px">
        <div class="col-lg-8 col-md-10 mx-auto">
            @include('partials.errors')
            @include('partials.success')
            <h3>
                注册会员
            </h3>
            <form name="sentMessage" action="/contact" method="post" id="contactForm">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>账号</label>
                        <input type="text" name="name" class="form-control" placeholder="填写你的账号" id="name" value="" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>密码</label>
                        <input type="password" name="password" class="form-control" placeholder="请填写您的密码" id="password"  value="" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>确认密码</label>
                        <input type="password" name="repassword" class="form-control" placeholder="请填写您的密码"  id="repassword" value="" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">注册</button>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>
