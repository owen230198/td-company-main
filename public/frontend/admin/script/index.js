var orderLastSixMonthChart = function()
{
    var bar_ctx = document.getElementById('bar-chart').getContext('2d');

    var purple_orange_gradient = bar_ctx.createLinearGradient(0, 100, 200, 500);
    purple_orange_gradient.addColorStop(0, '#459300');
    purple_orange_gradient.addColorStop(1, '#6be102');

    var bar_chart = new Chart(bar_ctx, {
        type: 'bar',
        data: {
            labels: ["Th 1", "Th 2", "th 3", "Th 4", "th 5", "th 6", "Th 7", "Th 8", "Th 9", "Th 10", "Th 11", "Th 12"],
            datasets: [{
                label: 'Số lượng đơn',
                data: [200, 155, 180, 230, 70, 50, 340, 210, 110, 211, 40, 35],
                backgroundColor: purple_orange_gradient,
                hoverBackgroundColor: purple_orange_gradient,
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
}

$(function(){
    orderLastSixMonthChart();   
});