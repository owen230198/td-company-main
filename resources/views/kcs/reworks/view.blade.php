@extends('index')
@section('content')
    <div class="dashborad_content position-relative">
        <form action="{{ url('product-require-rework/'.$product->id) }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            @csrf
            <div class="tab_pane_quote_pro">
                <div class="config_handle_paper_pro">
                    @include('products.base_field', ['pro_index' => 0])
                    @include('quotes.products.structure', ['pro_index' => 0])
                    <div class="group_btn_action_form text-center">
                        <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-3">
                            <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
                        </button>
                        <a href="{{ getBackUrl() }}" class="main_button color_white bg_green radius_5 font_bold smooth mr-3">
                            <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Trở về
                        </a>
                        <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
                            <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection
