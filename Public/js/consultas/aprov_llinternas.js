function  AprovechLlInternas() {
        cliente = $('#cliente').val();
        year = $('#year').val();
        mont = $('#mont').val();
        var param = {'Funcion': 'AprovechLlInternas', 'year': year, 'mont': mont, 'cliente': cliente};
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
                                '<td class="tdd"> '+json[1][i]+'</td>'+
                                '<td class="tdd" style="font-weight: bold!important;text-align: center;width: 50px">'+json[2][i]+'</td> '+
                          '</tr>';
                        trm+='<tr>'+
                            '<td rowspan="5" style="position:relative;bottom: -30px"><span style="margin-right: 4px">MENOS SE <BR>LLAMAN</span></td>'+
                            '<td style="text-align: center;margin:12px"><img src="Public/img/'+i+'.png" style="width: 16px"></td>'+
                            '<td class="tdd"> '+nu +'.'+json[3][i]+'</td>'+
                            '<td class="tdd"> '+json[4][i]+'</td>'+
                            '<td class="tdd" style="font-weight: bold!important;text-align: center;width: 50px">'+json[5][i]+'</td> '+
                            '</tr>';
                    }else{
                        tr+='<tr>'+
                                '<td style="text-align: center;margin:12px"><img src="Public/img/'+i+'.png" style="width: 16px"></td>'+
                                '<td class="tdd"> '+nu +'.'+json[0][i]+'</td>'+
                                '<td class="tdd"> '+json[1][i]+'</td>'+
                                '<td class="tdd" style="font-weight: bold!important;text-align: center;width: 50px">'+json[2][i]+'</td> '+
                            '</tr>';
                        trm+='<tr>'+
                            '<td style="text-align: center;margin:12px"><img src="Public/img/'+i+'.png" style="width: 16px"></td>'+
                            '<td class="tdd"> '+nu +'.'+json[3][i]+'</td>'+
                            '<td class="tdd"> '+json[4][i]+'</td>'+
                            '<td class="tdd" style="font-weight: bold!important;text-align: center;width: 50px">'+json[5][i]+'</td> '+
                            '</tr>';
                    }
                }
                $('#tbaprov_internasMas').html('<table style="width: 100%">' +
                                                     '<thead>' +
                                                     '    <tr>' +
                                                     '        <th colspan="5"><span style="float:right">Nº de Veces</span></th>' +
                                                     '    </tr>' +
                                                     '</thead>'+
                                                     '<tbody>'+tr+'</tbody>' +
                                                '</table>');
                $('#tbaprov_internasMenos').html('<table style="width: 100%">' +
                                                        '<tbody>'+trm+'</tbody>' +
                                                   '</table>');
                $('#aprov_inter_min').html(json[6][0]);
                $('#aprov_inter_lldia').html(json[6][2]);
                $('#aprov_inter_lltot').html(json[6][1]);
                var radarData5 = {
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
                            data: json[2]
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
                var radarData6 = {
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
                            data: json[5]
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
                var chart5 = document.getElementById("chart5").getContext("2d");
                window.myRadarChart = new Chart(chart5).Radar(radarData5, {
                    responsive: true,
                    scaleLineColor: "#898989",
                    angleLineColor: "#000000",
                    options: chartOptions
                });
                var chart6 = document.getElementById("chart6").getContext("2d");
                window.myRadarChart = new Chart(chart6).Radar(radarData6, {
                    responsive: true,
                    scaleLineColor: "#898989",
                    angleLineColor: "#s000000",
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
        chart5.globalAlpha=0.7;
        chart6.globalAlpha=0.7;


}

