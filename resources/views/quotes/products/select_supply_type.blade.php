@php
    $supp_base_name = 'product['.$pro_index.']['.$key_supp.']';
    if (@$supp_index != '') {
       $supp_base_name .= '['.$supp_index.']['.$key_stage.']';
    }else{
        $supp_base_name .= '['.$key_stage.']';    
    }
    $supply_materal_select = [
        'name' => $supp_base_name.'[materal]',
        'type' => 'linking',
        'note' => 'Chọn chất liệu '.getTextSupply($key_type),
        'attr' => ['required' => 1, 'inject_class' => '__supply_materal_select_module', 
        'disable_field' => !empty($disable_all) || in_array('size_materal', @$arr_disable ?? []) ? 1 : 0],
        'other_data' => [
            'config' => [
                'search' => 1,
                'other_choose' => 1,
            ],
            'data' => [
                'table' => 'supply_types',
                'where' => ['type' => $key_type]
            ]
        ],
        'value' => @$value['materal']
    ];
@endphp
<div class="__materal_select_supply_module {{ !empty($rework) ? 'd-none' : '' }}" 
data-pro_index="{{ $pro_index }}" data-supp_index="{{ $supp_index }}" data-key_supp="{{ $key_supp }}" data-key_stage="{{ $key_stage }}" data-key_type="{{ $key_type }}">
    @include('view_update.view', $supply_materal_select)
    <div class="__materal_ajax_qtv">
        @if (!empty($value['materal']))
            @include('quotes.products.field_qtv', ['value' => $value, 'materal' => $value['materal']])
        @endif
    </div>
</div>