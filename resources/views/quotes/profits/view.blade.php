@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="position-relative">
        @if (\GroupUser::isAdmin())
            <h3 class="fs-14 text-uppercase mb-3 handle_title">I. Chi tiết chi phí sản xuất</h3>
            @include('quotes.profits.cost_detail')
        @endif
        <form action="{{ asset('profit-config-quote?quote_id=' . $data_quote['id']) }}" method="POST"
            class="baseAjaxForm config_content" enctype="multipart/form-data">
            @csrf
            @include('quotes.profits.table_input')
            <div class="group_btn_action_form text-center">
                <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth">
                    <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
                </button>
                <a href="{{ url('update/quotes/' . $data_quote['id'] . '?step=handle_config') }}"
                    class="main_button color_white bg_green radius_5 font_bold smooth mx-3">
                    <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Trở về
                </a>
                <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
                    <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Thoát
                </a>
            </div>
        </form>
        <div class="quote_total_cost">
            <h3 class="font_bold fs-18 color_red mb-0">BỘ SẢN PHẨM BAO GỒ COMBO {{ count($products) }} SẢN PHẨM - TỔNG GIÁ :
                {{ number_format((int) @$data_quote['total_amount']) }} đ</h3>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
@endsection
