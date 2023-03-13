@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/base/css/bootstrap-multiselect.min.css') }}">
@endsection
@section('content')
    <form action="{{ asset('create-quote?step=handle_config') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="quote_handle_section mb-3">
            <h3 class="fs-14 text-uppercase pb-1 mb-3 text-center quote_handle_title">
                <span>Thông tin khách hàng</span>
            </h3>
            @foreach ($customer_fields as $customer)
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_150 text-capitalize text-right mr-3">{{ $customer['note'] }}: </label>
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
    </form>
@endsection
@section('script')
<script src="{{ asset('frontend/base/script/bootstrap-multiselect.min.js') }}"></script>
<script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
    
@endsection