function  MesImportar(){
    var year    = $('#year').val();
    var cliente = $('#cliente').val();
    if(year!=0 && cliente!=0) {
        var param = {'Funcion': 'InfoMesImportar', 'cliente': cliente, 'year': year};
        console.log(param)
        $.ajax({
            data: JSON.stringify(param),
            //async: false,
            type: "JSON",
            url: 'ajax.php',
            success: function (data) {
                console.log(data)
                json = JSON.parse(data);
                $('#mes_en_espera').html(json[0]['select'])
            }
        });
    }
}