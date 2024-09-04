@extends('index')
@section('content')
    <div class="dashborad_content">
        <div style="width: 75%; margin: auto;">
            <p class="mb-4 text-center color_red font_bold fs-16">Tổng {{ $value_label. ': '. $totalValue }}đ</p>
            <canvas id="orderChart"></canvas>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/chart.js') }}"></script>
    <script>
        var ctx = document.getElementById('orderChart').getContext('2d');
        var orderChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($labels),
                datasets: [{
                    data: @json($values),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(199, 199, 199, 0.2)',
                        'rgba(83, 102, 255, 0.2)',
                        'rgba(173, 255, 47, 0.2)',
                        'rgba(138, 43, 226, 0.2)',
                        'rgba(255, 165, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)',
                        'rgba(83, 102, 255, 1)',
                        'rgba(173, 255, 47, 1)',
                        'rgba(138, 43, 226, 1)',
                        'rgba(255, 165, 0, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Tỷ lệ phần trăm giá trị đơn hàng theo người tạo'
                    }
                }
            }
        });
    </script>
@endsection
