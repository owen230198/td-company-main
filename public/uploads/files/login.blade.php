@extends('index')
@section('content')
<div class=" main_login d-flex justify-content-center align-items-center">
    <div class="form_login_content text-center">
        <div class="login_logo mb-4">
            <img src="{{ asset('frontend/admin/images/logo.png') }}" />
        </div>
        <h3 class="fs-14 text-uppercase border_bot_eb pb-3 mb-3 text-center handle_title">
            <p class="mb-1">{{ $title }}</p>
        </h3>
        @if (@session(\StatusConst::ERR_MSG))
            <div class="alert alert-danger">
                {{ session(\StatusConst::ERR_MSG)['messages'] }}
            </div>
        @endif
        <form action="{{ asset(@$link_login ?? 'login') }}" method="POST" class="form_login form-group">
            @csrf
            @error ('username')
                <div class="alert alert-danger">
                    {{ @$message }}
                </div>
            @enderror
            <input type="text" class="form-control mb-3" name="username" placeholder="Username" value="{{ old('username') }}">
            @error ('password')
                <div class="alert alert-danger">
                    {{ @$message }}
                </div>
            @enderror
            <input type="password" class="form-control mb-3" name="password" placeholder="Password">
            <button type="submit" class="main_button bg_main color_white smooth border_main radius_5 font_bold smooth login_button">Đăng Nhập</button>
        </form>
    </div>
</div>
@endsection