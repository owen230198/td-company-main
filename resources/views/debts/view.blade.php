@extends('index')
@section('content')
    <div class="dashborad_content __debt_base_view">
        @include('table.form_search')
        <div class="d-flex align-center justify-content-end my-3">
            <button type="submit"
                class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2"
                form="form-search" value="submit">
                <i class="fa fa-pie-chart mr-2 fs-15" aria-hidden="true"></i>Xem lịch sử TT
            </button>
            <button type="button"
                class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2 __view_debt_goup_btn"
                form="form-search" value="submit">
                <i class="fa fa-address-card mr-2 fs-15" aria-hidden="true"></i>Xem công nợ
            </button>
            <button class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2 __export_data_debt" 
            data-table="{{ $table }}" data-group="{{ !empty($group_target) ? 1 : 0 }}">
                <i class="fa fa-file-excel-o mr-2 fs-15" aria-hidden="true"></i>Export Excel
            </button>
            <button data-toggle="modal" data-target="#actionModal"
                @php
                    $param = getParamUrlByArray($data_search);
                    $param .= empty($param) ? '?nosidebar=1' : '&nosidebar=1';
                @endphp
                data-src="{{ url($link_insert.''.$param) }}" 
                data-size="{{ @$size_popup }}"
                class="load_view_popup main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2">
                <i class="fa fa-plus mr-2 fs-15" aria-hidden="true"></i>Thêm mới
            </button>
        </div>
    </div>
    <div class="table_debt_module">
        @php
            $prefix = !empty($group_target) ? 'group_targets.' : '';
        @endphp
        @include($table.'.'.$prefix.'table_debt')
    </div>
    @include('table/action_popup')
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection
