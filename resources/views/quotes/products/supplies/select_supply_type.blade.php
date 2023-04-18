@php
    $pro_supply = [
        'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][supply_type]',
        'type' => 'linking',
        'note' => 'Chọn vật tư',
        'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
        'other_data' => ['config' => ['search' => 1], 
        'data' => ['table' => 'supply_types', 'where' => ['type' => $key_supp]]]
    ];
    
@endphp
<div class="module_select_supply">
    @include('view_update.view', $pro_supply)
    @if (empty($select_qttv))
        @php
            $pro_supp_price = [
                'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][supply_price]',
                'type' => 'select',
                'note' => 'Chọn định lượng',
                'attr' => ['required' => 1, 'inject_class' => 'ajax_supply_price'],
                'other_data' => ['config' => ['search_box' => 1], 'data' => ['options' => ['Chọn định lượng']]]
            ] 
        @endphp
        @include('view_update.view', $pro_supp_price)
    @endif
</div>