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
        <form action="{{ asset(@$link_login ?? 'login') }}" method="POST" class="form_login form-group __base_login_module" data-auth_key = {{ @$auth_key }}>
            @csrf
            @error ('username')
                <div class="alert alert-danger">
                    {{ @$message }}
                </div>
            @enderror
            <input type="hidden" class="__login_remembered_input" name="remembered" value="{{ !empty($data_remember['username']) && !empty($data_remember['password']) ? 1 : 0 }}">
            <input type="text" class="form-control mb-3 __login_username_input" name="username" placeholder="Username" value="{{ old('username') ?? @$data_remember['username'] }}">
            @error ('password')
                <div class="alert alert-danger">
                    {{ @$message }}
                </div>
            @enderror
            <input type="password" class="form-control mb-3 __login_password_input" name="password" placeholder="Password" value="{{ @$data_remember['password'] }}">
            <div class="d-flex justify-content-end align-items-center">
                <input type="checkbox" name="remember" value="1" class="mr-2"><label class="mb-1">Lưu mật khẩu ?</label>
            </div>
            <button type="submit" disabled class="main_button bg_main color_white smooth border_main radius_5 font_bold smooth login_button">Đăng Nhập</button>
        </form>
    </div>
</div>
@endsection