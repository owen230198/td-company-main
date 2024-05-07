@php
    $num = 1;
    $arr_time = explode("-", $data_item['created_at']);
@endphp
<div class="text-center my-4">
    <h3 class="fs-14 text-uppercase text-center font_bold">
        <strong>{{ $title }}</strong>
    </h3>
    <p class="font_bold font-italic">
        Mặt hàng : <strong class="color_red">{{ getFieldDataById('name', $data_item['table'], $data_item['target']) }}</strong>,
        Từ ngày : <strong class="color_red">{{ $arr_time[0] }}</strong>
        Đến ngày : <strong class="color_red">{{ $arr_time[1] }}</strong>
    </p>
</div>
<div class="position-relative table_inventory">
    <table class="table table-bordered mb-2 ">
        <thead class="theader">
            <tr>
                <th class="font-bold fs-13 text-center" rowspan = "2">
                    <div class="d-flex align-items-center justify-content-center">
                        <span>#</span>
                    </div>
                </th>
                <th class="font-bold fs-13" rowspan="2">Tên hàng</th>
                <th class="font-bold fs-13" rowspan="2">NCC</th>
                <th class="font-bold fs-13" rowspan="2">Ngày chứng từ</th>
                <th class="font-bold fs-13" rowspan="2">Diễn giải</th>
                <th class="font-bold fs-13" rowspan="2">ĐVT</th>
                <th class="font-bold fs-13" rowspan="2">Đơn giá</th>
                <th class="font-bold fs-13" rowspan="1" colspan="1">Nhập</th>
                <th class="font-bold fs-13" rowspan="1" colspan="1">Xuất</th>
                <th class="font-bold fs-13" rowspan="1" colspan="1">Tồn</th>
                <th class="font-bold fs-13" rowspan="2">Đối tượng THCP</th>
                <th class="font-bold fs-13" rowspan="2">Phụ trách</th>
            </tr>
            <tr>
                <th class="font-bold fs-13">Số lượng</th>
                <th class="font-bold fs-13">Số lượng</th>
                <th class="font-bold fs-13">Số lượng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list_data as $data)
                <tr>
                    <td class="text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <span>{{ $num ++ }}</span>
                        </div>
                    </td>
                    <td>
                        {{ $data['name'] }}
                    </td>
                    <td>
                        {{ getFieldDataById('name', 'warehouse_providers', $data['provider']) }}
                    </td>
                    <td>
                        @include('view_table.datetime', ['value' => $data['created_at']])
                    </td>
                    <td>
                        {{ $data['note'] }}
                    </td>
                    <td>
                        {{ getUnitWarehouseItem($data['unit']) }}
                    </td>
                    <td>
                        {{ $data['price'] }}đ
                    </td>
                    <td>
                        {{ $data['imported'] }}
                    </td>
                    <td>
                        {{ $data['exported'] }}
                    </td>
                    <td>
                        {{ $data['inventory'] }}
                    </td>
                    <td>
                        {{ getFieldDataById('name', 'products', $data['product']) }}
                    </td>
                    <td>
                        {{ getFieldDataById('name', 'n_users', $data['created_by']) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-center">
                    Số dòng {{ $count }}
                </td>   
                <td></td> 
                <td></td> 
                <td></td> 
                <td></td> 
                <td></td> 
                <td></td>
                <td class="color_red font_bold">
                    {{ $imported }}
                </td> 
                <td class="color_red font_bold">
                    {{ $exported }}
                </td> 
                <td class="color_red font_bold">
                    {{ $inventory }}
                </td>
                <td></td>  
                <td></td>  
            </tr>
        </tfoot>
    </table>
</div>