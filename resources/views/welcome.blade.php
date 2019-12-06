<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $meta_description }}">
    <meta name="author" content="{{ config('blog.author') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('blog.title') }}</title>
    <link rel="alternate" type="application/rss+xml" href="{{ url('rss') }}"
          title="RSS Feed {{ config('blog.title') }}">

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>
<header class="masthead" style="background-image: url('contact-bg.jpg ')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>联系我们</h1>
                    <span class="subheading">你有问题？我有答案。</span>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>
                想与我联系？填写下面的表单给我发消息，我会尽快给你回复！
            </p>
            <form name="sentMessage" action="/contact" method="post" id="contactForm" novalidate>
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>姓名</label>
                        <input type="text" name="name" class="form-control" placeholder="填写你的名字" id="name" value="{{ old('name') }}" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>邮箱</label>
                        <input type="email" name="email" class="form-control" placeholder="填写你的邮箱" id="email" value="{{ old('email') }}" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>手机</label>
                        <input type="tel" name="phone" class="form-control" placeholder="填写你的手机号" id="phone" value="{{ old('phone') }}" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>消息</label>
                        <textarea rows="5" name="message" class="form-control" placeholder="填写你想发送的消息" id="message" value="{{ old('message') }}" required></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">发送</button>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>
