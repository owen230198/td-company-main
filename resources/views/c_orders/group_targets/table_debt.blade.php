<div class="position-relative table_base_view">
    <table class="table table-bordered mb-2 ">
        <thead class="theader">
            @if (!empty($is_export))
                <tr>
                    <th colspan="6">
                        <h3>{{ $title}}</h3>
                    </th>
                </tr>
                <tr>
                    <th colspan="6">
                        Người xuất : {{ \User::getCurrent('name') }}
                    </th>
                </tr>
            @endif
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
            <tr>
                <td colspan="3">
                    <strong>Nợ cũ</strong>
                </td>
                <td>
                    {{ !empty($is_export) ? (float) $old_total : number_format($old_total) }}
                </td>
                <td>
                    {{ !empty($is_export) ? (float) $old_advance : number_format($old_advance) }}
                </td>
                <td>
                    @php
                        $old_rest = $old_total - $old_advance;
                    @endphp
                    {{ !empty($is_export) ? (float) $old_rest : number_format($old_rest) }}
                </td>
            </tr>
            @foreach ($data_tables as $key => $data)
                <tr>
                    <td>
                        {{ $range_time }}
                    </td>
                    <td>
                        @if (!empty($is_export))
                            <p>{{ getFieldDataById('name', 'customers', $data->customer) }}</p>
                        @else
                            <a href="{{ url()->full().'&customer='.$data->customer }}">
                                {{ getFieldDataById('name', 'customers', $data->customer) }}
                            </a>
                        @endif
                    </td>
                    <td>
                        @php
                            $represent = getDetailDataObject('represents', $data->represent);
                        @endphp
                        {{ $represent->name . ' - ' . $represent->phone }}
                    </td>
                    @php
                        $total = (float) $data->total;
                        $advance = (float) $data->advance;
                        $rest = $total - $advance;
                    @endphp
                    <td>
                        {{ number_format($total) }}
                    </td>
                    <td>
                        {{ number_format($advance) }}
                    </td>
                    <td>
                        {{ number_format($rest) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
                    <p class="font_bold color_green">{{ 'Tổng tiền hàng đã lấy & tiền đã thanh toán' }}</p>
                </td>   
                <td>
                    {{ number_format($total_amount) }}
                </td>
                <td colspan="1">
                    {{ number_format($total_advance) }}
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <p class="font_bold color_red">Số tiền còn nợ</p>
                </td>
                <td colspan="2">
                    <p class="font_bold color_red text-center">{{ number_format($total_rest) }}</p>
                </td>
            </tr>
        </tfoot>
    </table>
</div>