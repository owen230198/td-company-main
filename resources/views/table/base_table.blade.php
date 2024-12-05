@extends('index')
@section('content')
    <div class="dashborad_content">
        @if (!empty($tableItem['search_view']))
            @include('table.'.$tableItem['search_view'])
        @else
            @include('table.form_search')
        @endif
        @include('table.group_feature')
        @if (count($data_tables) > 0)
            @yield('type')
        @else
            <p class="fs-15 font-italic color_red">Chưa có dữ liệu {{ @$title }} !</p>
        @endif
    </div>
    @include('table.remove_confirm', ['table_name' => $tableItem['name'], 'table_note' => $tableItem['note']])
    @include('table.remove_confirm_check')
@endsection
