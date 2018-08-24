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
            <li><a href="Inicio">
                    <em class="fa fa-home"></em>
                </a></li>
            <li ><a href="BancoDatos">Banco Datos</a></li>
            <li class="active" ><a href="AgregarCliente">Agregar Cliente</a></li>




        </ol>
    </div><!--/.row-->

    <br><br>
    <div class="col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2 ">


        <div class="panel panel-default">
            <div class="panel-heading">Registrar Cliente</div>
            <div class="panel-body">
                <div class="col-md-6 col-md-offset-3 col-xs-12">
                    <?php
                    if (!empty($error)) {
                        # code...
                        echo '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> '.$error.' <a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a></div>';
                    }
                    if (!empty($success)) {
                        # code...
                        echo '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> '.$success.' <a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a></div>';
                    }
                    ?>

                    <form role="form" action="AgregarCliente" method="post">

                        <div class="form-group">
                            <label>Cliente</label>
                            <input class="form-control" placeholder="Emsitel" name="cliente">
                        </div>
                        <div class="form-group">
                            <label>Usuario</label>
                            <input class="form-control" placeholder="emsitel_analitica" name="usuario_cl">
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" placeholder="********" name="pass_cl">
                        </div>
                        <div class="form-group">
                            <label>Tipo Conexión</label>
                            <select class="form-control" name="tipo_conexion" id="tipo_conexion" onchange="TipoConex()">
                                <option value="">Seleccionar</option>
                                <?php
                                $res = $PrincipalController->InfoConexiones();
                                if($res!=false){
                                    while ($ro = mysqli_fetch_object($res)){
                                            echo '<option value="'.$ro->cod_conex.'">'.$ro->nombre_conex.'</option>';

                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group"  id="tabla_cdr">
                            <label>Tabla cdr</label>
                            <input type="text" class="form-control" placeholder="emsitel_cdr" name="tabla_cdr">
                        </div>
                        <hr>
                        <label>Base de Datos</label>
                        <hr>
                        <div class="form-group">
                            <label>Host:</label>
                            <input class="form-control" placeholder="IP servidor" name="host_bd" required>
                        </div>
                        <div class="form-group">
                            <label>usuario</label>
                            <input class="form-control" placeholder="root" name="user_bd" required>
                        </div>
                        <div class="form-group">
                            <label>Base de Datos</label>
                            <input class="form-control" placeholder="datos_bd" name="base_bd" required>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" placeholder="******" name="pass_bd" required>
                        </div>
                        <hr>
                        <label>$ Precio Minutos</label>
                        <hr>
                        <div class="form-group">
                            <label>Fijo Local:</label>
                            <input class="form-control" placeholder="150" name="precio_fijoLocal" required>
                        </div>
                        <div class="form-group">
                            <label>Fijo Nacional:</label>
                            <input class="form-control" placeholder="150" name="precio_fijoNacional" required>
                        </div>
                        <div class="form-group">
                            <label>Celular:</label>
                            <input class="form-control" placeholder="150" name="precio_celular" required>
                        </div>
                        <div class="form-group">
                            <label>Internacional:</label>
                            <input class="form-control" placeholder="150" name="precio_internacional" required>
                        </div>
                        <div class="form-group">
                            <label>Ejecutivo</label>
                            <select class="form-control" name="ejecutivo" id="ejecutivo" required >
                                <option value="">Seleccionar</option>
                                <?php
                                $res = $PrincipalController->InfoEjecutivos();
                                if($res!=false){
                                    while ($ro = mysqli_fetch_object($res))
                                        echo '<option value="'.$ro->id_eje.'">'.$ro->nombre_eje.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>
            </div>
        </div><!-- /.panel-->
    </div>
</div><!-- /.col-->