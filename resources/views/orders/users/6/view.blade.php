@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/order.css') }}">
@endsection
@section('content')
    <div class="config_content">
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
                                $pro_base_name_input = 'product['.$pro_index.']';
                                $pro_name_field = [
                                    'name' => $pro_base_name_input.'[name]',
                                    'note' => 'Tên sản phẩm',
                                    'attr' => ['required' => 1, 'inject_class' => 'quote_set_product_name', 'placeholder' => 'Nhập tên'],
                                    'value' => !empty($product['id']) ? @$product['name'] : ''
                                ];
                                $pro_qty_field = [
                                    'name' => $pro_base_name_input.'[qty]',
                                    'note' => 'Số lượng sản phẩm',
                                    'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_qty', 'placeholder' => 'Nhập số lượng'],
                                    'value' => @$product['qty']
                                ];
                                $pro_category_field = [
                                    'name' => $pro_base_name_input.'[category]',
                                    'type' => 'linking',
                                    'note' => 'Nhóm sản phẩm',
                                    'attr' => ['required' => 1 , 'inject_class' => 'select_quote_procategory', 'inject_attr' => 'proindex='.$pro_index],
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

    </div>
@endsection