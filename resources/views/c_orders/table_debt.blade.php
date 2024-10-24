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
                <th class="font-bold fs-13">Số lượng</th> 
                <th class="font-bold fs-13">Đơn giá</th>  
                <th class="font-bold fs-13">Thành tiền</th>    
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7">
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
                    <td rowspan="{{ $rowspan }}">
                        @php
                            $customer_name = getFieldDataById('name', 'customers', $data->customer);
                            $represent = getDetailDataObject('represents', $data->represent);
                        @endphp
                        @if (!empty($is_export))
                            <p>- {{ $customer_name }}</p>
                        @else
                            <a class="d-block" href="{{ url()->full().'&customer='.$data->customer }}">- {{ $customer_name }}</a>
                        @endif
                        <p class="mt-1">- {{ $represent->name .' - '.$represent->phone }}</p>
                    </td>
                    @if (count($objects) > 0)
                        @php $first_obj = array_shift($objects); @endphp
                        <td>{{ @$first_obj['name'] ?? getFieldDataById('name', 'product_warehouses', @$first_obj['id']) }}</td>
                        <td>{{ $first_obj['qty'] }}</td>
                        <td>{{ !empty($is_export) ? (float) $first_obj['price'] : number_format($first_obj['price']) }}</td>
                        <td>{{ !empty($is_export) ? (float) $first_obj['total'] : number_format($first_obj['total']) }}</td>
                    @else
                        <td colspan="4">{{ $data->note }}</td>
                    @endif
                    <td rowspan="{{ $rowspan }}">
                        {{ !empty($is_export) ? (float) $data->total : number_format($data->total) }}
                    </td>
                    <td rowspan="{{ $rowspan }}">
                        {{ !empty($is_export) ? (float) $data->advance : number_format($data->advance) }}
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
                        <td>{{ @$object['name'] ?? getFieldDataById('name', 'product_warehouses', @$object['id']) }}</td>
                        <td>{{ $object['qty'] }}</td>
                        <td>{{ !empty($is_export) ? (float) $object['price'] : number_format($object['price']) }}</td>
                        <td>{{ !empty($is_export) ? (float) $object['total'] : number_format($object['total']) }}</td>
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
                    {{ !empty($is_export) ? (float) $total_amount : number_format($total_amount) }}
                </td>
                <td>
                    {{ !empty($is_export) ? (float) $total_advance : number_format($total_advance) }}
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <p class="font_bold color_red">Số tiền còn nợ</p>
                </td>
                <td colspan="2">
                    <p class="font_bold color_red text-center">{{ !empty($is_export) ? (float) $total_rest : number_format($total_rest) }}</p>
                </td>
            </tr>
        </tfoot>
    </table>
</div>