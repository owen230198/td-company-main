<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ @$title ? $title : 'Management' }}</title>
    <base href="{{ url('') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/admin/images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/base/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/base/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/base/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/base/css/toastr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/base/daterangepickers/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/base/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/style.css') }}" />
    @yield('css')
</head>

<body>
    @if (@$nosidebar)
        @yield('content')
    @else
        @php
            $user_login = session('user_login');
            $modules = @$user_login['modules'] ?? [];
            $group_modules = @$user_login['group_modules'] ?? [];
        @endphp
        @include('header')
        @include('sidebar')
        @yield('content')
    @endif
    <script src="{{ asset('frontend/base/script/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/base/script/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/base/script/toastr.min.js') }}"></script>
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
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>
