@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="dashborad_content config_content base_content p-0 pb-5">
        <form action="{{ url('confirm-product-warehouse/'.$data_expertise->id) }}" method="POST" class="mb-0 baseAjaxForm __import_product_warehouse_form">
            @foreach ($info_fields as $key => $iField)
                @php
                    $is_last = $key == 8;
                    $iField['name'] = 'warehouse['.$iField['name'].']';
                    $is_show = !empty($iField['value']) || $is_last;
                @endphp
                @if ($is_show)
                    @include('view_update.view', $iField)
                @endif
            @endforeach
            @include('view_update.view', $field_chose_type)
            <div class="ajax_data_field_import_product">
                
            </div>
            @include('view_update.view', $receipt_field)
            @include('view_update.view', $field_note)
            <div class="group_btn_action_form text-center w-100">
                <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
                    <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
                </button>
                <button type="button" class="main_button bg_red color_white radius_5 font_bold smooth red_btn close_action_popup">
                    <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
                </button>
            </div>
        </form>  
    </div>
@endsection
