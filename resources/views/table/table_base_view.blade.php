<table class="table">
    <tr>
        <th class="font-bold fs-13 text-center">#</th>
        <th class="font-bold fs-13 text-center"><input type="checkbox" class="c_all_remove"></th>
        @foreach ($field_shows as $field)
            <th class="font-bold fs-13">{{ $field['note'] }}</th>
        @endforeach
        <th class="font-bold fs-13">Chức năng</th>
    </tr>
    @foreach ($data_tables as $key => $data)
        @php
            $data = (array) $data;
        @endphp
        <tr>
            <td class="text-center">
                {{ $key + 1 }}
            </td>
            <td class="text-center">
                <input type="checkbox" class="c_one_remove" data-id="{{ $data['id'] }}">
            </td>
            @foreach ($field_shows as $field)
                <td>
                    @include('view_table.' . $field['view_type'] . '', [
                        'data' => $data,
                        'field' => $field,
                    ])
                </td>
            @endforeach
            <td>
                <div class="func_btn_module text-center position-relative">
                    <button class="station-richmenu-main-btn-area change_menu_func_btn">
                        <i class="fa fa-ellipsis-v fs-15" aria-hidden="true"></i>
                    </button>
                    <div class="list_func_table">
                        @include('table.' . $tableItem['function_view'] . 'func_btn', ['data' => $data])
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
</table>
