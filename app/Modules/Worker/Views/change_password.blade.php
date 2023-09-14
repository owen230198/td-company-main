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
            <form action="{{ url('Worker/change-password') }}" method="POST" class="baseAjaxForm mt-lg-4 mt-3">
                @php
                    $arr_field = [
                        [
                            'name' => 'old_pass',
                            'note' => 'Mật khẩu cũ',
                            'attr' => ['type_input' => 'password']
                        ],
                        [
                            'name' => 'new_pass',
                            'note' => 'Mật khẩu mới',
                            'attr' => ['type_input' => 'password']
                        ],
                        [
                            'name' => 'confirm_pass',
                            'note' => 'Xác nhận mật hẩu mới',
                            'attr' => ['type_input' => 'password']
                        ],
                    ]
                @endphp 
                @foreach ($arr_field as $field)
                    @include('view_update.view', $field)  
                @endforeach
                <div class="mt-lg-4 mt-3 text-right">
                    <button type="submit" class="radius_5 box_shadow_3 main_button smooth mr-2 font_bold text-center bg_green color_white">
                        <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Hoàn tất
                    </button>  
                    <a href="{{ url('/Worker') }}" class="radius_5 box_shadow_3 main_button smooth font_bold text-center bg_red color_white">
                        <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Hủy
                    </a> 
                </div>
            </form>
        </div>
    </div>
@endsection