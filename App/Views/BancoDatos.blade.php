<?php
include "App/Views/includes/header.php";
$estado = "Inicio";
    if($_SESSION['rol_us'] == 1){
?>
<link href="../../Public/css/bootstrap.min.css" rel="stylesheet"  >
<link href="../../Public/css/styles.css" rel="stylesheet"  >
<link href="../../Public/css/datepicker3.css" rel="stylesheet" >
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="Inicio"><em class="fa fa-home"></em> </a></li>
            <li class="active"><a href="BancoDatos">Banco Datos</a></li>




        </ol>
    </div><!--/.row-->

    <br><br>

    <div style="">
        <div class="panel panel-default">
            <div class="panel-heading">
                Clientes
                   <a href="AgregarCliente"><span class="pull-right clickable panel-toggle panel-button-tab-left"  ><em class="fa fa-plus-square"></em> </span>
                <span class="pull-right">Agregar Cliente</span></a>
            </div>

            <div class="panel-body">
                <div class="input-group">
                    <input id="btn-input" type="text" class="form-control input-md" placeholder="Escribe el nombre del cliente" /><span class="input-group-btn">
								<button class="btn btn-primary btn-md" id="btn-todo">Filtrar</button>
						</span></div>
                <hr>
                <div class="col-md-12">
                    <table class="table-responsive table-bordered" style="width: 100%;text-align: center;font-size: 16px">
                        <thead>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>IP</th>
                            <th>Conexion</th>
                            <th>Accion</th>
                        </thead>
                        <tbody id="tbodyclientes">

                        </tbody>
                    </table>
                    <h3 id="responsetable"></h3>
                </div>
            </div>
        </div>
    </div>
</div>  <!--/.main-->
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

            <script type="text/javascript">
                TBodyClientes();
            </script>
<?php
        }
?>