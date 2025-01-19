@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <form action="{{ url('supply-handle') }}" method="POST" class="baseAjaxForm config_content" enctype="multipart/form-data" 
    onkeydown="return event.key != 'Enter'">
        @csrf
        <input type="hidden" name="id" value="{{ @$supply_obj->id }}">
        <input type="hidden" name="table" value="{{ @$table }}">
        @yield('process')
        <div class="group_btn_action_form text-center">
            <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
            </button>
            @if (\GroupUser::isPlanHandle())        
                <button type="button" data-src = "{{ url('insert/supply_buyings?nosidebar=1') }}" 
                class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2 load_view_popup"
                data-toggle="modal" data-target="#actionModal">
                    <i class="fa fa-lightbulb-o mr-2 fs-14" aria-hidden="true"></i>Đề xuất mua
                </button>   
            @endif
            <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
              <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
            </a>
        </div>  
    </form>
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection