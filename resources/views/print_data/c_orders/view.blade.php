@extends('print_data.index')
@section('content')
    @php
        $data_represent = getDetailDataById('Represent', $data_item->represent);  
        $data_customer = getDetailDataById('Customer', $data_item->customer);     
    @endphp
    <div class="_print_order_header">
        <div class="row">
            <div class="col-6">
                <div class="col-6">
                    <a href="{{ url('') }}" class="header_printdata_logo d-block text-right">
                        <img src="{{ url('frontend/admin/images/logo.jpg') }}" alt="logo">   
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
                    <th scope="col">STT</th>
                    <th scope="col">Mã SP</th>
                    <th scope="col">Tên Sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $key => $product)
                    <tr>
                        @php
                            $num = $key + 1;
                            $obj = getDetailDataById('ProductWarehouse', $product->id);
                            $product_cost += $product->total;
                        @endphp
                        <th scope="row">{{ $num }}</th>
                        <td>{{ $obj->code }}</td>
                        <td>{{ @$product->name ?? $obj->name }}</td>
                        <td>{{ $product->qty }}</td>
                        <td class="text-right">{{ number_format($product->price) }} vnđ</td>
                        <td class="text-right">{{ number_format($product->total) }} vnđ</td>
                    </tr>    
                @endforeach
                <tr class="bg_pink">
                    <td colspan="5"><p class="text-right mr-3">Tiền hàng</p></td>
                    <td class="text-right"><span class="font_bold">{{ number_format($product_cost) }} vnđ</span></td>
                </tr>
                @if ((float) @$data_item->ship_price > 0)
                    <tr class="bg_pink">
                        <td colspan="5"><p class="text-right mr-3">Chi phí vận chuyển</p></td>
                        <td class="text-right"><span class="font_bold">{{ number_format(@$data_item->ship_price) }} vnđ</span></td>
                    </tr>   
                @endif
                @if ((float) @$data_item->other_price > 0)
                    <tr class="bg_pink">
                        <td colspan="5"><p class="text-right mr-3">Chi phí vận chuyển</p></td>
                        <td class="text-right"><span class="font_bold">{{ number_format(@$data_item->other_price) }} vnđ</span></td>
                    </tr>   
                @endif
                @if ((float) @$data_item->advance > 0)
                    <tr class="bg_pink">
                        <td colspan="5"><p class="text-right mr-3">Tạm ứng</p></td>
                        <td class="text-right"><span class="font_bold">{{ number_format(@$data_item->advance) }} vnđ</span></td>
                    </tr>   
                @endif
                <tr class="bg_pink">
                    <td colspan="5"><p class="text-right mr-3">Thành tiền bằng số</p></td>
                    <td class="text-right"><span class="font_bold">{{ number_format(@$data_item->rest) }} vnđ</span></td>
                </tr>
            </tbody>
        </table>
        <p class="d-flex align-items-center">Thành tiền bằng chữ : <span class="ml-1 font_bold">{{ convertNumerToText($data_item->rest) }} đồng chẵn</span></p>
    </div>
    <div class="print_order_footer mt-4">
        <div class="row">
            <div class="col-6 mb-4">
                <p class="d-flex align-items-center">Ngày đặt hàng : {{ date('d/m/Y', strtotime($data_item->created_at)) }}</p>     
            </div>
            <div class="col-6 mb-4">
                <p class="d-flex align-items-center">Ngày trả hàng : </p>    
                <p class="d-flex align-items-center">GHI CHÚ : khách hàng lấy VAT không ? <input type="checkbox" class="ml-2"></p>     
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
@endsection