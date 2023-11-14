<div class="group_class_view {{ @$other_data['group_class'] }}" {{ @$other_data['inject_attr'] }}>
    @foreach ($child as $field_child)
        @php
            $arr = processArrField($field_child);
            $field_child_name = !empty($field_child['key_name']) ? $field_child['key_name'] : $field_child['name'];
            $arr['value'] = !empty($field_child['value']) ? $field_child['value'] : @$dataItem[$field_child_name];
        @endphp
        @include('view_update.view', $arr)
    @endforeach   
</div>