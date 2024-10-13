@php
    $num = 1;
    $arr_time = explode("-", $range_time);
    $ex_inventory = 0;
    $imported = 0;
    $exported = 0;
    $inventory = 0;
    $table_export = !empty($table_export);
@endphp
<div class="position-relative table_inventory">
    <table class="table table-bordered mb-2 ">
        <thead class="theader">
            <tr>
                <th colspan="{{ $table_export ? 8 : 9 }}">
                    <h3 class="fs-14 text-uppercase border_top_eb text-center font_bold title" style="text-align: center">
                       {{ $title}}
                    </h3>
                </th>
            </tr>
            <tr>
                <th colspan="{{ $table_export ? 8 : 9 }}">
                    Từ ngày : {{ $arr_time[0] }} đến ngày : {{ $arr_time[1] }}
                </th> 
            </tr>
            <tr>
                <th class="font-bold fs-13 text-center" rowspan = "2">
                    <div class="d-flex align-items-center justify-content-center">
                        <span>STT</span>
                    </div>
                </th>
                <th class="font-bold fs-13" rowspan="2">Tên hàng</th>
                <th class="font-bold fs-13" rowspan="2">ĐVT</th>
                <th class="font-bold fs-13" rowspan="2">Địa điểm kho</th>
                <th class="font-bold fs-13" rowspan="1" colspan="1">Đầu kỳ</th>
                <th class="font-bold fs-13" rowspan="1" colspan="1">Nhập kho</th>
                <th class="font-bold fs-13" rowspan="1" colspan="1">Xuất kho</th>
                <th class="font-bold fs-13" rowspan="1" colspan="1">Cuối kỳ</th>
                @if (!$table_export)
                    <th class="font-bold fs-13" rowspan="2">Xem</th>  
                @endif
            </tr>
            <tr>
                <th class="font-bold fs-13">Số lượng</th>
                <th class="font-bold fs-13">Số lượng</th>
                <th class="font-bold fs-13">Số lượng</th>
                <th class="font-bold fs-13">Số lượng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list_data as $data)
                @php
                    $obj_item = getObjectDataByWhere('product_histories', ['target' => $data->id]);
                    $link_detail = url('product-inventory-detail?target='.$data->id);
                    if (!empty($range_time)) {
                        $link_detail .= '&created_at='.$range_time;
                        $where_time = getDateRangeToQuery($range_time);
                        $obj_item = $obj_item->whereBetween('created_at', $where_time);
                    }
                    $item = $obj_item->get()->sortBy([['created_at', 'desc'],['id', 'desc']]);
                    $first = $item->first();
                    $last = $item->last();
                    $data_ex_inventory = !empty($last->ex_inventory) ? $last->ex_inventory : 0;
                    $ex_inventory += $data_ex_inventory;
                    $data_imported = $item->sum('imported');
                    $imported += $data_imported;
                    $data_exported = $item->sum('exported');
                    $exported += $data_exported;
                    $data_inventory = !empty($first->inventory) ? $first->inventory : 0;
                    $inventory += $data_inventory;
                @endphp
                <tr>
                    <td class="text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <span>{{ $num ++ }}</span>
                        </div>
                    </td>
                    <td>
                        {{ $data->name }}
                    </td>
                    <td>
                        {{ getUnitProductWarehouse($data->unit) }}
                    </td>
                    <td>
                        {{ getFieldDataById('name', 'supply_extends', $data->warehouse_type) }}
                    </td>
                    <td>
                        {{ $data_ex_inventory }}
                    </td>
                    <td>
                        {{ $data_imported }}
                    </td>
                    <td>
                        {{ $data_exported }}
                    </td>
                    <td>
                        {{ $data_inventory }}
                    </td>
                    @if (!$table_export)
                        <td>
                            <div class="list_table_func justify-content-center d-flex">
                                <button class="table-btn load_view_popup" data-toggle="modal" data-target="#actionModal" 
                                data-src="{{ $link_detail }}">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>    
                        </td>   
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-center">
                    @if (!$table_export)
                        Số dòng {{ $count }}
                    @endif
                </td>   
                <td></td> 
                <td></td> 
                <td></td> 
                <td class="color_red font_bold">
                    {{ $ex_inventory }}
                </td> 
                <td class="color_red font_bold">
                    {{ $imported }}
                </td> 
                <td class="color_red font_bold">
                    {{ $exported }}
                </td> 
                <td class="color_red font_bold">
                    {{ $inventory }}
                </td>
                @if (!$table_export)
                    <td>
                        
                    </td>
                @endif  
            </tr>
        </tfoot>
    </table>
</div>