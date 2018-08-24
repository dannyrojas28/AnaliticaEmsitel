<?php
require_once 'App/Controllers/PrincipalController.php';
require_once 'Config/vars.php';
include "App/Views/includes/header.php";
$estado = "Inicio";
$thiss = new PrincipalController();

//Calcular dias entre las dos fechas

?>
<link href="../../Public/css/bootstrap.min.css" rel="stylesheet"  >
<link href="../../Public/css/styles.css" rel="stylesheet"  >
<link href="../../Public/css/datepicker3.css" rel="stylesheet" >
<script type="text/javascript" src="../../Public/js/consumirdatos.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="">

    <?php
    // echo $dias;
    if(!empty($_GET['fechaI'])){
        echo ' <div style="text-align: center" class="col-xs-12">
        <hr><a href="ConsumirDatos" class="btn btn-primary" style="float: left;left: 0;">Volver</a></div>';
        $fechaI = $_GET['fechaI'];
        $fechaF = $_GET['fechaF'];
        $datetime1 = date_create($fechaI);
        $datetime2 = date_create($fechaF);
        $interval = date_diff($datetime1, $datetime2);
        $dias = $interval->format('%a');
        if($dias>=0){
            $sql = "";
            if($_GET['cliente']!=0){
                $sql = "AND cod_cl = ".$_GET['cliente'];
            }
            $result = $thiss->InfoClientesGrandStream($sql);
            if($result!=false){
                $con = "223";
                while ($res =mysqli_fetch_object($result)){
                     /*
                        $host = $res->host_bd;
                        $usuario = $res->usuario_bd;
                        $contrasena = $thiss->Desencriptar($res->contrasena_bd);
                        $values = "";

                         $values= $thiss->EjecutarApiCdr($usuario,$contrasena,$host,$fechaI,$fechaF,$values);
                        $values.="p";
                        $values = str_replace(',p','',$values);

                    */
                    $sql = $thiss->InfoLlamadaFecha($fechaI,$fechaF,$res->tabla_cdr);
                    if($sql == false){
                        $host = $res->host_bd;
                        $usuario = $res->usuario_bd;
                        $contrasena = $thiss->Desencriptar($res->contrasena_bd);
                        $values = "";

                          for($j=0;$j<=$dias;$j++){
                             //   echo $fechaI,$j;
                             $fecha = $thiss->SumarDias($fechaI,$j);
                             $fechaini = $fecha.'T00:00:00-05:00';
                             $fechafin = $fecha.'T11:59:59-05:00';
                             $values = $thiss->EjecutarApiCdr($usuario,$contrasena,$host,$fechaini,$fechafin,$values);
                             $fecha = $thiss->SumarDias($fechaI,$j);
                             $fechaini = $fecha.'T12:00:00-05:00';
                             $fechafin = $fecha.'T23:59:59-05:00';
                             $values = $thiss->EjecutarApiCdr($usuario,$contrasena,$host,$fechaini,$fechafin,$values);
                         }

                        $values.="p";
                        $values = str_replace(',p','',$values);
                        $insert =" INSERT INTO ".$res->tabla_cdr." (`id`, `src`, `dst`, `calldate`, `duration`, `billsec`, `disposition`, `mes`, `clid`,`tipo`,`userfield`,`session`) VALUES $values";
                        $nombre_cliente = $res->nombre_cliente;
                        if($thiss->Insert($insert)){
                            $con = 1;
                            echo "se registraron los datos de ".$res->nombre_cliente.'<br>';
                        }else{
                            echo "no se han podido registrar los datos de ".$res->nombre_cliente.'<br>';
                            $con == 0;
                        }
                    }else{
                        echo "YA EXISTE DATA DE ".$res->nombre_cliente." EN LA FECHA CONSULTADA ".$fechaI;
                    }
                }

            }else{
                echo "No Hay clientes GrandStream";
            }
        }else{
            echo "las fechas deben tener una diferencia de mas de 5 dias";
        }




    }else{
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">Seleccione Fechas</div>
        <div class="panel-body">
            <form action="ConsumirDatos" method="get">
                <div class="col-md-4 col-md-offset-3 col-xs-12">
                    <div class="form-group">
                        <label>Cliente</label>
                        <select class="form-control" name="cliente" id="cliente" onchange="MesImportar()">

                            <?php
                            echo '<option value="0">Seleccionar</option>';
                            $result= $thiss->InfoClientesGrandStream(' ');
                            if($result!=false){

                                while ($res =mysqli_fetch_object($result)){
                                    echo '<option value="'.$res->cod_cl.'">'.$res->nombre_cliente.'</option> ';
                                }
                            }else{
                                echo '<option value="">No hay Clientes</option>';
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-3 col-xs-12">
                    <div class="form-group">
                        <label>Año</label>
                        <input type="date" name="fechaI" class="form-control" style="display: none">
                            <select id="year" name="year" class="form-control" onchange="MesImportar()">

                                <?php
                                    echo '<option value="0">Seleccionar</option>';
                                     $m = date('m');
                                     if($m == 01){
                                         $yearFinal = 2017;
                                     }else{
                                         $yearFinal = date('Y');
                                     }
                                     for($y = 2017;$y<=$yearFinal;$y++){
                                         echo '<option value="'.$y.'">'.$y.'</option>';
                                     }
                                ?>
                            </select>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-3 col-xs-12">
                    <div class="form-group">
                        <label>Mes</label>
                        <input type="date" name="fechaF" class="form-control" style="display:none;">
                        <div id="mes_en_espera"></div>
                    </div>
                </div>


                <div style="text-align: center" class="col-xs-12">


                    <hr><button type="submit" class="btn btn-primary">Importar</button>
                </div>

                <div class="col-xs-12">

                </div>

            </form>
        </div><!-- /.panel-->
    </div>
    <?php
    }
    ?>
</div>
