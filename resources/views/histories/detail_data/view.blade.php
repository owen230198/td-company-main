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
                        $field_data = getDetailTableField(['table_map' => $data_log->table_map, 'name' => $key, 'history' => 1]);
                    @endphp
                    @if (!empty($field_data))
                        @php
                            $field_data['history_view'] = true;
                        @endphp
                        <tr>
                            <th scope="row">{{ $count++ }}</th>
                            <td>{{ $field_data['note'] }}</td>
                            <td>
                                @php
                                    $data_old = $field_data;
                                    $data_old['value'] = !empty($data['old']) ? $data['old'] : '';
                                @endphp
                                @include('view_table.'.$field_data['type'], $data_old)
                            </td>
                            <td class="text-center">
                                <i class="fa fa-long-arrow-right fs-18" aria-hidden="true"></i>
                            </td>
                            <td>
                                @php
                                    $data_new = $field_data;
                                    $data_new['value'] = !empty($data['new']) ? $data['new'] : '';
                                @endphp
                                @include('view_table.'.$field_data['type'], $data_new)
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
