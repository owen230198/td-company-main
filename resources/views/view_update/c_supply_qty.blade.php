@php
    $field_qtys = \App\Models\SupplyBuying::getFieldQtyArr($type);
    $value_qty = !empty($value) ? json_decode($value, true) : [];
@endphp
@foreach ($field_qtys as $field_qty)
    @php
         $name = $field_qty['name'];
         $field_qty['name'] = 'qty'.'['.$name.']';
         $field_qty['value'] = @$value_qty[$name] ?? 0;
         $field_qty['attr']['readonly'] = 0;
    @endphp
    @include('view_update.view', $field_qty)    
@endforeach