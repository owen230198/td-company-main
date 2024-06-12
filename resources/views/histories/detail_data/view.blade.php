@extends('index')
@section('content')
    <div class="dashborad_content">
        @include('base_title', [
            'text' => 'Người chỉnh sửa: ' . getFieldDataById('name', 'n_users', $data_log->user),
        ])
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Thông tin chỉnh sửa</th>
                    <th scope="col">Dữ liệu cũ</th>
                    <th scope="col"></th>
                    <th scope="col">Dữ liệu mới</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp
                @foreach ($detail_data as $key => $data)
                    @php
                        $where = ['table_map' => $data_log->table_map, 'name' => $key, 'history' => 1];
                        $field_data = \App\Models\NDetailTable::where($where)->first();
                        $arr_field = processArrField($field_data);
                    @endphp
                    @if (!empty($field_data))
                        <tr>
                            <th scope="row">{{ $count++ }}</th>
                            <td>{{ $field_data->note }}</td>
                            <td>
                                @php
                                    $data_old = $arr_field;
                                    $data_old['value'] = $data['old'];
                                @endphp
                                @include('view_table.'.$field_data->type, $data_old)
                            </td>
                            <td class="text-center">
                                <i class="fa fa-long-arrow-right fs-18" aria-hidden="true"></i>
                            </td>
                            <td>
                                @php
                                    $data_new = $arr_field;
                                    $data_new['value'] = $data['new'];
                                @endphp
                                @include('view_table.'.$field_data->type, $data_new)
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
