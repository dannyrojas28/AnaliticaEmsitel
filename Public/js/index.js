
function CheckRecordar(){
    remember = $('#remember').is(':checked');
    console.log(remember)
    if(remember == true){
        localStorage.setItem('user_ana',$('#usuario').val());
        localStorage.setItem('pass_ana',$('#password').val());
    }else{
        localStorage.setItem('user_ana','');
        localStorage.setItem('pass_ana','');
        localStorage.removeItem('user_ana');
        localStorage.removeItem('pass_ana');
    }
}
function TipoConex() {
    /* tpc=$('#tipo_conexion').val();
     if(tpc==2){
         $('#tabla_cdr').css('display','block');
     }else{
         $('#tabla_cdr').css('display','none');
     }*/
}
function VerPdf() {

    $('#respuesta').css('display', 'block');
    $('#header').css('display', 'none');
    $('#content').html('');
    $('#bodyll').css('display', 'none');

    //$('#content').css('display','block');
    //$('#contentFechas').css('display','none');
    extencion  = $('#extencion').val();
    if(extencion == 0) {
        $('.general2').css('display','block');
        $('.especifica2').css('display','none');
        CostosDistribuicion();
        CostosParticipacion();
        AprovechLlEntrantes();
        AprovechLlSalientes();
        AprovechLlInternas();
        LlamadasCalidad();
    }else{
        $('.general2').css('display','none');
        $('.especifica2').css('display','block');
        AprovechLlSalientesEspecifica();
    }
    setTimeout(function () {
        window.print();

    },5000);

}

function filtrarAnalitica(){
    $('#content').css('display','block');
    //$('#contentFechas').css('display','none');
    extencion  = $('#extencion').val();
    if(extencion == 0) {
        $('.general').css('display','block');
        $('.especifica').css('display','none');
        CostosDistribuicion();
        CostosParticipacion();
        AprovechLlEntrantes();
        AprovechLlSalientes();
        AprovechLlInternas();
        LlamadasCalidad();
    }else{

        $('.general').css('display','block');
        $('.especifica').css('display','none');
        AprovechLlSalientesEspecifica();
    }
}

function getListExtenciones(){
    cliente = $('#cliente').val();
    var param = {'Funcion': 'ListasExtenciones','cliente':cliente};
    $.ajax({
        data: JSON.stringify(param),
        //async: false,
        type: "JSON",
        url: 'ajax.php',
        success: function (data) {
            console.log(data)
            var json = JSON.parse(data);
            $('#extenciones').html('<label>Extender a extención</label>'+json[0]['select']);
        }
    });
}

function TBodyClientes(){
    var param = {'Funcion': 'InfoClientes'};
    console.log(param)
    $.ajax({
        data: JSON.stringify(param),
        //async: false,
        type: "JSON",
        url: 'ajax.php',
        success: function (data) {
            console.log(data)
            if(data!=false){
                var json = JSON.parse(data);
                html = "";
                for(i = 0;i<json.length;i++){
                    s = parseInt(i)+ 1;
                    html+= "<tr><td>"+s +"</td><td>"+json[i]['nombre_cliente']+"</td><td>"+json[i]['host_bd']+"</td><td>"+json[i]['name_conexion']+"</td><td><a href='BancoDatosCliente?cliente="+json[i]['id']+"'><span class='clickable panel-toggle panel-button-tab-left'><em class='fa fa-eye'></em></span></a></td></tr>";
                }
                $('#tbodyclientes').html(html);
            }else{
                $('#responsetable').html('No hay clientes');
            }

        }
    });
}

function NuevosDptos() {
    nuevos = $('#numerodepto').val();
    if(nuevos>0){
        html = "<br><br>";
        for(i = 1;i<=nuevos;i++){
            html+=' <input type="text" name="dpto_'+i+'" id="dpto_'+i+'" class="form-control" style="width: 320px;display: inline-block" placeholder="Escriba el nombre del Departamento" required><br><br>';
        }
        $('#dptos_html').html(html+' <button class="btn btn-primary" style="display: inline-block" type="submit"> Crear</button>');
    }else{
        $('#dptos_html').html('');
    }
}

function trashDpto(cod) {
    var param = {'Funcion': 'trashDpto','cod':cod};
    console.log(param)
    $.ajax({
        data: JSON.stringify(param),
        //async: false,
        type: "JSON",
        url: 'ajax.php',
        success: function (data) {
            console.log(data)
            $('#trtb' + cod).html('');
        }
    });
}
function saveDpto(cod) {
    dpto = $('#dpto_'+cod).val()
    var param = {'Funcion': 'saveDpto','cod':cod,'dpto':dpto};
    console.log(param)
    $.ajax({
        data: JSON.stringify(param),
        //async: false,
        type: "JSON",
        url: 'ajax.php',
        success: function (data) {
            console.log(data)
            //$('#trtb' + cod)
        }
    });
}
function  NuevasExtenciones(codcliente){
    nuevos = $('#numeroextenciones').val();
    if(nuevos>0){
        html = "<br><br>";
        var param = {'Funcion': 'ListasDptos','codcliente':codcliente};
        $.ajax({
            data: JSON.stringify(param),
            //async: false,
            type: "JSON",
            url: 'ajax.php',
            success: function (data) {
                console.log(data)
                if(data!=false) {
                    json = JSON.parse(data);
                    for (i = 1; i <= nuevos; i++) {
                        console.log(i);
                        console.log(nuevos);
                        html += ' <input type="numero" name="numextencion_' + i + '" id="numextencion_' + i + '" class="form-control" style="width: 100px;display: inline-block" placeholder="#" required>';
                        html += ' <input type="text" name="nameextencion_' + i + '" id="nameextencion_' + i + '"     class="form-control" style="width: 320px;display: inline-block" placeholder="Escriba el nombre de la extencion" required>';
                        html += '<select class="form-control"  name="cod_dptoextenciones' + i + '" style="margin:5px;width: 320px;display: inline-block" > ';
                        for (d = 0; d < json.length; d++) {
                            html += '<option value="' + json[d]['cod_dp'] + '">' + json[d]['cliente'] + '</option>';
                        }
                        html += '</select><br><br>';
                        console.log(i, nuevos)
                        if (i == nuevos) {
                            $('#extenciones_html').html(html + '<button class="btn btn-primary" style="display: inline-block" type="submit"> Crear</button>');
                        }
                    }
                }else{
                    $('#extenciones_html').html('Debes crear 1 departamento');
                }
            }
        });
    }else{
        $('#extenciones_html').html('');
    }
}
function trashExten(cod_ext) {
    var param = {'Funcion': 'trashExten','cod_ext':cod_ext};
    console.log(param)
    $.ajax({
        data: JSON.stringify(param),
        //async: false,
        type: "JSON",
        url: 'ajax.php',
        success: function (data) {
            console.log(data)
            $('#trtex' + cod_ext).html('');
        }
    });
}
function saveExten(cod_ext) {
    num_ext = $('#numextencion_'+cod_ext).val()
    name_ext = $('#nameextencion_'+cod_ext).val()
    cod_dpto = $('#coddptoextencion_'+cod_ext).val()
    var param = {'Funcion': 'saveExten','cod_ext':cod_ext,'nombre_ext':name_ext,'numero_ext':num_ext,'cod_dpto':cod_dpto};
    console.log(param)
    $.ajax({
        data: JSON.stringify(param),
        //async: false,
        type: "JSON",
        url: 'ajax.php',
        success: function (data) {
            console.log(data)
            //$('#trtb' + cod)
        }
    });
}