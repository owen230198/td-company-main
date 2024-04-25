@php
    $select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $field_value = @$select_data['field_value'] ?? 'id';
    $table_linking = getTableLinkingWithData(@$dataItem, $select_data['table']);
    $except_linking = !empty($select_config['except_linking']) ? $select_config['except_linking'] : 0;
@endphp

@if (@$select_config['search'] == 1)
    @php
        $url = asset('get-data-json-linking?table='.$table_linking.'&field_search='.$field_title.'&field_value='.$field_value.'&except_linking='.$except_linking);
        if (!empty($select_data['where'])) {
            foreach ($select_data['where'] as $key => $val) {
                $url .= '&'.$key.'='.$val;
            }
        }
        if (!empty($select_data['where_default'])) {
            foreach ($select_data['where_default'] as $key => $val) {
                if (!empty($default_field[$val])) {
                    $url .= '&'.$key.'='.$default_field[$val];
                }
            }
        }
        if (!empty($value)) {
            $data_id = $value;
            $linking_model = getModelByTable($table_linking);
            $linking_value = \DB::table($table_linking)->find($data_id);
            $data_label = method_exists($linking_model, 'getLabelLinking') ? $linking_model::getLabelLinking($linking_value) : @$linking_value->{$field_title};
        }
    @endphp
    <select name="{{ $name }}" {{ !empty($select_config['multiple']) ? 'multiple' : '' }} 
    class="form-control select_ajax {{ @$attr['inject_class'] ? ' '.$attr['inject_class'] : '' }} 
    {{ @$attr['class_on_search'] ? ' '.$attr['class_on_search'] : '' }}"
    data-url="{{ $url }}" data-id="{{ @$data_id }}", data-label = "{{ @$data_label }}" {{ @$attr['inject_attr'] ?? '' }} 
    {{ @$attr['disable_field'] == 1 ? 'disabled' : '' }}
    {{ @$attr['readonly'] == 1 ? 'readonly' : '' }}>
    </select>
@else
    @php
        $list_options = getOptionDataField($select_data);
    @endphp
    <select name="{{ $name }}" 
            class="form-control {{ @$select_config['searchbox'] == 1 ? ' select_config' : '' }} {{ @$attr['inject_class'] }}" 
            {{ @$attr['inject_attr'] ?? '' }}
            {{ @$attr['disable_field'] == 1 ? 'disabled' : '' }}
            {{ @$attr['readonly'] == 1 ? 'readonly' : '' }}
            >
        <option value="">{{ @$attr['placeholder'] ?? 'Chọn' }}</option>
        @foreach ($list_options as $item)
            <option value="{{ $item->$field_value }}" {{ $item->$field_value == @$value ? 'selected' : '' }}>
                {{ $item->$field_title }}
            </option>
        @endforeach
    </select>
@endif
