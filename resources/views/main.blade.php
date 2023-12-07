@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/base/css/animate.css') }}">
@endsection
@section('content')
    <div class="home_index">
        <div class="row justify-content-center">
            @if (!empty($not_accepted_table) && is_array($not_accepted_table))
                <div class="col-12 my-4">
                    <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">Thông báo & Yêu cầu công việc</h2>
                    <div class="row row-7">
                        @foreach ($not_accepted_table as $command)
                        <div class="col_lg_5 mb-3 text-center">
                            @php
                                $command_count = getCountDataTable($command['table'], $command['condition']);
                            @endphp
                            <a href={{ asset($command['link']) }} 
                            class="main_item_command h-100 smooth box_shadow_3 radius_5 w-100 p-2 position-relative h-100">
                                <img src="{{ asset('frontend/admin/images/'.$command['icon'].'_icon.png') }}" alt="order-icon" 
                                class="command_icon smooth">
                                <div class="command_detail ml-2">
                                    <p class="command_detail_tiltle font_bold color_main">
                                        {{ $command['text'] }}
                                    </p>
                                    @if ($command_count > 0)
                                        <p class="fs-15 font_bold notify_style">
                                            {{ $command_count }}
                                        </p>
                                    @endif
                                </div>
                            </a>
                        </div>     
                        @endforeach
                    </div>
                </div>   
            @endif
            <div class="col-lg-6 text-center">
                <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">thống kê đơn hàng trong năm</h2>
                <canvas id="bar-chart" width="400" height="300" class="bg_white radius_5 p-2 mb-3 box_shadow_3"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('frontend/admin/script/chart.js') }}" defer></script>
    <script src="{{ asset('frontend/admin/script/index.js') }}" defer></script>
@endsection