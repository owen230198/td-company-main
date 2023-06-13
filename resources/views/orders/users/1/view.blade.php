@extends('orders.view')
@section('main')
    @include('quotes.head_information')
    @include('orders.base_field')
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Danh sách sản phẩm</span>
    </h3>
    <div class="order_list_product">
        @include('quotes.products.ajax_view', ['order_get' => true])
    </div>
@endsection