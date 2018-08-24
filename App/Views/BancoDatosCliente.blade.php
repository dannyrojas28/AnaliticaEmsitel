<?php

if(!empty($_GET['cliente'])){
    include "App/Views/includes/header.php";
    $estado = "BancoDatosCliente";
    require_once 'App/Controllers/PrincipalController.php';
    require_once 'Config/vars.php';
    $estado = "Inicio";
    $PrincipalController = new PrincipalController();
    $sqlCliente = $PrincipalController->InfoClienteGet($_GET['cliente']);
    $false = false;
    if($sqlCliente!=false){
        while ($res = mysqli_fetch_object($sqlCliente)){
            $nombrecliente = $res->nombre_cliente;
        }
    }else{
        $false = true;
        $nombrecliente = "NO HAY NINGUN CLIENTE";
    }

?>
<link href="../../Public/css/bootstrap.min.css" rel="stylesheet"  >
<link href="../../Public/css/styles.css" rel="stylesheet"  >
<link href="../../Public/css/datepicker3.css" rel="stylesheet" >
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="Inicio"><em class="fa fa-home"></em> </a></li>
                <li class="active"><a href="BancoDatosCliente">Banco Datos Cliente</a></li>
            </ol>
        </div><!--/.row-->

        <br><br>
        <div style="">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="text-align: center"><?php echo $nombrecliente; ?></h3>
                </div>

                <div class="panel-body">
                    <hr>
                    <?php if($false == false){ ?>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body tabs">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li <?php if(!empty($_GET['itm'])){if($_GET['itm']==1){ echo 'class="active"';}}else{echo 'class="active"';}?> ><a href="#Departamentos" data-toggle="tab">Departamentos</a></li>
                                        <li <?php if(!empty($_GET['itm'])){if($_GET['itm']==2){ echo 'class="active"';}}?>><a href="#Extenciones" data-toggle="tab">Extenciones</a></li>
                                        <li <?php if(!empty($_GET['itm'])){if($_GET['itm']==3){ echo 'class="active"';}}?>><a href="#Editar" data-toggle="tab">Editar Informacion</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade <?php if(!empty($_GET['itm'])){if($_GET['itm']==1){ echo 'in active';}}else{ echo 'in active';}?>" id="Departamentos">
                                            <h3 style="text-align: center">Departamentos</h3>
                                            <div class="col-xs-12"><hr></div>

                                            <div class="col-xs-12">
                                                <form action="BancoDatosCliente" method="post">
                                                    <input type="hidden" name="tipo_form" value="1">
                                                    <input type="hidden" name="cod_cliente" value="<?php echo $_GET['cliente'];?>">
                                                    <div class=" center">
                                                        <input type="number" name="numerodepto" id="numerodepto" class="form-control" style="width: 120px;display: inline-block"><br><br>

                                                        <button class="btn btn-primary" style="display: inline-block" onclick="NuevosDptos()" type="button"> Nuevos Departamentos <em class="fa fa-plus-square"></em>
                                                        </button>
                                                    </div>
                                                    <div id="dptos_html" style="text-align: center"></div>
                                                </form>
                                            </div>
                                            <div class="col-xs-12"><hr></div>
                                            <div class="col-xs-12" style="text-align: center">
                                                <?php
                                                 $deptos = $PrincipalController->InfoDeptosBDCliente($_GET['cliente']);
                                                 if($deptos!=false){
                                                     echo '<table class="table table-responsive table-bordered" style="width: 50%;margin: 0 auto;font-size: 16px">
                                                                <thead>
                                                                    <th>#</th>
                                                                    <th>Departamento</th>
                                                                    <th>Fecha Creacion</th>
                                                                    <th>Accion</th>
                                                                </thead>';
                                                     $n = 1;
                                                    while ($res = mysqli_fetch_object($deptos)){
                                                        echo    '<tr id="trtb'.$res->cod_dp.'">
                                                                     <td>'.$n.'</td>
                                                                     <td><input type="text" class="form-control" id="dpto_'.$res->cod_dp.'" name="dpto_'.$res->cod_dp.'" value="'.$res->nombre_dp.'"></td>
                                                                     <td>'.$res->fecha_creacion.'</td>
                                                                     <td>
                                                                        <span onclick="saveDpto('.$res->cod_dp.')" class="clickable panel-toggle panel-button-tab-left" style="background: dodgerblue;color: #fff"><em class="fa fa-save "></em></span>
                                                                        <span onclick="trashDpto('.$res->cod_dp.')" class="clickable panel-toggle panel-button-tab-left btn-danger" style="background: red;color: #fff"><em class="fa fa-trash"></em></span>
                                                                     </td>
                                                                </tr>';
                                                        $n+=1;

                                                    }
                                                    echo ' </table>';
                                                 }else{
                                                     echo '<h5>No hay Departamentos Creados</h5>';
                                                 }

                                                ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade <?php if(!empty($_GET['itm'])){if($_GET['itm']==2){ echo ' in active';}}?>" id="Extenciones">
                                            <h3 style="text-align: center">Extenciones</h3>
                                            <div class="col-xs-12"><hr></div>

                                            <div class="col-xs-12">
                                                <form action="BancoDatosCliente" method="post">
                                                    <input type="hidden" name="tipo_form" value="2">
                                                    <input type="hidden" name="cod_cliente" value="<?php echo $_GET['cliente'];?>">
                                                    <div class=" center">
                                                        <input type="number" name="numeroextenciones" id="numeroextenciones" class="form-control" style="width: 120px;display: inline-block"><br><br>

                                                        <button class="btn btn-primary" style="display: inline-block" onclick="NuevasExtenciones(<?php echo $_GET['cliente'];?>)" type="button"> Nuevas Extenciones <em class="fa fa-plus-square"></em>
                                                        </button>
                                                    </div>
                                                    <div id="extenciones_html" style="text-align: center">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-xs-12"><hr></div>
                                            <div class="col-xs-12" style="text-align: center">
                                                <?php
                                                $extenciones = $PrincipalController->InfoExtencionesBDCliente($_GET['cliente']);
                                                if($extenciones!=false){
                                                    echo '<table class="table table-responsive table-bordered" style="width: 50%;margin: 0 auto;font-size: 16px">
                                                                <thead>
                                                                    <th>#</th>
                                                                    <th>Extencion</th>
                                                                    <th>Nombre</th>
                                                                    <th>Departamento</th>
                                                                    <th>Accion</th>
                                                                </thead>';
                                                    $n = 1;
                                                    while ($res = mysqli_fetch_object($extenciones)){
                                                        echo    '<tr id="trtex'.$res->cod_ext.'">
                                                                     <td>'.$n.'</td>
                                                                     <td><input type="text" class="form-control" id="numextencion_'.$res->cod_ext.'" name="numextencion_'.$res->cod_ext.'" value="'.$res->numero_ext.'"></td>
                                                                     <td><input type="text" class="form-control" id="nameextencion_'.$res->cod_ext.'" name="nameextencion_'.$res->cod_ext.'" value="'.$res->nombre_ext.'" style="width: 320px"></td>
                                                                     <td>';
                                                                            $deptos = $PrincipalController->InfoDeptosBDCliente($_GET['cliente']);
                                                                            if($deptos!=false){
                                                                                echo '<select class="form-control" id="coddptoextencion_' .$res->cod_ext. '" name="coddptoextencion_' .$res->cod_ext. '" style="margin:5px;width: 150px;display: inline-block" >';
                                                                                while ($row = mysqli_fetch_object($deptos)){
                                                                                        if($row->cod_dp==$res->cod_dp){
                                                                                            echo '<option value="'.$row->cod_dp.'" selected>'.$row->nombre_dp.'</option>';
                                                                                        }else{
                                                                                            echo '<option value="'.$row->cod_dp.'">'.$row->nombre_dp.'</option>';
                                                                                        }
                                                                                }
                                                                                echo '</select>';
                                                                            }
                                                                   echo '</td>
                                                                     <td>
                                                                        <span onclick="saveExten('.$res->cod_ext.')" class="clickable panel-toggle panel-button-tab-left" style="background: dodgerblue;color: #fff"><em class="fa fa-save "></em></span>
                                                                        <span onclick="trashExten('.$res->cod_ext.')" class="clickable panel-toggle panel-button-tab-left btn-danger" style="background: red;color: #fff"><em class="fa fa-trash"></em></span>
                                                                     </td>
                                                                </tr>';
                                                        $n+=1;

                                                    }
                                                    echo ' </table>';
                                                }else{
                                                    echo '<h5>No hay Extenciones Creadas</h5>';
                                                }

                                                ?>
                                            </div>
                                        </div>

                                            <div class="tab-pane fade <?php if(!empty($_GET['itm'])){if($_GET['itm']==3){ echo 'in active';}}?>" id="Editar">
                                                <h3 style="text-align: center">Editar Informacion</h3>
                                                <div class="col-xs-12"><hr></div>

                                                <div class="col-xs-12">
                                                    <form  action="BancoDatosCliente" method="post">
                                                        <input type="hidden" name="tipo_form" value="3">
                                                        <?php
                                                        $sql = $PrincipalController->InfoDetalleCliente($_GET['cliente']);
                                                        if($sql!=false){
                                                            while($res=mysqli_fetch_object($sql)){ ?>

                                                                    <div class="form-group">
                                                                        <label>Cliente</label>
                                                                        <input class="form-control" placeholder="Emsitel" name="cliente" value="<?php echo $res->nombre_cliente;?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Usuario</label>
                                                                        <input class="form-control" placeholder="emsitel_analitica" name="usuario_cl" value="<?php echo $res->user_us;?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Contraseña</label>
                                                                        <input type="password" class="form-control" placeholder="********" name="pass_cl" value="<?php echo $PrincipalController->Desencriptar($res->password_us);?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Tipo Conexión</label>
                                                                        <select class="form-control" name="tipo_conexion" id="tipo_conexion" onchange="TipoConex()" required>

                                                                            <option value="">Seleccionar</option>
                                                                            <?php
                                                                                $re = $PrincipalController->InfoConexiones();
                                                                                if($re!=false){
                                                                                    while ($ro = mysqli_fetch_object($re)){
                                                                                        if($res->tipo_conexion == $ro->cod_conex){
                                                                                            echo '<option value="'.$ro->cod_conex.'" selected>'.$ro->nombre_conex.'</option>';
                                                                                        }else{
                                                                                            echo '<option value="'.$ro->cod_conex.'">'.$ro->nombre_conex.'</option>';
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group"  id="tabla_cdr">
                                                                        <label>Tabla cdr</label>
                                                                        <input type="text" class="form-control" placeholder="emsitel_cdr" name="tabla_cdr"  value="<?php echo $res->tabla_cdr;?>" required>
                                                                    </div>
                                                                    <hr>
                                                                    <label>Base de Datos</label>
                                                                    <hr>
                                                                    <div class="form-group">
                                                                        <label>Host:</label>
                                                                        <input class="form-control" placeholder="IP servidor" name="host_bd" required  value="<?php echo $res->host_bd;?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>usuario</label>
                                                                        <input class="form-control" placeholder="root" name="user_bd" required  value="<?php echo $res->usuario_bd;?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Base de Datos</label>
                                                                        <input class="form-control" placeholder="datos_bd" name="base_bd" required value="<?php echo $res->base_bd;?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Contraseña</label>
                                                                        <input type="password" class="form-control" placeholder="******" name="pass_bd" required value="<?php echo $PrincipalController->Desencriptar($res->contrasena_bd);?>" required>
                                                                    </div>
                                                                    <hr>
                                                                    <label>$ Precio Minutos</label>
                                                                    <hr>
                                                                    <div class="form-group">
                                                                        <label>Fijo Local:</label>
                                                                        <input class="form-control" placeholder="150" name="precio_fijoLocal" required value="<?php echo $res->valorfijoLocal;?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Fijo Nacional:</label>
                                                                        <input class="form-control" placeholder="150" name="precio_fijoNacional" required value="<?php echo $res->valorfijoNacional;?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Celular:</label>
                                                                        <input class="form-control" placeholder="150" name="precio_celular" required value="<?php echo $res->valorCelular;?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Internacional:</label>
                                                                        <input class="form-control" placeholder="150" name="precio_internacional" required value="<?php echo $res->valorInternacional;?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Ejecutivo</label>
                                                                        <select class="form-control" name="ejecutivo" id="ejecutivo" required >
                                                                            <option value="">Seleccionar</option>
                                                                            <?php
                                                                            $re = $PrincipalController->InfoEjecutivos();
                                                                            if($re!=false){
                                                                                while ($ro = mysqli_fetch_object($re))
                                                                                    if($res->ejecutivo==$ro->id_eje){
                                                                                        echo '<option value="'.$ro->id_eje.'" selected>'.$ro->nombre_eje.'</option>';
                                                                                    }else{
                                                                                        echo '<option value="'.$ro->id_eje.'">'.$ro->nombre_eje.'</option>';
                                                                                    }

                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Valor Mes:</label>
                                                                        <input class="form-control" placeholder="150" name="valor_mes" required value="<?php echo $res->platames;?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Periodo:</label>
                                                                        <input class="form-control" placeholder="150" name="periodo" required value="<?php echo $res->periodo;?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Digitos de Extenciones:</label>
                                                                        <input class="form-control" placeholder="150" name="dig_ext" required value="<?php echo $res->numExt;?>" required>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                                                    <input type="hidden" name="cod_cliente" value="<?php echo $_GET['cliente'];?>">
                                                                    <input type="hidden" name="cod_us" value="<?php echo $res->id_us;?>">
                                                     <?php       }
                                                        }  ?>
                                                    </form>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div><!--/.panel-->
                        </div><!--/.col-->
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <style>
        th{
            text-align: center !important;
            font-size: 18px !important;
            font-weight: bold !important;
            height: 52px !important;
        }
        td{
            height: 45px !important;
            font-size: 17px !important;
        }
    </style>
<?php
}else{
    session_start();
    if($_SESSION['rol_us'] == 1){
        header('location:BancoDatos');
    }else{
        header('location:Inicio');
    }
}
?>