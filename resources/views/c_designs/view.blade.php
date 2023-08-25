@extends('orders.main')
@section('main')
    <h3 class="fs-14 text-uppercase pt-3 mt-3 text-center handle_title">
        <span>Chi tiết lệnh {{ @$data_command['code'] }}</span>
    </h3>
    <div class="order_list_product">
        @include('quotes.products.ajax_view', ['order_get' => true, 'not_detail' => true])
        <div class="design_paper_info">
            @include('c_designs.paper_table')
        </div>
    </div>
@endsection