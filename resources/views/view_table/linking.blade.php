@php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $table = getTableLinkingWithData($data, $select_data['table']);
    $linking_item = \DB::table($table)->find($value);
    $model = getModelByTable($table);
    if (method_exists($model, 'getLabelLinking')) {
        $label = $model::getLabelLinking($linking_item);
    }else{
        $label = getLabelLinking($linking_item, $field_title);
    }
@endphp
<p class="color_main py-1 radius_5 mb-0 text-center {{ empty($history_view) ? 'linking_table' : '' }}">
	{{ $label }}
</p>