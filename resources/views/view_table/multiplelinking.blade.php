@php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $field_linking = @$select_data['field_linking'] ?? 'id';
    $table = getTableLinkingWithData($data, $select_data['table']);
    $arr_value = json_decode($value, true);
    $linking_items = !empty($arr_value) ? \DB::table($table)->whereIn($field_linking, $arr_value)->get() : [];
    $model = getModelByTable($table);
@endphp
@foreach ($linking_items as $item)
    @php
        if (method_exists($model, 'getLabelLinking')) {
        $label = $model::getLabelLinking($item);
        }else{
            $label = getLabelLinking($item, $field_title);
        }
    @endphp
    <p class="color_main py-1 radius_5 mb-0 text-center {{ empty($history_view) ? 'linking_table' : '' }}">
        {{ $label }}
    </p>
@endforeach