function  LlamadasCalidad() {
    cliente = $('#cliente').val();
    year = $('#year').val();
    mont = $('#mont').val();
    var param = {'Funcion': 'LlamadasCalidad', 'year': year, 'mont': mont, 'cliente': cliente};
    console.log(param)
    $.ajax({
        data: JSON.stringify(param),
        //async: false,
        type: "JSON",
        url: 'ajax.php',
        success: function (data) {
            console.log(data)
            json = JSON.parse((data))
            tr = "";
            trm = "";
            for (i = 0; i < 5; i++) {
                nu = parseInt(i) + 1;
                if (i == 0) {

                    tr += '<tr>' +
                                '<td rowspan="5" ><td rowspan="5" ><img src="Public/img/cel_ok.png" style="width: 40px"></td></td>' +
                                '<td style="text-align: center;"><img src="Public/img/' + i + '.png" style="width: 16px"></td>' +
                                '<td class="tdd" style="font-weight: bold!important;font-size: 16px !important;margin-right: 2px"> ' + json[2][i] + ' Llamadas</td>' +
                                '<td class="tdd cc"> '+json[1][i]+'</td>'+
                                '<td class="tdd" style="font-weight: bold!important;font-size: 13px !important;">' + json[0][i] + '</td> ' +
                          '</tr>';
                    trm += '<tr>' +
                                '<td rowspan="5" ><img src="Public/img/cel_off.png" style="width: 40px"></td>' +
                                '<td style="text-align: center;"><img src="Public/img/' + i + '.png" style="width: 16px"></td>' +
                                '<td class="tdd" style="font-weight: bold!important;font-size: 16px !important;margin-right: 2px"> ' + json[5][i] + ' Llamadas</td>' +
                                '<td class="tdd cc"> '+json[4][i]+'</td>'+
                                '<td class="tdd" style="font-weight: bold!important;font-size: 13px !important;">' + json[3][i] + '</td> ' +
                            '</tr>';
                } else {
                    tr += '<tr>' +
                                '<td style="text-align: center;"><img src="Public/img/' + i + '.png" style="width: 16px"></td>' +
                                '<td class="tdd" style="font-weight: bold!important;font-size: 16px !important;margin-right: 2px"> ' + json[2][i] + ' Llamadas</td>' +
                                '<td class="tdd cc"> '+json[1][i]+'</td>'+
                                '<td class="tdd" style="font-weight: bold!important;font-size: 13px !important;">' + json[0][i] + '</td> ' +
                           '</tr>';
                    trm += '<tr>' +
                                '<td style="text-align: center;"><img src="Public/img/' + i + '.png" style="width: 16px"></td>' +
                                '<td class="tdd" style="font-weight: bold!important;font-size: 16px !important;margin-right: 2px"> ' + json[5][i] + ' Llamadas</td>' +
                                '<td class="tdd cc"> '+json[4][i]+'</td>'+
                                '<td class="tdd" style="font-weight: bold!important;font-size: 13px !important;">' + json[3][i] + '</td> ' +
                            '</tr>';
                }
            }
            $('#tbcalidadMas').html('<table style="width: 100%;margin-left: -30px;">' +
                                                '<thead>' +
                                                '    <tr>' +
                                                '        <th colspan="5"><span style="text-align: center;color:#02B7E6;font-size:19px">MAS ATIENDE</span></th>' +
                                                '    </tr>' +
                                                '</thead>' +
                                                '<tbody>' + tr + '</tbody>' +
                                            '</table>');
            $('#tbcalidadMenos').html('<table style="width: 100%;margin-left: -30px;">' +
                                                '<thead>' +
                                                '    <tr>' +
                                                '        <th colspan="5"><span style="text-align: center;color:#02B7E6;font-size:19px">MENOS ATIENDE</span></th>' +
                                                '    </tr>' +
                                                '</thead>' +
                                                '<tbody>' + trm + '</tbody>' +
                                            '</table>');
            at = json[6][0].split(',');
            console.log(at)
            at =at[0]+at[1];
            at =parseInt(at)+0;
            pd = json[6][1].split(',');
            pd =pd[0]+pd[1];
            pd =parseInt(pd)+0;
            console.log(at);
            Highcharts.chart('barchart', {
                chart: {
                    type: 'column',
                    backgroundColor: 'transparent'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: ['Perdidas', 'Atendidas']
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
                    name: 'Llamadas',
                    data: json[6],
                    data: [{
                        name: 'Perdidas',
                        y: at,
                        drilldown: '',
                        color: '#02B7E6'
                    }, {
                        name: 'Atendidas',
                        y: pd,
                        drilldown: '',
                        color: '#1588B2'
                    }]
                }]
            });
            $('.highcharts-credits').css('display', 'none');
            $('.highcharts-legend').css('display', 'none');
            $('.highcharts-yaxis-labels').css('display', 'none');
            $('.highcharts-text-outline').css('background-color', '#f1f1f1')
            $('.tspan').css('background-color', '#f1f1f1')
        }
    });

    var param = {'Funcion': 'MaxMinLlamada', 'year': year, 'mont': mont, 'cliente': cliente};
    console.log(param)
    $.ajax({
        data: JSON.stringify(param),
        //async: false,
        type: "JSON",
        url: 'ajax.php',
        success: function (data) {
            console.log(data)
            json = JSON.parse((data))
            entrantes ="";
            salientes ="";
            s=0;
            e=0;
            for(p=0;p<json.length;p++){

                if(json[p]['identificacion'] == 'saliente'){
                    if(s == 0){
                        salientes+= '<div class="col-xs-12" style="margin-top: 30px">' +
                                        '<h3 style="text-align: center;font-weight: 500;font-size:18px;" >'+json[p]['minS']+' Min'+
                                            '<span style="margin-left:20px;text-align: center;font-weight: 500;font-size:18px;">Ext. '+json[p]['extencionS']+' al Numero '+json[0]['numberS']+' </span>' +
                                        '</h3>' +
                                    '</div>';
                        s=1;
                    }else{
                        salientes+= '<div class="col-xs-12" style="margin-top: -15px">' +
                                        '<h3 style="text-align: center;font-weight: 500;font-size:18px;" >'+json[p]['minS']+' Min'+
                                            '<span style="margin-left:20px;text-align: center;font-weight: 500;font-size:18px;">Ext. '+json[p]['extencionS']+' al Numero '+json[0]['numberS']+' </span>' +
                                        '</h3>' +
                                    '</div>';
                    }
                }else{
                    if(e == 0){
                        entrantes+= '<div class="col-xs-12" style="margin-top: 30px">' +
                                        '<h3 style="text-align: center;font-weight: 500;font-size:18px;" >'+json[p]['minE']+' Min'+
                                            '<span style="margin-left:20px;text-align: center;font-weight: 500;font-size:18px;"> Numero '+json[0]['numberE']+' A la Ext. '+json[p]['extencionE']+'</span>' +
                                        '</h3>' +
                                    '</div>';
                        e=1;
                    }else{
                        entrantes+= '<div class="col-xs-12" style="margin-top: -15px">' +
                                        '<h3 style="text-align: center;font-weight: 500;font-size:18px;" >'+json[p]['minE']+' Min'+
                                            '<span style="margin-left:20px;text-align: center;font-weight: 500;font-size:18px;"> Numero '+json[0]['numberE']+' A la Ext. '+json[p]['extencionE']+'</span>' +
                                        '</h3>' +
                                    '</div>';
                    }
                }
            }
            $('#cal_duracion_ll_entrantes').html(entrantes);
            $('#cal_duracion_ll_salientes').html(salientes);

        }
    });

}

