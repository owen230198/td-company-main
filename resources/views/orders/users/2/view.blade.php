@if (@$data_order['status'] == \StatusConst::NOT_ACCEPTED)
    @include('orders.view')
@endif