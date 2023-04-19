@php
    $pro_supply = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][supply_type]',
        'type' => 'linking',
        'note' => 'Chọn vật tư',
        'attr' => ['required' => 1, 'inject_class' => 'select_supply_type'],
        'other_data' => ['config' => ['search' => 1], 
        'data' => ['table' => 'supply_types', 'where' => ['type' => $key_supp]]]
    ];
    
@endphp
<div class="module_select_supply_type">
    @include('view_update.view', $pro_supply)
    @if (empty($select_qttv))
        @php
            $pro_supp_price = [
                'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][supply_price]',
                'type' => 'select',
                'note' => 'Chọn định lượng',
                'attr' => ['required' => 1, 'inject_class' => 'ajax_supply_price'],
                'other_data' => ['config' => ['search_box' => 1], 'data' => ['options' => ['Chọn định lượng']]]
            ] 
        @endphp
        @include('view_update.view', $pro_supp_price)
    @endif
</div>