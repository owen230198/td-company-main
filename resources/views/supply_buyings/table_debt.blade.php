<div class="position-relative table_base_view">
    <table class="table table-bordered mb-2 ">
        <thead class="theader">
            <tr>
                <th class="font-bold fs-13">Ngày chứng từ</th>
                <th class="font-bold fs-13">Số CT</th>
                <th class="font-bold fs-13">NCC</th>
                <th class="font-bold fs-13">Diễn giải</th>
                <th class="font-bold fs-13">Hàng hóa</th>
                <th class="font-bold fs-13">Tiền hàng</th>
                <th class="font-bold fs-13">Thanh toán</th> 
                <th class="font-bold fs-13">Chức năng</th>   
            </tr>
        </thead>
        <tbody>
            @foreach ($data_tables as $key => $data)
                <tr>
                    <td>
                        @include('view_table.datetime', ['value' => $data->created_at])
                    </td>
                    <td>
                        {{ $data->code }}
                    </td>
                    <td>
                        {{ getFieldDataById('name', 'warehouse_providers', $data->provider) }}
                    </td>
                    <td>
                        {{ $data->name }}
                    </td>
                    <td class="text-center">
                        @include('view_table.json_supply')
                    </td>
                    <td>
                        {{ number_format($data->total) }}đ
                    </td>
                    <td>
                        {{ number_format($data->advance) }}đ
                    </td>
                    <td>
                        <div class="d-flex align-items-center list_table_func justify-content-center">
                            @if (@$data->rest > 0)
                                <button type="button" title="Thanh toán" 
                                data-src="{{ url('ajax-respone/confirmPaymentSelling?id='.$data->id.'&nosidebar=1') }}" 
                                class="load_view_popup btn btn-primary mr-2 mb-2 table-btn" data-toggle="modal" data-target="#actionModal">
                                    <i class="fa fa-credit-card-alt fs-14" aria-hidden="true"></i>
                                </button>
                            @endif
                            @include('table.btn_remove')
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <p class="font_bold color_green">Tổng tiền hàng đã lấy & tiền đã thanh toán</p>
                </td>   
                <td>
                    {{ number_format($total_amount) }}đ
                </td>
                <td colspan="3">
                    {{ number_format($total_advance) }}đ
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <p class="font_bold color_red">{{ $total_rest > 0 ? 'Đang nợ nhà cung cấp ' : 'Đang dư nợ nhà cung cấp' }}</p>
                </td>
                <td colspan="3">
                    <p class="font_bold color_red text-center">{{ number_format(abs($total_rest)) }}đ</p>
                </td>
            </tr>
        </tfoot>
    </table>
</div>