Highcharts.chart('barchart', {
    chart: {
        type: 'column',
        backgroundColor:'transparent'
    },
    title: {
        text: ''
    },
    xAxis: {
        categories: ['', '', '']
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },
    series: [{
        name: '',
        data: [787, 1763, 0],
        data: [{
            name: '',
            y: 787,
            drilldown: '',
            color:'#02B7E6'
        }, {
            name: '',
            y: 1763,
            drilldown: '',
            color: '#1588B2'
        }, {
            name: '',
            y: 0,
            drilldown: '',
            color: '#022562'
        }]
    }]
});
$('.highcharts-credits').css('display','none');
$('.highcharts-legend').css('display','none');
$('.highcharts-yaxis-labels').css('display','none');
$('.highcharts-text-outline').css('background-color','#f1f1f1')
$('.tspan').css('background-color','#f1f1f1')