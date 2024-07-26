@php
    $supplyBuying = new \App\Models\SupplyBuying;
    $status = !empty($dataItem->status) ? $dataItem->status : '';
    $field_qtys = $supplyBuying::getFieldQtyArr($type, $status);
    $group_name = 'supply['.$index.']';
@endphp
@foreach ($field_qtys as $field_qty)
    @php
         $name = $field_qty['name'];
         $field_qty['name'] = $group_name.'['.$name.']';
         $field_qty['min_label'] = 150;
         $field_qty['value'] = @$group_value[$name];
    @endphp
    @include('view_update.view', $field_qty)    
@endforeach
@foreach ($fields as $field)
    @php
        $name = $field['name'];
        $field['name'] = $group_name.'['.$name.']';
        $arr = processArrField($field);
        $arr['min_label'] = 150;
        $arr['default_field']['type'] = $type;
        $arr['value'] = @$group_value[$name];
        $arr['group_name'] = $group_name;
        if (\GroupUser::isPlanHandle() || \GroupUser::isAdmin()) {
            $arr['attr']['readonly'] = 0;
        }else{
            $arr['attr']['readonly'] = 1;    
        }
        if (!$supplyBuying::checkReadOnlyInputPrice($status) && in_array($name, ['width', 'length'])) {
            $arr['attr']['readonly'] = 0;
        }
    @endphp
    @if ($field['name'] != 'created_at')
        @include('view_update.view', $arr)         
    @endif  
@endforeach