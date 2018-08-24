
<!-- ESTE ARCHIVO SERA EL ENCARGADO DE RECIBIR POT _GET EL NOMBRE DE UNA VARIABLE LA CUAL INDICAR A DONDE SE QUIERE ACCESAR EN LA PAGINA -->
<!DOCTYPE html>
<html lang="es">

    <head>
    		<!-- INCLUYO LOS HEADERS -->
    		<?php  require_once "Public/index.php"; ?>
   	</head>
   	<body>
		<?php	
			
			require_once 'App/Controllers/PrincipalController.php';
			require_once 'Config/vars.php';

			

			//inicializo el controlador Principal
			$PrincipalController = new PrincipalController();	 
			//$PrincipalController->Roles();
			/*
			$var   = new Variables();
 			$roles=$var->Roles();
                foreach ($roles as $k => $v) {
				    echo $k." => ".$v."<br>";
				}

			*/
			//valido que la variable PAGE no este vacia, si tiene algo diferente de  vacio recibo la variable por GET la cual me indicara a la pagina que se quiere acceder, si esta vacia quiere decir que estan accesando al login
			
			if (empty($_GET['PAGE'])) {
				# code...
				$PAGE  = "Login";
			}else{
				$PAGE  = $_GET['PAGE'];
			}
			
			//VALIDO SI VIENE ALGUN DATO POR POST, SI VIENE QUIERE DECIR QUE ESTAN ENVIANDO INFORMACION DE UN FORMULARIO, SI NO VIENE ES QUE SOLO QUIEREN VER LA PAGINA
			if(!empty($_POST)){
				//VALIDO QUE EL ARCHIVO EXISTA, SI EXISTE EJECUTO LA FUNCION POR GET, SI NO EXISTE LO ENVIO A 404 ERROR
				if (is_file("App/Views/".$PAGE.".blade.php")) {

							// RECIBO LOS DATOS QUE VIENEN DEL FORMULARIO COMO UN STRING Y LOS CONVIERTO A UN ARRAY PARA PODER TRABAJAR CON ELLOS
						  	$data  = file_get_contents('php://input');
						  	$data=urldecode($data);
						  	/*
						  		//CONVIERTO LOS DATOS DE CADA INPUT EN UN ARRAY EJEMPLO ASI QUEDAN GUARDADOS LOS DATOS EN $data
								// usuario=pepe&password=2323
								// Vamos a separar el string donde haya un & se convertira en un array, nos quedaria algo asi
								// array[0] = "usuario=pepe"
								// array[1] = "password=2323"
								// Ahora vamos a validar donde haya un signo  = para convertir eso en otro array y almacenarlo en una variable llamada DATOS nos quedaria algo asi
								// DATOS[0] = ["usuario"  => "pepe"]
								// DATOS[1] = ["password" => "2323"]
						  	*/
							$data = explode("&", $data);
							$i = 0;
							//Recorremos el primer array de 1 en 1
							while ($i < count($data)) {
							   $array = explode("=", $data[$i]);
								$j = 0;
								//Recorremos el segundo array de 2 en 2 y lo almacenamos en la variable Datos
								while ($j < count($array)) {
								 	# code...
                                    $valor =$array[$j + 1];
								   $DATOS[$i] = array($array[$j] =>$valor );
								   $j = $j + 2;
								}
								$i = $i + 1;

							}
				
					# code...
					$Fun = "post".$PAGE;

                    //var_dump($DATOS);
					$PrincipalController->$Fun($PAGE,$DATOS);
				}else{
					$Fun = "getErrorPage";
					$PrincipalController->$Fun('404');
				}
				
			}else{
				//VALIDO QUE EL ARCHIVO EXISTA, SI EXISTE EJECUTO LA FUNCION POR GET, SI NO EXISTE LO ENVIO A 404 ERROR
				if (is_file("App/Views/".$PAGE.".blade.php")) {
					# code...
					$Fun = "get".$PAGE;
					$PrincipalController->$Fun($PAGE);
				}else{
					$Fun = "getErrorPage";
					$PrincipalController->$Fun('404');
				}
			}
			

		?>
	</body>
</html>
