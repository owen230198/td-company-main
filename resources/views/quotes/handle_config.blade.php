@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/base/css/bootstrap-multiselect.min.css') }}">
@endsection
@section('content')
    <form action="{{ !empty($link_action) ? $link_action : asset('insert/quotes?step=handle_config&customer='.$data_quote['id']) }}" method="POST" 
    class="config_handle_form config_content baseAjaxForm" enctype="multipart/form-data" onkeydown="return event.key != 'Enter'">
        @csrf
        @include('quotes.head_information')
        <div class="quote_handle_section handle_pro_section">
            <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
                <span>Khởi tạo sản phẩm</span>
            </h3>
            @php
                $quote_pro_qty_field = [
                    'name' => 'quote[product_qty]',
                    'note' => 'Số đơn hàng',
                    'attr' => ['type_input' => 'number', 
                    'inject_class' => 'quote_set_qty_pro_input',
                    'disable_field' => @$product_qty ? 1 : 0 ],
                    'value' => @$product_qty
                ] 
            @endphp
            @include('view_update.view', $quote_pro_qty_field)
            <div class="ajax_product_quote_number">
                @if (!empty($products))
                    @include('quotes.products.ajax_view')
                @endif       
            </div>
        </div>
        <div class="group_btn_action_form text-center">
            <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
            </button>
            <a href="{{ url('update/quotes/'.$data_quote['id']) }}" class="main_button color_white bg_green radius_5 font_bold smooth mx-3">
                <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Chọn khách hàng khác
            </a>
            <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
              <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
            </a>
        </div>  
    </form>
@endsection
@section('script')
<script src="{{ asset('frontend/base/script/bootstrap-multiselect.min.js') }}"></script>
<script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
@endsection