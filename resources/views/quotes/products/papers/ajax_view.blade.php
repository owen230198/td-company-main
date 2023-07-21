<div class="quote_product_structure quote_supp_item{{ $supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : '' }}" data-index={{ @$supp_index ?? 0 }}>
    @php
        $key_supp = \TDConst::PAPER;
        $paper_compen_percent = getDataConfig('QuoteConfig', 'COMPEN_PERCENT');

        $pro_paper_name = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][name]',
            'note' => 'Tên sản phẩm',
            'attr' => ['required' => 1, 
                        'inject_class' => $supp_index == 0 ? 'length_input quote_receive_paper_name_main' 
                        : 'length_input quote_receive_paper_name_ext'],
            'value' => @$supply_obj->name ?? @$supp_name
        ];
        $pro_paper_materals = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][materal]',
            'type' => 'linking',
            'note' => 'Chọn chất liệu giấy',
            'attr' => ['required' => 1, 'inject_class' => 'select_paper_materal'],
            'other_data' => ['data' => ['table' => 'materals','where' => ['type' => $key_supp], 'ext_option' => [['id' => 'other', 'name' => 'Giấy khác']]]],
            'value' => @$supply_size['materal']
        ];
        $pro_paper_qttv = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][qttv]',
            'note' => 'Định lượng',
            'attr' => ['type_input' => 'number', 'required' => 1],
            'value' => @$supply_size['qttv']
        ];
    @endphp
    @include('quotes.products.supplies.check_index_data')
    @if ($supp_index == 0 || @$supply_obj->main == 1)
        <input type="hidden" value="1" name="product[{{ $pro_index }}][{{ $key_supp }}][{{ $supp_index }}][main]">   
    @endif
    <div class="mb-2 paper_product_config">
        @if ($supp_index > 0)
            @php
                $pro_paper_extend_name = [
                    'name' => '',
                    'type' => 'linking',
                    'note' => 'Chọn tên phụ',
                    'attr' => ['required' => 1, 'inject_class' => 'select_ext_name_paper'],
                    'other_data' => [
                        'data' => [
                            'table' => 'supply_types',
                            'field_value' => 'name',
                            'where' => ['type' => $key_supp, 'is_name' => 1]
                        ]
                    ]
                ] 
            @endphp
            @include('view_update.view', $pro_paper_extend_name)
        @endif
        <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
            <span>{{ $supp_index == 0 ? 'Phần giấy in' : 'Lệnh in thêm thứ '.$supp_index }}</span>
        </h3>
        @include('view_update.view', $pro_paper_name)
        
        @include('quotes.products.supplies.quantity_config', 
        ['compen_percent' => $paper_compen_percent])
        
        <div class="materal_paper_module">
            @include('view_update.view', $pro_paper_materals)

            @include('view_update.view', $pro_paper_qttv)
            <div class="d-flex align-items-center mb-2 fs-13">
                <label class="mb-0 min_210 text-capitalize text-right mr-3">
                    <span class="fs-15 mr-1">*</span>Kích thước khổ giấy
                </label>
                <div class="d-flex justify-content-between align-items-center">
                    <input type="number" name = 'product[{{ $pro_index }}][{{ $key_supp }}][{{ $supp_index }}][size][length]' placeholder="Chiều dài (cm)" 
                    class="form-control medium_input" step="any" value="{{ @$supply_size['length'] }}"> 
                    <span class="mx-3">X</span>
                    <input type="number" name = 'product[{{ $pro_index }}][{{ $key_supp }}][{{ $supp_index }}][size][width]' placeholder="Chiều rộng (cm)" 
                    class="form-control medium_input" step="any"value="{{ @$supply_size['width'] }}"> 
                    <div class="paper_price_config_input" style="display:{{ @$supply_size['materal'] != 'other' ? 'none' : 'block' }}">
                        <div class="d-flex align-items-center">
                            <span class="mx-3">X</span>
                            <input type="number" name = 'product[{{ $pro_index }}][{{ $key_supp }}][{{ $supp_index }}][size][unit_price]' placeholder="Đơn giá" 
                            class="form-control medium_input price_input_paper" 
                            {{ @$supply_size['materal'] != 'other' ? 'disabled="disabled"' : '' }} step="any" value="{{ @$supply_size['unit_price'] }}">
                            <span class="ml-3 fs-12 color_gray">VD 22 triệu/tấn = 0.00022</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('quotes.products.papers.after_print', ['data_paper' => @$supply_obj])
</div>

