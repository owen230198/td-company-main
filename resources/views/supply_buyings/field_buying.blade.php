@php
    $supplyBuying = new \App\Models\SupplyBuying;
    $status = !empty($dataItem->status) ? $dataItem->status : '';
    $group_name = 'supply['.$index.']';
@endphp
<div class="__data_supply_buying_conf" data-cate={{ $supp_type }}>
    @foreach ($fields as $field)
        @php
            $name = $field['name'];
            $field['name'] = $group_name.'['.$name.']';
            $field['min_label'] = 175;
            $field['value'] = @$group_value[$name];
            $field['attr']['readonly'] = $supplyBuying::canUpdateSuppDataBuyibng() ? 0 : 1;
            if (!$supplyBuying::checkReadOnlyInputPrice($status) && in_array($name, ['width', 'length'])) {
                $field['attr']['readonly'] = 0;
            }
        @endphp
        @include('view_update.view', $field)      
    @endforeach
</div>