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
                <th class="font-bold fs-13">Mã lệnh</th>
                <th class="font-bold fs-13">Các sản phẩm được in ghép trong cùng lệnh in</th>
                <th class="font-bold fs-13 ">Chức năng</th>
            </tr>
            <tbody>
                @foreach ($data_tables as $key => $data)
                    <tr>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center">
                                <span>{{ $key + 1 }}</span>
                            </div>
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
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