@php
    $paginate = is_object($data_tables) && method_exists($data_tables, 'appends');
@endphp
@if ($paginate)
    <div class="paginate_view d-flex align-center justify-content-between mb-3">
        {!! $data_tables->appends(request()->input())->links('pagination::bootstrap-4') !!}
    </div>
@endif
    <div class="table_base_view position-relative">
        <table class="table table-bordered mb-2 table_main table_responsive">
            <thead>
                @if (!empty($is_export))
                    <tr>
                        <th colspan="{{ count($field_shows) }}">
                            <h3>
                            {{ $title}}
                            </h3>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="{{ count($field_shows) }}">
                            Người xuất : {{ \User::getCurrent('name') }}
                        </th>
                    </tr>
                @endif
                <tr>
                    @if (empty($is_export))
                        <th class="font-bold fs-13 text-center parentth" rowspan="{{ @$rowspan }}">
                            <div class="d-flex align-items-center justify-content-center">
                                <span>#</span>
                                @if (@$tableItem['remove'] == 1)
                                    <input type="checkbox" class="c_all_remove ml-2">          
                                @endif
                            </div>
                        </th>
                    @endif
                    @foreach ($field_shows as $key => $field)
                        @if ($field['parent'] == 0)
                            <th class="font-bold fs-13" rowspan="{{ !empty($field['colspan']) ? 1 : @$rowspan }}" colspan="{{ !empty($field['colspan']) ? $field['colspan'] : 1 }}">
                                {{ $field['note'] }}
                            </th>
                        @endif
                    @endforeach
                    @if (empty($is_export))
                        <th class="font-bold fs-13 parentth" rowspan="{{ @$rowspan }}">Chức năng</th>
                    @endif
                </tr>
                @if (@$rowspan == 2)
                    <tr>
                        @foreach ($field_shows as $key => $field)
                            @if ($field['type'] == 'group' && !empty($field['child']))
                                @foreach ($field['child'] as $field_child)
                                    <th class="font-bold fs-13">
                                        {{ $field_child['note'] }}
                                    </th>   
                                @endforeach
                            @endif
                        @endforeach
                    </tr>
                @endif
            </thead>
            <tbody>
                @foreach ($data_tables as $key => $data)
                    <tr>
                        @if (empty($is_export))
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span>{{ $key + 1 }}</span>
                                    @if (@$tableItem['remove'] == 1)
                                        <input type="checkbox" class="c_one_remove ml-2" data-id="{{ $data->id }}">
                                    @endif
                                </div>
                            </td>
                        @endif
                        @foreach ($field_shows as $field)
                            @if ($field['type'] != 'group')
                                <td data-label = "{{ $field['note'] }}">
                                    @php
                                        $arr = $field;
                                        $arr['obj_id'] = $data->id;
                                        $arr['value'] = @$data->{$field['name']};
                                        $arr['attr'] = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
                                        $arr['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
                                    @endphp
                                    @include('view_table.'.$field['type'], $arr)
                                </td>
                            @endif
                        @endforeach
                        @if (empty($is_export))
                            <td>
                                <div class="func_btn_module text-center position-relative">
                                    @include('table.func_btn')
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@if ($paginate)
    <div class="paginate_view d-flex align-center justify-content-between mt-3">
        {!! $data_tables->appends(request()->input())->links('pagination::bootstrap-4') !!}
    </div>
@endif
