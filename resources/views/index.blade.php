<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ @$title ? $title : 'Trang quản trị' }}</title>
    <base href="{{ url('') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/admin/images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/base/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/base/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/base/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/base/daterangepickers/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/base/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/style.css') }}" />
    @yield('css')
</head>

<body>
    @if (@$nosidebar)
        <div class="page_content container-fluid h-100">
            @yield('content')
        </div>
    @else
        @php
            $user_login = session('user_login');
            $modules = @$user_login['modules'] ?? [];
            $group_modules = @$user_login['group_modules'] ?? [];
        @endphp
        @include('header')
        @include('sidebar')
        <div class="base_content">
            <div class="container-fluid h-100">
                <div class="base_page h-100">
                    <div class="page_content">
                        @if (!isHome())
                            <div class="title_page_content">
                                <h2 class="fs-14 font_bold text-capitalize mb-0 d-flex align-items-center"><i class="fa fa-qrcode fs-18 mr-2" aria-hidden="true"></i>{{ @$title }}</h2>
                            </div>
                        @endif
                        <div class="px-3 pb-3">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script src="{{ asset('frontend/base/script/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/base/script/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/base/script/swal.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/tinymce/js/tinymce/init_tinymce.js') }}"></script>
    <script src="{{ asset('frontend/base/script/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/base/daterangepickers/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/base/daterangepickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('frontend/admin/script/loading.js') }}"></script>
    <script src="{{ asset('frontend/base/script/script.js') }}"></script>
    <script src="{{ asset('frontend/admin/script/script.js') }}"></script>
    @yield('script')
    <script>
        @if (Session::has('message'))
            swal('Thành công', "{{ session('message') }}", 'success');
        @endif

        @if (Session::has('error'))
            swal('Không thành công', "{{ session('error') }}", 'error');
        @endif
    </script>
</body>

</html>
