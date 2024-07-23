@php
    $status = !empty($dataItem->status) ? $dataItem->status : '';
    $field_supply_type = \App\Models\SupplyBuying::getFeildSupplyJson(@$value, $status);
@endphp
<div class="item_supp_buy mb-3 pb-3 border_bot_main position-relative" data-index = {{ $index }}>
    @if (\GroupUser::isPlanHandle() || \GroupUser::isApplyBuying())
        <span class="d-flex color_red smooth remove_parent_element_button"><i class="fa fa-times" aria-hidden="true"></i></span> 
    @endif
    @foreach ($field_supply_type as $item)
        @php
            $jname = $item['name'];
            $item['value'] = @$value[$jname]; 
            $item['name'] = 'supply['.$index.']['.$jname.']';
            $item['dataItem'] = @$value;
            $item['min_label'] = 150;
        @endphp
        @include('view_update.view', $item)   
    @endforeach
    <div class="ajax_supply_buying_data">
        @if (!empty($value['type']))
            @php
                $arr_view = getViewSuppluBuyingByType($value['type'], $index);
                $arr_view['group_value'] = $value;
            @endphp
            @include('supply_buyings.field_buying', $arr_view)
        @endif     
    </div>                
</div>