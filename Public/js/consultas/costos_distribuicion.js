function CostosDistribuicion() {
    mont    = $("#mont :selected").text();
    year    = $("#year :selected").text();
    cliente = $("#cliente :selected").text();

    $('#mest').html(mont);
    $('#yeart').html(year);
    $('#clientet').html(cliente);


    cliente = $('#cliente').val();
    year = $('#year').val();
    mont = $('#mont').val();
    var param = {'Funcion': 'CostosDistribuicion', 'year': year, 'mont': mont, 'cliente': cliente};
    console.log(param)
    $.ajax({
        data: JSON.stringify(param),
        //async: false,
        type: "JSON",
        url: 'ajax.php',
        success: function (data) {
            console.log(data)
            var json = JSON.parse(data);
            $('#periodot').html(json[0]['periodo']);
            $('#nombre_ejec').html(json[0]['nombre_eje']);
            $('#cosDis_mensual').html(json[0]['totalPlata'] )
            $('#cosDis_minuto').html(json[0]['valorMin'] )
            $('#cosPar_mensual').html(json[0]['totalPlata'])
            $('#cosPar_minuto').html(json[0]['valorMin'])

            Highcharts.chart('pie_chart', {
                chart: {
                    type: 'pie',
                    backgroundColor: 'transparent'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                plotOptions: {
                    series: {
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: {point.y:.1f}%'
                        },
                        animation: {
                            duration: 2000,
                            easing: 'easeOutBounce'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br/>'
                },
                series: [{
                    name: 'Canales',
                    colorByPoint: true,
                    data: [{
                        name: 'Fijo Local',
                        y: parseFloat(json[0]['fijoPor']) + 0,
                        color: '#16546E',
                        drilldown: 'Fijo Local'
                    }, {
                        name: 'Celular',
                        y: parseFloat(json[0]['celularPor']) + 0,
                        color: '#022562',
                        drilldown: 'Celular'
                    }, {
                        name: 'Fijo Nacional',
                        y: parseFloat(json[0]['nacionalPor']) + 0,
                        color: '#02B7E6',
                        drilldown: 'Fijo Nacional'
                    }, {
                      name: 'Internacional',
                        y: parseFloat(json[0]['internacionalPor']) + 0,
                        color: '#1588B2',
                        drilldown: 'Internacional'
                    }]
                }]
            });
            $('.highcharts-credits').css('display', 'none');
            $('.highcharts-text-outline').css('font-size', '15px')
            $('.highcharts-text-outline').css('background-color', '#f1f1f1')
            $('tspan').css('font-size', '15px')
            $('.tspan').css('background-color', '#f1f1f1')
            $('.highcharts-container ').css('margin-bottom', '-50px')
        }
    });
}