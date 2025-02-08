@extends('index')
@section('content')
    <div class="dashborad_content">
        @if (!empty($tableItem['search_view']))
            @include('table.'.$tableItem['search_view'])
        @else
            @include('table.form_search')
        @endif
        <div class="d-flex align-center justify-content-end my-3">
            <button type="submit"
                class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2"
                form="form-search" value="submit">
                <i class="fa fa-table mr-2 fs-15" aria-hidden="true"></i>Xem dạng bảng
            </button>
            @if (!empty($chart_buttons))
                @foreach ($chart_buttons as $chart_btn)
                    <button type="button" data-table = {{ $tableItem['name'] }} data-field = {{ $chart_btn['name'] }} data-field_by = "total_amount" class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2 __view_chart_buton">
                        <i class="fa fa-{{ $chart_btn['icon'] }} mr-2 fs-15" aria-hidden="true"></i>thống kê {{ $chart_btn['text'] }}
                    </button>   
                @endforeach
            @endif
        </div>
        @if (count($data_tables) > 0)
            <div class="table_base_view position-relative">
                <table class="table table-bordered mb-2 table_responsive">
                    <thead>
                        <tr>
                            <th class="font-bold fs-13 text-center parentth w_50" rowspan="{{ @$rowspan }}">
                                <span>#</span>
                            </th>
                            @foreach ($field_shows as $key => $field)
                                @if ($field['parent'] == 0)
                                    <th class="font-bold fs-13" rowspan="{{ !empty($field['colspan']) ? 1 : @$rowspan }}" colspan="{{ !empty($field['colspan']) ? $field['colspan'] : 1 }}">
                                        {{ $field['note'] }}
                                    </th>
                                @endif
                            @endforeach
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
                                <td class="text-center w_50">
                                    <span>{{ $key + 1 }}</span>
                                </td>
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
                            </tr>
                        @endforeach
                    </tbody>
                    <div class="paginate_view d-none">
                        {!! $data_tables->appends(request()->input())->links('pagination::bootstrap-4') !!}
                    </div>
                    <tfoot class="fs-18">
                        <tr>
                            <td colspan="4">
                                <p class="font_bold color_red text-center">Tổng Doanh Thu Đơn</p>
                            </td>
                            <td colspan="4">
                                <p class="font_bold color_red text-center">{{ number_format(abs($total_amount)) }} đ</p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                
            </div>
        @else
            <p class="fs-15 font-italic color_red">Chưa có dữ liệu {{ @$title }} !</p>
        @endif
    </div>
@endsection
