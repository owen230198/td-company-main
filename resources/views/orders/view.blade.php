@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/order.css') }}">
@endsection
@section('content')
    <form action="{{ @$link_action }}" method="POST" class="baseAjaxForm config_content __form_order" enctype="multipart/form-data" 
    onkeydown="return event.key != 'Enter'">
        @csrf
        <input type="hidden" name="quote" value="{{ $data_quote['id'] }}">
        @if (!empty($customer_info))
            @include('quotes.head_information')
        @endif
        @if (\GroupUser::isSale())
            <div class="order_field_update __order_field_module mt- pt-3 border_top_eb">
                @if (!empty($data_order['id']))
                    <input type="hidden" name="order[id]" value="{{ $data_order['id'] }}">     
                @endif
                <input type="hidden" name="order[quote]" value="{{ $data_quote['id'] }}">
                @php
                    $order_field_update = [
                        [
                            'name' => '',
                            'note' => 'Tổng tiền (chưa bao gồm VAT)',
                            'attr' => ['disable_field' => 1, 'inject_class' => '__order_total_input'],
                            'value' => round(@$data_quote['total_amount'])
                        ],
                        [
                            'name' => 'order[advance]',
                            'note' => 'Tạm ứng đơn hàng',
                            'attr' => ['type_input' => 'number', 'inject_class' => '__order_advance_input'],
                            'value' => @$data_order['advance'] ?? 0
                        ],
                        [
                            'name' => 'order[rest]',
                            'note' => 'Chi phí còn lại',
                            'attr' => ['readonly' => 1, 'inject_class' => '__order_rest_input'],
                            'value' => @$data_order['rest'] ?? round(@$data_quote['total_amount'])
                        ],
                        [
                            'name' => 'order[rest_bill]',
                            'note' => 'File bill tạm ứng',
                            'type' => 'file',
                            'value' => @$data_order['rest_bill']
                        ],
                        [
                            'name' => 'order[rest_note]',
                            'note' => 'Ghi chú công nợ',
                            'type' => 'textarea',
                            'value' => @$data_order['rest_note']
                        ],
                        [
                            'name' => 'order[ship_note]',
                            'note' => 'Ghi chú giao hàng',
                            'type' => 'textarea',
                            'value' => @$data_order['ship_note']
                        ]
                    ]
                @endphp
                @foreach ($order_field_update as $order_field)
                    @include('view_update.view', $order_field)    
                @endforeach
            </div>
        @endif
        <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
            <span>Danh sách sản phẩm</span>
        </h3>
        <div class="order_list_product">
            @include('quotes.products.ajax_view', ['order_get' => true])
        </div>
        <div class="group_btn_action_form text-center">
            <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
            </button>
            @if (@$data_order['status'] == StatusConst::NOT_ACCEPTED)
                <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2 __apply_order" 
                data-step="{{ \TDConst::APPLY_HANDLE }}" data-id={{ @$data_order['id'] }}>
                    <i class="fa fa-thumbs-o-up mr-2 fs-14" aria-hidden="true"></i>Xác nhận sản xuất
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