@extends('index')
@section('css')
    <link rel="stylesheet" href="frontend/admin/css/quote.css">
@endsection
@section('content')
    <div class="chose_customer_form">
        <form action="create-quote?step=chose_customer" method="POST" class="chose_customer_quote_form" enctype="multipart/form-data">
            @csrf
            <div class="form-group d-flex mb-3 pb-3">
                <label class="mb-0 min_150 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">Tìm kiếm Khách hàng</label>
                <select name="customer_id" class="form-control select_ajax select_customer_quote" 
                data-url = 'get-data-json-customer?status=1'></select>
            </div>
            <div class="customer_info_quote">
    
            </div>
            <div class="group_btn_action_form">
                <button type="submit" class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth">
                  <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
                </button>
                <a href="{{ url('') }}" class="main_button bg_red color_white smooth radius_5 font_bold smooth red_btn">
                  <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
                </a>
              </div>
        </form>
    </div>   
@endsection
@section('script')
    <script src="frontend/admin/script/quote.js"></script>
@endsection