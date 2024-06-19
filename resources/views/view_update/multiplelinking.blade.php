@php
    $select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $url = getLinkingUrl($select_data, @$dataItem);
    $field_title = @$select_data['field_title'] ?? 'name';
    $field_value = @$select_data['field_value'] ?? 'id';
    $table_linking = getTableLinkingWithData(@$dataItem, $select_data['table']);
    $model = getModelByTable($table_linking);
    $arr_value = json_decode($value, true);
    if (!empty($arr_value)) {
        $data_value = \DB::table($table_linking)->whereIn($field_value, $arr_value)->get()->all();
        $json_value = getJsonMultipleValue($data_value, $model, $field_title, $field_value);
    }
@endphp
<select class="__multiple_select" multiple="multiple" note="{{ @$note }}" url={{ $url }} name="{{ $name }}[]" value="{{ @$json_value }}">
    
</select>