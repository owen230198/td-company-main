@extends('index')
@section('content')
<div class=" main_login d-flex justify-content-center align-items-center">
    <div class="form_login_content text-center">
        <div class="login_logo mb-4">
            <img src="{{ asset('frontend/admin/images/logo.png') }}" />
        </div>
        @php
            $const = new \App\Constants\StatusConstant;
        @endphp
        @if (@session($const::ERR_MSG))
            <div class="alert alert-danger">
                {{ session($const::ERR_MSG)['messages'] }}
            </div>
        @endif
        <form action="{{ asset('login') }}" method="POST" class="form_login form-group">
            @csrf
            @error ('username')
                <p class="err_mess fs-13 font-italic color_red text-left">{{ $message }}</p>
            @enderror
            <input type="text" class="form-control mb-3" name="username" placeholder="Username" value="{{ old('username') }}">
            @error ('password')
                <p class="err_mess fs-13 font-italic color_red text-left">{{ $message }}</p>
            @enderror
            <input type="password" class="form-control mb-3" name="password" placeholder="Password">
            <button type="submit" class="main_button bg_main color_white smooth border_main radius_5 font_bold smooth login_button">Đăng Nhập</button>
        </form>
    </div>
</div>
@endsection