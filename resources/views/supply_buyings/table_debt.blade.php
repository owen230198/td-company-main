<div class="position-relative table_base_view">
    <table class="table table-bordered mb-2 ">
        <thead class="theader">
            <tr>
                <th class="font-bold fs-13" rowspan="2">Ngày chứng từ</th>
                <th class="font-bold fs-13" rowspan="2">Số CT</th>
                <th class="font-bold fs-13" rowspan="2">NCC</th>
                {{-- <th class="font-bold fs-13">Diễn giải</th> --}}
                <th class="font-bold fs-13" colspan="4">Hàng hóa</th>
                <th class="font-bold fs-13" rowspan="2">Tiền hàng</th>
                <th class="font-bold fs-13" rowspan="2">Thanh toán</th> 
                <th class="font-bold fs-13" rowspan="2">Chức năng</th>   
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
                    {{-- <td>
                        {{ $data->name }}
                    </td> --}}
                    @if (count($supplies) > 0)
                        @php $firstSupply = array_shift($supplies); @endphp
                        @include('supply_buyings.supply_td', ['data' => $firstSupply])
                    @else
                        <td colspan="4" class="text-center">Không có hàng hóa</td>
                    @endif
                    <td rowspan="{{ $rowspan }}" class="ver_align_top">
                        {{ number_format($data->total) }}đ
                    </td>
                    <td rowspan="{{ $rowspan }}" class="ver_align_top">
                        {{ number_format($data->advance) }}đ
                    </td>
                    <td rowspan="{{ $rowspan }}" class="ver_align_top">
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
                    <p class="font_bold color_green">Tổng tiền hàng đã lấy & tiền đã thanh toán</p>
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
                    <p class="font_bold color_red">{{ $total_rest > 0 ? 'Đang nợ nhà cung cấp ' : 'Đang dư nợ nhà cung cấp' }}</p>
                </td>
                <td colspan="3">
                    <p class="font_bold color_red text-center">{{ number_format(abs($total_rest)) }}đ</p>
                </td>
            </tr>
        </tfoot>
    </table>
</div>