<div class="group_class_view {{ @$other_data['group_class'] }}" {{ @$other_data['inject_attr'] }}>
    @foreach ($child as $field_child)
        @php
            $arr = processArrField($field_child);
            $field_child_name = !empty($field_child['key_name']) ? $field_child['key_name'] : $field_child['name'];
            $arr['value'] = @$group_value[$field_child_name] ?? (!empty($field_child['value']) ? $field_child['value'] : @$dataItem[$field_child_name]);
            if (!empty($group_name)) {
                $arr['name'] = $group_name.'['.$field_child_name.']';
            }
            if (!empty($attr_parent['readonly'])) {
                $arr['attr']['readonly'] = 1;
            }
        @endphp
        @include('view_update.view', $arr)
    @endforeach   
</div>