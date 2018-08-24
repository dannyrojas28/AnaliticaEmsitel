function  AprovechLlSalientes() {
        cliente = $('#cliente').val();
        year = $('#year').val();
        mont = $('#mont').val();
        var param = {'Funcion': 'AprovechLlSalientes', 'year': year, 'mont': mont, 'cliente': cliente};
        console.log(param)
        $.ajax({
            data: JSON.stringify(param),
            //async: false,
            type: "JSON",
            url: 'ajax.php',
            success: function (data) {
                console.log(data)
                json = JSON.parse((data))
                tr="";
                trm="";
                for(i=0;i<5;i++){
                    nu = parseInt(i)+ 1;
                    if(i ==0){

                      tr+='<tr>'+
                                '<td rowspan="5" style="position:relative;bottom: -30px"><span style="margin-right: 4px">MAS SE <BR>LLAMAN</span></td>'+
                                '<td style="text-align: center;margin:12px"><img src="Public/img/'+i+'.png" style="width: 16px"></td>'+
                                '<td class="tdd"> '+nu +'.'+json[0][i]+'</td>'+
                                '<td class="tdd" style="font-weight: bold!important;text-align: center;width: 50px">'+json[1][i]+'</td> '+
                          '</tr>';
                        trm+='<tr>'+
                            '<td rowspan="5" style="position:relative;bottom: -30px"><span style="margin-right: 4px">MENOS SE <BR>LLAMAN</span></td>'+
                            '<td style="text-align: center;margin:12px"><img src="Public/img/'+i+'.png" style="width: 16px"></td>'+
                            '<td class="tdd"> '+nu +'.'+json[2][i]+'</td>'+
                            '<td class="tdd" style="font-weight: bold!important;text-align: center;width: 50px">'+json[3][i]+'</td> '+
                            '</tr>';
                    }else{
                        tr+='<tr>'+
                                '<td style="text-align: center;margin:12px"><img src="Public/img/'+i+'.png" style="width: 16px"></td>'+
                                '<td class="tdd"> '+nu +'.'+json[0][i]+'</td>'+
                                '<td class="tdd" style="font-weight: bold!important;text-align: center;width: 50px">'+json[1][i]+'</td> '+
                            '</tr>';
                        trm+='<tr>'+
                            '<td style="text-align: center;margin:12px"><img src="Public/img/'+i+'.png" style="width: 16px"></td>'+
                            '<td class="tdd"> '+nu +'.'+json[2][i]+'</td>'+
                            '<td class="tdd" style="font-weight: bold!important;text-align: center;width: 50px">'+json[3][i]+'</td> '+
                            '</tr>';
                    }
                }
                $('#tbaprov_salientesMas').html('<table style="width: 100%">' +
                                                     '<thead>' +
                                                     '    <tr>' +
                                                     '        <th colspan="4"><span style="float:right">Nº de Veces</span></th>' +
                                                     '    </tr>' +
                                                     '</thead>'+
                                                     '<tbody>'+tr+'</tbody>' +
                                                '</table>');
                $('#tbaprov_salientesMenos').html('<table style="width: 100%">' +
                                                        '<tbody>'+trm+'</tbody>' +
                                                   '</table>');
                $('#aprov_salien_min').html(json[4][0]);
                $('#aprov_salien_lldia').html(json[4][2]);
                $('#aprov_salien_lltot').html(json[4][1]);
                var radarData3 = {
                    labels: [1,2,3,4,5],
                    datasets: [
                        {
                            label: "My Second dataset",
                            fillColor: "#02B7E6",
                            strokeColor: "#02B7E6",
                            pointColor: "#02B7E6",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "#290271",
                            max: 100,
                            min: 4,
                            startAngle: 1000,
                            data: json[1]
                        }
                    ],
                    scale: {
                        ticks: {
                            beginAtZero: false,
                            min: 1,
                            max: 10,
                            stepSize: 1000
                        },
                        pointLabels: {
                            fontSize: 18
                        }
                    },
                    legend: {
                        position: 'left'
                    }
                };
                var radarData4 = {
                    labels: [1,2,3,4,5],
                    datasets: [
                        {
                            label: "My Second dataset",
                            fillColor : "#ED5B42",
                            strokeColor : "#ED5B42",
                            pointColor : "#ED5B42",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "#290271",
                            startAngle:1000,
                            data: json[3]
                        }
                    ],
                    scale: {
                        ticks: {
                            beginAtZero: false,
                            min: 1,
                            max: 10,
                            stepSize: 50
                        },
                        pointLabels: {
                            fontSize: 18
                        }
                    },
                    legend: {
                        position: 'left'
                    }
                };
                var chart3 = document.getElementById("chart3").getContext("2d");
                window.myRadarChart = new Chart(chart3).Radar(radarData3, {
                    responsive: true,
                    scaleLineColor: "#898989",
                    angleLineColor: "#000000",
                    options: chartOptions
                });
                var chart4 = document.getElementById("chart4").getContext("2d");
                window.myRadarChart = new Chart(chart4).Radar(radarData4, {
                    responsive: true,
                    scaleLineColor: "#898989",
                    angleLineColor: "#000000",
                    options:chartOptions
                });
            }
        });
        var chartOptions = {
            scale: {
                ticks: {
                    beginAtZero: true,
                    min: 0,
                    max: 10,
                    stepSize: 20
                },
                pointLabels: {
                    fontSize: 18
                }
            },
            legend: {
                position: 'left'
            }
        };
        chart3.globalAlpha=0.7;
        chart4.globalAlpha=0.7;


}

