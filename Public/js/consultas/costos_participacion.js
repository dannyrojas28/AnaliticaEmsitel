function CostosParticipacion() {
    cliente = $('#cliente').val();
    year = $('#year').val();
    mont = $('#mont').val();
    var param = {'Funcion': 'CostosParticipacion', 'year': year, 'mont': mont, 'cliente': cliente};
    console.log(param)
    $.ajax({
        data: JSON.stringify(param),
        //async: false,
        type: "JSON",
        url: 'ajax.php',
        success: function (data) {
            console.log(data)
            json=JSON.parse((data))
            console.log(json[0])
            console.log(json[1])
            console.log(json[2])
            Highcharts.chart('stacket_chart', {
                chart: {
                    type: 'bar',
                    backgroundColor: 'transparent'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: json[0],
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                            format: '{point.name} {point.y:.1f} {value}'
                        }
                    }
                },
                series: [{
                    name: 'Porcentaje',
                    color: '#02B7E6',
                    data: json[2],
                    dataLabels: {
                        format: '{point.name} {point.y:.1f} {value}%'
                    }
                }, {
                    name: 'Minutos',
                    color: '#022562',
                    data: json[1]
                }]
            });
            $('.highcharts-credits').css('display', 'none');
            $('.highcharts-text-outline').css('background-color', '#f1f1f1')
            $('.tspan').css('background-color', '#f1f1f1')
        }
    });
}