<div class="position-relative table_base_view">
    <table class="table table-bordered mb-2 ">
        <thead class="theader">
            <tr>
                <th class="font-bold fs-13">Ngày chứng từ</th>
                <th class="font-bold fs-13">Khách hàng</th>
                <th class="font-bold fs-13">Người đại diện</th>
                <th class="font-bold fs-13">Tiền hàng</th>
                <th class="font-bold fs-13">Thanh toán</th> 
                <th class="font-bold fs-13">Tổng nợ</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($data_tables as $key => $data)
                <tr>
                    <td>
                        {{ $range_time }}
                    </td>
                    <td>
                        {{ getFieldDataById('name', 'customers', $data->customer) }}
                    </td>
                    <td>
                        {{ getFieldDataById('name', 'represents', $data->represent) }}
                    </td>
                    @php
                        $total = (float) $data->total;
                        $advance = (float) $data->advance;
                        $rest = $total - $advance;
                    @endphp
                    <td>
                        {{ number_format($total) }}đ
                    </td>
                    <td>
                        {{ number_format($advance) }}đ
                    </td>
                    <td>
                        {{ number_format($rest) }}đ
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
                    <p class="font_bold color_green">Tổng tiền hàng đã lấy & tiền đã thanh toán</p>
                </td>   
                <td>
                    {{ number_format($total_amount) }}đ
                </td>
                <td colspan="1">
                    {{ number_format($total_advance) }}đ
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <p class="font_bold color_red">{{ $total_rest > 0 ? 'Khách hàng đang nợ' : 'Đang nợ khách ' }}</p>
                </td>
                <td colspan="2">
                    <p class="font_bold color_red text-center">{{ number_format(abs($total_rest)) }}đ</p>
                </td>
            </tr>
        </tfoot>
    </table>
</div>