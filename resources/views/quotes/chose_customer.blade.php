@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="chose_customer_form">
        <form action="{{ asset('create-quote?step=chose_customer') }}" method="POST" class="chose_customer_quote_form" enctype="multipart/form-data">
            @csrf
            <div class="form-group d-flex mb-3 pb-3">
                <label class="mb-0 min_180 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">Tìm kiếm Khách hàng</label>
                <select name="customer_id" class="form-control select_ajax select_customer_quote" 
                data-url = {{asset('get-data-json-customer?status=1')}}></select>
            </div>
            <div class="customer_info_quote mr-5">

            </div>
        </form>
    </div>   
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
@endsection