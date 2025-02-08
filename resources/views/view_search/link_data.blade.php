@php
    $table_get = $other_data['data']['table_get']; 
    $field_get = !empty($other_data['data']['field_get']) ? $other_data['data']['field_get'] : 'name'; 
    $arr_field = \App\Models\NDetailTable::where(['act' => 1, 'table_map' => $table_get, 'name' => $field_get])->first();
@endphp
@php
    $arr = processArrField($arr_field);
    $arr['value'] = @$data_search[$name];
    $arr['name'] = $name;
@endphp
@include('view_search.'.$arr['type'], $arr)