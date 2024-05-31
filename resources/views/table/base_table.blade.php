@extends('index')
@section('content')
    <div class="dashborad_content">
        @if (!empty($tableItem['search_view']))
            @include('table.'.$tableItem['search_view'])
        @else
            @include('table.form_search')
        @endif
        <div class="d-flex align-center justify-content-end my-3">
            <button type="submit"
                class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2"
                form="form-search" value="submit">
                <i class="fa fa-filter mr-2 fs-15" aria-hidden="true"></i>Tìm kiếm
            </button>
            @if ($tableItem['insert'] == 1)
                <a href="{{ url('insert/' . $tableItem['name'].''.@$param_action) }}"
                    class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2">
                    <i class="fa fa-plus mr-2 fs-15" aria-hidden="true"></i>Thêm mới
                </a>
            @endif
            @if ($tableItem['remove'])
                <button class="main_button bg_red color_white smooth radius_5 font_bold smooth red_btn d-lg-block d-none" data-toggle="modal"
                    data-target="#multiDeleteModal">
                    <i class="fa fa-trash mr-2 fs-15" aria-hidden="true"></i>Xóa
                </button>
            @endif
            <button type="button" data-src = "{{ url('view/n_log_actions?default_data=%7B"table_map"%3A"'.$tableItem['name'].'"%7D&nosidebar=1') }}" 
            class="btn btn-primary main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-2 load_view_popup" 
            data-toggle="modal" data-target="#actionModal">
                <i class="fa fa-history mr-2 fs-15" aria-hidden="true"></i>Lịch sử
            </button>
            <a href="javascript:void(0)" class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-2 d-lg-block d-none">
                <i class="fa fa-book mr-2 fs-15" aria-hidden="true"></i>Trợ giúp
            </a>
        </div>
        @if (count($data_tables) > 0)
            @yield('type')
        @else
            <p class="fs-15 font-italic color_red">Chưa có dữ liệu {{ @$title }} !</p>
        @endif
    </div>
    @include('table.remove_confirm', ['table_name' => $tableItem['name'], 'table_note' => $tableItem['note']])
    @include('table.remove_confirm_check')
    @include('table/action_popup')
@endsection
