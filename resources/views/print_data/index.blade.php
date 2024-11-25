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
        <link rel="stylesheet" href="{{ asset('frontend/base/css/style.css?v=8') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/admin/css/style.css?v=8') }}" />
        @yield('css')
    </head>

    <body>
        <div class="print_data_section font_auto">
            <div class="container py-5">
                <div class="bg_white">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>
