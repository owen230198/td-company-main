@php
    $pro_supply = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][supply_type]',
        'type' => 'linking',
        'note' => 'Chọn vật tư',
        'attr' => ['required' => 1, 'inject_class' => 'select_supply_type', 'inject_attr' => 'cvalue = '.@$supply_size['supply_price']],
        'value' => @$supply_size['supply_type'],
        'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'supply_types', 'where' => ['type' => $key_supp, 'is_name' => 0]]]
    ];
    $option_supp_price = !empty($supply_size['supply_price']) ? 
    ['supply_price' => getFieldDataById('name', 'supply_prices', $supply_size['supply_price'])] : ['Chọn định lượng'];
    $pro_supp_price = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][supply_price]',
        'type' => 'select',
        'note' => 'Chọn định lượng',
        'attr' => ['required' => 1, 'inject_class' => 'ajax_supply_price'],
        'value' => @$supply_size['supply_price'],
        'other_data' => ['config' => ['search_box' => 1], 'data' => ['options' => $option_supp_price]]
    ] 
@endphp
<div class="module_select_supply_type">
    @include('view_update.view', $pro_supply)
    @include('view_update.view', $pro_supp_price)
</div>