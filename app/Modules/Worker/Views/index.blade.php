<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ @$title ?? 'Chấm công - công nhân' }}</title>
        <base href="{{ url('Worker') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('frontend/admin/images/logo.png') }}">
        <link rel="stylesheet" href="{{ asset('frontend/base/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/base/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/base/css/select2.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/base/daterangepickers/daterangepicker.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/base/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/admin/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/workers/css/style.css') }}" />
        @yield('css')
    </head>
    <body>
        @include('Worker::header')
        <div class="container main_worker_content">
            @yield('content')
        </div>
        @include('Worker::footer')
        @include('index_script_const')
        <script src="{{ asset('frontend/base/script/jquery.min.js') }}"></script>
        <script src="{{ asset('frontend/base/script/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend/base/script/swal.min.js') }}"></script>
        <script src="{{ asset('frontend/base/script/select2.min.js') }}"></script>
        <script src="{{ asset('frontend/base/daterangepickers/moment.min.js') }}"></script>
        <script src="{{ asset('frontend/base/daterangepickers/daterangepicker.js') }}"></script>
        <script src="{{ asset('frontend/workers/script/loading.js') }}"></script>
        <script src="{{ asset('frontend/base/script/script.js') }}"></script>
        <script src="{{ asset('frontend/workers/script/script.js') }}"></script>
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
