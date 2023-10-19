<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>In dữ liệu {{ @$data_item->code }}</title>
        <base href="{{ url('') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('frontend/admin/images/logo.png') }}">
        <link rel="stylesheet" href="{{ asset('frontend/base/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/base/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/base/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/admin/css/style.css') }}" />
        @yield('css')
    </head>

    <body>
        <div class="print_data_section bg_eb">
            <div class="container py-5">
                <div class="bg_white p-4 fs-14">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>
