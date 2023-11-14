@php
    $field_supply_type = \App\Models\SupplyBuying::getFeildSupplyJson($index, @$value);
@endphp
<div class="item_supp_buy mb-3 pb-3 border_bot_main position-relative" data-index = {{ $index }}>
    <span class="d-flex color_red smooth remove_parent_element_button"><i class="fa fa-times" aria-hidden="true"></i></span> 
    @foreach ($field_supply_type as $item)
        @php
            $jname = $item['name'];
            $item['value'] = @$value[$jname]; 
            $item['name'] = 'supply['.$index.']['.$jname.']';
            $item['dataItem'] = @$value;
        @endphp
        @include('view_update.view', $item)   
    @endforeach                
</div>