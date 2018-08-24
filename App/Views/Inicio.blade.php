<?php
require_once 'App/Controllers/PrincipalController.php';
require_once 'Config/vars.php';


$estado = "Inicio";
$PrincipalController = new PrincipalController();
echo '<div id="header">';
include "App/Views/includes/header.php";
echo '</div>';
?>
<link href="../../Public/css/bootstrap.min.css" rel="stylesheet"  >
<link href="../../Public/css/styles.css" rel="stylesheet"  >
<link href="../../Public/css/datepicker3.css" rel="stylesheet" >

<div id="bodyll">


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
                <?php /*echo $PrincipalController->Desencriptar('7JiqamhoZmmFeam1vQ==');*/?>
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
                            <select class="form-control" name="cliente" id="cliente" onchange="getListExtenciones()">
                                <?php
                                echo ' <option value="0">Seleccionar</option>';
                                $result = $PrincipalController->InfoClienteGet($re = '');
                                while($res = mysqli_fetch_object($result)){
                                    echo ' <option value="'.$res->cod_cl.'">'.utf8_encode($res->nombre_cliente).'</option>';
                                }


                                ?>
                            </select>
                        </div>
                        <div class="form-group" id="extenciones">


                        </div>
                        <?php
                        }else{
                            echo '<input type="hidden" id="cliente" value="">';
                        }

                        ?>
                        <button onclick="filtrarAnalitica()" class="btn btn-primary">Filtrar</button>
                        <button onclick="VerPdf()" class="btn btn-primary">Ver PDF</button>
                    </div>
                </div>
            </div><!-- /.panel-->
        </div>
        <div class="col-sm-12" style="margin:0 auto;padding:0px;display: none;" id="content" >

            <div class="general" style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div style="width: 100%;height:187.78px;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;" >
                    <br><h3 style="color: #ffffff;font-size: 28px;text-align: center;">LA ANALÍTICA TELEFONICA <br> Primer Paso hacia la transformación Digitial<br> Periodo Nº <span id="periodot"></span>: <span id="mest"></span> <span id="yeart"></span> <br><span id="clientet"></span></h3><br>

                </div>

            </div>
            <div class="general" style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
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
                    <span id="nombre_ejec" style="color: #808080;font-size: 20px;"></span><br>
                    Ejecutiva<br>
                    Desarrollo Empresarial<br>
                </h3>
            </div>
            <div class="general" style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
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
                    <div id="pie_chart"  style="margin-top: -70px;    margin-left: -62px;">
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
            <div class="general" style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
                <br><br>
                <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">Costos</h1></div>

                <h3 style="color:#193D81;text-align: center;font-weight: 500"><i>Participación</i></h3><br><br>
                <div class="col-md-8"></div>
                <div class="col-md-3" style="    background: url(Public/img/fondo_informativo.png) no-repeat;-webkit-background-size: cover;-moz-background-size: cover;background-size: 100% 160px;height: 199px;top:500px;    position: absolute;right: 0px;float: right;">
                    <div style="text-align: center">
                        <img src="Public/img/globo_emsitel.png" style="width: 50px;margin-top: 5px"><br>
                        <h5 style="color:#ffffff">$<span id="cosPar_minuto"></span> &nbsp;&nbsp;&nbsp; |Costo por min.</h5>
                        <h4 style="color:#ffffff">$<span id="cosPar_mensual"></span><br>
                            Valor Mensual</h4>
                    </div>
                </div>
                <h3 style="color:#193D81;margin-top:  -30px;font-weight: 500;margin-left: 90px;"><i>Dpto. Area Ext.</i></h3>
                <h3 style="color:#193D81;text-align: center;margin-top:  -42px;font-weight: 500;float:left;margin-left:430px"><i>Min</i></h3>
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
            <div class="general" style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
                <br><br>
                <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">APROVECHAMIENTO</h1></div>
                <div class="col-md-8"></div>
                <div class="col-md-3" style="    background: url(Public/img/fondo_informativo.png) no-repeat;-webkit-background-size: cover;-moz-background-size: cover;background-size: 100% 160px;height: 199px;top:507px;    position: absolute;right: 0px;float: right;">
                    <div style="text-align: center">

                        <h4 style="color:#ffffff;font-size: 19px!important;"><span style="color: #fffff;">Promedio de Llamadas</span><br><span style="color:#94C433"><span id="aprov_entra_lldia"></span> al dia</span><br><span style="color: #fffff;">Datos basados en</span><br><span style="color:#94C433" id="aprov_entra_lltot"></span><br><span style="color: #fffff;">Llamadas</span></h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4 style="color: #94C433;    margin-left: 70px;margin-top: 10px;"> LLAMADAS ENTRANTES</h4>
                    <img src="Public/img/pie_de_titulo.png" style="width:183px;    position: absolute;margin-left: 112px;margin-top: -52px;">
                </div>
                <div class="col-md-5" style=" "><br>
                    <canvas class="chart" id="chart1" style="float: left;left: 0;margin-left: 14px;"></canvas>
                </div>
                <div class="col-md-7" style="  margin-top: -20px">
                    <div id="tbaprov_entrantesMas"></div>
                    <img src="Public/img/fondo_titulos.png" style="width: 100%;height: 10px">
                </div>

                <div class="col-md-12"></div>
                <div class="col-md-5 "  style="position: relative"><br>
                    <canvas class="chart" id="chart2" style="float: right;right: 0;margin-top: -20px;margin-right:4px;"></canvas>

                </div>
                <div class="col-md-7 " style="  margin-top: -40px; "><br>
                    <div id="tbaprov_entrantesMenos"></div>
                </div>
                <div class="col-md-12" style="text-align: center">
                    <img src="Public/img/fondo_titulos.png" style="    width: 270px;position: absolute; margin-left: -130px;margin-top: -17px;z-index: 9998;">
                    <h5 style="    font-weight: 500;margin-top: -7px;z-index: 99999;position: absolute;text-align: center;width: 100%;">Promedio de duración <br>de la llamada <span id="aprov_entra_min"></span>min</h5>

                </div>
                <div class="col-md-12" style="margin-top: 15px">
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
            <div class="general" style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
                <br><br>
                <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">APROVECHAMIENTO</h1></div>
                <div class="col-md-8"></div>
                <div class="col-md-3" style="    background: url(Public/img/fondo_informativo.png) no-repeat;-webkit-background-size: cover;-moz-background-size: cover;background-size: 100% 130px;height: 199px;top:515px;    position: absolute;right: 0px;float: right;">
                    <div style="text-align: center">

                        <h4 style="color:#ffffff;font-size: 17px!important;"><span style="color: #fffff;">Promedio de Llamadas</span><br><span style="color:#94C433"><span id="aprov_salien_lldia"></span> al dia</span><br><span style="color: #fffff;">Datos basados en</span><br><span style="color:#94C433" id="aprov_salien_lltot"></span><br><span style="color: #fffff;">Llamadas</span></h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4 style="color: #94C433;    margin-left:10px;margin-top: 10px;"> LLAMADAS SALIENTES</h4>
                    <img src="Public/img/pie_de_titulo.png" style="width:183px;    position: absolute;margin-left: 34px;margin-top: -52px;">
                </div>
                <div class="col-md-7" style="  margin-top: -20px">
                    <div id="tbaprov_salientesMas"></div>
                    <img src="Public/img/fondo_titulos.png" style="width: 100%;height: 10px">
                </div>
                <div class="col-md-5" style=" "><br>
                    <canvas class="chart" id="chart3" style="float: right;right: 0;margin-top: -20px;margin-right: 36px;"></canvas>
                </div>


                <div class="col-md-12"></div>
                <div class="col-md-7 " style="    margin-top: -30px; "><br>
                    <div id="tbaprov_salientesMenos"></div>
                </div>
                <div class="col-md-5 "  style="position: relative"><br>
                    <canvas class="chart" id="chart4" style="float: right;right: 0;margin-top: -20px;margin-right: 36px;"></canvas>

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
            <div class="general" style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
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
            <div class="general" style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
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
            <div class="general" style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
                <br><br>
                <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">CALIDAD</h1></div>
                <div class="col-xs-12"  >
                    <div class="col-xs-12">
                        <div class="col-md-12" style="text-align: center">
                            <img src="Public/img/fondo_titulos.png" style="    width: 100%;position: absolute; height: 43px;z-index: 9998;margin-left: -383px;">
                            <h3 style="font-size:18px;color:#193D81;font-weight: 500;    margin-top: 11px;z-index: 99999;position: absolute;text-align: center;width: 100%;">LLAMADAS ENTRANTES CON MAS DURACIÓN</h3>
                        </div>
                    </div>
                    <div id="cal_duracion_ll_entrantes"></div>
                </div>
                <div class="col-xs-12" style="margin-top: -28px"><hr style="border-top:7px solid #898b8d;"></div>
                <div class="col-xs-12"  style="margin-top: -10px">
                    <div class="col-xs-12">
                        <div class="col-md-12" style="text-align: center">
                            <img src="Public/img/fondo_titulos.png" style="    width: 100%;position: absolute; height: 43px;z-index: 9998;margin-left: -383px;">
                            <h3 style="font-size:18px;color:#193D81;font-weight: 500;    margin-top: 11px;z-index: 99999;position: absolute;text-align: center;width: 100%;">LLAMADAS SALIENTES CON MAS DURACIÓN</h3>
                        </div>
                    </div>
                    <div id="cal_duracion_ll_salientes"></div>
                </div>

                <div class="col-md-12" style="margin-top: -10px">
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
            <div class="especifica" style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
                <br><br>
                <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">APROVECHAMIENTO</h1></div>
                <div class="col-md-8"></div>
                <div class="col-md-3" style="    background: url(Public/img/fondo_informativo.png) no-repeat;-webkit-background-size: cover;-moz-background-size: cover;background-size: 100% 130px;height: 199px;top:560px;    position: absolute;right: 0px;float: right;">
                    <div style="text-align: center">

                        <h4 style="color:#ffffff;font-size: 17px!important;"><span style="color: #fffff;">Promedio de Llamadas</span><br><span style="color:#94C433"><span id="2aprov_salien_lldia"></span> al dia</span><br><span style="color: #fffff;">Datos basados en</span><br><span style="color:#94C433" id="2aprov_salien_lltot"></span><br><span style="color: #fffff;">Llamadas</span></h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4 style="color: #94C433;    margin-left:10px;margin-top: 10px;"> LLAMADAS SALIENTES  Ext. <span id="extEspecifica" style="font-size: 25px"></span></h4>
                    <img src="Public/img/pie_de_titulo.png" style="width:318px;    position: absolute;margin-left: 133px;margin-top: -84px;">
                </div>
                <div class="col-md-7" style="  margin-top: 5px">
                    <div id="2tbaprov_salientesMas"></div>
                    <img src="Public/img/fondo_titulos.png" style="width: 100%;height: 10px">
                </div>
                <div class="col-md-5" style=" "><br>
                    <canvas class="chart" id="2chart3" style="float: right;right: 0;margin-top: -20px;margin-right: 36px;"></canvas>
                </div>


                <div class="col-md-12"></div>
                <div class="col-md-7 " style="    margin-top: -30px; "><br>
                    <div id="2tbaprov_salientesMenos"></div>
                </div>
                <div class="col-md-5 "  style="position: relative"><br>
                    <canvas class="chart" id="2chart4" style="float: right;right: 0;margin-top: -20px;margin-right: 36px;"></canvas>

                </div>

                <div class="col-md-12" style="">
                    <img src="Public/img/fondo_titulos.png" style="    width: 230px;position: absolute;margin-top: -402px;float: right;z-index: 9998;right: 0px;">
                    <h5 style="    font-weight: 500;margin-left: 265px;margin-top: -397px;z-index: 99999;position: absolute;text-align: center;width: 100%;">Promedio de duración <br>de la llamada <span id="2aprov_salien_min"></span>min</h5>

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
            <div class="especifica" style="position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;top:100%;width:822px;height: 1012px;background: url(Public/img/fondo_analitica.png) no-repeat; -webkit-background-size: cover;-moz-background-size: cover;background-size:100% 100%;border: 12px solid #ffffff;">
                <br><br>
                <div style="width: 100%;background: url(Public/img/fondo_titulos.png) ; -webkit-background-size: cover;-moz-background-size: cover;background-size:100%;" ><h1 style="color: #ffffff;font-size: 50px;text-align: center;font-weight: bold;">CALIDAD</h1></div>
                <div class="col-xs-12"  >
                    <div class="col-xs-12">
                        <div class="col-md-12" style="text-align: center">
                            <img src="Public/img/fondo_titulos.png" style="    width: 100%;position: absolute; height: 43px;z-index: 9998;margin-left: -383px;">
                            <h3 style="font-size:18px;color:#193D81;font-weight: 500;    margin-top: 11px;z-index: 99999;position: absolute;text-align: center;width: 100%;">LLAMADAS ENTRANTES CON MAS DURACIÓN</h3>
                        </div>
                    </div>
                    <div id="2cal_duracion_ll_entrantes"></div>
                </div>
                <div class="col-xs-12" style="margin-top: -28px"><hr style="border-top:7px solid #898b8d;"></div>
                <div class="col-xs-12"  style="margin-top: -10px">
                    <div class="col-xs-12">
                        <div class="col-md-12" style="text-align: center">
                            <img src="Public/img/fondo_titulos.png" style="    width: 100%;position: absolute; height: 43px;z-index: 9998;margin-left: -383px;">
                            <h3 style="font-size:18px;color:#193D81;font-weight: 500;    margin-top: 11px;z-index: 99999;position: absolute;text-align: center;width: 100%;">LLAMADAS SALIENTES CON MAS DURACIÓN</h3>
                        </div>
                    </div>
                    <div id="2cal_duracion_ll_salientes"></div>
                </div>

                <div class="col-md-12" style="margin-top: -10px">
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

            <script src="../../Public/js/consultas/costos_distribuicion.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>" async="async"></script>
            <script src="../../Public/js/consultas/costos_participacion.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>
            <script src="../../Public/js/consultas/aprov_llentrantes.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>
            <script src="../../Public/js/consultas/aprov_llsalientes.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>
            <script src="../../Public/js/consultas/aprov_llsalientesEspecifica.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>
            <script src="../../Public/js/consultas/aprov_llinternas.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>
            <script src="../../Public/js/consultas/llamadas_calidad.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>
            <!--
            <script src="https://code.highcharts.com/highcharts-more.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <script src="../../Public/js/highcharts/policharts.js"></script>
            -->

        </div>
    </div>  <!--/.main-->
