<?php

    $estado = "Login";
?>
<link href="../../Public/css/bootstrap.min.css" rel="stylesheet"  >
<link href="../../Public/css/styles.css" rel="stylesheet"  >
<link href="../../Public/css/datepicker3.css" rel="stylesheet" >
<div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        	<?php 
                        if (!empty($error)) {
                            # code...
                            echo '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> '.$error.' <a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a></div>';
                        }
            require_once 'App/Controllers/PrincipalController.php';
            require_once 'Config/vars.php';



            //inicializo el controlador Principal
          /* $PrincipalController = new PrincipalController();
            echo $PrincipalController->Encriptar('pbx5724422ems');
                    */?>
                    <!--Panel-->

            <div class="login-panel panel panel-default">
                <div class="panel-heading">Analitica Emsitel</div>
                <div class="panel-body">
                    <form action="Login" method="post" role="form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Usuario" name="usuario" id="usuario" type="text" autofocus="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Contraseña" name="password" id="password" type="password" value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" id="remember" type="checkbox" value="Remember Me" onclick="CheckRecordar()">Recordar
                                </label>
                            </div>
                            <button type="submit"  class="btn btn-primary"  onclick="CheckRecordar()">Iniciar Sesión</button></fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    
</div><!-- /.row -->    
    
<script type="text/javascript">
	window.onload = function(){
		if(localStorage.getItem('user_ana') == null){
            $('#usuario').val('');
            $('#password').val('');
		}else{
            console.log(localStorage.getItem('user_ana'))
            $('#usuario').val(localStorage.getItem('user_ana'));
            $('#password').val(localStorage.getItem('pass_ana'));
            document.getElementById('remember').checked = true;
		}
	};
</script>