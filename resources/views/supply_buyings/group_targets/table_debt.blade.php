<div class="position-relative table_base_view">
    <table class="table table-bordered mb-2 ">
        <thead class="theader">
            @if (!empty($is_export))
                <tr>
                    <th colspan="4">
                        <h3>{{ $title}}</h3>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        Người xuất : {{ \User::getCurrent('name') }}
                    </th>
                </tr>
            @endif
            <tr>
                <th class="font-bold fs-13">Ngày chứng từ</th>
                <th class="font-bold fs-13">Nhà cung cấp</th>
                <th class="font-bold fs-13">Tiền hàng</th>
                <th class="font-bold fs-13">Thanh toán</th>  
            </tr>
        </thead>
        <tbody>
            @foreach ($data_tables as $key => $data)
                <tr>
                    <td>
                        {{ $range_time }}
                    </td>
                    <td>
                        {{ getFieldDataById('name', 'warehouse_providers', $data->provider) }}
                    </td>
                    <td>
                        {{ number_format($data->total) }}đ
                    </td>
                    <td>
                        {{ number_format($data->advance) }}đ
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <p class="font_bold color_green">{{ 'Tổng tiền hàng đã lấy & tiền đã thanh toán' }}</p>
                </td>   
                <td>
                    {{ number_format($total_amount) }}đ
                </td>
                <td colspan="1">
                    {{ number_format($total_advance) }}đ
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="font_bold color_red">Số tiền còn nợ</p>
                </td>
                <td colspan="2">
                    <p class="font_bold color_red text-center">{{ number_format(abs($total_rest)) }}đ</p>
                </td>
            </tr>
        </tfoot>
    </table>
</div>