</div>
<div id="respuesta" style="display: none" style="width: 110px !important;">

    <img class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: 12px;width:1024px;height: 98%;z-index: 9998;" src="Public/img/fondo_analitica.png">
    <div class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;width:1024px;height: 100%;z-index: 9998;border: 12px solid #ffffff;">

        <img  style="position: absolute;width: 100%;z-index: 9998;height:187.78px;margin-top:500px" src="Public/img/fondo_titulos.png">
        <div  style="position: absolute;width: 100%;z-index: 9999;height:187.78px;margin-top:500px" >
            <br><h3 style="color: #ffffff !important;font-size: 28px;text-align: center;">LA ANALÍTICA TELEFONICA <br> Primer Paso hacia la transformación Digitial<br> Periodo Nº <span id="periodot" style="color: #ffffff !important"></span>: <span id="mest" style="color: #ffffff !important"></span> <span id="yeart" style="color: #ffffff !important"></span> <br><span id="clientet" style="color: #ffffff !important"></span></h3><br>

        </div>

    </div>
    <img class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: 12px;width:1024px;top:100%;height: 100%;z-index: 9998;" src="Public/img/fondo_analitica.png">
    <div class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;width:1024px;top:100%;height: 100%;z-index: 9998;border: 12px solid #ffffff;">   <br><br>
        <br><h3 style="color: #808080 !important;font-size: 20px;text-align: center;font-weight: 400;"><br><br><br><br>
            BIENVENIDO :<br><br><br><br><br><br>
            La analítica telefónica; recolecta, explora, analiza y entrega la<br>
            infografía para visualizar la información de manera efectiva e<br>
            identificar las oportunidades de mejora.<br><br><br><br><br><br>
            Nuestro compromiso para transformar las palabras en<br>
            conocimiento , innovar y ser mas eficientes y competitivos;<br>
            tiene como requisito se utilice de manera metódica,<br>
            constante y disciplinada.<br><br><br><br><br><br>
            En consecuencia la Infografía esta diseñada para que nos<br>
            ayude si no entendemos algo, se nos ocurre una idea o se<br>
            necesita información adicional. De esta manera obtenemos el<br>
            conocimiento de manera sencilla y entretenida.<br><br><br><br><br><br><br>
            EVOLUCIONEMOS JUNTOS<br><br><br><br><br><br>
            Vanessa Uribe<br>
            Ejecutiva<br>
            Desarrollo Empresarial<br>
        </h3>
    </div>
    <img class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: 12px;width:1024px;top:200%;height:  98%;z-index: 9998;" src="Public/img/fondo_analitica.png">
    <div class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;width:1024px;top:200%;height: 100%;z-index: 9998;border: 12px solid #ffffff !important;;"><br><br>
        <img style="position: absolute;width: 100%;z-index: 9998;height: 81px;margin-top: 15px" src="Public/img/fondo_titulos.png">
        <div style="position: absolute;width: 100%;z-index: 9999;height: 81px;margin-top: 15px" ><h1 style="color: #ffffff !important;font-size:74px;text-align: center;font-weight: bold;margin-top: 0px">Costos</h1></div>

        <h3 style="color:#193D81 !important;text-align: center;font-weight: 500 !important;margin-top: 107px;"><i><u style="color:#808080 !important; ">
                    <span style="color: #193D81 !important;margin-top: 10px">Distribuición</span></u></i></h3><br><br>
        <div style="width: 100% !important;margin-top: -15px;float: left;margin-left:-20px;left: -160px"><br>
            <div id="pie_chart">
            </div>
        </div>

        <img style=" width: 20.33333333%;height:199px;right: 0;position: absolute;z-index: 9998;margin-top:227px;"  src="Public/img/fondo_informativo.png">
        <div style=" width: 20.33333333%;height:199px;right: 0;position: absolute;z-index: 9999;margin-top:227px;float: right;">
            <div style="text-align: center">
                <img src="Public/img/globo_emsitel.png" style="width: 40px;margin-top: 5px"><br>
                <h5 style="color:#ffffff !important;">$<span id="cosDis_minuto" style="color:#ffffff !important;"></span> &nbsp;&nbsp;&nbsp; |Costo por min.</h5>
                <h3 style="color:#ffffff !important">$<span id="cosDis_mensual" style="color:#ffffff !important;"></span><br>
                    Valor Mensual</h3>
            </div>
        </div>
        <div style="margin-top:390px;width:100%">
            <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 !important; ">
                        <span style="color: #193D81 !important;margin-top: 10px">Oportunidad de Mejora</span></u></i></h3>
            <div class="col-md-8 " style="    width: 66.66666667%;height:150px;position:relative;margin-top: 5px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                </div>-->
                <img src="Public/img/no_entiendo.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
            <div style="width: 100%;"></div>
            <div style="margin-left:33.33333333%;width: 66.66666667%;height:150px;position:relative;margin-top: 25px">
                <!-- <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                 <div style="position: absolute;width:100%;height: 100%;">
                     <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                 </div>-->
                <img src="Public/img/se_meocurre.png" style="width: 100%;height:100%;">
            </div>
            <div style="width: 100%;"></div>
            <div  class="col-md-8 " style="width: 66.66666667%;height:150px;position:relative;margin-top: 32px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                </div>-->
                <img src="Public/img/necesito_info.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
        </div>

    </div>
    <img class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: 12px;width:1024px;top:300%;height:  98%;z-index: 9998;" src="Public/img/fondo_analitica.png">
    <div class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;width:1024px;top:300%;height: 100%;z-index: 9998;border: 12px solid #ffffff;">   <br><br>
        <img style="position: absolute;width: 100%;z-index: 9998;height: 81px;margin-top: 15px" src="Public/img/fondo_titulos.png">
        <div style="position: absolute;width: 100%;z-index: 9999;height: 81px;margin-top: 15px" ><h1 style="color: #ffffff !important;font-size:74px;text-align: center;font-weight: bold;margin-top: 0px">Costos</h1></div>

        <h3 style="color:#193D81 !important;text-align: center;font-weight: 500 !important;margin-top: 107px;"><i><u style="color:#808080 !important; ">
                    <span style="color: #193D81 !important;margin-top: 10px">Participación</span></u></i></h3><br><br>
        <h3 style="color:#193D81 !important;margin-top:  -30px;font-weight: 500;margin-left: 23px;"><i style="color:#193D81 !important;">Dpto. Area Ext.</i></h3>
        <h3 style="color:#193D81 !important;text-align: center;margin-top:  -42px;font-weight: 500;float:left;margin-left:430px"><i style="color:#193D81 !important;">Min</i></h3>
        <div  style=" width:100% !important;margin-top: -60px;"><br>
            <div id="stacket_chart" >
            </div>
        </div>
        <img style=" width: 20.33333333%;height:199px;right: 0;position: absolute;z-index: 9998;margin-top: -50px;"  src="Public/img/fondo_informativo.png">
        <div style=" width: 20.33333333%;height:199px;right: 0;position: absolute;z-index: 9999;margin-top: -50px;float: right;">
            <div style="text-align: center">
                <img src="Public/img/globo_emsitel.png" style="width: 40px;margin-top: 5px"><br>
                <h5 style="color:#ffffff !important;">$<span id="cosPar_minuto" style="color:#ffffff !important;"></span> &nbsp;&nbsp;&nbsp; |Costo por min.</h5>
                <h3 style="color:#ffffff !important">$<span id="cosPar_mensual" style="color:#ffffff !important;"></span><br>
                    Valor Mensual</h3>
            </div>
        </div>
        <div style="width:100%;margin-top:-30px">
            <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 !important; ">
                        <span style="color: #193D81 !important;margin-top: 10px">Oportunidad de Mejora</span></u></i></h3>
            <div class="col-md-8 " style="    width: 66.66666667%;height:150px;position:relative;margin-top: 5px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                </div>-->
                <img src="Public/img/no_entiendo.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
            <div style="width: 100%;"></div>
            <div style="margin-left:33.33333333%;width: 66.66666667%;height:150px;position:relative;margin-top: 23px">
                <!-- <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                 <div style="position: absolute;width:100%;height: 100%;">
                     <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                 </div>-->
                <img src="Public/img/se_meocurre.png" style="width: 100%;height:100%;">
            </div>
            <div style="width: 100%;"></div>
            <div  class="col-md-8 " style="width: 66.66666667%;height:150px;position:relative;margin-top: 30px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                </div>-->
                <img src="Public/img/necesito_info.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
        </div>

    </div>
    <img class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: 12px;width:1024px;top:400%;height:  98%;z-index: 9998;" src="Public/img/fondo_analitica.png">
    <div class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;width:1024px;top:400%;height: 100%;z-index: 9998;border: 12px solid #ffffff;">
        <img style="position: absolute;width: 100%;z-index: 9998;height: 81px;margin-top: 51px" src="Public/img/fondo_titulos.png">
        <div style="position: absolute;width: 100%;z-index: 9999;height: 81px;margin-top: 51px;" ><h1 style="color: #ffffff !important;font-size:74px;text-align: center;font-weight: bold;margin-top: 0px">APROVECHAMIENTO</h1></div>




        <div  style=" width: 100% !important;margin-top: 170px;">
            <h4 style="color: #94C433 !important;    margin-left: 70px;margin-top: 10px;"> LLAMADAS ENTRANTES</h4>
            <img src="Public/img/pie_de_titulo.png" style="width:183px;    position: absolute;margin-left: 112px;margin-top: -52px;">
        </div>
        <div style="position:  absolute;display: inline-block;width: 39% !important; "><br>
            <canvas class="chart" id="chart1" style="float: left;left: 0;margin-left: 50px;    width: 399px;height:199px;"></canvas>
        </div>
        <div  style=" position:  absolute;display: inline-block;width: 49% !important;margin-left:50%;margin-top: -20px;">
            <div id="tbaprov_entrantesMas"></div>
            <img src="Public/img/fondo_titulos.png" style="width: 100%;height: 10px">
        </div>

        <div style=" width: 100% !important;"></div>
        <div   style="display: inline-block;width: 39% !important;position: absolute;margin-top:  311px;"><br>
            <canvas class="chart" id="chart2" style="margin-top: -139px  !important;margin-left: -100px !important; width: 399px;height: 199px;"></canvas>

        </div>
        <div style=" display: inline-block;width: 49% !important;margin-top: 171px;position:  absolute;margin-left: 50%; "><br>
            <div id="tbaprov_entrantesMenos"></div>
        </div>
        <div class="col-md-12" style="text-align: center">
            <img src="Public/img/fondo_titulos.png" style="    width: 270px;position: absolute; margin-left: -130px;margin-top: 371px;z-index: 9998;">
            <h5 style="    font-weight: 500;margin-top: 379px;z-index: 99999;position: absolute;text-align: center;width: 100%;">Promedio de duración <br>de la llamada <span id="aprov_entra_min"></span>min</h5>

        </div>
        <img style=" width: 20.33333333%;height:133px;right: 0;position: absolute;z-index: 9998;margin-top: 400px;"  src="Public/img/fondo_informativo.png">
        <div style=" width: 20.33333333%;height:133px;right: 0;position: absolute;z-index: 9999;margin-top: 400px;float: right;">
            <div style="text-align: center">
                <h4 style="color:#ffffff !important;font-size: 19px!important;"><span style="color: #ffffff !important;">Promedio de Llamadas</span><br><span style="color:#193D81 !important;font-weight:bold"><span id="aprov_entra_lldia" style="color:#193D81 !important;font-weight:bold"></span> al dia</span><br><span style="color: #ffffff !important;">Datos basados en</span><br><span style="color:#193D81 !important;font-weight:bold" id="aprov_entra_lltot"></span><br><span style="color: #ffffff !important;">Llamadas</span></h4>

            </div>
        </div>
        <div style="width:100%;margin-top: 443px">
            <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 !important; ">
                        <span style="color: #193D81 !important;margin-top: 10px">Oportunidad de Mejora</span></u></i></h3>
            <div class="col-md-8 " style="    width: 66.66666667%;height:150px;position:relative;margin-top: 5px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                </div>-->
                <img src="Public/img/no_entiendo.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
            <div style="width: 100%;"></div>
            <div style="margin-left:33.33333333%;width: 66.66666667%;height:150px;position:relative;margin-top: 15px">
                <!-- <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                 <div style="position: absolute;width:100%;height: 100%;">
                     <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                 </div>-->
                <img src="Public/img/se_meocurre.png" style="width: 100%;height:100%;">
            </div>
            <div style="width: 100%;"></div>
            <div  class="col-md-8 " style="width: 66.66666667%;height:150px;position:relative;margin-top: 15px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                </div>-->
                <img src="Public/img/necesito_info.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
        </div>

    </div>
    <img class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: 12px;width:1024px;top:500%;height:  98%;z-index: 9998;" src="Public/img/fondo_analitica.png">
    <div class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;width:1024px;top:500%;height: 100%;z-index: 9998;border: 12px solid #ffffff;">
        <img style="position: absolute;width: 100%;z-index: 9998;height: 81px;margin-top: 51px" src="Public/img/fondo_titulos.png">
        <div style="position: absolute;width: 100%;z-index: 9999;height: 81px;margin-top: 51px;" ><h1 style="color: #ffffff !important;font-size:74px;text-align: center;font-weight: bold;margin-top: 0px">APROVECHAMIENTO</h1></div>




        <div  style=" width: 100% !important;margin-top: 170px;">
            <h4 style="color: #94C433 !important;    margin-left:10px;margin-top: 10px;"> LLAMADAS SALIENTES</h4>
            <img src="Public/img/pie_de_titulo.png" style="width:183px;    position: absolute;margin-left: 34px;margin-top: -52px;">
        </div>
        <div  style="  position:  absolute;display: inline-block;width: 49% !important;margin-left: 10px;">
            <div id="tbaprov_salientesMas"></div>
            <img src="Public/img/fondo_titulos.png" style="width: 100%;height: 10px">
        </div>
        <div style="position:  absolute;display: inline-block;width: 39% !important;margin-top: -20px;margin-left:50%; "><br>
            <canvas class="chart" id="chart3" style="float: right;right: 0;margin-top: -54px;margin-right: -20px;width: 399px;height: 199px;"></canvas>
        </div>


        <div style=" width: 100% !important;"></div>
        <div style=" display: inline-block;width: 39% !important;position: absolute;margin-top:  181px;margin-left: 10px; "><br>
            <div id="tbaprov_salientesMenos"></div>
        </div>
        <div style="position:  absolute;display: inline-block;width: 39% !important;margin-top: 171px;margin-left: 50%;"><br>
            <canvas class="chart" id="chart4" style="float: right;right: 0;margin-top: 3px;margin-right: -20px;width: 399px;height: 199px;"></canvas>

        </div>
        <div class="col-md-12" style="text-align: center">
            <img src="Public/img/fondo_titulos.png" style="    width: 200px;margin-top:50px;position: absolute; margin-left: -130px;z-index: 9998;float: right;right: 0px;">
            <h5 style="    font-weight: 500;z-index: 99999;position: absolute;margin-top:50px;text-align: center;float: right;right: 15px;">Promedio de duración <br>de la llamada <span id="aprov_salien_min"></span>min</h5>

        </div>
        <img style=" width: 20.33333333%;height:133px;right: 0;position: absolute;z-index: 9998;margin-top: 158px;"  src="Public/img/fondo_informativo.png">
        <div style=" width: 20.33333333%;height:133px;right: 0;position: absolute;z-index: 9999;margin-top: 158px;float: right;">
            <div style="text-align: center">
                <h4 style="color:#ffffff !important;font-size: 19px!important;"><span style="color: #ffffff !important;">Promedio de Llamadas</span><br><span style="color:#193D81 !important;font-weight:bold"><span id="aprov_salien_lldia" style="color:#193D81 !important;font-weight:bold"></span> al dia</span><br><span style="color: #ffffff !important;">Datos basados en</span><br><span style="color:#193D81 !important;font-weight:bold" id="aprov_salien_lltot"></span><br><span style="color: #ffffff !important;">Llamadas</span></h4>

            </div>
        </div>
        <div style="width:100%;margin-top: 445px">
            <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 !important; ">
                        <span style="color: #193D81 !important;margin-top: 10px">Oportunidad de Mejora</span></u></i></h3>
            <div class="col-md-8 " style="    width: 66.66666667%;height:150px;position:relative;margin-top: 5px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                </div>-->
                <img src="Public/img/no_entiendo.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
            <div style="width: 100%;"></div>
            <div style="margin-left:33.33333333%;width: 66.66666667%;height:150px;position:relative;margin-top: 15px">
                <!-- <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                 <div style="position: absolute;width:100%;height: 100%;">
                     <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                 </div>-->
                <img src="Public/img/se_meocurre.png" style="width: 100%;height:100%;">
            </div>
            <div style="width: 100%;"></div>
            <div  class="col-md-8 " style="width: 66.66666667%;height:150px;position:relative;margin-top: 15px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                </div>-->
                <img src="Public/img/necesito_info.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
        </div>

    </div>
    <img class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: 12px;width:1024px;top:600%;height:  98%;z-index: 9998;" src="Public/img/fondo_analitica.png">
    <div class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;width:1024px;top:600%;height: 100%;z-index: 9998;border: 12px solid #ffffff;">
        <img style="position: absolute;width: 100%;z-index: 9998;height: 81px;margin-top: 51px" src="Public/img/fondo_titulos.png">
        <div style="position: absolute;width: 100%;z-index: 9999;height: 81px;margin-top: 51px;" ><h1 style="color: #ffffff !important;font-size:74px;text-align: center;font-weight: bold;margin-top: 0px">APROVECHAMIENTO</h1></div>




        <div  style=" width: 100% !important;margin-top: 170px;">
            <h4 style="color: #94C433 !important;    margin-left: 70px;margin-top: 10px;"> LLAMADAS INTERNAS</h4>
            <img src="Public/img/pie_de_titulo.png" style="width:183px;    position: absolute;margin-left: 112px;margin-top: -52px;">
        </div>
        <div style="position:  absolute;display: inline-block;width: 39% !important; "><br>
            <canvas class="chart" id="chart5" style="float: left;left: 0;margin-left: 50px;    width: 399px;height:199px;"></canvas>
        </div>
        <div  style=" position:  absolute;display: inline-block;width: 49% !important;margin-left:50%;margin-top: -20px;">
            <div id="tbaprov_internasMas"></div>
            <img src="Public/img/fondo_titulos.png" style="width: 100%;height: 10px">
        </div>

        <div style=" width: 100% !important;"></div>
        <div   style="display: inline-block;width: 39% !important;position: absolute;margin-top:  311px;"><br>
            <canvas class="chart" id="chart6" style="margin-top: -139px  !important;margin-left: -100px !important; width: 399px;height: 199px;"></canvas>

        </div>
        <div style=" display: inline-block;width: 49% !important;margin-top: 171px;position:  absolute;margin-left: 50%; "><br>
            <div id="tbaprov_internasMenos"></div>
        </div>
        <div class="col-md-12" style="text-align: center">
            <img src="Public/img/fondo_titulos.png" style="    width: 270px;position: absolute; margin-left: -130px;margin-top: 384px;z-index: 9998;">
            <h5 style="    font-weight: 500;margin-top: 392px;z-index: 99999;position: absolute;text-align: center;width: 100%;">Promedio de duración <br>de la llamada <span id="aprov_inter_min"></span>min</h5>

        </div>
        <img style=" width: 20.33333333%;height:133px;right: 0;position: absolute;z-index: 9998;margin-top: 400px;"  src="Public/img/fondo_informativo.png">
        <div style=" width: 20.33333333%;height:133px;right: 0;position: absolute;z-index: 9999;margin-top: 400px;float: right;">
            <div style="text-align: center">
                <h4 style="color:#ffffff !important;font-size: 19px!important;"><span style="color: #ffffff !important;">Promedio de Llamadas</span><br><span style="color:#193D81 !important;font-weight:bold"><span id="aprov_inter_lldia" style="color:#193D81 !important;font-weight:bold"></span> al dia</span><br><span style="color: #ffffff !important;">Datos basados en</span><br><span style="color:#193D81 !important;font-weight:bold" id="aprov_inter_lltot"></span><br><span style="color: #ffffff !important;">Llamadas</span></h4>

            </div>
        </div>


        <div style="width:100%;margin-top: 445px">
            <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 !important; ">
                        <span style="color: #193D81 !important;margin-top: 10px">Oportunidad de Mejora</span></u></i></h3>
            <div class="col-md-8 " style="    width: 66.66666667%;height:150px;position:relative;margin-top: 5px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                </div>-->
                <img src="Public/img/no_entiendo.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
            <div style="width: 100%;"></div>
            <div style="margin-left:33.33333333%;width: 66.66666667%;height:150px;position:relative;margin-top: 10px">
                <!-- <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                 <div style="position: absolute;width:100%;height: 100%;">
                     <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                 </div>-->
                <img src="Public/img/se_meocurre.png" style="width: 100%;height:100%;">
            </div>
            <div style="width: 100%;"></div>
            <div  class="col-md-8 " style="width: 66.66666667%;height:150px;position:relative;margin-top: 10px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                </div>-->
                <img src="Public/img/necesito_info.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
        </div>

    </div>
    <img class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: 12px;width:1024px;top:700%;height:  98%;z-index: 9998;" src="Public/img/fondo_analitica.png">
    <div class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;width:1024px;top:700%;height: 100%;z-index: 9998;border: 12px solid #ffffff;">
        <img style="position: absolute;width: 100%;z-index: 9998;height: 81px;margin-top: 51px" src="Public/img/fondo_titulos.png">
        <div style="position: absolute;width: 100%;z-index: 9999;height: 81px;margin-top: 51px;" ><h1 style="color: #ffffff !important;font-size:74px;text-align: center;font-weight: bold;margin-top: 0px">CALIDAD</h1></div>




        <div  style=" width: 100% !important;margin-top: 170px;">
            <h4 style="color: #94C433 !important;    margin-left: 70px;margin-top: 10px;"> Registro De Llamadas</h4>
            <img src="Public/img/pie_de_titulo.png" style="width:183px;    position: absolute;margin-left: 112px;margin-top: -52px;">
        </div>



        <div  style="position:  absolute;display: inline-block;width: 39% !important; "><br>
            <div id="barchart" style="min-width: 310px; height: 250px; margin: 0 auto;margin-left: -40px; width: 399px;height:199px;"></div>
        </div>
        <div style="  position:  absolute;display: inline-block;width: 49% !important;margin-left:50%;margin-top: -20px;" id="tbcalidadMas">

        </div>
        <div style="width: 100% !important;"></div>
        <div  style="position:  absolute;display: inline-block;width: 39% !important; margin-top:  221px;"><br>
            <div style="margin-top:-20px;    margin-left: 30px;">
                <div style="width:23px;height: 14px;display:inline-block"><img src="Public/img/ll_per.png" style="width: 100%"></div><h5 style="display:inline-block;margin-top: -2px;margin-left: 8px;font-weight: bold">Llamadas Perdidas</h5>
            </div>
            <div style="    margin-left: 30px;">
                <div style="width:23px;height: 14px;display:inline-block"><img src="Public/img/ll_aten.png" style="width: 100%"></div><h5 style="display:inline-block;margin-top: -2px;margin-left: 8px;font-weight: bold">Llamadas Atendidas</h5>
            </div>
        </div>
        <div  style="  display: inline-block;width: 49% !important;margin-top: 171px;position:  absolute;margin-left: 50%; " id="tbcalidadMenos"><br>

        </div>
        <div style="width:100%;margin-top: 455px">
            <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 !important; ">
                        <span style="color: #193D81 !important;margin-top: 10px">Oportunidad de Mejora</span></u></i></h3>
            <div class="col-md-8 " style="    width: 66.66666667%;height: 150px;position:relative;margin-top: 5px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                </div>-->
                <img src="Public/img/no_entiendo.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
            <div style="width: 100%;"></div>
            <div style="margin-left:33.33333333%;width: 66.66666667%;height: 150px;position:relative;margin-top: 10px">
                <!-- <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                 <div style="position: absolute;width:100%;height: 100%;">
                     <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                 </div>-->
                <img src="Public/img/se_meocurre.png" style="width: 100%;height:100%;">
            </div>
            <div style="width: 100%;"></div>
            <div  class="col-md-8 " style="width: 66.66666667%;height: 150px;position:relative;margin-top: 10px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                </div>-->
                <img src="Public/img/necesito_info.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
        </div>

    </div>
    <img class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: 12px;width:1024px;top:800%;height:  98%;z-index: 9998;" src="Public/img/fondo_analitica.png">
    <div class="general2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;width:1024px;top:800%;height: 100%;z-index: 9998;border: 12px solid #ffffff;">
        <img style="position: absolute;width: 100%;z-index: 9998;height: 81px;margin-top: 51px" src="Public/img/fondo_titulos.png">
        <div style="position: absolute;width: 100%;z-index: 9999;height: 81px;margin-top: 51px;" ><h1 style="color: #ffffff !important;font-size:74px;text-align: center;font-weight: bold;margin-top: 0px">CALIDAD</h1></div>



        <div class="col-xs-12"  style="margin-top: 160px">
            <div class="col-xs-12">
                <div class="col-md-12" style="text-align: center">
                    <img src="Public/img/fondo_titulos.png" style="    width: 100%;position: absolute; height: 43px;z-index: 9998;margin-left: -383px;">
                    <h3 style="font-size:18px;color:#193D81;font-weight: 500;    margin-top: 11px;z-index: 99999;position: absolute;text-align: center;width: 100%;">LLAMADAS ENTRANTES CON MAS DURACIÓN</h3>
                </div>
            </div>
            <div id="cal_duracion_ll_entrantes"></div>
        </div>
        <div class="col-xs-12" style="margin-top: -28px"><hr style="border-top:7px solid #898b8d;"></div>
        <div class="col-xs-12"  style="margin-top: -10px">
            <div class="col-xs-12">
                <div class="col-md-12" style="text-align: center">
                    <img src="Public/img/fondo_titulos.png" style="    width: 100%;position: absolute; height: 43px;z-index: 9998;margin-left: -383px;">
                    <h3 style="font-size:18px;color:#193D81;font-weight: 500;    margin-top: 11px;z-index: 99999;position: absolute;text-align: center;width: 100%;">LLAMADAS SALIENTES CON MAS DURACIÓN</h3>
                </div>
            </div>
            <div id="cal_duracion_ll_salientes"></div>
        </div>

        <div class="col-md-12" style="margin-top: -10px">
            <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 !important; ">
                        <span style="color: #193D81 !important;margin-top: 10px">Oportunidad de Mejora</span></u></i></h3>
            <div class="col-md-8 " style="    width: 66.66666667%;height: 150px;position:relative;margin-top: 5px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                </div>-->
                <img src="Public/img/no_entiendo.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
            <div style="width: 100%;"></div>
            <div style="margin-left:33.33333333%;width: 66.66666667%;height: 150px;position:relative;margin-top: 10px">
                <!-- <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                 <div style="position: absolute;width:100%;height: 100%;">
                     <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                 </div>-->
                <img src="Public/img/se_meocurre.png" style="width: 100%;height:100%;">
            </div>
            <div style="width: 100%;"></div>
            <div  class="col-md-8 " style="width: 66.66666667%;height: 150px;position:relative;margin-top: 10px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                </div>-->
                <img src="Public/img/necesito_info.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
        </div>

    </div>
    <img class="especifica2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: 12px;width:1024px;height:  98%;z-index: 9998;" src="Public/img/fondo_analitica.png">
    <div class="especifica2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;width:1024px;height: 100%;z-index: 9998;border: 12px solid #ffffff;">
        <img style="position: absolute;width: 100%;z-index: 9998;height: 81px;margin-top: 51px" src="Public/img/fondo_titulos.png">
        <div style="position: absolute;width: 100%;z-index: 9999;height: 81px;margin-top: 51px;" ><h1 style="color: #ffffff !important;font-size:74px;text-align: center;font-weight: bold;margin-top: 0px">APROVECHAMIENTO</h1></div>




        <div  style=" width: 100% !important;margin-top: 170px;">
            <h4 style="color: #94C433;    margin-left:10px;margin-top: 10px;"> LLAMADAS SALIENTES  Ext. <span id="extEspecifica" style="font-size: 25px"></span></h4>
            <img src="Public/img/pie_de_titulo.png" style="width:318px;    position: absolute;margin-left: 133px;margin-top: -84px;">
        </div>
        <div  style="  position:  absolute;display: inline-block;width: 49% !important;margin-left: 10px;">
            <div id="2tbaprov_salientesMas"></div>
            <img src="Public/img/fondo_titulos.png" style="width: 100%;height: 10px">
        </div>
        <div style="position:  absolute;display: inline-block;width: 39% !important;margin-top: -20px;margin-left:50%; "><br>
            <canvas class="chart" id="2chart3" style="float: right;right: 0;margin-top: -54px;margin-right: -20px;width: 399px;height: 199px;"></canvas>
        </div>


        <div style=" width: 100% !important;"></div>
        <div style=" display: inline-block;width: 39% !important;position: absolute;margin-top:  181px;margin-left: 10px; "><br>
            <div id="2tbaprov_salientesMenos"></div>
        </div>
        <div style="position:  absolute;display: inline-block;width: 39% !important;margin-top: 171px;margin-left: 50%;"><br>
            <canvas class="chart" id="2chart4" style="float: right;right: 0;margin-top: 3px;margin-right: -20px;width: 399px;height: 199px;"></canvas>

        </div>
        <div class="col-md-12" style="text-align: center">
            <img src="Public/img/fondo_titulos.png" style="    width: 200px;margin-top:50px;position: absolute; margin-left: -130px;z-index: 9998;float: right;right: 0px;">
            <h5 style="    font-weight: 500;z-index: 99999;position: absolute;margin-top:50px;text-align: center;float: right;right: 15px;">Promedio de duración <br>de la llamada <span id="2aprov_salien_min"></span>min</h5>

        </div>
        <img style=" width: 20.33333333%;height:133px;right: 0;position: absolute;z-index: 9998;margin-top: 395px;"  src="Public/img/fondo_informativo.png">
        <div style=" width: 20.33333333%;height:133px;right: 0;position: absolute;z-index: 9999;margin-top: 395px;float: right;">
            <div style="text-align: center">
                <h4 style="color:#ffffff !important;font-size: 19px!important;"><span style="color: #ffffff !important;">Promedio de Llamadas</span><br><span style="color:#193D81 !important;font-weight:bold"><span id="2aprov_salien_lldia" style="color:#193D81 !important;font-weight:bold"></span> al dia</span><br><span style="color: #ffffff !important;">Datos basados en</span><br><span style="color:#193D81 !important;font-weight:bold" id="2aprov_salien_lltot"></span><br><span style="color: #ffffff !important;">Llamadas</span></h4>

            </div>
        </div>
        <div style="width:100%;margin-top: 445px">
            <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 !important; ">
                        <span style="color: #193D81 !important;margin-top: 10px">Oportunidad de Mejora</span></u></i></h3>
            <div class="col-md-8 " style="    width: 66.66666667%;height:150px;position:relative;margin-top: 5px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                </div>-->
                <img src="Public/img/no_entiendo.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
            <div style="width: 100%;"></div>
            <div style="margin-left:33.33333333%;width: 66.66666667%;height:150px;position:relative;margin-top: 15px">
                <!-- <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                 <div style="position: absolute;width:100%;height: 100%;">
                     <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                 </div>-->
                <img src="Public/img/se_meocurre.png" style="width: 100%;height:100%;">
            </div>
            <div style="width: 100%;"></div>
            <div  class="col-md-8 " style="width: 66.66666667%;height:150px;position:relative;margin-top: 15px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                </div>-->
                <img src="Public/img/necesito_info.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
        </div>

    </div>
    <img class="especifica2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: 12px;width:1024px;top:100%;height:  98%;z-index: 9998;" src="Public/img/fondo_analitica.png">
    <div class="especifica2" style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;margin-top: auto;width:1024px;top:100%;height: 100%;z-index: 9998;border: 12px solid #ffffff;">
        <img style="position: absolute;width: 100%;z-index: 9998;height: 81px;margin-top: 51px" src="Public/img/fondo_titulos.png">
        <div style="position: absolute;width: 100%;z-index: 9999;height: 81px;margin-top: 51px;" ><h1 style="color: #ffffff !important;font-size:74px;text-align: center;font-weight: bold;margin-top: 0px">CALIDAD</h1></div>



        <div class="col-xs-12"  style="margin-top: 160px">
            <div class="col-xs-12">
                <div class="col-md-12" style="text-align: center">
                    <img src="Public/img/fondo_titulos.png" style="    width: 100%;position: absolute; height: 43px;z-index: 9998;margin-left: -383px;">
                    <h3 style="font-size:18px;color:#193D81;font-weight: 500;    margin-top: 11px;z-index: 99999;position: absolute;text-align: center;width: 100%;">LLAMADAS ENTRANTES CON MAS DURACIÓN</h3>
                </div>
            </div>
            <div id="2cal_duracion_ll_entrantes"></div>
        </div>
        <div class="col-xs-12" style="margin-top: -28px"><hr style="border-top:7px solid #898b8d;"></div>
        <div class="col-xs-12"  style="margin-top: -10px">
            <div class="col-xs-12">
                <div class="col-md-12" style="text-align: center">
                    <img src="Public/img/fondo_titulos.png" style="    width: 100%;position: absolute; height: 43px;z-index: 9998;margin-left: -383px;">
                    <h3 style="font-size:18px;color:#193D81;font-weight: 500;    margin-top: 11px;z-index: 99999;position: absolute;text-align: center;width: 100%;">LLAMADAS SALIENTES CON MAS DURACIÓN</h3>
                </div>
            </div>
            <div id="2cal_duracion_ll_salientes"></div>
        </div>

        <div class="col-md-12" style="margin-top: -10px">
            <h3 style="color:#193D81;text-align: center;font-weight: 500"><i><u style="color:#808080 !important; ">
                        <span style="color: #193D81 !important;margin-top: 10px">Oportunidad de Mejora</span></u></i></h3>
            <div class="col-md-8 " style="    width: 66.66666667%;height: 150px;position:relative;margin-top: 5px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_noentiendoalgo.png" style="width: 30px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">No entiendo algo:</span>
                </div>-->
                <img src="Public/img/no_entiendo.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
            <div style="width: 100%;"></div>
            <div style="margin-left:33.33333333%;width: 66.66666667%;height: 150px;position:relative;margin-top: 10px">
                <!-- <div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                 <div style="position: absolute;width:100%;height: 100%;">
                     <img src="Public/img/Incono_semeocurreunaidea.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300" >Se me ocurre una idea:</span>
                 </div>-->
                <img src="Public/img/se_meocurre.png" style="width: 100%;height:100%;">
            </div>
            <div style="width: 100%;"></div>
            <div  class="col-md-8 " style="width: 66.66666667%;height: 150px;position:relative;margin-top: 10px">
                <!--<div style="position: absolute;background: #808080;opacity: 0.2;border-radius: 4px;width:100%;height: 100%;"></div>
                <div style="position: absolute;width:100%;height: 100%;">
                    <img src="Public/img/Incono_necesitoinformacionadicional.png" style="width: 40px;display: inline-block;margin:5px"> <span style="display: inline-block;color: #000000;font-weight: 300">Necesito Informacion Adicional:</span>
                </div>-->
                <img src="Public/img/necesito_info.png" style="width: 100%;height:100%;margin-left: 10px">
            </div>
        </div>

    </div>

    <style type="text/css">
        body{
            padding-top: 0 !important;
        }
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

    <link href="../../Public/css/bootstrap.min.css" rel="stylesheet" media="print"  >
    <link href="../../Public/css/styles.css" rel="stylesheet" media="print" >
    <script src="../../Public/js/consultas/costos_distribuicion.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>" async="async"></script>
    <script src="../../Public/js/consultas/costos_participacion.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>
    <script src="../../Public/js/consultas/aprov_llentrantes.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>
    <script src="../../Public/js/consultas/aprov_llsalientes.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>
    <script src="../../Public/js/consultas/aprov_llinternas.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>
    <script src="../../Public/js/consultas/llamadas_calidad.js?fecha=<?php echo date('Y-m-d H:i:s'); ?>"></script>


</div>