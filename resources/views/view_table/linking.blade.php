@php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $table = getTableLinkingWithData($data, $select_data['table']);
    
@endphp
@if (!empty($table))
    @php
        $linking_item = \DB::table($table)->find($value);
        $model = getModelByTable($table);
        if (method_exists($model, 'getLabelLinking')) {
            $label = $model::getLabelLinking($linking_item);
        }else{
            $label = getLabelLinking($linking_item, $field_title);
        }
    @endphp
    <button data-src="{{ url('update/'.$table.'/'.$value.'?nosidebar=1') }}" 
    class="color_main py-1 radius_5 mb-0 text-center {{ empty($history_view) ? 'linking_table load_view_popup' : '' }} d-block"
    data-toggle="modal" data-target="#actionModal">
        {{ $label }}
    </button>
@endif