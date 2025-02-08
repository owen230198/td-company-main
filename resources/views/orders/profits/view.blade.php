@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="position-relative">
        <h3 class="fs-14 text-uppercase mb-3 handle_title">I. Chi tiết chi phí sản xuất</h3>
        @include('quotes.profits.cost_detail')
        <form class="config_content">
            <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 handle_title">II. Chi phí vận chuyển & lợi nhuận sản phẩm</h3>
            <table class="table table-bordered mb-1 quote_table_profit my-4">
                <thead class="font_bold">
                    <tr>
                        <th class="text-center">Mã đơn</th>
                        <th>Chi phí vận chuyển</th>
                        <th>Lợi nhuận %</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center align-middle font_bold color_green">{{ $data_item->code }}</td>
                        <td class="align-middle">
                            <p class="fs-15 font_bold color_red text-center">
                                {{ number_format(@$data_item->ship_price) }}
                            </p>
                        </td>
                        <td class="align-middle">
                            <p class="fs-15 font_bold color_red text-center"> 
                                {{ @$data_item->profit }}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="group_btn_action_form text-center">
                <a href="{{ getBackUrl() }}" class="main_button color_white bg_green radius_5 font_bold smooth mx-3">
                    <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Trở về
                </a>
                <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
                    <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Thoát
                </a>
            </div>
        </form>
        <div class="quote_total_cost">
            <h3 class="font_bold fs-18 color_red mb-0">BỘ SẢN PHẨM BAO GỒ COMBO {{ count($products) }} SẢN PHẨM - TỔNG GIÁ :
                {{ number_format((int) @$data_item['total_amount']) }} đ</h3>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
@endsection
