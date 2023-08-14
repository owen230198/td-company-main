@php
    $select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $field_value = @$select_data['field_value'] ?? 'id';
@endphp

@if (@$select_config['search'] == 1)
    @php
        $url = asset('get-data-json-linking?table='.$select_data['table'].'&field_search='.$field_title);
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
            $data_label = getFieldDataById($field_title, $select_data['table'], [$field_value => $value]);
        }
    @endphp
    <select name="{{ $name }}" class="form-control select_ajax {{ @$attr['inject_class'] ? ' '.$attr['inject_class'] : '' }}"
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
        <option value="0">Chọn</option>
        @foreach ($list_options as $item)
            <option value="{{ $item->$field_value }}" {{ $item->$field_value == @$value ? 'selected' : '' }}>
                {{ $item->$field_title }}
            </option>
        @endforeach
    </select>
@endif
