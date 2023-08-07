@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/order.css') }}">
@endsection
@section('content')
    <form action="{{ @$link_action }}" method="POST" class="baseAjaxForm config_content __form_order" enctype="multipart/form-data" 
    onkeydown="return event.key != 'Enter'">
        @csrf
        @if (!empty($data_quote['id']))
            <input type="hidden" name="quote" value="{{ $data_quote['id'] }}">
        @endif
        @if (!empty($data_order['id']))
            <input type="hidden" name="order[id]" value="{{ $data_order['id'] }}">     
        @endif
        @yield('main')
        <div class="group_btn_action_form text-center">
            <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
            </button>
            @php
                $stage_button = getOrderNameStageByKey(@$stage)
            @endphp
            @if (!empty($stage_button))
                <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2 __apply_order" 
                data-id={{ $id }} data-stage="{{ $stage }}">
                    <i class="fa fa-thumbs-o-up mr-2 fs-14" aria-hidden="true"></i>
                    {{ $stage_button }}
                </button> 
            @endif
            <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
                <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i>In đơn
            </button>
            <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
              <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
            </a>
        </div>  
    </form>
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection