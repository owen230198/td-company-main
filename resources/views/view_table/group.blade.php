<div class="group_view_table_module">
    @foreach ($child as $field_child)
        @php
            $arr = processArrField($field_child);
            $field_child_name = !empty($field_child['key_name']) ? $field_child['key_name'] : $field_child['name'];
            $arr['value'] = !empty($field_child['value']) ? $field_child['value'] : @$data->{$field_child_name};
        @endphp
        <div class="mb-1 d-flex align-items-center">
            <label class="mr-2 mb-0 font_bold">- {{ $field_child['note'] }}: </label>
            @include('view_table.'.$field_child['type'], $arr)
        </div>
        
    @endforeach   
</div>