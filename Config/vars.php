<?php

	/**
	* 
	cambios ");
	*/
	class Variables
	{
		public $host = '';
		public $pass = '';
		public $user = '';
		public $db   = '';
		public $hostLL = '';
		public $passLL = '';
		public $userLL = '';
		public $dbLL   = '';
		public $port = '';

		//Array que contendra el nombre de cada pagina para realizar el llamado
		function Globales(){
			return  $globals= array( '' 			=> 'login.blade' ,
								     'admin' 		=> 'admin.blade', 
								     'info'			=> 'info.blade',  
								     'dowloands' 	=> 'dowloands.blade',
								     'login' 		=> 'login.blade' );
		}
		function Roles(){
			return  $roles= array( 'EMSITEL' 			=> 'ADMINISTRADOR' ,
								     'E' 				=> 'COMERCIAL', 
								     'M'				=> 'CONTABILIDAD',  
								     'S' 				=> 'SERVICIOS',
								     'I' 				=> 'INTERNET',
								     'T' 				=> 'TELEFONIA',
								     'E' 				=> 'EMSIVOZ',
								     'L' 				=> 'VENTAS'
								    );
		}
	}
?>