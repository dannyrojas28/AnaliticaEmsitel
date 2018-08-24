
Highcharts.chart('charta', {

    chart: {
        polar: true,
        type: 'line',
        backgroundColor:'transparent'
    },

    title: {
        text: ''
    },

    pane: {
        size: '80%',
        angleLineColor: "#000000",
        startAngle: 0,
        endAngle: 360
    },

    xAxis: {
        categories: ['&bull;', 'hola', '', '',
            ''],
        lineWidth: 0,
        backgroundColor:'#02B7E6',
        tickmarkPlacement: 'on',
    },

    yAxis: {
        gridLineInterpolation: 'polygon',
        lineWidth: 0,
        min: 0 ,
        max:10,
    },


    series: [{
        type: 'area',
        name: '',
        data: [7, 6, 5, 5, 4],
        pointPlacement: 'on'
    }]

});

Highcharts.chart('chartb', {

    chart: {
        polar: true,
        type: 'line',
        backgroundColor:'transparent'
    },

    title: {
        text: ''
    },

    pane: {
        size: '80%'
    },

    xAxis: {
        categories: ['', '', '', '',
            ''],
        lineWidth: 0,
        backgroundColor:'#02B7E6',
        tickmarkPlacement: 'on',
        lineWidth: 0
    },
    yAxis:{

        gridLineInterpolation: 'polygon',
        lineWidth: 0,
        min: 0,
        max:5
    },




    series: [{
        type: 'area',
        name: '',
        data: [1, 1,1, 1, 1],
        pointPlacement: 'on',
        lineWidth: 3
    }]

});
$('.highcharts-credits').css('display','none');
$('.highcharts-button').css('display','none');
$('.highcharts-legend-item').css('display','none');
/*
$('.highcharts-color-0').css('fill','#7cb5ec');
$('.highcharts-color-0').css('stroke','#7cb5ec');
$('.highcharts-axis.highcharts-color-0 .highcharts-axis-line').css('stroke','#7cb5ec');
$('.highcharts-axis.highcharts-color-0 text').css('fill','#7cb5ec');
$('.highcharts-yaxis .highcharts-axis-line').css('stroke-width','2px')*/