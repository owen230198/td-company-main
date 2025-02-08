<td>
    @php
        $table_supply = tableWarehouseByType(@$data->type);
        $fields = (new \App\Services\AdminService)->getFieldAction($table_supply, 'get_other', [['key' => 'type', 'value' => $data->type]]);
    @endphp
    @foreach ($fields as $field)
        @php
            $field = processArrField($field);
            $field_type = $field['type'];
            if ($field_type != 'group') {
                $field['value'] = @$data->{$field['name']};
            }
            $field['history_view'] = true;
        @endphp
        @if ($field_type == 'group')
            @include('view_table.group', $field)
        @else
            <div class="mb-1 d-flex align-items-center flex_wrap">
                <label class="mr-2 mb-0 font_bold">- {{ $field['note'] }}: </label>
                @include('view_table.'.$field_type, $field)
            </div>
        @endif
    @endforeach
</td>
<td>
    @include('view_table.text', ['value' => @$data->qty])
</td>
<td>
    @include('view_table.money', ['value' => @$data->price])
</td>
<td>
    @include('view_table.money', ['value' => @$data->total])
</td>