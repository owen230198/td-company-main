@php
    $customer = getFieldDataById('name', 'customers', $data_search['customer']);   
    if (!empty($data_search['represent'])) {
        $represent = getDetailDataObject('represents', $data_search['represent']);
        $customer .= ', ' .$represent->name . ': ' . $represent->phone;
    }
@endphp
<div class="position-relative table_base_view">
    <table class="table table-bordered mb-2 ">
        <thead class="theader">
            <tr>
                <th colspan="8">
                    <h3>{{ mb_strtoupper($title) }}</h3>
                </th>
            </tr>
            <tr>
                <th colspan="8">
                    <h3>Tên khách hàng : {{ $customer }}</h3>
                </th>
                
            </tr>
            <tr>
                <th class="font-bold fs-13">Ngày chứng từ</th>
                <th class="font-bold fs-13">Số CT</th>
                <th class="font-bold fs-13">Tên hàng</th> 
                <th class="font-bold fs-13">Số lượng</th> 
                <th class="font-bold fs-13">Đơn giá</th>  
                <th class="font-bold fs-13">Thành tiền</th>   
                <th class="font-bold fs-13">Tiền hàng</th>
                <th class="font-bold fs-13">Thanh toán</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <strong>Nợ cũ</strong>
                </td>
                <td colspan="2">
                    {{ !empty($is_export) ? (float) $old_rest : number_format($old_rest) }}
                </td>
            </tr>
            @foreach ($data_tables as $key => $data)
                @php
                    $objects = !empty($data->object) ? json_decode($data->object, true) : [];
                    $rowspan = count($objects) > 0 ? count($objects) : 1;     
                @endphp
                <tr>
                    <td rowspan="{{ $rowspan }}">
                        @include('view_table.datetime', ['value' => $data->created_at])
                    </td>
                    <td rowspan="{{ $rowspan }}">
                        {{ $data->code }}
                    </td>
                    @if (count($objects) > 0)
                        @php 
                            $first_obj = array_shift($objects); 
                        @endphp
                        @include('c_orders.view_types.product_td', ['object' => $first_obj, 'is_export' => true])
                    @else
                        <td colspan="1">{{ $data->note }}</td>
                        <td colspan="3"></td>
                    @endif
                    <td rowspan="{{ $rowspan }}">
                        {{ $data->total }}
                    </td>
                    <td rowspan="{{ $rowspan }}">
                        {{ $data->advance }}
                    </td>
                </tr>
                @foreach ($objects as $index => $object)
                    <tr>
                        @include('c_orders.view_types.product_td', ['object' => $object, 'is_export' => true])
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">
                    <p class="font_bold color_green">{{ 'Tổng tiền hàng đã lấy & tiền đã thanh toán' }}</p>
                </td>   
                <td>
                    {{ $total_amount }}
                </td>
                <td>
                    {{ $total_advance }}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <p class="font_bold color_red">Số tiền còn nợ</p>
                </td>
                <td colspan="2">
                    <p class="font_bold color_red text-center">{{ $total_rest }}</p>
                </td>
            </tr>
        </tfoot>
    </table>
</div>