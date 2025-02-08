<div class="position-relative table_base_view">
    <table class="table table-bordered mb-2 ">
        <thead class="theader">
            @if (!empty($is_export))
                <tr>
                    <th colspan="7">
                        <h3>{{ $title}}</h3>
                    </th>
                </tr>
                <tr>
                    <th colspan="7">
                        Người xuất : {{ \User::getCurrent('name') }}
                    </th>
                </tr>
            @endif
            <tr>
                <th class="font-bold fs-13" rowspan="2">Ngày chứng từ</th>
                <th class="font-bold fs-13" rowspan="2">Số CT</th>
                <th class="font-bold fs-13" rowspan="2">NCC</th>
                <th class="font-bold fs-13" colspan="4">Hàng hóa</th>
                <th class="font-bold fs-13" rowspan="2">Tiền hàng</th>
                <th class="font-bold fs-13" rowspan="2">Thanh toán</th>  
            </tr>
            <tr>
                <th class="font-bold fs-13">Tên hàng</th>
                <th class="font-bold fs-13">Số lượng</th>
                <th class="font-bold fs-13">Giá</th> 
                <th class="font-bold fs-13">TT</th>   
            </tr>
        </thead>
        <tbody>
            @foreach ($data_tables as $key => $data)
                @php
                    $supplies = !empty($data->supply) ? json_decode($data->supply) : [];
                    $rowspan = !empty($supplies) ? count($supplies) : 1;
                @endphp
                <tr>
                    <td rowspan="{{ $rowspan }}" class="ver_align_top">
                        @include('view_table.datetime', ['value' => $data->created_at])
                    </td>
                    <td rowspan="{{ $rowspan }}" class="ver_align_top">
                        {{ $data->code }}
                    </td>
                    <td rowspan="{{ $rowspan }}" class="ver_align_top">
                        {{ getFieldDataById('name', 'warehouse_providers', $data->provider) }}
                    </td>
                    @if (count($supplies) > 0)
                        @php $firstSupply = array_shift($supplies); @endphp
                        @include('supply_buyings.supply_td', ['data' => $firstSupply])
                    @else
                        <td colspan="4" class="text-center">{{ @$data->note }}</td>
                    @endif
                    <td rowspan="{{ $rowspan }}" class="ver_align_top">
                        {{ number_format($data->total) }}đ
                    </td>
                    <td rowspan="{{ $rowspan }}" class="ver_align_top">
                        {{ number_format($data->advance) }}đ
                    </td>
                </tr>
                @foreach ($supplies as $supply)
                    <tr>
                        @include('supply_buyings.supply_td', ['data' => $supply])
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7">
                    <p class="font_bold color_green">{{ 'Tổng tiền hàng đã lấy & tiền đã thanh toán' }}</p>
                </td>   
                <td>
                    {{ number_format($total_amount) }}đ
                </td>
                <td colspan="2">
                    {{ number_format($total_advance) }}đ
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <p class="font_bold color_red">Số tiền còn nợ</p>
                </td>
                <td colspan="3">
                    <p class="font_bold color_red text-center">{{ number_format($total_rest) }}đ</p>
                </td>
            </tr>
        </tfoot>
    </table>
</div>