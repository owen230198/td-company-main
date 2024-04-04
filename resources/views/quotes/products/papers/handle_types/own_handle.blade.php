@php
    $key_supp = \TDConst::PAPER;
    $_compen_percent = getDataConfig('QuoteConfig', 'COMPEN_PERCENT');
    $_plus_direct = (int) getDataConfig('QuoteConfig', 'PLUS_DIRECT');
    $_plus_to_per = (int) getDataConfig('QuoteConfig', 'PLUS_TO_PERCENT');
    $paper_hd_base_name = 'product['.$pro_index.'][paper]['.$supp_index.']';
    $pro_paper_materals = [
        'name' => $paper_hd_base_name.'[size][materal]',
        'type' => 'linking',
        'note' => 'Chọn chất liệu giấy',
        'attr' => ['required' => 1, 'inject_class' => 'select_paper_materal', 
        'disable_field' => !empty($disable_all) || in_array('size_materal', @$arr_disable ?? []) ? 1 : 0],
        'other_data' => ['data' => ['table' => 'materals','where' => ['type' => $key_supp], 'ext_option' => [['id' => 'other', 'name' => 'Giấy khác']]]],
        'value' => @$supply_size['materal']
    ];
    $pro_paper_qttv = [
        'name' => $paper_hd_base_name.'[size][qttv]',
        'note' => 'Định lượng',
        'attr' => ['type_input' => 'number', 'required' => 1,
        'disable_field' => !empty($disable_all) || in_array('size_qttv', @$arr_disable ?? []) ? 1 : 0],
        'value' => @$supply_size['qttv']
    ];
    $_note_materal = [
        'name' => $paper_hd_base_name.'[size][note]',
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
@include('quotes.products.supplies.quantity_config', ['compen_percent' => $_compen_percent, 'plus_direct' => $_plus_direct, 'per_plus' => $_plus_to_per])
<div class="materal_paper_module {{ !empty($rework) ? 'd-none' : '' }}">
    @include('view_update.view', $pro_paper_materals)
    <div class="__module_paper_materal_note" style="display:{{ @$supply_size['materal'] != 'other' ? 'none' : 'block' }}">
        @include('view_update.view', $_note_materal)
    </div>
    @include('view_update.view', $pro_paper_qttv)
    @include('quotes.products.papers.size')
</div>
<div class="paper_ajax_after_print {{ !empty($rework) ? 'd-none' : '' }}">
    @if ((@$supp_index == 0 || !empty($supply_obj)) && empty($no_exc))
        @include('quotes.products.papers.after_print', ['data_paper' => @$supply_obj, ])    
    @endif
</div>