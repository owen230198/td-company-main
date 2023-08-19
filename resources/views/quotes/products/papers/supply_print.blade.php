@php
    $key_supp = \TDConst::PAPER;
    $paper_compen_percent = getDataConfig('QuoteConfig', 'COMPEN_PERCENT');
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
        'attr' => ['inject_class' => "__paper_except_handle",
        'disable_field' => !empty($disable_all) || in_array('name', @$arr_disable ?? []) ? 1 : 0],
        'value' => @$supply_obj->except_handle
    ]
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
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>{{ $supp_index == 0 ? 'Phần giấy in' : 'Lệnh in thêm thứ '.$supp_index }}</span>
    </h3>
    @include('view_update.view', $pro_paper_name)
    
    @include('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $paper_compen_percent])
    
    <div class="materal_paper_module">
        @include('view_update.view', $pro_paper_materals)
        @include('view_update.view', $pro_paper_qttv)
        @include('quotes.products.papers.size')
    </div>
    @if (empty($no_exc))
        @include('view_update.view', $pro_paper_except)
    @endif
</div>