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
                <th class="font-bold fs-13">Tên lệnh</th>
                <th class="font-bold fs-13">Các sản phẩm được in ghép trong cùng lệnh in</th>
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
                            <span>{{ $data->code }}</span>    
                        </td>
                        <td>
                            <span>{{ $data->name }}</span>      
                        </td>
                        <td>
                            <div class="list_child_print_join">
                                @php
                                    $arrwher = ['handle_type' => \TDConst::JOIN_HANDLE, 'parent' => $data->id];
                                    $childs = \DB::table('papers')->where($arrwher)->get();
                                @endphp
                                @foreach ($childs as $item)
                                    <div class="d-flex align-items-center child_print_join justify-content-between mb-2">
                                        <p class="mr-2">{{ $item->code.' - '.$item->name }}</p>
                                        <div>
                                            <a href="{{ url('print-data/papers/'.$data->id) }}" target="_blank" class="main_button color_white bg_green border_green radius_5 font_bold sooth">
                                                <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i> In lệnh
                                            </a>
                                        </div>
                                    </div>   
                                @endforeach
                            </div>     
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection