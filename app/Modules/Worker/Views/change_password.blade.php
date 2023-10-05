@extends('Worker::index')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <img src="{{ url('frontend/workers/images/auth_img.png') }}" alt="" class="w-100 mt-lg-4 mt-3">
        </div>
        <div class="col-lg-6">
            <h3 class="fs-15 text-uppercase my-lg-4 my-3 text-center handle_title color_green mx-auto">
                {{ $title }} - Công nhân: {{ \Worker::getCurrent('name') }}
            </h3>
            <p class="d-flex justify-content-center color_green mb-1 fs-14">
                <i class="fa fa-asterisk mr-1 color_yellow" aria-hidden="true"></i>
                Tên công nhân : {{ \Worker::getCurrent('name') }}
            </p> 
            <p class="d-flex justify-content-center color_green mb-1 fs-14">
                <i class="fa fa-asterisk mr-1 color_yellow" aria-hidden="true"></i>
                Số điện thoại : {{ \Worker::getCurrent('phone') }}
            </p> 
            <p class="d-flex justify-content-center color_green mb-1 fs-14">
                <i class="fa fa-asterisk mr-1 color_yellow" aria-hidden="true"></i>
                Tổ máy : {{ getDeviceGroupName(\Worker::getCurrent('type'), \Worker::getCurrent('device')) }}
            </p> 
            <div class="mt-lg-4 mt-3">
                @include('change_password_base_form'['action_url' => url('Worker/change-password')])
            </div>
        </div>
    </div>
@endsection