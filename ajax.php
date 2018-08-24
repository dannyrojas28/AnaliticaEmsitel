<?php

	require_once 'App/Controllers/PrincipalController.php';
	//inicializo el controlador Principal
	$PrincipalController = new PrincipalController();
	//recivo los datos que me envian y los desencodifico de json a un array, accedo al metodo Funcion y ejecuto la funcion correspondiente a ese metodo, le paso los datos que recibo a la funcion para poder manejarlos en el controlador
	$array = file_get_contents('php://input');
	$request = json_decode($array);
	//var_dump($request);
	$Func = $request->Funcion;

	echo $PrincipalController->$Func($request);

?>