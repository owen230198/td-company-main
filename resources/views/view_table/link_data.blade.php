@php
    $table_get = $other_data['data']['table']; 
    $field_get = !empty($other_data['data']['field_get']) ? $other_data['data']['field_get'] : 'name'; 
    $field_data = $other_data['data']['field_data'];
    $table_query = $other_data['data']['table_query'];
    $field_query = $other_data['data']['field_query'];
    $data_query = \DB::table($table_query)->find($data->{$field_query});
    $data_get = \DB::table($table_get)->find($data_query->{$field_data});
    $arr_field = \App\Models\NDetailTable::where(['act' => 1, 'table_map' => $table_get, 'name' => $field_get])->first();
@endphp
@if (!empty($arr_field))
    @php
        $arr = processArrField($arr_field);
        $arr['obj_id'] = $data_get->id;
        $arr['value'] = @$data_get->{$field_get};
    @endphp
    <div class="mb-1">
        @include('view_table.'.$arr->type, $arr)
    </div>
@else
    <p class="color_main radius_5 mb-2 text-center linking_table">
        {{ $child->{$field_title} }}
    </p>
@endif