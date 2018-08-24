<?php
require_once 'App/Controllers/PrincipalController.php';
require_once 'Config/vars.php';
include "App/Views/includes/header.php";
$estado = "Inicio";
$PrincipalController = new PrincipalController();
?>

<link href="../../Public/css/bootstrap.min.css" rel="stylesheet"  >
<link href="../../Public/css/styles.css" rel="stylesheet"  >
<link href="../../Public/css/datepicker3.css" rel="stylesheet" >
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="Inicio"><em class="fa fa-home"></em></a></li>
            <li class="active"><a href="Inicio">Dashboard</a></li>
        </ol>
    </div><!--/.row-->

    <br><br>
    <!--<div class="col-sm-12 col-lg-8 col-lg-offset-2 col-md-12 col-xs-12 main" style="  background: url(Public/img/fondo_analitica.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size: 792px 612px">-->
    <div class="col-sm-12" style="margin:0 auto;padding:0px;" id="contentFechas" >
        <div class="panel panel-default">
            <div class="panel-heading">Seleccione Fechas</div>
            <div class="panel-body">
                <div class="col-md-6 col-md-offset-3 col-xs-12">
                    <div class="form-group">
                        <label>Mes</label>
                        <select class="form-control" name="mont" id="mont">
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Año</label>
                        <select class="form-control" name="year" id="year">
                            <?php
                            $year = date('Y');
                            $yearf = $year - 8;
                            for($yearn = $year; $yearn>$yearf;$yearn--){
                                echo ' <option value="'.$yearn.'">'.$yearn.'</option>';
                            }


                            ?>
                        </select>
                    </div>
                    <?php
                    if($_SESSION['rol_us'] == 1){

                    ?>
                    <div class="form-group">
                        <label>Seleccione el Cliente</label>
                        <select class="form-control" name="cliente" id="cliente">
                            <?php

                            $result = $PrincipalController->InfoClienteGet($re = '');
                            while($res = mysqli_fetch_object($result)){
                                echo ' <option value="'.$res->cod_cl.'">'.utf8_encode($res->nombre_cliente).'</option>';
                            }


                            ?>
                        </select>
                    </div>
                    <?php
                    }else{
                        echo '<input type="hidden" id="cliente" value="">';
                    }

                    ?>
                    <button onclick="filtrarAnalitica()" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </div><!-- /.panel-->
    </div>
    <div class="col-sm-12" style="margin:0 auto;padding:0px;display: none;" id="content" >
        <div style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div style="width: 100%;height:187.78px;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;" >
                <br><h3 style="color: #ffffff;font-size: 28px;text-align: center;">LA ANALÍTICA TELEFONICA <br> Primer Paso hacia la transformación Digitial<br> Periodo Nº 2: Diciembre 2017 <br>Palustre</h3><br>

            </div>

        </div>
        <div style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
            <br><br>
            <br><h3 style="color: #808080;font-size: 20px;text-align: center;font-weight: 400;"><br><br><br><br>
                BIENVENIDO :<br><br><br>
                La analítica telefónica; recolecta, explora, analiza y entrega la<br>
                infografía para visualizar la información de manera efectiva e<br>
                identificar las oportunidades de mejora.<br><br><br>
                Nuestro compromiso para transformar las palabras en<br>
                conocimiento , innovar y ser mas eficientes y competitivos;<br>
                tiene como requisito se utilice de manera metódica,<br>
                constante y disciplinada.<br><br><br>
                En consecuencia la Infografía esta diseñada para que nos<br>
                ayude si no entendemos algo, se nos ocurre una idea o se<br>
                necesita información adicional. De esta manera obtenemos el<br>
                conocimiento de manera sencilla y entretenida.<br><br><br><br><br><br><br>
                EVOLUCIONEMOS JUNTOS<br><br><br><br>
                Vanessa Uribe<br>
                Ejecutiva<br>
                Desarrollo Empresarial<br>
            </h3>
        </div>
        <div style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
            <br><br>
            <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">Costos</h1></div>

            <h3 style="color:#193D81;text-align: center;font-weight: 500"><i>Distribuición</i></h3><br><br>
            <div class="col-md-8"></div>
            <div class="col-md-4" style="    background: url(Public/img/fondo_informativo.png) no-repeat;-webkit-background-size: cover;-moz-background-size: cover;background-size: 100% 160px;height: 199px; margin-top:220px;   position: absolute;right: 0px;float: right;">
                <div style="text-align: center">
                    <img src="Public/img/globo_emsitel.png" style="width: 40px;margin-top: 5px"><br>
                    <h5 style="color:#ffffff">$<span id="cosDis_minuto"></span> &nbsp;&nbsp;&nbsp; |Costo por min.</h5>
                    <h3 style="color:#ffffff">$<span id="cosDis_mensual"></span><br>
                        Valor Mensual</h3>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1"><br>
                <div id="pie_chart"  style="margin-top: -70px">
                </div>
            </div>
            <div class="col-md-12" style="margin-top:70px">
                <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 "><span style="color: #193D81">Oportunidad de Mejora</span></u></i></h3>
                <div class="col-md-8 " style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8 col-md-offset-4" style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8"  style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                    </div>
                </div>
            </div>

        </div>
        <div style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
            <br><br>
            <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">Costos</h1></div>

            <h3 style="color:#193D81;text-align: center;font-weight: 500"><i>Participación</i></h3><br><br>
            <div class="col-md-8"></div>
            <div class="col-md-3" style="    background: url(Public/img/fondo_informativo.png) no-repeat;-webkit-background-size: cover;-moz-background-size: cover;background-size: 100% 160px;height: 199px;top:555px;    position: absolute;right: 0px;float: right;">
                <div style="text-align: center">
                    <img src="Public/img/globo_emsitel.png" style="width: 50px;margin-top: 5px"><br>
                    <h5 style="color:#ffffff">$<span id="cosPar_minuto"></span> &nbsp;&nbsp;&nbsp; |Costo por min.</h5>
                    <h4 style="color:#ffffff">$<span id="cosPar_mensual"></span><br>
                        Valor Mensual</h4>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1" style=" margin-top: -50px;"><br>
                <div id="stacket_chart" >
                </div>
            </div>
            <div class="col-md-12">
                <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 "><span style="color: #193D81">Oportunidad de Mejora</span></u></i></h3>
                <div class="col-md-8 " style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8 col-md-offset-4" style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8"  style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                    </div>
                </div>
            </div>

        </div>
        <div style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
            <br><br>
            <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">APROVECHAMIENTO</h1></div>
            <div class="col-md-8"></div>
            <div class="col-md-3" style="    background: url(Public/img/fondo_informativo.png) no-repeat;-webkit-background-size: cover;-moz-background-size: cover;background-size: 100% 160px;height: 199px;top:555px;    position: absolute;right: 0px;float: right;">
                <div style="text-align: center">

                    <h4 style="color:#ffffff;font-size: 19px!important;"><span style="color: #fffff;">Promedio de Llamadas</span><br><span style="color:#94C433"><span id="aprov_entra_lldia"></span> al dia</span><br><span style="color: #fffff;">Datos basados en</span><br><span style="color:#94C433" id="aprov_entra_lltot"></span><br><span style="color: #fffff;">Llamadas</span></h4>
                </div>
            </div>
            <div class="col-md-12">
                <h4 style="color: #94C433;    margin-left: 70px;margin-top: 10px;"> LLAMADAS ENTRANTES</h4>
                <img src="Public/img/pie_de_titulo.png" style="width:183px;    position: absolute;margin-left: 112px;margin-top: -52px;">
            </div>
            <div class="col-md-6" style=" "><br>
                <canvas class="chart" id="chart1" style="float: left;left: 0;margin-left: 60px;"></canvas>
            </div>
            <div class="col-md-6" style="  margin-top: -20px">
                <div id="tbaprov_entrantesMas"></div>
                <img src="Public/img/fondo_titulos.png" style="width: 100%;height: 10px">
            </div>

            <div class="col-md-12"></div>
            <div class="col-md-6 "  style="position: relative"><br>
                <canvas class="chart" id="chart2" style="float: right;right: 0;margin-top: -20px;
    margin-right: 80px;"></canvas>

            </div>
            <div class="col-md-6 " style="  margin-top: -40px; "><br>
                <div id="tbaprov_entrantesMenos"></div>
            </div>
            <div class="col-md-12" style="text-align: center">
                <img src="Public/img/fondo_titulos.png" style="    width: 270px;position: absolute; margin-left: -130px;margin-top: -52px;z-index: 9998;">
                <h5 style="    font-weight: 500;margin-top: -50px;z-index: 99999;position: absolute;text-align: center;width: 100%;">Promedio de duración <br>de la llamada <span id="aprov_entra_min"></span>min</h5>

            </div>
            <div class="col-md-12">
                <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 "><span style="color: #193D81">Oportunidad de Mejora</span></u></i></h3>
                <div class="col-md-8 " style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8 col-md-offset-4" style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8"  style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                    </div>
                </div>
            </div>

        </div>
        <div style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
            <br><br>
            <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">APROVECHAMIENTO</h1></div>
            <div class="col-md-8"></div>
            <div class="col-md-3" style="    background: url(Public/img/fondo_informativo.png) no-repeat;-webkit-background-size: cover;-moz-background-size: cover;background-size: 100% 130px;height: 199px;top:255px;    position: absolute;right: 0px;float: right;">
                <div style="text-align: center">

                    <h4 style="color:#ffffff;font-size: 17px!important;"><span style="color: #fffff;">Promedio de Llamadas</span><br><span style="color:#94C433"><span id="aprov_salien_lldia"></span> al dia</span><br><span style="color: #fffff;">Datos basados en</span><br><span style="color:#94C433" id="aprov_salien_lltot"></span><br><span style="color: #fffff;">Llamadas</span></h4>
                </div>
            </div>
            <div class="col-md-12">
                <h4 style="color: #94C433;    margin-left:10px;margin-top: 10px;"> LLAMADAS SALIENTES</h4>
                <img src="Public/img/pie_de_titulo.png" style="width:183px;    position: absolute;margin-left: 34px;margin-top: -52px;">
            </div>
            <div class="col-md-6" style="  margin-top: -20px">
                <div id="tbaprov_salientesMas"></div>
                <img src="Public/img/fondo_titulos.png" style="width: 100%;height: 10px">
            </div>
            <div class="col-md-6" style=" "><br>
                <canvas class="chart" id="chart3" style="float: right;right: 0;margin-top: -20px;margin-right: 80px;"></canvas>
            </div>


            <div class="col-md-12"></div>
            <div class="col-md-6 " style="    margin-top: -30px; "><br>
                <div id="tbaprov_salientesMenos"></div>
            </div>
            <div class="col-md-6 "  style="position: relative"><br>
                <canvas class="chart" id="chart4" style="float: right;right: 0;margin-top: -20px;margin-right: 80px;"></canvas>

            </div>

            <div class="col-md-12" style="">
                <img src="Public/img/fondo_titulos.png" style="    width: 230px;position: absolute;margin-top: -402px;float: right;z-index: 9998;right: 0px;">
                <h5 style="    font-weight: 500;margin-left: 265px;margin-top: -397px;z-index: 99999;position: absolute;text-align: center;width: 100%;">Promedio de duración <br>de la llamada <span id="aprov_salien_min"></span>min</h5>

            </div>
            <div class="col-md-12"><br>
                <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 "><span style="color: #193D81">Oportunidad de Mejora</span></u></i></h3>
                <div class="col-md-8 " style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8 col-md-offset-4" style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8"  style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                    </div>
                </div>
            </div>

        </div>
        <div style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
            <br><br>
            <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">APROVECHAMIENTO</h1></div>
            <div class="col-md-8"></div>
            <div class="col-md-3" style="    background: url(Public/img/fondo_informativo.png) no-repeat;-webkit-background-size: cover;-moz-background-size: cover;background-size: 100% 160px;height: 199px;top:555px;    position: absolute;right: 0px;float: right;">
                <div style="text-align: center">

                    <h4 style="color:#ffffff;font-size: 19px!important;"><span style="color: #fffff;">Promedio de Llamadas</span><br><span style="color:#94C433"><span style="color:#94C433"><span id="aprov_inter_lldia"> al dia</span><br><span style="color: #fffff;">Datos basados en</span><br><span style="color:#94C433" id="aprov_inter_lltot"></span><br><span style="color: #fffff;">Llamadas</span></h4>
                </div>
            </div>
            <div class="col-md-12">
                <h4 style="color: #94C433;    margin-left:10px;margin-top: 10px;"> LLAMADAS INTERNAS</h4>
                <img src="Public/img/pie_de_titulo.png" style="width:183px;    position: absolute;margin-left: 34px;margin-top: -52px;">
            </div>
            <div class="col-md-5" style=" "><br>
                <canvas class="chart" id="chart5" style="float: left;left: 0;margin-left: 60px;"></canvas>
            </div>
            <div class="col-md-7" style="  margin-top: -10px">
                <div id="tbaprov_internasMas"></div>
                <img src="Public/img/fondo_titulos.png" style="width: 100%;height: 10px">
            </div>

            <div class="col-md-12"></div>
            <div class="col-md-5 "  style="position: relative"><br>
                <canvas class="chart" id="chart6" style="float: right;right: 0;margin-top: -20px;
    margin-right: 40px;"></canvas>

            </div>
            <div class="col-md-7 " style="    margin-top: -20px; "><br>
                <div id="tbaprov_internasMenos"></div>
            </div>
            <br><br>
            <div class="col-md-12" style="text-align: center">
                <img src="Public/img/fondo_titulos.png" style="    width: 270px;position: absolute; margin-left: -130px;margin-top: -2px;z-index: 9998;">
                <h5 style="    font-weight: 500;margin-top: -1px;z-index: 99999;position: absolute;text-align: center;width: 100%;">Promedio de duración <br>de la llamada <span style="color:#94C433" id="aprov_inter_min"></span>min</h5>

            </div>
            <div class="col-md-12"><br><br>
                <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 "><span style="color: #193D81">Oportunidad de Mejora</span></u></i></h3>
                <div class="col-md-8 " style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8 col-md-offset-4" style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8"  style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                    </div>
                </div>
            </div>

        </div>
        <div style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
            <br><br>
            <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">CALIDAD</h1></div>
            <div class="col-md-12">
                <h4 style="color: #94C433;    margin-left:10px;margin-top: 10px;">Registro de Llamadas</h4>
                <img src="Public/img/pie_de_titulo.png" style="width:183px;    position: absolute;margin-left: 34px;margin-top: -52px;">
            </div>
            <div class="col-md-5" style=" "><br>
                <div id="barchart" style="min-width: 310px; height: 250px; margin: 0 auto;margin-left: -40px;"></div>
            </div>
            <div class="col-md-7" style="  margin-top: -10px" id="tbcalidadMas">

            </div>
            <div class="col-md-12"></div>
            <div class="col-md-5 "  style="position: relative;margin-top: -40px"><br>
                <div style="margin-top:-20px;    margin-left: 30px;">
                    <div style="width:23px;height: 14px;background: #02B7E6;display:inline-block"><p style="color:transparent">sd</p></div><h5 style="display:inline-block;margin-top: -2px;margin-left: 8px;font-weight: bold">Llamadas Perdidas</h5>
                </div>
                <div style="    margin-left: 30px;">
                    <div style="width:23px;height: 14px;background: #1588B2;display:inline-block"><p style="color:transparent">sd</p></div><h5 style="display:inline-block;margin-top: -2px;margin-left: 8px;font-weight: bold">Llamadas Atendidas</h5>
                </div>
            </div>
            <div class="col-md-7 " style="    margin-top: -100px; " id="tbcalidadMenos"><br>

            </div>
            <br><br>
            <br><br>
            <div class="col-md-12"><br><br><br>
                <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 "><span style="color: #193D81">Oportunidad de Mejora</span></u></i></h3>
                <div class="col-md-8 " style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8 col-md-offset-4" style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8"  style="height: 110px;position:relative;margin-top: 5px">
                    <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                    <div style="position: absolute;width:100%;height: 100%;">
                        <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="MyModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Buscar/Asignar Cliente</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 ">
                                <div class="form-group" style="margin-left:4px">
                                    <label>Identificacion</label>
                                    <input class="form-control" placeholder="Digite su busqueda" type="text" id="identificacion" onkeyup="BuscarCliente()">
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" id="table_clientes"></div>
                        <center><img src="Public/img/load.gif" style="width:280px;display: none;" id="img_load_cli"></center>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_llamada">
                        <input type="hidden" id="cliente_asignado">
                        <input type="hidden" id="nombre_cliente_asignado">
                        <label style="color:red;left: 0;display: none;" id="vacio_cliente_error">Debes asignar un cliente</label>
                        <label style="color:red;left: 0;display: none;" id="asignar_cliente_error">ERROR! No hemos podido asignar este cliente</label>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="AsignarCliente()">Asignar Cliente</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="MyModalSm">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Sesion</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 ">
                                <center><h2>Su Sesion ha expirado</h2></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style type="text/css">
            td, th{
                font-weight: 500!important;
                color: #555 !important;
                margin-top: 10px!important;
                height: 31px !important;
                font-size: 16px!important;
                /* max-width: 158.44px !important;*/
            }
            .tdd{
                font-size: 15px !important;
                font-weight: normal !important;
                color: #555 !important;
                text-overflow:ellipsis;
                white-space:nowrap;
                overflow:hidden;
            }
            .cc{
                color:#94C433 !important;
            }
        </style>

        <script src="../../Public/js/consultas/costos_distribuicion.js"></script>
        <script src="../../Public/js/consultas/costos_participacion.js"></script>
        <script src="../../Public/js/consultas/aprov_llentrantes.js"></script>
        <script src="../../Public/js/consultas/aprov_llsalientes.js"></script>
        <script src="../../Public/js/consultas/aprov_llinternas.js"></script>
        <script src="../../Public/js/consultas/llamadas_calidad.js"></script>


        <!--
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="../../Public/js/highcharts/policharts.js"></script>
        -->

    </div>
</div>  <!--/.main-->