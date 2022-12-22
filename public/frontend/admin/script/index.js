var orderLastSixMonthChart = function()
{
    var bar_ctx = document.getElementById('bar-chart').getContext('2d');

    var purple_orange_gradient = bar_ctx.createLinearGradient(0, 0, 0, 500);
    purple_orange_gradient.addColorStop(0, '#000020');
    purple_orange_gradient.addColorStop(1, '#000088');

    var bar_chart = new Chart(bar_ctx, {
        type: 'bar',
        data: {
            labels: ["Th 12", "Th 11", "th 10", "Th 9", "th 8", "th 7", "Th 6", "Th 5", "Th 4", "Th 3", "Th 2", "Th 1"],
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