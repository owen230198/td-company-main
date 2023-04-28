<div class="table_base_view position-relative">
    <table class="table table-bordered mb-2 table_main">
        <theader>
            <tr>
                <th class="font-bold fs-13 text-center parentth" rowspan="{{ @$rowspan }}">
                    <div class="d-flex align-items-center justify-content-center">
                        <span>#</span>
                        @if (@$tableItem['remove'] == 1)
                            <input type="checkbox" class="c_all_remove ml-2">          
                        @endif
                    </div>
                </th>
                @foreach ($field_shows as $key => $field)
                    @if ($field['parent'] == 0)
                        <th class="font-bold fs-13" rowspan="{{ !empty($field['colspan']) ? 1 : @$rowspan }}" colspan="{{ !empty($field['colspan']) ? $field['colspan'] : 1 }}">
                            {{ $field['note'] }}
                        </th>
                    @endif
                @endforeach
                <th class="font-bold fs-13 parentth" rowspan="{{ @$rowspan }}">Chức năng</th>
            </tr>
            @if (@$rowspan == 2)
                <tr>
                    @foreach ($field_shows as $key => $field)
                        @if ($field['type'] == 'group' && !empty($field['child']))
                            @foreach ($field['child'] as $field_child)
                                <th class="font-bold fs-13"">
                                    {{ $field_child['note'] }}
                                </th>   
                            @endforeach
                        @else
                            
                        @endif
                    @endforeach
                </tr>
            @endif
        </theader>
        <tbody>
            @foreach ($data_tables as $key => $data)
                <tr>
                    <td class="text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <span>{{ $key + 1 }}</span>
                            @if (@$tableItem['remove'] == 1)
                                <input type="checkbox" class="c_one_remove ml-2" data-id="{{ $data->id }}">
                            @endif
                        </div>
                    </td>
                    @foreach ($field_shows as $field)
                        @if ($field['type'] != 'group')
                            <td>
                                @php
                                    $arr = $field;
                                    $arr['obj_id'] = $data->id;
                                    $arr['value'] = $data->{$field['name']};
                                    $arr['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
                                @endphp
                                @include('view_table.'.$field['type'], $arr)
                            </td>
                        @endif
                    @endforeach
                    <td>
                        <div class="func_btn_module text-center position-relative">
                            @include('table.func_btn')
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
