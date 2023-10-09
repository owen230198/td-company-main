@php
    $key_supp = \TDConst::PAPER;
    $paper_compen_percent = getDataConfig('QuoteConfig', 'COMPEN_PERCENT');
    $paper_plus_direct = (int) getDataConfig('QuoteConfig', 'PLUS_DIRECT');
    $paper_plus_to_per = (int) getDataConfig('QuoteConfig', 'PLUS_TO_PERCENT');
    $pro_paper_name = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][name]',
        'note' => 'Tên sản phẩm',
        'attr' => ['required' => 1, 
                    'inject_class' => $supp_index == 0 ? 'length_input quote_receive_paper_name_main' 
                    : 'length_input quote_receive_paper_name_ext',
                'disable_field' => !empty($disable_all) || in_array('size_name', @$arr_disable ?? []) ? 1 : 0],
        'value' => @$supply_obj->name ?? @$supp_name
    ];
    $pro_paper_materals = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][materal]',
        'type' => 'linking',
        'note' => 'Chọn chất liệu giấy',
        'attr' => ['required' => 1, 'inject_class' => 'select_paper_materal', 
        'disable_field' => !empty($disable_all) || in_array('size_materal', @$arr_disable ?? []) ? 1 : 0],
        'other_data' => ['data' => ['table' => 'materals','where' => ['type' => $key_supp], 'ext_option' => [['id' => 'other', 'name' => 'Giấy khác']]]],
        'value' => @$supply_size['materal']
    ];
    $pro_paper_qttv = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][qttv]',
        'note' => 'Định lượng',
        'attr' => ['type_input' => 'number', 'required' => 1,
        'disable_field' => !empty($disable_all) || in_array('size_qttv', @$arr_disable ?? []) ? 1 : 0],
        'value' => @$supply_size['qttv']
    ];
    $pro_paper_except = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.'][except_handle]',
        'note' => 'Lệnh in ghép',
        'type' => 'checkbox',
        'attr' => ['inject_class' => "__paper_except_handle"],
        'value' => @$supply_obj->except_handle
    ];
    $paper_note_materal = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.'][size][note]',
        'note' => 'Ghi chú giấy in',
        'type' => 'textarea',
        'attr' => [
            'disable_field' => !empty($disable_all) 
            || in_array('note', @$arr_disable ?? []) 
            || @$supply_size['materal'] != 'other' ? 1 : 0,
            'inject_class' => '__paper_materal_note'
        ],
        'value' => @$supply_size['note']
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
        <span class="mr-2">{{ $supp_index == 0 ? 'Phần giấy in' : 'Lệnh in thêm thứ '.$supp_index }}</span>
        <a href="{{ url('print-data/'.$supp_view.'/'.$supply_obj->id) }}" target="_blank" class="main_button color_white bg_green border_green radius_5 font_bold sooth">
            <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i> In lệnh sản xuất
        </a>
    </h3>
    @include('view_update.view', $pro_paper_name)
    
    @include('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $paper_compen_percent, 'plus_direct' => $paper_plus_direct, 'per_plus' =>$paper_plus_to_per])
    
    <div class="materal_paper_module">
        @include('view_update.view', $pro_paper_materals)
        <div class="__module_paper_materal_note" style="display:{{ @$supply_size['materal'] != 'other' ? 'none' : 'block' }}">
            @include('view_update.view', $paper_note_materal)
        </div>
        @include('view_update.view', $pro_paper_qttv)
        @include('quotes.products.papers.size')
    </div>
    @if (empty($no_exc))
        @include('view_update.view', $pro_paper_except)
    @endif
</div>