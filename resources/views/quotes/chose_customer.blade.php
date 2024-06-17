@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="chose_customer_form config_content">
        <form action="{{ !empty($link_action) ? $link_action : asset('insert/quotes?step=chose_customer') }}" method="POST" class="chose_customer_quote_form baseAjaxForm" 
        enctype="multipart/form-data">
            @csrf
            <div class="form-group d-flex">
                <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">Tìm kiếm Khách hàng</label>
                <select class="form-control select_ajax select_customer_quote" 
                data-url = {{asset('get-data-json-customer?status=1')}} data-id={{ @$customer->id }} 
                data-label='{{ @$customer->code.'-'.@$customer->name }}'></select>
            </div>
            <div class="customer_info_quote">
                @if (!empty($customer))
                    @include('quotes.customer_info', $customer)
                @endif
            </div>
        </form>
    </div>   
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
@endsection