@php
    $supplyBuying = new \App\Models\SupplyBuying;
    $group_name = 'supply['.$index.']';
@endphp
<div class="__data_supply_buying_conf" data-cate={{ $supp_type }}>
    @if (!empty($value['id']))
        <input type="hidden" name="{{ $group_name.'[id]' }}" value="{{ $value['id'] }}">
    @endif
    @foreach ($fields as $field)
        @php
            $name = $field['name'];
            $field['name'] = $group_name.'['.$name.']';
            $field['min_label'] = 175;
        @endphp
        @include('view_update.view', $field)      
    @endforeach
    <div class="__ajax_buying_qtv_field">
        @if (!empty($value['target']))
            @include('supply_buyings.field_qtv') 
        @endif
    </div>
</div>
