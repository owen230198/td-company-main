@php
    $key_supp = \TDConst::PAPER;
    $base_name = 'product['.$pro_index.']['.$key_supp.']['.$supp_index.']';
    $is_from_partner = !empty(@$supply_obj->parent);
    $handle_type_options = [\TDConst::MADE_BY_OWN => 'Tuấn Dung gia công ngay', 
                            \TDConst::JOIN_HANDLE => 'Tạo lệnh in ghép với sản phẩm khác', 
                            \TDConst::MADE_BY_PARTNER => 'Mua từ đơn vị khác'];
    if (!empty($rework)) {
        unset($handle_type_options[\TDConst::MADE_BY_PARTNER]);
    }
    $paper_base_fields = [
        [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][name]',
            'note' => 'Tên sản phẩm',
            'attr' => ['required' => 1, 
                        'inject_class' => $supp_index == 0 ? 'length_input quote_receive_paper_name_main' 
                        : 'length_input quote_receive_paper_name_ext',
                    'disable_field' => !empty($disable_all) || in_array('size_name', @$arr_disable ?? []) ? 1 : 0,
                'readonly' => !empty($rework)],
            'value' => @$supply_obj->name ?? @$supp_name
        ],
        [
            'name' => $base_name.'[handle_type]',
            'note' => 'Hình thức sản xuất',
            'type' => 'select',
            'attr' => ['required' => 1, 'inject_class' => "__select_pro_made_by", 'inject_attr' => 'pro_index='.$pro_index.' supp_index='.$supp_index.' rework='.@$rework ?? 0 , 
            'disable_field' => !empty($disable_all) || in_array('size_name', @$arr_disable ?? []) ? 1 : 0],
            'value' => $is_from_partner ? \TDConst::MADE_BY_PARTNER : @$supply_obj->handle_type,
            'other_data' => ['data' => [
                'options' => $handle_type_options,
                ]
            ]
        ]
    ];
@endphp
@if (empty($rework))
    @include('quotes.products.supplies.check_index_data')
@endif
@if ($supp_index == 0 || @$supply_obj->main == 1)
    <input type="hidden" value="1" name="product[{{ $pro_index }}][{{ $key_supp }}][{{ $supp_index }}][main]">   
@endif
<div class="mb-2 paper_product_config">
    @if ($supp_index > 0 && empty($rework))
        @php
            $pro_paper_extend_name = [
                'name' => '',
                'type' => 'linking',
                'note' => 'Chọn tên phụ',
                'attr' => [
                    'required' => 1, 
                    'inject_class' => 'select_ext_name_paper', 
                    'disable_field' => !empty($disable_all) || in_array('ext_name', @$arr_disable ?? []) ? 1 : 0,
                    'inject_attr' => 'pro_index = '."$pro_index".' supp_index = '."$supp_index".''
                ],
                'other_data' => [
                    'data' => [
                        'table' => 'paper_extends',
                        'field_value' => 'name'
                    ]
                ]
            ] 
        @endphp
        @include('view_update.view', $pro_paper_extend_name)
    @endif
    
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 mb-4 text-center handle_title d-flex align-items-center justify-content-center">
        <span class="mr-2">{{ $is_from_partner ? ($supp_index == 0 ? 'Sản phẩm mua ngoài' : 'Sản phẩm mua ngoài thứ '.$supp_index + 1 ) : ($supp_index == 0 ? 'Phần giấy in' : 'Lệnh in thêm thứ '.$supp_index )}}</span>
        @if (!empty($supply_obj->id))
            <a href="{{ url('print-data/'.$supp_view.'/'.$supply_obj->id) }}" target="_blank" class="main_button color_white bg_green border_green radius_5 font_bold sooth">
                <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i> In lệnh
            </a>
        @endif
    </h3>  
    @foreach ($paper_base_fields as $field)
        @include('view_update.view', $field)
    @endforeach
    
    <div class="ajax_made_by_content">
        @if ($is_from_partner)
            @include('quotes.products.papers.handle_types.made_by_partner')
        @elseif(@$supply_obj->handle_type == \TDConst::JOIN_HANDLE)
            @include('quotes.products.papers.handle_types.join_handle')
        @else
            @include('quotes.products.papers.handle_types.own_handle')
        @endif
    </div>
</div>