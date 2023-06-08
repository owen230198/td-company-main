<ul class="nav nav-pills mb-3 pro_nav_link" id="quote-pro-tab" role="tablist">
    <label class="mb-0 min_210 mr-3"></label>
    @foreach ($products as $i => $product)
        <li class="nav-item">
            <a class="nav-link{{ $i == 0 ? ' active' : '' }}" id="quote-pro-{{ $i }}-tab" data-toggle="pill" href="#quote-pro-{{ $i }}" 
            role="tab" aria-controls="quote-pro-{{ $i }}" aria-selected="true">
                {{ @$product['name'] }}
            </a>
        </li>
    @endforeach
</ul>

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
                        ];
                        $quote_pro_design = [
                            'name' => $pro_base_name_input.'[design]',
                            'note' => 'thiết kế',
                            'type' => 'linking',
                            'other_data' => ['data' => ['table' => 'design_types', 'select' => ['id', 'name']]],
                            'value' => @$product['design']
                        ]
                    @endphp

                    @include('view_update.view', $pro_name_field)

                    @include('view_update.view', $pro_qty_field)
                    
                    @include('view_update.view', $pro_category_field)

                    <div class="quote_product_design_config">
                        @include('view_update.view', $quote_pro_design)
                    </div>

                    @include('quotes.products.size')

                    @if (!empty($order_get))
                        @include('orders.products.extend_info')   
                    @endif
                </div>
                <div class="ajax_product_view_by_category">
                    
                </div>
                @if (!empty($product['id']))
                    <input type="hidden" name="product[{{ $pro_index }}][id]" value="{{ $product['id'] }}">
                    <div class="text-center">
                        <button type="button" 
                        class="main_button color_white bg_green border_green radius_5 font_bold smooth show_config_handle_quote"
                        proindex = {{ $pro_index }} data-proid = {{ $product['id'] }} data-category = {{ @$product['category'] }}>
                            <i class="fa fa-angle-double-down fs-14 mr-2" aria-hidden="true"></i>
                            <span>Xem chi tiết sản xuất</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>