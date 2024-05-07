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
                <th class="font-bold fs-13" rowspan="2">ĐVT</th>
                <th class="font-bold fs-13" rowspan="1" colspan="1">Đầu kỳ</th>
                <th class="font-bold fs-13" rowspan="1" colspan="1">Nhập kho</th>
                <th class="font-bold fs-13" rowspan="1" colspan="1">Xuất kho</th>
                <th class="font-bold fs-13" rowspan="1" colspan="1">Cuối kỳ</th>
            </tr>
            <tr>
                <th class="font-bold fs-13">Số lượng</th>
                <th class="font-bold fs-13">Số lượng</th>
                <th class="font-bold fs-13">Số lượng</th>
                <th class="font-bold fs-13">Số lượng</th>
            </tr>
        </thead>
        <tbody>
            @php
                $num = 1
            @endphp
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
                        {{ getUnitWarehouseItem($data['unit']) }}
                    </td>
                    <td>
                        {{ $data['ex_inventory'] }}
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
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-center">
                    Số dòng {{ $count }}
                </td>   
                <td>
                    
                </td> 
                <td>
                    
                </td> 
                <td>
                    {{ $ex_inventory }}
                </td> 
                <td>
                    {{ $imported }}
                </td> 
                <td>
                    {{ $exported }}
                </td> 
                <td>
                    {{ $inventory }}
                </td> 
            </tr>
        </tfoot>
    </table>
</div>