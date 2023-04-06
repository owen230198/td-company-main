<div class="table_base_view position-relative">
    <table class="table table-bordered mb-2">
        <theader>
            <tr>
                <th class="font-bold fs-13 text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <span>#</span>
                        @if (@$tableItem['remove'] == 1)
                            <input type="checkbox" class="c_all_remove ml-2">          
                        @endif
                    </div>
                </th>
                @foreach ($field_shows as $key => $field)
                    <th class="font-bold fs-13">
                        {{ $field['note'] }}
                    </th>
                @endforeach
                <th class="font-bold fs-13">Chức năng</th>
            </tr>
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
                        <td>
                            @php
                                $arr = $field;
                                $arr['value'] = $data->{$field['name']};
                                $arr['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
                            @endphp
                            @include('view_table.'.$field['type'], $arr)
                        </td>
                    @endforeach
                    <td>
                        <div class="func_btn_module text-center position-relative">
                            @php
                                $func_view = !empty($tableItem['function_view']) ? $tableItem['function_view'] : 'func_btn';
                            @endphp
                            @include('table.'.$func_view)
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
