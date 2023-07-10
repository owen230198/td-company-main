@php
    $field_shows = \App\Models\Product::SUPPLY_FIELDS;
@endphp
<div class="table_base_view position-relative">
    <table class="table table-bordered mb-2 table_main">
        <tr>
            <th class="font-bold fs-13 text-center">
                <span>#</span>
            </th>
            @foreach ($field_shows as $key => $field)
                <th class="font-bold fs-13" rowspan="{{ !empty($field['colspan']) ? 1 : @$rowspan }}" colspan="{{ !empty($field['colspan']) ? $field['colspan'] : 1 }}">
                    {{ $field['note'] }}
                </th>
            @endforeach
            <th class="font-bold fs-13">Chức năng</th>
        </tr>
        <tbody>
            @foreach ($element['data'] as $key => $data)
                <tr>
                    <td class="text-center">
                        <span>{{ $key + 1 }}</span>
                    </td>
                    @foreach ($field_shows as $field)
                    <td>
                        @php
                            $arr = $field;
                            $arr['obj_id'] = $data->id;
                            $arr['value'] = @$data->{$field['name']};
                            $arr['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
                        @endphp
                        @include('view_table.'.$field['type'], $arr)
                    </td>
                    @endforeach
                    <td>
                        <div class="func_btn_module text-center">
                            <a href="{{ url('supply-handle/'.$element['table'].'/'.$data->id) }}">
                                <i class="fa fa-paper-plane-o mr-1" aria-hidden="true"></i> Yêu cầu xuất vật tư
                            </a>   
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
