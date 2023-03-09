@extends('index')
@section('content')
    <div class="home_index mt-3">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">thống kê đơn hàng trong năm</h2>
                <canvas id="bar-chart" width="400" height="300" class="bg_white radius_5 p-2 mb-3 box_shadow_3"></canvas>
            </div>
            @if (!empty($not_accepted_table) && is_array($not_accepted_table))
                <div class="col-lg-6">
                    <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">Đơn hàng & Lệnh chờ duyệt</h2>
                    <div class="row row-7">
                        @foreach ($not_accepted_table as $table => $text)
                        <div class="col-lg-6 mb-3">
                            <a href={{ asset('get-data-table-command/'.$table.'?status=0') }} class="main_item_command h-100 smooth d-flex align-items-center position-relative h-100">
                                <img src="{{ asset('frontend/admin/images/'.$table.'_icon.png') }}" alt="order-icon" 
                                class="command_icon smooth">
                                <div class="command_detail">
                                    <p class="command_detail_tiltle text-uppercase font_bold color_main">
                                        {{ $text }}
                                    </p>
                                    <p class="fs-18 font_bold color_red">{{ getCountDataTable($table, ['status' => 'not_accepted']) }}</p>
                                    <p class="border_top_eb pt-2 mt-2 fs-12 color_gray d-flex align-items-center">
                                        Xem chi tiết 
                                    </p>
                                </div>
                            </a>
                        </div>     
                        @endforeach
                    </div>
                </div>   
            @endif
            
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('frontend/admin/script/chart.js') }}" defer></script>
    <script src="{{ asset('frontend/admin/script/index.js') }}" defer></script>
@endsection