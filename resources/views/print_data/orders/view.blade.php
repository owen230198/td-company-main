@extends('print_data.index')
@section('content')
    @php
        $data_customer = getDetailDataById('Customer', $data_item->customer);    
    @endphp
    <div class="_print_order_header">
        <div class="row">
            <div class="col-7">
                <div class="col-6">
                    <a href="{{ url('') }}" class="header_printdata_logo d-block text-right">
                        <img src="{{ url('frontend/admin/images/logo.jpg') }}" alt="logo">   
                    </a>
                </div>

            </div>
            <div class="col-5">
                <ul class="header_print_data_info">
                    <li class="d-flex align-items-center"><span class="w_60 d-block">VPGD</span>     : {{ getDataConfig('QuoteConfig', 'OFFICE_ADD') }}</li>
                    <li class="d-flex align-items-center"><span class="w_60 d-block">Tel</span>      : {{ getDataConfig('QuoteConfig', 'OFFICE_PHONE') }}</li>
                    <li class="d-flex align-items-center"><span class="w_60 d-block">Email</span>    : {{ getDataConfig('QuoteConfig', 'OFFICE_EMAIL') }}</li>
                    <li class="d-flex align-items-center"><span class="w_60 d-block">Website</span>  : {{ getDataConfig('QuoteConfig', 'SITE') }}</li>
                </ul>
            </div>
            <div class="col-7 my-3">
                <div class="col-6">
                    <p class="text-uppercase fs-20 font_bold color_green text-right">đơn đặt hàng</p>
                </div>
            </div>
            <div class="col-5 mb-2">
                <p class="d-flex align-items-center"><span class="w_60 d-block">Số seri</span>  : <span class="fs-18 color_red ml-1 font_bold">{{ $data_item->code }}</span></p>
            </div>
            <div class="col-7">
                <p><span class="mr-1">Tên Khách hàng/Công ty :</span> {{ $data_customer['name'].' ('.$data_customer['contacter'].')' }}</p>
            </div>
            <div class="col-5">
                <p class="d-flex align-items-center">
                    <span class="w_60 d-block">Tỉnh/TP</span>  : 
                    <span class="fs-18 color_red ml-1 font_bold">{{ getFieldDataById('name', 'citys', $data_customer['city']) }}</span>
                </p>   
            </div>
            <div class="col-7">
                <p><span class="mr-1">Địa chỉ :</span> {{ $data_customer['address'] }}</p>
            </div>
            <div class="col-5">
                <p class="d-flex"><span class="mr-1">Tel :</span> {{ $data_customer['phone'].' - '.$data_customer['telephone'] }}</p>
            </div>
        </div>
    </div>
    @php
        $list_product = \DB::table('products')->where(['act' => 1, 'order' => $data_item->id])->get();
    @endphp
    <div class="print_product_table mt-3">
        <table class="table table-bordered mb-1">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mã Lệnh</th>
                    <th scope="col">Tên Sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_product as $key => $product)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->qty }}</td>
                        <td class="text-right">{{ number_format($product->total_amount/$product->qty) }} vnđ</td>
                        <td class="text-right">{{ number_format(round($product->total_amount, -3)) }} vnđ</td>
                    </tr>    
                @endforeach
                @php
                        $order_total = (float) @$data_item->advance > 0 ? @$data_item->rest : $data_item->total_amount;
                        $vat_cost = calValuePercentPlus(0, $order_total, $data_item->vat);
                        $order_cost = $order_total - $vat_cost;
                @endphp
                <tr class="bg_pink">
                    <td colspan="5"><p class="text-right mr-3">Tiền hàng</p></td>
                    <td class="text-right"><span class="font_bold">{{ number_format($data_item->total_amount) }} vnđ</span></td>
                </tr>
                <tr class="bg_pink">
                    <td colspan="5"><p class="text-right mr-3">Tiền VAT</p></td>
                    <td class="text-right"><span class="font_bold">{{ number_format($vat_cost) }} vnđ</span></td>
                </tr>
                @if ((float) @$data_item->advance > 0)
                    <tr class="bg_pink">
                        <td colspan="5"><p class="text-right mr-3">Tạm ứng</p></td>
                        <td class="text-right"><span class="font_bold">{{ number_format(@$data_item->advance) }} vnđ</span></td>
                    </tr>   
                @endif
                <tr class="bg_pink">
                    <td colspan="5"><p class="text-right mr-3">Thành tiền bằng số</p></td>
                    <td class="text-right"><span class="font_bold">{{ number_format($order_total) }} vnđ</span></td>
                </tr>
            </tbody>
        </table>
        <p class="d-flex align-items-center">Thành tiền bằng chữ : <span class="ml-1 font_bold">{{ convertNumerToText($order_total) }} đồng chẵn</span></p>
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