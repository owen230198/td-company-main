@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/order.css') }}">
@endsection
@section('content')
    <form action="{{ url('apply-to-worker-handle/'.$id) }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data" 
    onkeydown="return event.key != 'Enter'">
        @csrf
        <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
            <span>Danh sách sản phẩm</span>
        </h3>
        @include('quotes.products.list_tab')
        <div class="tab-content" id="quote-pro-tabContent">
            @foreach ($products as $pro_index => $product)
                <div class="tab-pane fade{{ $pro_index == 0 ? ' show active' : '' }} tab_pane_quote_pro" id="quote-pro-{{ $pro_index }}" role="tabpanel" aria-labelledby="quote-pro-{{ $pro_index }}-tab">
                    <div class="config_handle_paper_pro">
                        <div class="mb-2 base_product_config">
                            @php
                                $pro_name_field = [
                                    'name' => '',
                                    'note' => 'Tên sản phẩm',
                                    'attr' => ['required' => 1, 'inject_class' => 'quote_set_product_name', 'placeholder' => 'Nhập tên', 'disable_field' => 1],
                                    'value' => !empty($product['id']) ? @$product['name'] : ''
                                ];
                                $pro_qty_field = [
                                    'name' => '',
                                    'note' => 'Số lượng sản phẩm',
                                    'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_qty', 'placeholder' => 'Nhập số lượng', 'disable_field' => 1],
                                    'value' => @$product['qty']
                                ];
                                $pro_category_field = [
                                    'name' => '',
                                    'type' => 'linking',
                                    'note' => 'Nhóm sản phẩm',
                                    'attr' => ['required' => 1, 'inject_class' => 'select_quote_procategory', 'inject_attr' => 'proindex='.$pro_index, 'disable_field' => 1],
                                    'other_data' => ['data' => ['table' => 'product_categories']],
                                    'value' => @$product['category']
                                ]
                            @endphp
        
                            @include('view_update.view', $pro_name_field)
        
                            @include('view_update.view', $pro_qty_field)
                            
                            @include('view_update.view', $pro_category_field)
                        </div>
                    </div>
                    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
                        <span>Danh sách yêu cầu xử lí vật tư</span>
                    </h3>
                    @php
                        $elements = getProductElementData($product['category'], $product['id']);
                    @endphp
                    @if (count($elements) > 0)
                        <ul class="nav nav-pills mb-3 quote_pro_strct_nav_link" id="quote-pro-{{ $pro_index }}-struct-tab" role="tablist">
                            @foreach ($elements as $key => $element)
                                <li class="nav-item">
                                    <a class="nav-link{{ $key == 0 ? ' active' : '' }}" id="quote-pro-{{ $pro_index }}-struct-{{ $element['key'] }}-tab" data-toggle="pill" href="#quote-pro-{{ $pro_index }}-struct-{{ $element['key'] }}" 
                                    role="tab" aria-controls="quote-pro-{{ $pro_index }}-struct-{{ $element['key'] }}" aria-selected="true">{{ $element['note'] }}</a>
                                </li>   
                            @endforeach
                        </ul>
                        <div class="tab-content" id="quote-pro-{{ $pro_index }}-struct-tabContent">
                            @foreach ($elements as $key => $element)
                                @if (!empty($element['data']))
                                    <div class="tab-pane fade{{ $key == 0 ? ' show active' : '' }} tab_pane_quote_pro" id="quote-pro-{{ $pro_index }}-struct-{{ $element['key'] }}" role="tabpanel" aria-labelledby="quote-pro-{{ $pro_index }}-struct-{{ $element['key'] }}-tab">
                                        @include('orders.users.6.supply_table')
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="group_btn_action_form text-center">
            <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Xác nhận xuống xưởng SX
            </button>
            <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
              <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
            </a>
        </div>
    </form>
@endsection