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
                <th class="font-bold fs-13" rowspan="2">Khách hàng</th>
                <th class="font-bold fs-13" rowspan="1" colspan="4">Hàng hóa</th>
                <th class="font-bold fs-13" rowspan="2">Tiền hàng</th>
                <th class="font-bold fs-13" rowspan="2">Thanh toán</th> 
                @if (empty($is_export))
                    <th class="font-bold fs-13" rowspan="2">Chức năng</th>  
                @endif 
            </tr>
            <tr>
                <th class="font-bold fs-13">Tên hàng</th> 
                <th class="font-bold fs-13">SL</th> 
                <th class="font-bold fs-13">ĐG</th>  
                <th class="font-bold fs-13">TT</th>    
            </tr>
        </thead>
        <tbody>
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
                    <td rowspan="{{ $rowspan }}">
                        @php
                            $customer_name = getFieldDataById('name', 'customers', $data->customer);
                            $represent = getDetailDataObject('represents', $data->represent);
                        @endphp
                        @if ($is_export)
                            <p>- {{ $customer_name }}</p>
                        @else
                        <a class="d-block" href="{{ url()->full().'&customer='.$data->customer }}">
                        </a>
                        @endif
                        <p class="mt-1">- {{ $represent->name .' - '.$represent->phone }}</p>
                    </td>
                    @if (count($objects) > 0)
                        @php $first_obj = array_shift($objects); @endphp
                        <td>{{ $first_obj['name'] }}</td>
                        <td>{{ $first_obj['qty'] }}</td>
                        <td>{{ number_format($first_obj['price']) }}đ</td>
                        <td>{{ number_format($first_obj['total']) }}đ</td>
                    @else
                        <td colspan="4">{{ $data->note }}</td>
                    @endif
                    <td rowspan="{{ $rowspan }}">
                        {{ number_format($data->total) }}đ
                    </td>
                    <td rowspan="{{ $rowspan }}">
                        {{ number_format($data->advance) }}đ
                    </td>
                    @if (empty($is_export))
                        <td rowspan="{{ $rowspan }}">
                            <div class="d-flex align-items-center list_table_func justify-content-center">
                                @if (in_array(@$data->type, \App\Models\COrder::TYPE_PAYMENT) && @$data->rest > 0)
                                    <button type="button" title="Thanh toán" 
                                    data-src="{{ url('ajax-respone/confirmPaymentSelling?id='.$data->id.'&nosidebar=1') }}" 
                                    class="load_view_popup btn btn-primary mr-2 mb-2 table-btn" data-toggle="modal" data-target="#actionModal">
                                        <i class="fa fa-credit-card-alt fs-14" aria-hidden="true"></i>
                                    </button>
                                @endif
                                <button type="button" title="Sửa" 
                                data-src="{{ url('update/c_orders/'.$data->id.'?nosidebar=1') }}" 
                                class="load_view_popup btn btn-primary mr-2 mb-2 table-btn" data-toggle="modal" data-target="#actionModal">
                                    <i class="fa fa-pencil-square-o fs-14" aria-hidden="true"></i>
                                </button>
                                @include('table.btn_remove')
                            </div>
                        </td>
                    @endif
                </tr>
                @foreach ($objects as $index => $object)
                    <tr>
                        <td>{{ $object['name'] }}</td>
                        <td>{{ $object['qty'] }}</td>
                        <td>{{ number_format($object['price']) }}đ</td>
                        <td>{{ number_format($object['total']) }}đ</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8">
                    <p class="font_bold color_green">{{ 'Tổng tiền hàng đã lấy & tiền đã thanh toán' }}</p>
                </td>   
                <td>
                    {{ number_format($total_amount) }}đ
                </td>
                <td colspan="6">
                    {{ number_format($total_advance) }}đ
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <p class="font_bold color_red">Số tiền còn nợ</p>
                </td>
                <td colspan="3">
                    <p class="font_bold color_red text-center">{{ number_format($total_rest) }}đ</p>
                </td>
            </tr>
        </tfoot>
    </table>
</div>