@extends('orders.view')
@section('main')
@if (@$order_type == \OrderConst::INCLUDE)
    @if (!empty($data_quote))
        @include('quotes.head_information')
    @endif
    @include('orders.base_field')
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Danh sách sản phẩm</span>
    </h3>    
@endif
    <div class="order_list_product">
        @include('quotes.products.ajax_view', ['order_get' => true])
    </div>
@endsection