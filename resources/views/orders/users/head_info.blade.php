@php
    $sale = getDetailDataObject('n_users', $product_obj->created_by);
    $order_obj = getDetailDataObject('orders', $product_obj->order);
    if (!empty($order_obj)) {
        $customer = getDetailDataObject('customers', $order_obj->customer);
        $represent = getDetailDataObject('represents', $order_obj->represent);
    }
@endphp
@if (!empty($sale) && !empty($customer) && !empty($represent))
    <div class="quote_handle_section mb-3">
        @include('quotes.text_info', ['name' => 'Kinh doanh', 'value' => @$sale->name . ' - '. $sale->phone])
        @include('quotes.text_info', ['name' => 'Công ty', 'value' => @$customer->name])
        @include('quotes.text_info', ['name' => 'Người liên hệ', 'value' => @$represent->name])
        @include('quotes.text_info', ['name' => 'Số di động', 'value' => @$represent->phone])
        @include('quotes.text_info', ['name' => 'Email', 'value' => @$represent->email])
    </div>
@endif