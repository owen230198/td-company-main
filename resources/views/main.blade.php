@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/base/css/animate.css') }}">
@endsection
@section('content')
    <div class="home_index">
        <div class="row justify-content-center">
            @if (!empty($not_accepted_table) && is_array($not_accepted_table))
                <div class="col-12 my-4">
                    <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">Yêu xử lý công việc</h2>
                    <div class="row row-5 justify-content-center">
                        @foreach ($not_accepted_table as $command)
                            @if (in_array(\GroupUser::getCurrent(), $command['group_user']))
                                <div class="col-lg-2 col-6 mb_10 text-center">
                                    @php
                                        $command_count = getCountDataTable($command['table'], $command['condition']);
                                    @endphp
                                    <a href={{ asset($command['link']) }} 
                                    class="main_item_command h-100 smooth box_shadow_3 radius_5 w-100 p-2 h-100">
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('frontend/admin/images/'.$command['icon'].'_icon.png') }}" alt="order-icon" class="command_icon smooth">
                                            @if ($command_count > 0)
                                                <p class="font_bold notify_style">
                                                    {{ $command_count > 99 ? '99+' : $command_count }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="command_detail ml-2">
                                            <p class="command_detail_tiltle font_bold color_main">
                                                {{ $command['text'] }}
                                            </p>
                                        </div>
                                    </a>
                                </div>  
                            @endif   
                        @endforeach
                    </div>
                </div>   
            @endif
            <div class="col-lg-6 text-center">
                <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">thống kê đơn hàng đặt trong năm</h2>
                <canvas id="order-chart" width="400" height="300" class="bg_white radius_5 p-2 mb-3 box_shadow_3"></canvas>
            </div>
            <div class="col-lg-6 text-center">
                <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">thống kê bán hàng trong tuần</h2>
                <canvas id="selling-chart" width="400" height="300" class="bg_white radius_5 p-2 mb-3 box_shadow_3"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('frontend/admin/script/chart.js') }}"></script>
    <script>
        //order chart
        let bar_ctx = document.getElementById('order-chart').getContext('2d');
        let bg_chart = bar_ctx.createLinearGradient(0, 100, 200, 500);
        bg_chart.addColorStop(0, '#459300');
        bg_chart.addColorStop(1, '#6be10294');
        let chat_data = @json($chart_data);
        let bar_chart = new Chart(bar_ctx, {
            type: 'bar',
            data: {
                labels: ["Th 1", "Th 2", "th 3", "Th 4", "th 5", "th 6", "Th 7", "Th 8", "Th 9", "Th 10", "Th 11", "Th 12"],
                datasets: [{
                    label: 'Số lượng đơn hàng đặt đã tạo trong tháng',
                    data:  Object.values(chat_data),
                    backgroundColor: bg_chart,
                    hoverBackgroundColor: bg_chart,
                    hoverBorderWidth: 0,
                    hoverBorderColor: 'red'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        //selling chart
        let selling_chat = @json($selling_chat);
        let labels = selling_chat.map(item => item.sale_name);
        let data = selling_chat.map(item => item.count);

        let ctx = document.getElementById('selling-chart').getContext('2d');
        let topUsersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Số đơn hàng bán sẵn đã tạo trong tuần',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
@endsection