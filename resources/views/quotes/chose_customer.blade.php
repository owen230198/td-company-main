@extends('index')
@section('css')
    <link rel="stylesheet" href="frontend/admin/css/quote.css">
@endsection
@section('content')
    <div class="chose_customer_form">
        <div class="form-group d-flex mb-4 pb-4 border_bot_eb">
            <label class="mb-0 min_250 fs-13 text-capitalize">Tìm kiếm Khách hàng</label>
            <select name="customer_id" class="form-control select_ajax" data-url = 'get-data-json-customer?status=old'></select>
        </div>
    </div>   
@endsection