@php
    $select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $url = 'get-data-json-linking?table='.$select_data['table'];
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
<select name="{{ @$field['table_map']=='orders'?'order['.$name.']':$name }}" 
class="form-control {{ @$select_config['search'] == 1 ? 'select_ajax' : '' }}"
data-url="{{ $url }}" data-id="{{ $data_id }}", data-label = "{{ $data_label }}">
</select>