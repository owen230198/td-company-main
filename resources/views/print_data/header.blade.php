<div class="_print_order_header">
    <div class="row">
        <div class="col-4">
            <a href="{{ url('') }}" class="header_printdata_logo d-block">
                <img src="{{ url('frontend/admin/images/logo.jpg') }}" alt="logo">   
            </a>
        </div>
        <div class="col-4">
            <p class="text-uppercase fs-18 font_bold color_green">{{ $title }}</p>  
            <p class="d-flex align-items-center"><span class="w_66 d-block">Mã lệnh</span>  : <span class="fs-18 color_red ml-1 font_bold">{{ $data_item->code }}</span></p>
        </div>
        <div class="col-4">
            <p class="d-flex align-items-center"><span class="w_80 d-block">Người giao</span> : {{ getFieldDataById('name', 'n_users', $data_item->created_by) }}</p>
            <p class="d-flex align-items-center"><span class="w_80 d-block">Ngày đặt</span> : {{ $data_item->created_at }}</p>
            @if (!empty($return_time))
                <p class="d-flex align-items-center"><span class="w_80 d-block">Ngày trả</span> : {{ $return_time }}</p>
            @endif
        </div>
    </div>
</div>