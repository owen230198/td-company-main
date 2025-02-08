@extends('index')
@section('content')
    <div class="dashborad_content config_content base_content p-0 pb-5">
        <form action="{{ url($action_url) }}" method="POST" class="mb-0 baseAjaxForm __move_product_warehouse_form">
            @foreach ($fields as $key => $field)
                @include('view_update.view', $field)
            @endforeach
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
