@php
    $field_qtys = \App\Models\SupplyBuying::getFieldQtyArr($type);
    $value_qty = !empty($value) ? json_decode($value, true) : [];
@endphp
@if ($type == \TDConst::EMULSION)
    @php
        $field_width = [
            'name' => 'qty[width]',
            'type' => 'text',
            'note' => 'Cắt khổ rộng (cm)',
            'value' => @$value_qty['width'] ?? 0,
            'attr' => ['type_input' => 'number'],
        ];
    @endphp
    @include('view_update.view', $field_width)   
@endif
@foreach ($field_qtys as $field_qty)
    @php
         $name = $field_qty['name'];
         $field_qty['name'] = 'qty'.'['.$name.']';
         $field_qty['value'] = @$value_qty[$name] ?? 0;
    @endphp
    @include('view_update.view', $field_qty)    
@endforeach