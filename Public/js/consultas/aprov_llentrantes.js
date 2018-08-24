function  AprovechLlEntrantes() {
        cliente = $('#cliente').val();
        year = $('#year').val();
        mont = $('#mont').val();
        var param = {'Funcion': 'AprovechLlEntrantes', 'year': year, 'mont': mont, 'cliente': cliente};
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
                                '<td rowspan="5" style="position:relative;bottom: -30px"><span style="margin-right: 4px">MAS ME <BR>LLAMAN</span></td>'+
                                '<td style="text-align: center;margin:12px"><img src="Public/img/'+i+'.png" style="width: 16px"></td>'+
                                '<td class="tdd"> '+nu +'.'+json[0][i]+'</td>'+
                                '<td class="tdd" style="font-weight: bold!important;text-align: center;width: 50px">'+json[1][i]+'</td> '+
                          '</tr>';
                        trm+='<tr>'+
                            '<td rowspan="5" style="position:relative;bottom: -30px"><span style="margin-right: 4px">MENOS ME <BR>LLAMAN</span></td>'+
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
                $('#tbaprov_entrantesMas').html('<table style="width: 100%">' +
                                                     '<thead>' +
                                                     '    <tr>' +
                                                     '        <th colspan="4"><span style="float:right">Nº de Veces</span></th>' +
                                                     '    </tr>' +
                                                     '</thead>'+
                                                     '<tbody>'+tr+'</tbody>' +
                                                '</table>');
                $('#tbaprov_entrantesMenos').html('<table style="width: 100%">' +
                                                        '<tbody>'+trm+'</tbody>' +
                                                   '</table>');
                $('#aprov_entra_min').html(json[4][0]);
                $('#aprov_entra_lldia').html(json[4][2]);
                $('#aprov_entra_lltot').html(json[4][1]);
                var radarData1 = {
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
                var radarData2 = {
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
                var chart1 = document.getElementById("chart1").getContext("2d");
                window.myRadarChart = new Chart(chart1).Radar(radarData1, {
                    responsive: true,
                    scaleLineColor: "#898989",
                   angleLineColor: "#000000",
                    options: chartOptions
                });
                var chart2 = document.getElementById("chart2").getContext("2d");
                window.myRadarChart = new Chart(chart2).Radar(radarData2, {
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
        chart1.globalAlpha=0.7;
        chart2.globalAlpha=0.7;


}

