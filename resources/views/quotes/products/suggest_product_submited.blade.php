@if ($list_data->isEmpty())
    <p class="fs-15 font-italic color_red text-center mb-3">Chưa có sản phẩm cùng kích thước khuôn đã sản xuất !</p>
@else
    <div class="table_base_view position-relative mb-3">
        <table class="table table-bordered table_main">
            <theader>
                <tr>
                    <th class="font-bold fs-13 text-center"><span>#</span></th>
                    <th class="font-bold fs-13">Mã Đơn</th>
                    <th class="font-bold fs-13">Sản phẩm</th>
                    <th class="font-bold fs-13">Kích thước</th>  
                    <th class="font-bold fs-13">Phụ trách</th> 
                    <th class="font-bold fs-13">File khuôn (kinh doanh)</th> 
                    <th class="font-bold fs-13">File khuôn (kỹ thuật)</th>     
                </tr>
            </theader>
            <tbody>
                @foreach ($list_data as $key => $data)
                    <tr>
                        <td class="text-center"><span>{{ $key + 1 }}</span></td>
                        <td>{{ $data->code }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ getSizeTitleProduct($data) }}</td>
                        <td>{{ getFieldDataById('name', 'n_users', $data->created_by) }}</td>
                        <td>
                            @include('view_table.file', ['value' => $data->sale_shape_file])
                        </td>
                        <td>
                            @include('view_table.file', ['value' => $data->tech_shape_file])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif