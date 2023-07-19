@extends('table.base_table')
@section('type')
    <div class="table_base_view position-relative">
        <table class="table table-bordered mb-2 table_main">
            <tr>
                <th class="font-bold fs-13 text-center ">
                    <div class="d-flex align-items-center justify-content-center">
                        <span>#</span>
                        <input type="checkbox" class="c_all_remove ml-2">     
                    </div>
                </th>
                <th class="font-bold fs-13">Thời gian</th>
                <th class="font-bold fs-13">Nội dung thực hiện</th>
                <th class="font-bold fs-13 ">Chức năng</th>
            </tr>
            <tbody>
                @foreach ($data_tables as $key => $data)
                    <tr>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center">
                                <span>{{ $key + 1 }}</span>
                                <input type="checkbox" class="c_one_remove ml-2" data-id="{{ $data->id }}">
                            </div>
                        </td>
                        <td>
                            @include('view_table.datetime', ['value' => @$data->created_at])
                        </td>
                        @php
                            $htable = \DB::table('n_tables')->where('name', $data->table_map)->first();
                        @endphp
                        <td>
                            <div>
                                Nhân viên <strong class="color_green">{{ getFieldDataById('name', 'n_users', $data->user) }}</strong> đã 
                                <strong class="color_red">{{ mb_strtolower(getActionByKey($data->action)) }}</strong> 1 {{ @$htable->note }}
                            </div>
                        </td>
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
@endsection