@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="dashborad_content">
        @include('table.form_search')
        @include('table.group_feature')
    </div>
    @include('quotes.products.suggest_product_submited')
    @include('table/action_popup')
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
@endsection
