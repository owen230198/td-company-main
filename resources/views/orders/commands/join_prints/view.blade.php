@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@php
    $_compen_percent = getDataConfig('QuoteConfig', 'COMPEN_PERCENT');
    $_plus_direct = (int) getDataConfig('QuoteConfig', 'PLUS_DIRECT');
    $_plus_to_per = (int) getDataConfig('QuoteConfig', 'PLUS_TO_PERCENT');
@endphp
@section('content')
    <form action="{{ url('join-print-command') }}" method="POST" class="baseAjaxForm config_content" enctype="multipart/form-data" onkeydown="return event.key != 'Enter'">
        @csrf
        @foreach ($arr_fields as $key => $field)
            @include('view_update.view', $field)
        @endforeach
        @include('quotes.products.papers.size', ['base_name' => 'join_paper'])
        @include('quotes.products.papers.after_print', ['pro_index' => 0, 'supp_index' => 0, 'paper_hd_base_name' => 'join_paper'])    
        <div class="group_btn_action_form text-center">
            <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
            </button>
            <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
              <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
            </a>
        </div>  
    </form>
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
@endsection