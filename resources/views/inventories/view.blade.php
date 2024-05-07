@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="dashborad_content">
        <form action="{{ url('inventory-aggregate') }}" method="GET" class="mb-0 base_table_form_search" id="form-search">
            <input type="hidden" name="is_ajax" value="1">
            @foreach ($fields as $field)
                @include('view_search.view', ['field' => $field])
            @endforeach
        </form>
        <div class="d-flex align-center justify-content-end my-3">
            <button type="submit"
                class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2"
                form="form-search" value="submit">
                <i class="fa fa-filter mr-2 fs-15" aria-hidden="true"></i>Hoàn tất
            </button>
            <a href="javascript:void(0)" class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-2">
                <i class="fa fa-book mr-2 fs-15" aria-hidden="true"></i>Trợ giúp
            </a>
        </div>
        <div class="ajax_data_inventory">
            
        </div>
    </div>
    @include('table/action_popup')
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection
