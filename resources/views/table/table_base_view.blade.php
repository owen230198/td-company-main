<table class="table">
    <tr>
        <th class="font-bold fs-13 text-center">
            <div class="d-flex align-items-center justify-content-center">
                <span>#</span>
                @if (!@$hideCheck)
                    <input type="checkbox" class="c_all_remove ml-2">          
                @endif
            </div>
        </th>
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
                <div class="d-flex align-items-center justify-content-center">
                    <span>{{ $key + 1 }}</span>
                    @if (!@$hideCheck)
                        <input type="checkbox" class="c_one_remove ml-2" data-id="{{ $data['id'] }}">
                    @endif
                </div>
            </td>
            @foreach ($field_shows as $field)
                <td>
                    @include('view_table.' . $field['type'] . '', [
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
