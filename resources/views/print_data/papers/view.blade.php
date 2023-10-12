@extends('print_data.index')
@section('content')
    <div class="_print_order_header">
        <div class="row">
            <div class="col-4">
                <a href="{{ url('') }}" class="header_printdata_logo d-block">
                    <img src="{{ url('frontend/admin/images/logo.jpg') }}" alt="logo">   
                </a>
            </div>
            <div class="col-4">
                <p class="text-uppercase fs-18 font_bold color_green">lệnh sản xuất - vật tư giấy</p>   
                <p class="d-flex align-items-center"><span class="w_60 d-block">Mã lệnh</span>  : <span class="fs-18 color_red ml-1 font_bold">{{ $data_item->code }}</span></p>
            </div>
            <div class="col-4">

            </div>
        </div>
    </div>
    <div class="">

    </div>
@endsection