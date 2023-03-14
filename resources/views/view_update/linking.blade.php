@php
    $select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
@endphp
@if (@$select_config['search'] == 1)
    @php
        $url = asset('get-data-json-linking?table='.$select_data['table']);
        if (!empty($select_data['where'])) {
            foreach ($select_data['where'] as $key => $val) {
                $url .= '&'.$key.'='.$val;
            }
        }
        if (!empty($value)) {
            $data_id = $value;
            $data_label = getFieldDataById('name', $select_data['table'], $value);
        }
    @endphp
    <select name="{{ $name }}" class="form-control select_ajax {{ @$attr['inject_class'] ? ' '.$attr['inject_class'] : '' }}"
    data-url="{{ $url }}" data-id="{{ @$data_id }}", data-label = "{{ @$data_label }}">
    </select>
@else
    @php
        $list_options = getOptionDataField($select_data);
        $field_value = @$select_data['select_data'] ?? 'id';
        $field_title = @$select_data['field_title'] ?? 'name';
    @endphp
    <select name="{{ $name }}" class="form-control {{ @$attr['inject_class'] ? ' '.$attr['inject_class'] : '' }}">
        <option value="0">Chọn {{ $note }}</option>
        @foreach ($list_options as $item)
            <option value="{{ $item->$field_value }}">{{ $item->$field_title }}</option>
        @endforeach
    </select>
@endif
