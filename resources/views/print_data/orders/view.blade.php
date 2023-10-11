@extends('print_data.index')
@section('content')
    @php
        $data_customer = getDetailDataById('Customer', $data_item->customer);    
    @endphp
    <div class="_print_order_header">
        <div class="row">
            <div class="col-8">
                <div class="col-6">
                    <a href="{{ url('') }}" class="header_printdata_logo d-block text-right">
                        <img src="{{ url('frontend/admin/images/logo.jpg') }}" alt="logo">   
                    </a>
                </div>

            </div>
            <div class="col-4">
                <ul class="header_print_data_info">
                    <li class="d-flex align-items-center"><span class="w_60 d-block">VPGD</span>     : {{ getDataConfig('QuoteConfig', 'OFFICE_ADD') }}</li>
                    <li class="d-flex align-items-center"><span class="w_60 d-block">Tel</span>      : {{ getDataConfig('QuoteConfig', 'OFFICE_PHONE') }}</li>
                    <li class="d-flex align-items-center"><span class="w_60 d-block">Email</span>    : {{ getDataConfig('QuoteConfig', 'OFFICE_EMAIL') }}</li>
                    <li class="d-flex align-items-center"><span class="w_60 d-block">Website</span>  : {{ getDataConfig('QuoteConfig', 'SITE') }}</li>
                </ul>
            </div>
            <div class="col-8 mb-2">
                <div class="col-6">
                    <p class="text-uppercase fs-18 font_bold color_green text-right">đơn đặt hàng</p>
                </div>
            </div>
            <div class="col-4 mb-2">
                <p class="d-flex align-items-center"><span class="w_60 d-block">Số seri</span>  : <span class="fs-18 color_red ml-1">{{ $data_item->code }}</span></p>
            </div>
            <div class="col-8">
                <li><span class="mr-1">Tên Khách hàng/Công ty :</span> {{ $data_customer['name'].' ('.$data_customer['contacter'].')' }}</li>
            </div>
            <div class="col-4">
                <p class="d-flex align-items-center">
                    <span class="w_60 d-block">Tỉnh/TP</span>  : 
                    <span class="fs-18 color_red ml-1">{{ getFieldDataById('name', 'citys', $data_customer['city']) }}</span>
                </p>   
            </div>
            <div class="col-8">
                <li><span class="mr-1">Địa chỉ :</span> {{ $data_customer['address'] }}</li>
            </div>
            <div class="col-4">
                <li class="d-flex"><span class="mr-1">Tel :</span> {{ $data_customer['phone'].' - '.$data_customer['telephone'] }}</li>
            </div>
        </div>
    </div>
@endsection