@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="dashborad_content">
        @include('table.form_search')
        <div class="d-flex align-center justify-content-end my-3">
            <button type="submit"
                class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2"
                form="form-search" value="submit">
                <i class="fa fa-pie-chart mr-2 fs-15" aria-hidden="true"></i>Xem thống kê
            </button>
            <button class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2">
                <i class="fa fa-file-excel-o mr-2 fs-15" aria-hidden="true"></i>Export Excel
            </button>
            <buton data-toggle="modal" data-target="#actionModal"
                data-src="{{ url('insert/c_orders'.getParamUrlByArray($data_search).'&nosidebar=1') }}" 
                class="load_view_popup main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2">
                <i class="fa fa-plus mr-2 fs-15" aria-hidden="true"></i>Thêm mới
            </buton>
        </div>
    </div>
    <div class="table_debt_module">
        @include('debts.table')
    </div>
    @include('table/action_popup')
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection
