@extends('index')
@section('content')
    <div class="dashborad_content">
        <div style="max-width:850px; margin: auto;">
            <div class="p-2 border_eb radius_5 my-3">
                <canvas id="orderChart"></canvas>
            </div>
            <div class="table_char">
                <p class="fs-15 font_bold mb-3">Thời điểm tính toán thống kê: {{ date('d/m/Y', Time()) }}</p>
                <table class="table table-bordered">
                    <thead class="bg_green color_white">
                        <tr>
                            <th class="font_bold text-center">STT</th>
                            <th class="font_bold text-center">Tên {{ $title_object }}</th>
                            <th class="font_bold text-right">Doanh thu (VNĐ)</th>
                            <th class="font_bold text-right">Tỉ lệ (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->obj_name }}</td>
                                <td class="text-right">{{ number_format($item->total_value) }}</td>
                                <td class="text-right">{{ number_format($item->percent) }}</td>
                            </tr>   
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg_red color_white font_bold">
                            <td colspan="3" class="text-right font_bold fs-16">{{ $totalValue }}</td>
                            <td class="text-right">100</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/chart.js') }}"></script>
    <script>
        let ctx = document.getElementById('orderChart').getContext('2d');
        let orderChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($labels),
                datasets: [{
                    data: @json($values),
                    backgroundColor: [
                        '#505093',
                        '#f77f03',
                        '#dddd00',
                        '#df0000',
                        '#df5555',
                        '#505555',
                        '#f77f99',
                        '#dddd99',
                        '#df9999',
                        '#ad00ad',
                        '#02af02'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        fontSize: 12,
                        boxWidth: 10, // Kích thước hộp màu trong legend
                        padding: 15, // Khoảng cách giữa các item
                        generateLabels: function(chart) {
                            return chart.data.labels.map(function(label, i) {
                                // Lấy giá trị của phần
                                let value = chart.data.datasets[0].data[i];
                                // Tính phần trăm của giá trị
                                let total = chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                let percentage = ((value / total) * 100).toFixed(2);
                                // Trả về cấu trúc tùy chỉnh, sử dụng \n để xuống dòng
                                return {
                                    text: `${label} - Doanh số: ${value}đ - Chiếm: ${percentage}%`, // Hiển thị 1 lần
                                    fillStyle: chart.data.datasets[0].backgroundColor[i],
                                    hidden: chart.getDatasetMeta(0).data[i].hidden,
                                    index: i
                                };
                            });
                        }
                    }
                },
                title: {
                    display: false,
                }
            }
        });
    </script>
@endsection
