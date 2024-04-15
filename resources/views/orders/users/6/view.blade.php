@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/order.css') }}">
@endsection
@section('content')
    <form action="{{ url('apply-to-worker-handle/products/'.$id) }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data" 
    onkeydown="return event.key != 'Enter'">
        @csrf
        <h3 class="fs-14 text-uppercase mt-3 text-center handle_title">
            <span>Danh sách sản phẩm</span>
        </h3>
        {{-- @include('quotes.products.list_tab') --}}
        <div class="tab-content" id="quote-pro-tabContent">
            @foreach ($products as $pro_index => $product)
                <div class="tab-pane fade{{ $pro_index == 0 ? ' show active' : '' }} tab_pane_quote_pro" id="quote-pro-{{ $pro_index }}" role="tabpanel" aria-labelledby="quote-pro-{{ $pro_index }}-tab">
                    @include('orders.users.6.base_pro_info')
                    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
                        <span>Danh sách yêu cầu xử lí vật tư</span>
                    </h3>
                    @if (count($elements) > 0)
                        <ul class="nav nav-pills mb-3 quote_pro_strct_nav_link" style="top: 95px">
                            @foreach ($elements as $key => $element)
                                @if (!empty($element['data']))
                                    <li class="_nav-item">
                                        <a class="nav-link{{ $element['pro_field'] == @$key_supply ? ' active' : '' }}" href="{{ url('update/products/'.$id.'?key_supply='.$element['pro_field']) }}">
                                            {{ $element['note'] }}
                                        </a>
                                    </li>   
                                @endif
                            @endforeach
                        </ul>
                        <div class="_tab-content" id="quote-pro-{{ $pro_index }}-struct-tabContent">
                            @foreach ($elements as $key => $element)
                                @if (!empty($element['data']) && $element['pro_field'] == @$key_supply)
                                    <div class="tab-pane tab_pane_quote_pro">
                                        @include('orders.users.6.supply_table')
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="group_btn_action_form text-center">
            <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Xác nhận xuống xưởng SX
            </button>
            <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
              <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
            </a>
        </div>
    </form>
@endsection