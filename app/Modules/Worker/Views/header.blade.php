@php
    $worker_login = session('worker_login')['user'];
    $group_worker_name = getDeviceGroupName($worker_login['type'], $worker_login['device']);
@endphp
<div class="header_worker text-center">
    <a href="{{ url('Worker') }}" class="login_logo mb-3">
        <img src="{{ url('frontend/admin/images/logo.png') }}" alt="'logo">
    </a>
    <h3 class="fs-14 text-uppercase mb-3 text-center handle_title mx-auto">
        <p class="mb-1">{{ $title.' - '.$group_worker_name }}</p>
    </h3>
</div>
<div class="header_worker_nav p-2 bg_grey">
    <div class="container">
        @if (!isHome('Worker'))
            <nav aria-label="breadcrumb" class="breadcrumb_section">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('Worker') }}" class="color_green">Trang chủ</a>
                    </li>
                    @if (!empty($parent_url['link']))
                        <li class="breadcrumb-item">
                            <a href="{{ url(@$parent_url['link']) }}" class="color_green">{{ @$parent_url['note'] }}</a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ @$title }}</li>
                </ol>
            </nav>
        @else
            <ul class="d-flex justify-content-end">
                <li class="d-inline-block color_green mr-2 pr-2 border_right">
                    <i class="fa fa-user fs-15" aria-hidden="true"></i>
                    <a href="{{ url('Worker/change-password') }}" class="color_green">{{ $worker_login['name'] }}</a>
                </li>
                <li class="d-inline-block color_green">
                    <i class="fa fa-sign-out fs-15" aria-hidden="true"></i>
                    <a href="{{ url('Worker/logout') }}" class="color_green">Thoát</a>
                </li>
            </ul>
        @endif
    </div>
</div>