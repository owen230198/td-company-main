@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/base/css/bootstrap-multiselect.min.css') }}">
@endsection
@section('content')
    <form action="{{ asset('create-quote?step=handle_config&id='.$data_quote['id']) }}" method="POST" class="config_handle_form baseAjaxForm" 
    enctype="multipart/form-data" onkeydown="return event.key != 'Enter'">
        @csrf
        <div class="quote_handle_section mb-3">
            <h3 class="fs-14 text-uppercase pb-1 mb-3 text-center quote_handle_title">
                <span>Thông tin khách hàng - Mã báo giá <strong>{{ $data_quote['seri'] }}</strong></span>
            </h3>
            @foreach ($customer_fields as $customer)
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_180 text-capitalize text-right mr-3">{{ $customer['note'] }}: </label>
                    <p class="font_italic">
                        @if (!empty($data_quote[$customer['name']]))
                            {{ 
                                @$customer['type'] != 'linking' ? $data_quote[$customer['name']] 
                                : getFieldDataById('name', $customer['other_data']['data']['table'], $data_quote[$customer['name']]) 
                            }}
                        @endif
                    </p>
                </div>    
            @endforeach
        </div>
        <div class="quote_handle_section handle_pro_section mb-3">
            <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
                <span>Khởi tạo sản phẩm</span>
            </h3>
            @php
                $quote_pro_qty_field = [
                    'name' => 'quote[product_qty]',
                    'note' => 'Số lượng sản phẩm',
                    'attr' => ['type_input' => 'number', 'inject_class' => 'quote_set_qty_pro_input']
                ] 
            @endphp
            @include('view_update.view', $quote_pro_qty_field)
            <div class="ajax_product_quote_number">
                  
            </div>
        </div>
        <div class="group_btn_action_form text-center">
            <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
            </button>
            <a href="" class="main_button color_white bg_green radius_5 font_bold smooth mx-3">
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