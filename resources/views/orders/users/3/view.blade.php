@extends('orders.main')
@section('main')
    @if (!empty($product_obj))
        @include('orders.users.head_info')
    @endif
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Danh sách sản phẩm</span>
    </h3>
    <div class="order_list_product">
        @include('quotes.products.ajax_view', ['order_get' => true])
    </div>
@endsection