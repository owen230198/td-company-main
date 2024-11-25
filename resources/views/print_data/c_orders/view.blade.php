@extends('print_data.index')
@section('content')
    <div class="fs-18">
        @php
            $data_represent = getDetailDataById('Represent', $data_item->represent);  
            $data_customer = getDetailDataById('Customer', $data_item->customer);     
        @endphp
        <div class="_print_order_header">
            <div class="row">
                <div class="col-6">
                    <div class="col-6">
                        <a href="{{ url('') }}" class="header_printdata_logo d-block text-right">
                            <img src="{{ url('frontend/admin/images/td_logo.png') }}" alt="logo">   
                        </a>
                    </div>

                </div>
                <div class="col-5">
                    <ul class="header_print_data_info">
                        <li class="d-flex align-items-center"><span class="w_66 d-block">VPGD</span>     : {{ getDataConfig('QuoteConfig', 'OFFICE_ADD') }}</li>
                        <li class="d-flex align-items-center"><span class="w_66 d-block">Tel</span>      : {{ getDataConfig('QuoteConfig', 'OFFICE_PHONE') }}</li>
                        <li class="d-flex align-items-center"><span class="w_66 d-block">Email</span>    : {{ getDataConfig('QuoteConfig', 'OFFICE_EMAIL') }}</li>
                        <li class="d-flex align-items-center"><span class="w_66 d-block">Website</span>  : {{ getDataConfig('QuoteConfig', 'SITE') }}</li>
                    </ul>
                </div>
                @include('print_data.orders.customer_info')
            </div>
        </div>
        @php
            $products = json_decode($data_item->object);
            $product_cost = 0;
        @endphp
        <div class="print_product_table mt-3">
            <table class="table table-bordered mb-1">
                <thead>
                    <tr>
                        <th scope="col" class="num_td">STT</th>
                        <th scope="col" class="code_td">Mã SP</th>
                        <th scope="col">Tên Sản phẩm</th>
                        <th scope="col" class="qty_td">Số lượng</th>
                        <th scope="col" class="code_td">Đơn giá</th>
                        <th scope="col" class="code_td">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($products as $key => $product)
                        <tr>
                            @php
                                $num = $key + 1;
                                $obj = getDetailDataById('ProductWarehouse', $product->id);
                                $product_cost += $product->total;
                                $other_price_obj = !empty($product->other_price) ? collect($product->other_price) : collect(new \stdClass());
                                $other_price = $other_price_obj->sum('price');
                                $product_qty = $product->qty;
                                $other_price_total = $other_price * $product_qty;
                            @endphp
                            <td scope="row" class="num_td">{{ $num }}</td>
                            <td class="code_td">{{ $obj->code }}</td>
                            <td>
                                <p class="product_name_td">{{ @$product->name ?? $obj->name }}</p>
                            </td>
                            <td class="qty_td">{{ $product_qty }}</td>
                            <td class="text-right code_td">{{ number_format($product->price) }}</td>
                            <td class="text-right code_td">{{ number_format($product->total - $other_price_total) }}</td>
                        </tr> 
                        @if (!empty($product->other_price))
                            @foreach ($product->other_price as $other_price)
                                @if (!empty($other_price->name) && !empty($other_price->price))
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            {{ $other_price->name }}
                                        </td>
                                        <td>
                                            {{ $product_qty }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($other_price->price) }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($product_qty * $other_price->price) }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach    
                        @endif   
                    @endforeach
                    <tr class="bg_pink">
                        <td colspan="5"><p class="text-right mr-3">Thành tiền</p></td>
                        <td class="text-right"><span class="font_bold">{{ number_format($product_cost) }}</span></td>
                    </tr>
                    @if ((float) @$data_item->other_price != 0)
                        <tr class="bg_pink">
                            <td colspan="5"><p class="text-right mr-3">Vận chuyển</p></td>
                            <td class="text-right"><span class="font_bold">{{ number_format(@$data_item->other_price) }}</span></td>
                        </tr>   
                    @endif
                    @if ((float) @$data_item->profit != 0)
                        <tr class="bg_pink">
                            <td colspan="5"><p class="text-right mr-3">VAT</p></td>
                            <td class="text-right"><span class="font_bold">{{ @$data_item->profit }} %</span></td>
                        </tr>   
                    @endif
                    @if ((float) @$data_item->profit != 0 || (float) @$data_item->other_price != 0)
                        <tr class="bg_pink">
                            <td colspan="5"><p class="text-right mr-3">Tổng chi phí</p></td>
                            <td class="text-right"><span class="font_bold">{{ number_format($data_item->total) }}</span></td>
                        </tr>   
                    @endif
                    @if ((float) @$data_item->advance > 0)
                        <tr class="bg_pink">
                            @php
                                $payment_method = getNamePaymentMethod(@$data_item->payment_type);
                            @endphp
                            <td colspan="5"><p class="text-right mr-3">Tạm ứng - Thanh toán {{ !empty($payment_method) ? '('.$payment_method.')' : ''  }}</p></td>
                            <td class="text-right"><span class="font_bold">{{ number_format(@$data_item->advance) }}</span></td>
                        </tr>   
                    @endif
                    <tr class="bg_pink">
                        <td colspan="5"><p class="text-right mr-3">Công nợ còn lại</p></td>
                        <td class="text-right"><span class="font_bold">{{ number_format(@$data_item->rest) }}</span></td>
                    </tr>
                </tbody>
            </table>
            <p class="d-flex align-items-center">Thành tiền bằng chữ : <span class="ml-1 font_bold">{{ convertNumerToText($data_item->rest) }} đồng chẵn</span></p>
        </div>
        <div class="print_order_footer mt-4">
            <div class="row">
                <div class="col-12 mb-3">
                    <p class="d-flex align-items-center">Ngày đặt hàng : {{ date('d/m/Y', strtotime($data_item->created_at)) }}</p>
                    <p class="d-flex align-items-center">Ngày trả hàng : {{ date('d/m/Y', strtotime($data_item->return_date)) }}</p>    
                    <p class="d-flex align-items-center">Ghi chú : {{ @$data_item->note ?? 'trả hàng thu tiền ngay'  }} </p>        
                </div>
                <div class="col-6 text-center">
                    <p class="text-uppercase">khách hàng</p>
                    <p>(Ký rõ họ tên)</p>
                </div>
                <div class="col-6 text-center" style="padding-bottom: 100px">
                    <p>HN, ngày {{ \Carbon\Carbon::now()->day }} tháng {{ \Carbon\Carbon::now()->month }} năm {{ \Carbon\Carbon::now()->year }}</p>
                    <p class="text-uppercase">người viết biên nhận</p>
                    <p>(Ký rõ họ tên)</p>
                </div>
            </div>
        </div>
    </div>
@endsection