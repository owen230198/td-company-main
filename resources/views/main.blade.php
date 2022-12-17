@extends('index')
@section('content')
    <div class="home_index mt-3">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">thống kê đơn hàng 6 tháng gần đây</h2>
                <canvas id="bar-chart" width="400" height="300" class="bg_white radius_5 p-2 mb-3 box_shadow_3"></canvas>
            </div>
            <div class="col-lg-6">
                <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">Đơn hàng & Lệnh chờ duyệt</h2>
                <div class="row row-7">
                    <div class="col-lg-6 mb-3">
                        <a href="" class="main_item_command h-100 smooth d-flex align-items-center position-relative h-100">
                            <img src="{{ asset('frontend/admin/images/order_icon.png') }}" alt="order-icon" 
                            class="command_icon smooth">
                            <div class="command_detail">
                                <p class="command_detail_tiltle text-uppercase font_bold color_main">
                                    Đơn hàng
                                </p>
                                <p class="fs-18 font_bold color_red">2000</p>
                                <p class="border_top_eb pt-2 mt-2 fs-12 color_gray d-flex align-items-center">
                                    Xem chi tiết 
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <a href="" class="main_item_command h-100 smooth d-flex align-items-center position-relative h-100">
                            <img src="{{ asset('frontend/admin/images/design_icon.png') }}" alt="design-icon" 
                            class="command_icon smooth">
                            <div class="command_detail">
                                <p class="command_detail_tiltle text-uppercase font_bold color_main">
                                    Lệnh thiết kế
                                </p>
                                <p class="fs-18 font_bold color_red">2000</p>
                                <p class="border_top_eb pt-2 mt-2 fs-12 color_gray d-flex align-items-center">
                                    Xem chi tiết 
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <a href="" class="main_item_command h-100 smooth d-flex align-items-center position-relative h-100">
                            <img src="{{ asset('frontend/admin/images/print_icon.png') }}" alt="print-icon" 
                            class="command_icon smooth">
                            <div class="command_detail">
                                <p class="command_detail_tiltle text-uppercase font_bold color_main">
                                    Lệnh In
                                </p>
                                <p class="fs-18 font_bold color_red">2000</p>
                                <p class="border_top_eb pt-2 mt-2 fs-12 color_gray d-flex align-items-center">
                                    Xem chi tiết 
                                </p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-lg-6 mb-3">
                        <a href="" class="main_item_command h-100 smooth d-flex align-items-center position-relative h-100">
                            <img src="{{ asset('frontend/admin/images/process_icon.png') }}" alt="process-icon" 
                            class="command_icon smooth">
                            <div class="command_detail">
                                <p class="command_detail_tiltle text-uppercase font_bold color_main">
                                    Lệnh sản xuất
                                </p>
                                <p class="fs-18 font_bold color_red">2000</p>
                                <p class="border_top_eb pt-2 mt-2 fs-12 color_gray d-flex align-items-center">
                                    Xem chi tiết 
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('frontend/admin/script/chart.js') }}"></script>
    <script src="{{ asset('frontend/admin/script/index.js') }}"></script>
@endsection