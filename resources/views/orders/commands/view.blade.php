@extends('index')
@section('content')
@php
    $singleObject = true;
@endphp
    <div class="dashborad_content position-relative p-3 bg_white product_config_item">
        <div class="mt-4 pt-4 border_top_thin position-relative">
            <div class="tab-content" id="pills-tabContent">
                <form action="apply-commands/c_designs/{{ @$dataItem['id'] }}" method="POST" class="actionCommandForm baseAjacForm" enctype="multipart/form-data">
                    @if (@$tableItem['name'] == 'c_designs')
                        @include('orders.products.design_commands', 
                        ['singleObject'=>$singleObject, 'dataItem'=>@$dataItem ?? []])
                    @else
                        @include('orders.products.process_commands', 
                        ['singleObject'=>$singleObject, 'dataItem'=>@$dataItem ?? []])
                    @endif
                    <div class="group_btn_action_form p-1 mt-3">
                        <button type="button" class="station-richmenu-main-btn-area">
                            <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i>In lệnh
                        </button> 
                        @if (@$dataItem['status'] == \App\Constants\OrderConstant::ORDER_NOT_ACCEPTED)
                            <a href="{{ asset('received-command/'.@$tableItem['name'].'/'.@$dataItem['id']) }}" class="station-richmenu-main-btn-area">
                                <i class="fa fa-download mr-2 fs-14" aria-hidden="true"></i>Tiếp nhận
                            </a>
                        @else
                            <a href="{{ asset('apply-command/'.@$tableItem['name'].'/'.@$dataItem['id']) }}" class="station-richmenu-main-btn-area">
                                <i class="fa fa-download mr-2 fs-14" aria-hidden="true"></i>Duyệt lệnh
                            </a>
                        @endif
                        <a href="update/orders/{{ @$dataItemProduct['order_id'] }}"
                            class="station-richmenu-main-btn-area">
                            <i class="fa fa-chevron-left mr-2 fs-14" aria-hidden="true"></i>Trở về
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>    
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/order.js') }} "></script>
@endsection