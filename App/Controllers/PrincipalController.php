<?php

require_once 'Database/conexion/index.php';

class PrincipalController extends Conexion {

    public $rout;

    public function __construct(){

        $this->rout = "App/Views/";

    }

    /* 
    //
    //FUNCIONES EJECUTADAS POR GET
    //
    */
    public function getLogin($PAGE)
    {
        if($this->ValidateSession() == TRUE){
            # code...
            $usuario  = "";
            $password = "";
            $error    = "";
            include $this->rout.$PAGE.".blade.php";
        }else{
            header('location:Inicio');
        }
    }
    public function getErrorPage($PAGE)
    {
        include $this->rout.$PAGE.".blade.php";

    }

    public function getInicio($PAGE)
    {
        if($this->ValidateSession() == FALSE){
            # code...
            $this->UpdateDateSession($PAGE);
        }else{
            header('location:Login');
        }
    }
    public function getInicioCopia($PAGE)
    {
        if($this->ValidateSession() == FALSE){
            # code...
            $this->UpdateDateSession($PAGE);
        }else{
            header('location:Login');
        }
    }
    public function getDocumentacion($PAGE)
    {
        if($this->ValidateSession() == FALSE){
            # code...
            $this->UpdateDateSession($PAGE);
        }else{
            header('location:Login');
        }
    }
    public function getBancoDatos($PAGE)
    {
        if($this->ValidateSession() == FALSE){
            # code...
            $this->UpdateDateSession($PAGE);
        }else{
            header('location:Login');
        }
    }
    public function getBancoDatosCliente($PAGE)
    {
        if($this->ValidateSession() == FALSE){
            # code...
            $this->UpdateDateSession($PAGE);
        }else{
            header('location:Login');
        }
    }
    public function getAgregarCliente($PAGE)
    {
        if($this->ValidateSession() == FALSE){
            # code...
            $this->UpdateDateSession($PAGE);
        }else{
            header('location:Login');
        }
    }
    public function getConsumirDatos($PAGE)
    {
        if($this->ValidateSession() == FALSE){
            # code...
            $this->UpdateDateSession($PAGE);
        }else{
            header('location:Login');
        }
    }
    public function getCerrarsession(){
        $this->DeleteSession();
        header('location:Login');
    }


    /*
    //
    //FUNCIONES EJECUTADAS POR POST
    //
    */

    public function postLogin($PAGE,$DATOS){
        if($this->ValidateSession() == TRUE){
            $usuario  = $DATOS[0]['usuario'];
            $password = $DATOS[1]['password'];
            $password = $this->Encriptar($password);
            $query = "SELECT * FROM  users,rol WHERE user_us = '$usuario' AND password_us = '$password' AND rol_us = id_rol ";
            $result = $this->Ejecutar($query);
            if($this->CreateSession($result) == TRUE){
                $date =date('Y-m-d H:i:s');
                $token    = $_SESSION['token_us'];
                $cod_usu  = $_SESSION['id_us'];
                $query = "INSERT INTO tokens (token,id_user,fecha_ingreso,fecha_salida,state) VALUES ('$token','$cod_usu','$date','0000-00-00 00:00:00','ACTIVO')";
                $this->Ejecutar($query);
                $this->getInicio('Inicio');
            }else{
                $error = "Datos Incorrectos";
                include $this->rout.$PAGE.".blade.php";
            }
        }else{
            header('location:Inicio');
        }
    }
    public function postAgregarCliente($PAGE,$DATOS){
        if($this->ValidateSession() == FALSE){
            $cliente = $DATOS[0]['cliente'];
            $user_cl = $DATOS[1]['usuario_cl'];
            $pass_cl = $this->Encriptar($DATOS[2]['pass_cl']);
            $tipo_co = $DATOS[3]['tipo_conexion'];
            $tabla_cdr = $DATOS[4]['tabla_cdr'];
            $host_bd = $DATOS[5]['host_bd'];
            $user_bd = $DATOS[6]['user_bd'];
            $base_bd = $DATOS[7]['base_bd'];
            $pass_bd = $this->Encriptar($DATOS[8]['pass_bd']);
            $p_fijoloc = $DATOS[9]['precio_fijoLocal'];
            $p_fijonal = $DATOS[10]['precio_fijoNacional'];
            $p_celular = $DATOS[11]['precio_celular'];
            $p_interna = $DATOS[12]['precio_internacional'];
            $id_user = time();
            $query = "INSERT INTO  users (id_us,user_us,password_us,rol_us,name_us,logo_us) VALUES ('$id_user','$user_cl','$pass_cl','2','$cliente','emsitel.png') ";
            $result = $this->Ejecutar($query);
            if($result){
                switch ($tipo_co){
                    case  1:
                        $name_conex = 'Dream Pbx';
                        break;
                    case  2:
                        $name_conex = 'Grand Stream';
                        break;
                    case  3:
                        $name_conex = 'Free PBX';
                        break;
                    case  4:
                        $name_conex = 'CDR';
                        break;

                }
                $date =date('Y-m-d H:i:s');
                $id_cl = time();
                $query = "INSERT INTO `clientes`(`cod_cl`,`nombre_cliente`, `tipo_conexion`, `name_conexion`,`tabla_cdr`, `host_bd`, `usuario_bd`, `base_bd`, `contrasena_bd`, `fechacreacion_bd`, `user_admin`, `status`) VALUES ('$id_cl','$cliente','$tipo_co','$name_conex','$tabla_cdr','$host_bd','$user_bd','$base_bd','$pass_bd','$date','$id_user','1') ";
                $resulta = $this->Ejecutar($query);
                $query = "INSERT INTO `precios_minutos`( `valorfijoLocal`, `valorfijoNacional`, `valorCelular`, `valorInternacional`, `cliente`) VALUES ('$p_fijoloc','$p_fijonal','$p_celular','$p_interna','$id_cl') ";
                $resultb = $this->Ejecutar($query);
                if($tipo_co==2) {

                    $query = "CREATE TABLE $tabla_cdr(
                               id   VARCHAR (50)              NOT NULL,
                               src  VARCHAR (20)     NOT NULL,
                               dst  VARCHAR (20)              NOT NULL,
                               calldate  DATETIME ,
                               duration  VARCHAR (20),  
                               billsec  VARCHAR (20),    
                               disposition  VARCHAR (20),
                               clid  VARCHAR (50),
                               mes  VARCHAR (20),
                               tipo VARCHAR (20),
                               userfield  VARCHAR (100),
                               session  VARCHAR (100),      
                               PRIMARY KEY (id)
                            ); ";
                    $this->Ejecutar($query);
                }
                if($resulta && $resultb){
                    $success = "Se Registro Correctamente";
                    include $this->rout.$PAGE.".blade.php";
                }else{
                    $error = "No se ha podido crear el usuario";
                    include $this->rout.$PAGE.".blade.php";
                }
            }else{
                $error = "No se ha podido crear el usuario";
                include $this->rout.$PAGE.".blade.php";
            }
        }else{
            header('location:Inicio');
        }
    }
    public function postBancoDatosCliente($PAGE,$DATOS){
        if ($this->ValidateSession() == FALSE) {
            $tipo_form = $DATOS[0]['tipo_form'];
            if($tipo_form==1) {
                $nu = 1;
                $cod_cliente = $DATOS[$nu]['cod_cliente'];
                $nu += 1;
                $numerodpto = $DATOS[$nu]['numerodepto'];
                for ($i = 1; $i <= $numerodpto; $i++) {
                    $nu += 1;
                    $nombre_dpto = $DATOS[$nu]['dpto_' . $i];
                    $query = "INSERT INTO bd_departamentos(`nombre_dp`, `cliente`) VALUES ('$nombre_dpto','$cod_cliente') ";
                    $result = $this->Ejecutar($query);
                    if ($result) {
                    } else {
                    };
                }
                $itm=1;
            }
            if($tipo_form==2){
                $itm=2;
                $nu = 1;
                $cod_cliente = $DATOS[$nu]['cod_cliente'];
                $nu += 1;
                $numeroextenciones = $DATOS[$nu]['numeroextenciones'];
                for ($i = 1; $i <= $numeroextenciones; $i++) {
                    $nu += 1;
                    $num_exte = $DATOS[$nu]['numextencion_' . $i];
                    $nu += 1;
                    $name_exte = $DATOS[$nu]['nameextencion_' . $i];
                    $nu += 1;
                    $cod_dpto = $DATOS[$nu]['cod_dptoextenciones' . $i];
                    $query = "INSERT INTO bd_extenciones(`numero_ext`, `nombre_ext`, `cod_dp`) VALUES ('$num_exte','$name_exte','$cod_dpto') ";
                    $result = $this->Ejecutar($query);
                    if ($result) {
                    } else {
                    }
                }
            }
            if($tipo_form==3) {
                $itm=3;
                $cliente = $DATOS[1]['cliente'];
                $user_cl = $DATOS[2]['usuario_cl'];
                $pass_cl = $this->Encriptar($DATOS[3]['pass_cl']);
                $tipo_co = $DATOS[4]['tipo_conexion'];
                $tabla_cdr = $DATOS[5]['tabla_cdr'];
                $host_bd = $DATOS[6]['host_bd'];
                $user_bd = $DATOS[7]['user_bd'];
                $base_bd = $DATOS[8]['base_bd'];
                $pass_bd = $this->Encriptar($DATOS[9]['pass_bd']);
                $p_fijoloc = $DATOS[10]['precio_fijoLocal'];
                $p_fijonal = $DATOS[11]['precio_fijoNacional'];
                $p_celular = $DATOS[12]['precio_celular'];
                $p_interna = $DATOS[13]['precio_internacional'];
                $ejecutivo = $DATOS[14]['ejecutivo'];
                $val_mes = $DATOS[15]['valor_mes'];
                $periodo = $DATOS[16]['periodo'];
                $dig_ext = $DATOS[17]['dig_ext'];
                $cod_cliente = $DATOS[18]['cod_cliente'];
                $cod_us = $DATOS[19]['cod_us'];
                $id_user = time();
                $query = "UPDATE  users SET user_us = '$user_cl',password_us = '$pass_cl',name_us='$cliente' WHERE  id_us ='$cod_us' ";
                $result = $this->Ejecutar($query);
                if($result) {
                    switch ($tipo_co) {
                        case  1:
                            $name_conex = 'Dream Pbx';
                            break;
                        case  2:
                            $name_conex = 'Grand Stream';
                            break;
                        case  3:
                            $name_conex = 'Free PBX';
                            break;
                        case  4:
                            $name_conex = 'CDR';
                            break;
                        case  5:
                            $name_conex = 'Local';
                            break;
                    }
                    $query = "UPDATE `clientes` SET `nombre_cliente`='$cliente',`tipo_conexion`='$tipo_co',`name_conexion`='$name_conex',`tabla_cdr`='$tabla_cdr',`host_bd`='$host_bd',`usuario_bd`='$user_bd',`base_bd`='$base_bd',`contrasena_bd`='$pass_bd',`periodo`='$periodo',`ejecutivo`='$ejecutivo',`platames`='$val_mes',numExt ='$dig_ext' WHERE `cod_cl`='$cod_cliente'";
                    $result = $this->Ejecutar($query);
                    if($result) {
                        echo true;
                    }else{
                        echo false;
                    }


                }
            }
            header('location:BancoDatosCliente?cliente='.$cod_cliente.'&itm='.$itm);
        }else{
            header('location:Inicio');
        }
    }

    public function UpdateDateSession($PAGE){
        $token    = $_SESSION['token_us'];
        $query = "SELECT * FROM  users,rol,tokens WHERE rol_us = id_rol AND id_user =  id_us AND token = '$token' ";
        $result = $this->Ejecutar($query);
        if($this->UpdateSession($result) == TRUE){
            include $this->rout.$PAGE.".blade.php";
        }else{
            $this->getCerrarsession();
        }
    }


    //funciones de RECURSOS
    public function Encriptar($password){
        $key      = "6251625SGDHJAGJÇ2382783HJHSDJHSDN\~%X4SQ;4324237Q4324-*]+q;Lg4324|";
        $result = '';
        for($i=0; $i<strlen($password); $i++) {
            $char = substr($password, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result.=$char;
        }
        return base64_encode($result);
    }

    public function Desencriptar($password){
        $key      = "6251625SGDHJAGJÇ2382783HJHSDJHSDN\~%X4SQ;4324237Q4324-*]+q;Lg4324|";

        $result = '';
        $password = base64_decode($password);
        for($i=0; $i<strlen($password); $i++) {
            $char = substr($password, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }
        return $result;
    }
    public function eliminar_simbolos($string)
    {

        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        $string = str_replace(
            array("\\", "¨", "º", "-", "~",
                "#", "@", "|", "!", "\"",
                "·", "$", "%", "&", "/",
                "(", ")", "?", "'", "¡",
                "¿", "[", "^", "<code>", "]",
                "+", "}", "{", "¨", "´",
                ">", "< ", ";", ",", ":",
                ".", " "),
            ' ',
            $string
        );
        return $string;
    }
    public function SumarDias($fecha,$dias){
        $nuevafecha = strtotime ( '+'.$dias.' day' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-d' , $nuevafecha );

        return $nuevafecha;
    }

    public function EjecutarApiCdr($usuario,$contrasena,$host,$fechaI,$fechaF,$values){
        $Username = $usuario;
        $Password = $contrasena;
        $url = 'https://'.$host.'/cdrapi?format=JSON&startTime='.$fechaI.'&endTime='.$fechaF;
        // echo $url;
        $opts = array(
            'http'=>array(
                'method'=>"GET",
                'header' => "Authorization: Basic " . base64_encode("$Username:$Password")
            )
        );

        $context = stream_context_create($opts);

        $file = file_get_contents($url, false, $context);
        //
        //echo $file;
        $JSON=json_decode($file);
        for($i=0;$i<count($JSON->cdr_root);$i++){

            foreach($JSON as $obj){
                if(!empty($obj[$i]->start)){
                    //echo $obj[$i]->AcctId.",";
                    $values.="('".$obj[$i]->AcctId."','".$obj[$i]->src."','".$obj[$i]->dst."','".$obj[$i]->start."','".$obj[$i]->duration."','".$obj[$i]->billsec."','".$obj[$i]->disposition."','".$obj[$i]->AcctId."','".$obj[$i]->clid."','cdr','".$obj[$i]->userfield."','".$obj[$i]->cdr."'),";
                }else{
                    if(!empty($obj[$i]->sub_cdr_1)){

                        $obp = (object)$obj[$i]->sub_cdr_1;
                        //echo $obp->AcctId.",";
                        if(empty($obp->AcctId)){
                            $id = $obj[$i]->cdr;
                        }else{
                            $id= $obp->AcctId;
                        }
                        $values.="('".$id."','".$obp->src."','".$obp->dst."','".$obp->start."','".$obp->duration."','".$obp->billsec."','".$obp->disposition."','".$obp->AcctId."','".$obp->clid."','subcdr1','".$obp->userfield."','".$obp->session."'),";
                    }
                    if(!empty($obj[$i]->main_cdr)){
                        $obc = (object)$obj[$i]->main_cdr;
                        //echo $obc->AcctId.",";
                        if(empty($obc->AcctId)){
                            $id = $obj[$i]->cdr;
                        }else{
                            $id= $obc->AcctId;
                        }
                        $values.="('".$id."','".$obc->src."','".$obc->dst."','".$obc->start."','".$obc->duration."','".$obc->billsec."','".$obc->disposition."','".$obc->AcctId."','".$obc->clid."','maincdr','".$obc->userfield."','".$obc->session."'),";
                    }
                    if(!empty($obj[$i]->sub_cdr_2)){
                        $obd = (object)$obj[$i]->sub_cdr_2;
                        //echo $obd->AcctId.",";
                        if(empty($obd->AcctId)){
                            $id = $obj[$i]->cdr;
                        }else{
                            $id= $obd->AcctId;
                        }
                        $values.="('".$id."','".$obd->src."','".$obd->dst."','".$obd->start."','".$obd->duration."','".$obd->billsec."','".$obd->disposition."','".$obd->AcctId."','".$obd->clid."','subcdr2','".$obd->userfield."','".$obd->session."'),";
                    }
                }
            }
        }
        return $values;
    }

    //*peticiones ajax.php

    //usuario root
    public function InfoEjecutivos() {
        session_start();
        $rol =  $_SESSION['rol_us'];
        if($rol == 1) {
            $query = "SELECT nombre_eje,id_eje FROM `ejecutivos` WHERE 1";
            $result = $this->Ejecutar($query);
            if(mysqli_num_rows($result)>0) {
                return $result;
            }else{
                echo false;
            }
        }

    }
    public function InfoConexiones() {
        // session_start();
        $rol =  $_SESSION['rol_us'];
        if($rol == 1) {
            $query = "SELECT * FROM `conexiones` WHERE 1";
            $result = $this->Ejecutar($query);
            if(mysqli_num_rows($result)>0) {
                return $result;
            }else{
                echo false;
            }
        }

    }
    public function InfoDetalleCliente($id) {

        $rol =  $_SESSION['rol_us'];
        if($rol == 1) {
            $query = "SELECT numExt,`cod_cl`,`id_us`,password_us,contrasena_bd,`user_us`, `nombre_cliente`, `tipo_conexion`, `name_conexion`, `tabla_cdr`, `host_bd`, `usuario_bd`, `base_bd`, `fechacreacion_bd`, `user_admin`, `status`, `periodo`, `platames`, `ejecutivo`,`valorfijoLocal`, `valorfijoNacional`, `valorCelular`, `valorInternacional` FROM `clientes`,users,precios_minutos WHERE cod_cl ='$id' AND clientes.user_admin=users.id_us AND precios_minutos.cliente=clientes.cod_cl ";
            $result = $this->Ejecutar($query);
            if(mysqli_num_rows($result)>0) {
                return $result;
            }else{
                echo false;
            }
        }

    }
    public function InfoClientes($request) {
        session_start();
        $rol =  $_SESSION['rol_us'];
        if($rol == 1) {
            $query = "SELECT cod_cl,nombre_cliente,host_bd,name_conexion FROM `clientes` WHERE status = 1";
            $result = $this->Ejecutar($query);
            if(mysqli_num_rows($result)>0) {
                $post = array();
                while ($res = mysqli_fetch_object($result)) {
                    $post[] = array('nombre_cliente' => $res->nombre_cliente, 'host_bd' => $res->host_bd, 'name_conexion' => $res->name_conexion, 'id' => $res->cod_cl);
                }
                if(empty($request)){
                    var_dump($result);
                    return $result;
                }else {
                    echo json_encode($post);
                }
            }else{
                echo false;
            }
        }

    }
    public function InfoClienteGet($id) {
        if(empty($id)){
            $sql  = "";
        }else{
            $sql = 'AND cod_cl = "'.$id.'" ';
        }
        $query = "SELECT cod_cl,nombre_cliente,host_bd,name_conexion FROM `clientes` WHERE status = 1 $sql";
        $result = $this->Ejecutar($query);
        if(mysqli_num_rows($result)>0) {
            return $result;
        }else{
            return false;
        }
    }
    public function InfoClientesGrandStream($sql) {
        $query = "SELECT * FROM `clientes` WHERE status = 1 AND tipo_conexion=2 $sql ";
        $result = $this->Ejecutar($query);
        if(mysqli_num_rows($result)>0) {
            return $result;
        }else{
            return false;
        }
    }
    public function InfoLlamadaFecha($fechai,$fechaf,$tabla) {
        $query = "SELECT * FROM ".$tabla." WHERE calldate>='$fechai 00:00:00' AND  calldate<='$fechaf 23:59:59' ";
        $result = $this->Ejecutar($query);
        if(mysqli_num_rows($result)>0) {
            return $result;
        }else{
            return false;
        }
    }
    public function Insert($query) {
        $result = $this->Ejecutar($query);
        if($result) {
            return true;
        }else{
            return false;
        }
    }
    public function InfoDeptosBDCliente($id) {
        $query = "SELECT * FROM `bd_departamentos` WHERE cliente = $id";
        $result = $this->Ejecutar($query);
        if(mysqli_num_rows($result)>0) {
            return $result;
        }else{
            return false;
        }
    }
    public function InfoExtencionesBDCliente($id) {
        $query = "SELECT bd_departamentos.cod_dp,nombre_dp,numero_ext,nombre_ext,cod_ext FROM `bd_extenciones`,`bd_departamentos` WHERE cliente = $id AND bd_departamentos.cod_dp=bd_extenciones.cod_dp ORDER BY cod_ext ASC";
        $result = $this->Ejecutar($query);
        if(mysqli_num_rows($result)>0) {
            return $result;
        }else{
            return false;
        }
    }
    public function ListasExtenciones($request) {
        $cod = $request->cliente;
        $query = "SELECT * FROM bd_departamentos,`bd_extenciones` WHERE cliente= '$cod' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp ORDER BY cod_ext ASC ";
        $result = $this->Ejecutar($query);
        if(mysqli_num_rows($result)>0) {
            $select = '<select class="form-control" name="extencion" id="extencion" ><option value="0">Ninguna</option>';
            while ($res =mysqli_fetch_object($result)){
                $select.="<option value='".$res->numero_ext."'>".$res->nombre_ext." - ".$res->numero_ext."</option>";
            }
            $select.="</select>";
            $post[] =array('select'=>$select);

        }else{
            $select='<select class="form-control" name="extencion" id="extencion" ><option value="0">No hay extenciones</option></select>';
            $post[] =array('select'=>$select);
        }
        echo json_encode($post);
    }

    public function ListasDptos($request) {
        $cod = $request->codcliente;
        $query = "SELECT * FROM bd_departamentos WHERE cliente= '$cod' ";
        $result = $this->Ejecutar($query);
        if(mysqli_num_rows($result)>0) {
            while ($res =mysqli_fetch_object($result)){
                $post[]=array('cliente'=>$res->nombre_dp,'cod_dp'=>$res->cod_dp);
            }
            echo json_encode($post);
        }else{
            return false;
        }
    }
    public function InfoMesImportar($request) {
        $c_cl = $request->cliente;
        $year = $request->year;
        $query = "SELECT * FROM hisotiral_exportacionData WHERE cod_cliente= '$c_cl' AND year = '$year' ";
        $post =array();
        $result = $this->Ejecutar($query);
        if(mysqli_num_rows($result)>0) {
            while ($res =mysqli_fetch_object($result)){

                $post[$res->num_mesexportado]=true;
            }
        }

            $mes = date('m');
            $mes = $mes  - 01;
            if($year == 2017){
                $inicio = 12;
                $mes  = 12;
            }else{
                $inicio = 01;
            }
            $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
            $option = "<option value='0'>Seleccionar</option>";
            for($p = $inicio;$p<=$mes;$p++){
                $tmes = $p - 1;
                if(!empty($post[$p])){
                   $option.='<option value="'.$p.'" disabled>'.$meses[$tmes].' - Exportado</option>';
                }else{
                    $option.='<option value="'.$p.'" >'.$meses[$tmes].' </option>';
                }
            }
            $respuesta[] = array('select'=>'<select class="form-control" name="month" id="month">'.$option.'</select>');
            echo json_encode($respuesta);

    }

    public function saveExten($request) {
        $nombre_ext = $request->nombre_ext;
        $numero_ext = $request->numero_ext;
        $cod_ext = $request->cod_ext;
        $cod_dp = $request->cod_dpto;
        $query = "UPDATE bd_extenciones SET nombre_ext = '$nombre_ext',numero_ext='$numero_ext',cod_dp='$cod_dp' WHERE cod_ext= '$cod_ext' ";
        $result = $this->Ejecutar($query);
        if($result) {
            return true;
        }else{
            return false;
        }
    }

    public function trashExten($request) {
        $cod_ext = $request->cod_ext;
        $query = "DELETE FROM bd_extenciones WHERE cod_ext= '$cod_ext' ";
        $result = $this->Ejecutar($query);
        if($result) {
            return true;
        }else{
            return false;
        }
    }


    //** consultas DREAMPBX ANALITICA
    public function CostosDistribuicion($request) {
        session_start();
        if($_SESSION['rol_us'] == 2) {
            $id_us = $_SESSION['id_us'];
            $sql = "user_admin = '$id_us'";
        }else{
            $id_us = $request->cliente;
            $sql = "cod_cl = '$id_us'";
        }
        $query = "SELECT * FROM `clientes`,precios_minutos,ejecutivos WHERE $sql AND precios_minutos.cliente=clientes.cod_cl AND id_eje = ejecutivo";
        $result = $this->Ejecutar($query);
        $post = array();

        while ($row = mysqli_fetch_object($result)) {
            //$fechahoy = date('Y-m-d');
            //$fechahoy = "2016-08-31";
            $year = $request->year;
            $mont = $request->mont;

            $fechaI = $year."-".$mont."-01";
            $fechaF = $year."-".$mont."-31";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $tabla= $row->tabla_cdr;
            }else{
                $tabla = 'cdr';
            }
            $pref= '';
           //echo $row->prefijo;
            $nummas = 0;
            if($row->prefijo!=null || $row->prefijo!=NULL){
                $pref=$row->prefijo;
                $nummas =count($pref);

            }
            $fijo = 7 + $nummas;
            $fijonac = 10 + $nummas;

            $sqlFijoLocal = "SELECT SUM( CEIL( billsec /60 )) as minutos FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH(dst) = (".$fijo.") AND disposition = 'ANSWERED' AND  billsec > 0 AND dst LIKE '".$pref."5%'  ";
           // echo $sqlFijoLocal;
            //echo $row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlFijoLocal;
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar($sqlFijoLocal);
              //  echo ",,";
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlFijoLocal);
            }

            while ($res = mysqli_fetch_object($queryRes)) {
               $minutosFijo = $res->minutos."...p";
                $valorFijo = $minutosFijo * $row->valorfijoLocal;
            }
            $sqlFijoNacio = "SELECT SUM( CEIL( billsec /60 )) as minutos FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH(dst) =(".$fijonac.") AND (dst LIKE '".$pref."07%' OR dst LIKE '".$pref."08%' OR dst LIKE '".$pref."09%' OR dst LIKE '".$pref."03%') AND disposition = 'ANSWERED' AND  billsec > 0  ";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar($sqlFijoNacio);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlFijoNacio);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $minutosNacio = $res->minutos;
                $valorNacio = $minutosNacio * $row->valorfijoNacional;
            }
            $sqlCelular = "SELECT SUM( CEIL( billsec /60 )) as minutos FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH(dst) = ($fijonac) AND dst LIKE '".$pref."3%' AND disposition = 'ANSWERED' AND  billsec > 0";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCelular);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCelular);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $minutosCelular = $res->minutos;
                $valorCelular = $minutosCelular * $row->valorCelular;
            }

            $sqlInternacional = "SELECT SUM( CEIL( billsec /60 )) as minutos FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH(dst) > ($row->numExt) AND dst LIKE '".$pref."009%' AND disposition = 'ANSWERED' AND  billsec > 0";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlInternacional);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlInternacional);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $minutosInternacional = $res->minutos;
                $valorInternacional = $minutosInternacional * $row->valorInternacional;
            }


            $totalplata = $valorCelular + $valorNacio + $valorFijo + $valorInternacional;
            $totalMinutos = $minutosFijo + $minutosNacio + $minutosCelular  + $minutosInternacional;
            $fijopor = 0;
            $nacionalpor=0;
            $celularpor =0;
            $valormin = 0;
            $internacionalpor =0;

            if($row->platames>0) {
                $fijopor = ($minutosFijo * 100) / $totalMinutos;
                $nacionalpor = ($minutosNacio * 100) / $totalMinutos;
                $celularpor = ($minutosCelular * 100) / $totalMinutos;
                $internacionalpor = ( $minutosInternacional * 100) / $totalMinutos;
                //$valormin = number_format($row->platames / $totalMinutos, 0);
                $valormin = number_format($row->platames / $totalMinutos, 0);
            }
            //  $post[] = array('fijo'=>$minutosFijo,'valorFijo'=>$valorFijo,'nacional'=>$minutosNacio,'valorNacional'=>$valorNacio,'celular'=>$minutosCelular,'valorCeluar'=>$valorCelular,'fijoPor'=>number_format($fijopor,2),'nacionalPor'=>number_format($nacionalpor,2),'celularPor'=>number_format($celularpor,2),'totalplata'=>$totalplata,'totalLlamadas'=>$totalMinutos);
            $post[] = array('nombre_eje'=>$row->nombre_eje,'periodo'=>$row->periodo,'fijoPor'=>number_format($fijopor,2),'nacionalPor'=>number_format($nacionalpor,2),'celularPor'=>number_format($celularpor,2),'internacionalPor'=>number_format($internacionalpor,2),'totalPlata'=>number_format($row->platames,0),'valorMin'=>$valormin,'totalMinutos'=>$totalMinutos);
            echo json_encode($post);

        }

    }
    public function CostosParticipacion($request) {
        session_start();
        if($_SESSION['rol_us'] == 2) {
            $id_us = $_SESSION['id_us'];
            $sql = "user_admin = '$id_us'";
        }else{
            $id_us = $request->cliente;
            $sql = "cod_cl = '$id_us'";
        }
        $query = "SELECT * FROM `clientes`,precios_minutos WHERE $sql AND precios_minutos.cliente=clientes.cod_cl";
        $result = $this->Ejecutar($query);
        $post = array();

        while ($row = mysqli_fetch_object($result)) {
            //$fechahoy = date('Y-m-d');
            //$fechahoy = "2016-08-31";
            $year = $request->year;
            $mont = $request->mont;

            $fechaI = $year."-".$mont."-01";
            $fechaF = $year."-".$mont."-31";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $tabla= $row->tabla_cdr;
            }else{
                $tabla = 'cdr';
            }
            $sqlCostos = "SELECT SUM( CEIL( billsec /60 )) as minutos,src,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH(src) = ($row->numExt) AND LENGTH(dst) > (5) AND  disposition = 'ANSWERED' AND  billsec > 0  ORDER BY minutos DESC limit 0,5";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);

            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            $totalMinutos = 1;
            while ($res = mysqli_fetch_object($queryRes)) {
                $totalMinutos = $res->minutos;
            }

            $sqlCostos = "SELECT SUM( CEIL( billsec /60 )) as minutos,src,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH(src) = ($row->numExt) AND LENGTH(dst) > (5) AND  disposition = 'ANSWERED' AND  billsec > 0 GROUP  BY src ORDER BY minutos DESC limit 0,5";

            $post=array();
            $totalplata=0;
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);

            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                //divido la i en 2 para poder sumar la cantidad de la plata y sacar el porcentaje de cadad uno
                $name = $res->clid;
                $name = str_replace('"','',$name);
                $subname = '<';
                // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                $posicionsubname = strpos ($name, $subname);
                // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                $name_ext = substr ($name, 0,($posicionsubname));
                $name_ext = $this->eliminar_simbolos($name_ext);
                $name_ext = substr ($name_ext, 0,18);
                // leonpurpura.com


                $minutos = $res->minutos;
                $valorllamadas = $minutos * $row->valorfijoLocal;
                $extencion = $res->src;

                $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion' ";
                $queryExten = $this->Ejecutar($sqlExten);
                $name_dp = '';

                while ($obj = mysqli_fetch_object($queryExten)) {
                    $name_dp = $obj->nombre_dp;
                    $name_dp = substr ($name_dp, 0,10);
                    $name_dp = $name_dp." - ";
                    $name_ext = $obj->nombre_ext;
                    $name_ext = substr ($name_ext, 0,10);
                }
                $valmin = $row->platames / $totalMinutos;
                if($row->platames>0){
                    $por = (($minutos * $valmin) * 100 )/ $row->platames;
                }else{
                    $por = 0;
                }
                $post[] = array('src' => $res->src, 'minutos' => $minutos, 'value' => number_format($valorllamadas,0), 'nombre' => $name_dp . " " . $name_ext, 'porcentaje' =>number_format(($por),2));


            }

            $nombre=array();
            $minutos=array();
            $porcentaje=array();
            for($j=0;$j<5;$j++){
                if(!empty($post[$j])){
                    $nombre[$j] = $post[$j]['nombre']." - ".$post[$j]['src'];
                    $minutos[$j] = $post[$j]['minutos'] + 0;
                    $porcentaje[$j] = $post[$j]['porcentaje'] + 0;
                }else{
                    $nombre[$j] = 0;
                    $minutos[$j] = 0;
                    $porcentaje[$j] = 0;
                }
            }
            $json = array();
            $json[]=array($nombre[0],$nombre[1],$nombre[2],$nombre[3],$nombre[4]);
            $json[]=array($minutos[0],$minutos[1],$minutos[2],$minutos[3],$minutos[4]);
            $json[]=array($porcentaje[0],$porcentaje[1],$porcentaje[2],$porcentaje[3],$porcentaje[4]);
            echo json_encode($json);
        }

    }
    public function AprovechLlEntrantes($request) {
        session_start();
        if($_SESSION['rol_us'] == 2) {
            $id_us = $_SESSION['id_us'];
            $sql = "user_admin = '$id_us'";
        }else{
            $id_us = $request->cliente;
            $sql = "cod_cl = '$id_us'";
        }
        $query = "SELECT * FROM `clientes`,precios_minutos WHERE $sql AND precios_minutos.cliente=clientes.cod_cl";
        $result = $this->Ejecutar($query);
        $post = array();

        while ($row = mysqli_fetch_object($result)) {
            //$fechahoy = date('Y-m-d');
            //$fechahoy = "2016-08-31";
            $year = $request->year;
            $mont = $request->mont;

            $fechaI = $year."-".$mont."-01";
            $fechaF = $year."-".$mont."-31";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $tabla= $row->tabla_cdr;
            }else{
                $tabla = 'cdr';
            }
            $post=array();
            $sqlCostos = "SELECT COUNT( src ) AS llamadas, src,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH( dst ) = ( $row->numExt ) AND (LENGTH( src ) > ( $row->numExt ) OR LENGTH( src ) = ( 0 )) AND  disposition = 'ANSWERED' AND  billsec > 0  /*AND userfield = 'Inbound'*/ GROUP BY src ORDER BY llamadas DESC LIMIT 0 , 5";
            //echo $sqlCostos;
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            $i=0;
            while ($res = mysqli_fetch_object($queryRes)) {
                $extencion = $res->src;
                $llamadas  = $res->llamadas;
                $name = $res->clid;
                $name = str_replace('"','',$name);
                $subname = '<';
                // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                $posicionsubname = strpos ($name, $subname);
                // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                $name_ext = substr ($name, 0,($posicionsubname));
                $name_ext = substr ($name_ext, 0,18);
                $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion' ";
                $queryExten = $this->Ejecutar($sqlExten);
                $name_dp = 'NULL';

                while ($obj = mysqli_fetch_object($queryExten)) {
                    $name_dp = $obj->nombre_dp;
                    $name_ext = $obj->nombre_ext;
                }

                $post[] = array('extencion' => $extencion, 'llamadas' => $llamadas, 'nombre_ext' =>$name_ext);
                $i+=1;
            }
            $r=5-$i;
            if($r>0){
                for($p=1;$p<=$r;$p++){
                    $post[] = array('extencion' =>0, 'llamadas' => 0, 'nombre_ext' =>0);
                }
            }
            $i=0;
            $sqlCostos = "SELECT COUNT( src ) AS llamadas, src ,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH( dst ) = ( $row->numExt ) AND (LENGTH( src ) > ( $row->numExt ) OR LENGTH( src ) = ( 0 )) AND  disposition = 'ANSWERED' AND  billsec > 0  /*AND userfield = 'Inbound'*/ GROUP BY src ORDER BY llamadas ASC LIMIT 0 , 5";

            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $extencion = $res->src;
                $llamadas  = $res->llamadas;
                $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion' ";
                $queryExten = $this->Ejecutar($sqlExten);
                $name_dp = 'NULL';
                $name = $res->clid;
                $name = str_replace('"','',$name);
                $subname = '<';
                // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                $posicionsubname = strpos ($name, $subname);
                // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                $name_ext = substr ($name, 0,($posicionsubname));
                $name_ext = substr ($name_ext, 0,18);

                while ($obj = mysqli_fetch_object($queryExten)) {
                    $name_dp = $obj->nombre_dp;
                    $name_ext = $obj->nombre_ext;
                }

                $post[] = array('extencion' => $extencion, 'llamadas' => $llamadas, 'nombre_ext' =>$name_ext);
                $i+=1;
            }
            $r=5-$i;
            if($r>0){
                for($p=1;$p<=$r;$p++){
                    $post[] = array('extencion' =>0, 'llamadas' => 0, 'nombre_ext' =>0);
                }
            }
            $i=0;

            $sqlCostos = "SELECT SUM( CEIL( billsec /60 ) ) AS minutos, COUNT( src ) AS llamadas FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59' AND LENGTH( dst ) = ($row->numExt ) AND (LENGTH( src ) > ( $row->numExt ) OR LENGTH( src ) = ( 0 )) AND disposition = 'ANSWERED' AND  billsec > 0   /*AND userfield = 'Inbound' */";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $minutos = $res->minutos;
                $llamadas  = $res->llamadas;

                $post[] = array('prom_minutos' => $minutos/$llamadas, 'totalllamadas' => $llamadas, 'llamadasdia' =>$llamadas/30);
            }
            $nombre=array();
            $llamadas=array();
            for($j=0;$j<10;$j++){
                if(!empty($post[$j])){
                    $nombre[$j] = $post[$j]['nombre_ext']." - ".$post[$j]['extencion'];
                    $llamadas[$j] = $post[$j]['llamadas'] + 0;
                }else{
                    $nombre[$j] = 0;
                    $llamadas[$j] = 0;
                }
            }
            $json = array();
            $json[]=array($nombre[0],$nombre[1],$nombre[2],$nombre[3],$nombre[4]);
            $json[]=array($llamadas[0],$llamadas[1],$llamadas[2],$llamadas[3],$llamadas[4]);
            $json[]=array($nombre[5],$nombre[6],$nombre[7],$nombre[8],$nombre[9]);
            $json[]=array($llamadas[5],$llamadas[6],$llamadas[7],$llamadas[8],$llamadas[9]);
            $json[]=array(number_format($post[10]['prom_minutos'],2),number_format($post[10]['totalllamadas'],0),number_format($post[10]['llamadasdia'],2));
            echo json_encode($json);
        }

    }
    public function AprovechLlSalientes($request) {
        session_start();
        if($_SESSION['rol_us'] == 2) {
            $id_us = $_SESSION['id_us'];
            $sql = "user_admin = '$id_us'";
        }else{
            $id_us = $request->cliente;
            $sql = "cod_cl = '$id_us'";
        }
        $query = "SELECT * FROM `clientes`,precios_minutos WHERE $sql AND precios_minutos.cliente=clientes.cod_cl";
        $result = $this->Ejecutar($query);
        $post = array();

        while ($row = mysqli_fetch_object($result)) {
            //$fechahoy = date('Y-m-d');
            //$fechahoy = "2016-08-31";
            $year = $request->year;
            $mont = $request->mont;

            $fechaI = $year."-".$mont."-01";
            $fechaF = $year."-".$mont."-31";

            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $tabla= $row->tabla_cdr;
            }else{
                $tabla = 'cdr';
            }
            $post=array();
            $sqlCostos = "SELECT COUNT(dst ) AS llamadas, dst ,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH( dst ) >= ( 5 ) AND LENGTH( src ) = ( $row->numExt ) AND  disposition = 'ANSWERED' /*AND userfield = 'Outbound'*/ AND  billsec > 0  GROUP BY dst ORDER BY llamadas DESC LIMIT 0 , 5";


            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            $i=0;
            while ($res = mysqli_fetch_object($queryRes)) {
                $extencion = $res->dst;
                $llamadas  = $res->llamadas;
                $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion' ";
                $queryExten = $this->Ejecutar($sqlExten);
                $name_dp = 'NULL';
                $name = $res->clid;
                $name = str_replace('"','',$name);
                $subname = '<';
                // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                $posicionsubname = strpos ($name, $subname);
                // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                $name_ext = substr ($name, 0,($posicionsubname));
                $name_ext = substr ($name_ext, 0,18);

                while ($obj = mysqli_fetch_object($queryExten)) {
                    $name_dp = $obj->nombre_dp;
                    $name_ext = $obj->nombre_ext;
                }

                $post[] = array('extencion' => $extencion, 'llamadas' => $llamadas, 'nombre_ext' =>$name_ext);
                $i+=1;
            }
            $r=5-$i;
            if($r>0){
                for($p=1;$p<=$r;$p++){
                    $post[] = array('extencion' =>0, 'llamadas' => 0, 'nombre_ext' =>0);
                }
            }
            $i=0;
            $sqlCostos = "SELECT COUNT( dst) AS llamadas, dst,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH( dst ) >= ( 5 ) AND LENGTH( src ) = ( $row->numExt ) AND  disposition = 'ANSWERED' /*AND userfield = 'Outbound'*/ AND  billsec > 0  GROUP BY dst ORDER BY llamadas ASC LIMIT 0 , 5";

            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $extencion = $res->dst;
                $llamadas  = $res->llamadas;
                $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion' ";
                $queryExten = $this->Ejecutar($sqlExten);
                $name_dp = 'NULL';
                $name = $res->clid;
                $name = str_replace('"','',$name);
                $subname = '<';
                // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                $posicionsubname = strpos ($name, $subname);
                // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                $name_ext = substr ($name, 0,($posicionsubname));
                $name_ext = substr ($name_ext, 0,18);
                while ($obj = mysqli_fetch_object($queryExten)) {
                    $name_dp = $obj->nombre_dp;
                    $name_ext = $obj->nombre_ext;
                }

                $post[] = array('extencion' => $extencion, 'llamadas' => $llamadas, 'nombre_ext' =>$name_ext);
                $i+=1;
            }
            $r=5-$i;
            if($r>0){
                for($p=1;$p<=$r;$p++){
                    $post[] = array('extencion' =>0, 'llamadas' => 0, 'nombre_ext' =>0);
                }
            }
            $i=0;

            $sqlCostos = "SELECT SUM( CEIL( billsec /60 ) ) AS minutos, COUNT( dst) AS llamadas FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59' AND LENGTH( dst ) >= ( 5 )  AND LENGTH( src ) = ( $row->numExt ) AND  disposition = 'ANSWERED' AND  billsec > 0 /*AND userfield = 'Outbound'*/  ";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $minutos = $res->minutos;
                $llamadas  = $res->llamadas;

                $post[] = array('prom_minutos' => $minutos/$llamadas, 'totalllamadas' => $llamadas, 'llamadasdia' =>$llamadas/30);
            }
            $nombre=array();
            $llamadas=array();
            for($j=0;$j<10;$j++){
                if(!empty($post[$j])){
                    $nombre[$j] = $post[$j]['nombre_ext']." - ".$post[$j]['extencion'];
                    $llamadas[$j] = $post[$j]['llamadas'] + 0;
                }else{
                    $nombre[$j] = 0;
                    $llamadas[$j] = 0;
                }
            }
            $json = array();
            $json[]=array($nombre[0],$nombre[1],$nombre[2],$nombre[3],$nombre[4]);
            $json[]=array($llamadas[0],$llamadas[1],$llamadas[2],$llamadas[3],$llamadas[4]);
            $json[]=array($nombre[5],$nombre[6],$nombre[7],$nombre[8],$nombre[9]);
            $json[]=array($llamadas[5],$llamadas[6],$llamadas[7],$llamadas[8],$llamadas[9]);
            $json[]=array(number_format($post[10]['prom_minutos'],2),number_format($post[10]['totalllamadas'],0),number_format($post[10]['llamadasdia'],2));
            echo json_encode($json);

        }

    }
    public function AprovechLlInternas($request) {
        session_start();
        if($_SESSION['rol_us'] == 2) {
            $id_us = $_SESSION['id_us'];
            $sql = "user_admin = '$id_us'";
        }else{
            $id_us = $request->cliente;
            $sql = "cod_cl = '$id_us'";
        }
        $query = "SELECT * FROM `clientes`,precios_minutos WHERE $sql AND precios_minutos.cliente=clientes.cod_cl";
        $result = $this->Ejecutar($query);
        $post = array();

        while ($row = mysqli_fetch_object($result)) {
            //$fechahoy = date('Y-m-d');
            //$fechahoy = "2016-08-31";
            $year = $request->year;
            $mont = $request->mont;

            $fechaI = $year."-".$mont."-01";
            $fechaF = $year."-".$mont."-31";
            $post=array();
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $tabla= $row->tabla_cdr;
            }else{
                $tabla = 'cdr';
            }

            $sqlCostos = "SELECT COUNT( src ) AS llamadas, src,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH( src ) = ( $row->numExt ) AND LENGTH( dst ) = ( $row->numExt ) AND  disposition = 'ANSWERED' AND  billsec > 0 /*AND  userfield ='Internal'*/  GROUP BY src ORDER BY llamadas DESC LIMIT 0 , 5";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            $i=0;
            while ($res = mysqli_fetch_object($queryRes)) {
                $extencion = $res->src;
                $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion' ";
                $queryExten = $this->Ejecutar($sqlExten);
                $name_dp = 'NULL';
                $name = $res->clid;
                $extencion2=0;
                $name_ext2=0;
                $name = str_replace('"','',$name);
                $subname = '<';
                // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                $posicionsubname = strpos ($name, $subname);
                // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                $name_ext = substr ($name, 0,($posicionsubname));
                $name_ext = substr ($name_ext, 0,13);

                while ($obj = mysqli_fetch_object($queryExten)) {
                    $name_dp = $obj->nombre_dp;
                    $name_ext = $obj->nombre_ext;
                    $name_ext = substr ($name_ext, 0,13);
                }
                $sqlCostosD = "SELECT COUNT( dst ) AS llamadas, dst,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH( dst ) = ( $row->numExt ) AND src = '$extencion' AND  disposition = 'ANSWERED' AND  billsec > 0 /*AND  userfield ='INTERNAL'*/ GROUP BY dst ORDER BY llamadas DESC LIMIT 0 , 1";
                if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                    $queryResD = $this->Ejecutar( $sqlCostosD);
                }else{
                    $queryResD = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostosD);
                }
                while ($res = mysqli_fetch_object($queryResD)) {
                    $extencion2 = $res->dst;
                    $llamadas2  = $res->llamadas;
                    $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion2' ";
                    $queryExten = $this->Ejecutar($sqlExten);
                    $name_dp = 'NULL';
                    $name = $res->clid;
                    $name = str_replace('"','',$name);
                    $subname = '<';
                    // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                    $posicionsubname = strpos ($name, $subname);
                    // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                    $name_ext2 = substr ($name, 0,($posicionsubname));
                    $name_ext2 = substr ($name_ext2, 0,13);

                    while ($obj = mysqli_fetch_object($queryExten)) {
                        $name_dp2 = $obj->nombre_dp;
                        $name_ext2 = $obj->nombre_ext;
                        $name_ext2 = substr ($name_ext2, 0,13);
                    }
                }

                $post[] = array('extencion1' => $extencion,'extencion2' => $extencion2, 'llamadas' => $llamadas2, 'nombre_ext1' =>$name_ext, 'nombre_ext2' =>$name_ext2);
                $i+=1;
            }
            $r=5-$i;
            if($r>0){
                for($p=1;$p<=$r;$p++){
                    $post[] = array('extencion1' => 0,'extencion2' => 0, 'llamadas' => 0, 'nombre_ext1' =>0, 'nombre_ext2' =>0);
                }
            }
            $i=0;

            $sqlCostos = "SELECT COUNT( src ) AS llamadas, src,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH( src ) = ( $row->numExt ) AND LENGTH( dst ) = ( $row->numExt ) AND  disposition = 'ANSWERED' AND  billsec > 0  /*AND  userfield ='INTERNAL'*/ GROUP BY src ORDER BY llamadas ASC LIMIT 0 , 5";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $extencion = $res->src;
                $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion' ";
                $queryExten = $this->Ejecutar($sqlExten);
                $name_dp = 'NULL';
                $name = $res->clid;
                $extencion2=0;
                $name_ext2=0;
                $name = str_replace('"','',$name);
                $subname = '<';
                // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                $posicionsubname = strpos ($name, $subname);
                // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                $name_ext = substr ($name, 0,($posicionsubname));
                $name_ext = substr ($name_ext, 0,13);

                while ($obj = mysqli_fetch_object($queryExten)) {
                    $name_dp = $obj->nombre_dp;
                    $name_ext = $obj->nombre_ext;
                    $name_ext = substr ($name_ext, 0,13);
                }
                $sqlCostosD = "SELECT COUNT( dst ) AS llamadas, dst,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH( dst ) = ( $row->numExt ) AND src = '$extencion' AND  disposition = 'ANSWERED' AND  billsec > 0 /*AND  userfield ='INTERNAL'*/ GROUP BY dst ORDER BY llamadas ASC LIMIT 0 , 1";
                if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                    $queryResD = $this->Ejecutar( $sqlCostosD);
                }else{
                    $queryResD = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostosD);
                }
                while ($res = mysqli_fetch_object($queryResD)) {
                    $extencion2 = $res->dst;
                    $llamadas2  = $res->llamadas;
                    $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion2' ";
                    $queryExten = $this->Ejecutar($sqlExten);
                    $name_dp = 'NULL';
                    $name = $res->clid;
                    $name = str_replace('"','',$name);
                    $subname = '<';
                    // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                    $posicionsubname = strpos ($name, $subname);
                    // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                    $name_ext2 = substr ($name, 0,($posicionsubname));
                    $name_ext2 = substr ($name_ext2, 0,13);

                    while ($obj = mysqli_fetch_object($queryExten)) {
                        $name_dp2 = $obj->nombre_dp;
                        $name_ext2 = $obj->nombre_ext;
                        $name_ext2 = substr ($name_ext2, 0,13);
                    }
                }

                $post[] = array('extencion1' => $extencion,'extencion2' => $extencion2, 'llamadas' => $llamadas2, 'nombre_ext1' =>$name_ext, 'nombre_ext2' =>$name_ext2);
                $i+=1;
            }
            $r=5-$i;
            if($r>0){
                for($p=1;$p<=$r;$p++){
                    $post[] = array('extencion1' => 0,'extencion2' => 0, 'llamadas' => 0, 'nombre_ext1' =>0, 'nombre_ext2' =>0);
                }
            }
            $i=0;
            $sqlCostos = "SELECT SUM( CEIL( billsec /60 ) ) AS minutos, COUNT(src) AS llamadas FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59' AND LENGTH( src ) = ( $row->numExt ) AND LENGTH( dst ) = ( $row->numExt )  AND  disposition = 'ANSWERED' AND  billsec > 0  /*AND  userfield ='INTERNAL'*/  ";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $minutos = $res->minutos;
                $llamadas  = $res->llamadas;

                $post[] = array('prom_minutos' => $minutos/$llamadas, 'totalllamadas' => $llamadas, 'llamadasdia' =>$llamadas/30);
            }
            $nombre=array();
            $nombre_usr=array();
            $llamadas=array();
            for($j=0;$j<10;$j++){
                if(!empty($post[$j])){
                    $nombre[$j] = $post[$j]['extencion1']." - ".$post[$j]['nombre_ext1'];
                    $nombre_usr[$j] = $post[$j]['extencion2']." - ".$post[$j]['nombre_ext2'];
                    $llamadas[$j] = $post[$j]['llamadas'] + 0;
                }else{
                    $nombre[$j] = 0;
                    $nombre_usr[$j] = 0;
                    $llamadas[$j] = 0;
                }
            }
            $json = array();
            $json[]=array($nombre[0],$nombre[1],$nombre[2],$nombre[3],$nombre[4]);
            $json[]=array($nombre_usr[0],$nombre_usr[1],$nombre_usr[2],$nombre_usr[3],$nombre_usr[4]);
            $json[]=array($llamadas[1],$llamadas[0],$llamadas[2],$llamadas[3],$llamadas[4]);
            $json[]=array($nombre_usr[5],$nombre_usr[6],$nombre_usr[7],$nombre_usr[8],$nombre_usr[9]);
            $json[]=array($nombre[5],$nombre[6],$nombre[7],$nombre[8],$nombre[9]);
            $json[]=array($llamadas[6],$llamadas[5],$llamadas[7],$llamadas[8],$llamadas[9]);
            $json[]=array(number_format($post[10]['prom_minutos'],2),number_format($post[10]['totalllamadas'],0),number_format($post[10]['llamadasdia'],2));
            echo json_encode($json);

        }

    }
    public function LlamadasCalidad($request) {
        session_start();
        if($_SESSION['rol_us'] == 2) {
            $id_us = $_SESSION['id_us'];
            $sql = "user_admin = '$id_us'";
        }else{
            $id_us = $request->cliente;
            $sql = "cod_cl = '$id_us'";
        }
        $query = "SELECT * FROM `clientes`,precios_minutos WHERE $sql AND precios_minutos.cliente=clientes.cod_cl";
        $result = $this->Ejecutar($query);
        $post = array();

        while ($row = mysqli_fetch_object($result)) {
            //$fechahoy = date('Y-m-d');
            //$fechahoy = "2016-08-31";
            $year = $request->year;
            $mont = $request->mont;

            $fechaI = $year."-".$mont."-01";
            $fechaF = $year."-".$mont."-31";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $tabla= $row->tabla_cdr;
                $sl = "";
            }else{
                $tabla = 'cdr';
                $sl = "";
            }
            $post=array();

            $sqlCostos = "SELECT COUNT( dst ) AS llamadas, dst,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH(dst ) = ( $row->numExt ) AND (LENGTH( src ) > ( $row->numExt ) OR LENGTH( src ) = ( 0 )) AND  disposition = 'ANSWERED' AND  billsec > 0 $sl /*AND userfield = 'Inbound'*/ GROUP BY dst ORDER BY llamadas DESC LIMIT 0 , 5";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            $i=0;
            while ($res = mysqli_fetch_object($queryRes)) {
                $extencion = $res->dst;
                $llamadas  = $res->llamadas;
                $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion' ";
                $queryExten = $this->Ejecutar($sqlExten);
                $name_dp = 'NULL';
                $name = $res->clid;
                $name = str_replace('"','',$name);
                $subname = '<';
                // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                $posicionsubname = strpos ($name, $subname);
                // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                $name_ext = substr ($name, 0,($posicionsubname));
                $name_ext = substr ($name_ext, 0,18);

                while ($obj = mysqli_fetch_object($queryExten)) {
                    $name_dp = $obj->nombre_dp;
                    $name_ext = $obj->nombre_ext;
                }

                $post[] = array('extencion' => $extencion, 'llamadas' => $llamadas, 'nombre_ext' =>$name_ext);
                $i+=1;
            }
            $r=5-$i;
            if($r>0){
                for($p=1;$p<=$r;$p++){
                    $post[] = array('extencion' =>0, 'llamadas' => 0, 'nombre_ext' =>0);
                }
            }
            $i=0;
            $sqlCostos = "SELECT COUNT( dst ) AS llamadas, dst,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59' AND LENGTH( dst ) = ( $row->numExt ) AND (LENGTH( src ) > ( $row->numExt ) OR LENGTH( src ) = ( 0 )) AND  disposition = 'ANSWERED' AND  billsec > 0 /*AND userfield = 'Inbound'*/ GROUP BY dst ORDER BY llamadas ASC LIMIT 0 , 5";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $extencion = $res->dst;
                $llamadas  = $res->llamadas;
                $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion' ";
                $queryExten = $this->Ejecutar($sqlExten);
                $name_dp = 'NULL';
                $name = $res->clid;
                $name = str_replace('"','',$name);
                $subname = '<';
                // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                $posicionsubname = strpos ($name, $subname);
                // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                $name_ext = substr ($name, 0,($posicionsubname));
                $name_ext = substr ($name_ext, 0,18);

                while ($obj = mysqli_fetch_object($queryExten)) {
                    $name_dp = $obj->nombre_dp;
                    $name_ext = $obj->nombre_ext;
                }

                $post[] = array('extencion' => $extencion, 'llamadas' => $llamadas, 'nombre_ext' =>$name_ext);
                $i+=1;
            }
            $r=5-$i;
            if($r>0){
                for($p=1;$p<=$r;$p++){
                    $post[] = array('extencion' =>0, 'llamadas' => 0, 'nombre_ext' =>0);
                }
            }
            $i=0;
            $sqlCostos = "SELECT COUNT( dst ) AS llamadas FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59' AND LENGTH( dst ) = ( $row->numExt ) AND (LENGTH( src ) > ( $row->numExt) OR LENGTH( src ) = ( 0 ))  AND billsec =0 AND disposition = 'NO ANSWER' /*AND userfield = 'Inbound'*/  ";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $llamadas  = $res->llamadas;

                $post[] = array('perdidas' => $llamadas);
            }
            $sqlCostos = "SELECT COUNT( dst ) AS llamadas FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59' AND LENGTH( dst ) = ( $row->numExt )  AND  (LENGTH( src ) > ($row->numExt ) OR LENGTH( src ) = ( 0 )) AND disposition = 'ANSWERED' AND  billsec > 0  /*AND userfield = 'Inbound' */";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $llamadas  = $res->llamadas;

                $post[] = array('atendidas' => $llamadas);
            }
            $nombre=array();
            $llamadas=array();
            $extencion=array();
            for($j=0;$j<10;$j++){
                if(!empty($post[$j])){
                    $nombre[$j]     =  $post[$j]['nombre_ext'];
                    $extencion[$j]  = 'Ext.'.$post[$j]['extencion'];
                    $llamadas[$j] = $post[$j]['llamadas'] + 0;
                }else{
                    $nombre[$j] = 0;
                    $llamadas[$j] = 0;
                }
            }
            $json = array();
            $json[]=array($nombre[0],$nombre[1],$nombre[2],$nombre[3],$nombre[4]);
            $json[]=array($extencion[0],$extencion[1],$extencion[2],$extencion[3],$extencion[4]);
            $json[]=array($llamadas[0],$llamadas[1],$llamadas[2],$llamadas[3],$llamadas[4]);
            $json[]=array($nombre[5],$nombre[6],$nombre[7],$nombre[8],$nombre[9]);
            $json[]=array($extencion[5],$extencion[6],$extencion[7],$extencion[8],$extencion[9]);
            $json[]=array($llamadas[5],$llamadas[6],$llamadas[7],$llamadas[8],$llamadas[9]);
            $json[]=array(number_format($post[10]['perdidas'],0) ,number_format($post[11]['atendidas'],0) );
            echo json_encode($json);
        }



    }
    public function MaxMinLlamada($request)
    {
        session_start();
        if ($_SESSION['rol_us'] == 2) {
            $id_us = $_SESSION['id_us'];
            $sql = "user_admin = '$id_us'";
        } else {
            $id_us = $request->cliente;
            $sql = "cod_cl = '$id_us'";
        }
        $query = "SELECT * FROM `clientes`,precios_minutos WHERE $sql AND precios_minutos.cliente=clientes.cod_cl";
        $result = $this->Ejecutar($query);
        $post = array();

        while ($row = mysqli_fetch_object($result)) {
            //$fechahoy = date('Y-m-d');
            //$fechahoy = "2016-08-31";
            $year = $request->year;
            $mont = $request->mont;

            $fechaI = $year . "-" . $mont . "-01";
            $fechaF = $year . "-" . $mont . "-31";
            if ($row->tipo_conexion == 2 || $row->tipo_conexion == 5) {
                $tabla = $row->tabla_cdr;
            } else {
                $tabla = 'cdr';
            }
            $post = array();

            $sqlCostos = "SELECT CEIL( billsec /60 ) as min, src,dst,clid FROM " . $tabla . " WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH(src ) = ( $row->numExt ) AND (LENGTH( dst ) >= ( 5 ) ) AND  disposition = 'ANSWERED' AND  billsec > 0 /*AND userfield = 'Inbound'*/  ORDER BY billsec DESC LIMIT 0 , 5";
            if ($row->tipo_conexion == 2 || $row->tipo_conexion == 5) {
                $queryRes = $this->Ejecutar($sqlCostos);
            } else {
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            $i = 0;
            $extencionS =0;
            $numberS    =0;
            $minS       =0;
            if($queryRes!=false) {
                while ($res = mysqli_fetch_object($queryRes)) {
                    $extencionS = $res->src;
                    $numberS = $res->dst;
                    $minS = $res->min;
                    $post[] = array('extencionS' => $extencionS, 'minS' => $minS, 'numberS' =>$numberS,'identificacion'=>'saliente');
                    $i+=1;
                }
            }
            $sqlCostos = "SELECT  CEIL( billsec /60 ) as min, src,dst,clid FROM " . $tabla . " WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH(dst ) >= ( $row->numExt ) AND (LENGTH( src ) > ( $row->numExt ) OR LENGTH( src ) = ( 0 ) ) AND  disposition = 'ANSWERED' AND  billsec > 0 /*AND userfield = 'Inbound'*/  ORDER BY billsec DESC LIMIT 0 , 5";
            if ($row->tipo_conexion == 2 || $row->tipo_conexion == 5) {
                $queryRes = $this->Ejecutar($sqlCostos);
            } else {
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }

            $i=0;
            $extencionE =0;
            $numberE    =0;
            $minE       =0;
            if($queryRes!=false) {
                while ($res = mysqli_fetch_object($queryRes)) {
                    $extencionE = $res->dst;
                    $numberE = $res->src;
                    $minE = $res->min;
                    $post[] = array('extencionE' => $extencionE, 'minE' => $minE, 'numberE' =>$numberE,'identificacion'=>'entrante');
                    $i+=1;
                }
            }

            echo json_encode($post);
        }
    }


    public function AprovechLlSalientesEspecifica($request) {
        session_start();
        if($_SESSION['rol_us'] == 2) {
            $id_us = $_SESSION['id_us'];
            $sql = "user_admin = '$id_us'";
        }else{
            $id_us = $request->cliente;
            $sql = "cod_cl = '$id_us'";
        }
        $extOrigin= $request->extencion;
        $query = "SELECT * FROM `clientes`,precios_minutos WHERE $sql AND precios_minutos.cliente=clientes.cod_cl";
        $result = $this->Ejecutar($query);
        $post = array();

        while ($row = mysqli_fetch_object($result)) {
            //$fechahoy = date('Y-m-d');
            //$fechahoy = "2016-08-31";
            $year = $request->year;
            $mont = $request->mont;

            $fechaI = $year."-".$mont."-01";
            $fechaF = $year."-".$mont."-31";

            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $tabla= $row->tabla_cdr;
            }else{
                $tabla = 'cdr';
            }
            $post=array();
            $sqlCostos = "SELECT COUNT(dst ) AS llamadas, dst ,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH( dst ) >= ( 5 ) AND src = '$extOrigin'  AND   disposition = 'ANSWERED' /*AND userfield = 'Outbound'*/ AND  billsec > 0  GROUP BY dst ORDER BY llamadas DESC LIMIT 0 , 5";


            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            $i=0;
            while ($res = mysqli_fetch_object($queryRes)) {
                $extencion = $res->dst;
                $llamadas  = $res->llamadas;
                $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion' ";
                $queryExten = $this->Ejecutar($sqlExten);
                $name_dp = 'NULL';
                $name = $res->clid;
                $name = str_replace('"','',$name);
                $subname = '<';
                // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                $posicionsubname = strpos ($name, $subname);
                // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                $name_ext = substr ($name, 0,($posicionsubname));
                $name_ext = substr ($name_ext, 0,18);

                while ($obj = mysqli_fetch_object($queryExten)) {
                    $name_dp = $obj->nombre_dp;
                    $name_ext = $obj->nombre_ext;
                }

                $post[] = array('extencion' => $extencion, 'llamadas' => $llamadas, 'nombre_ext' =>$name_ext);
                $i+=1;
            }
            $r=5-$i;
            if($r>0){
                for($p=1;$p<=$r;$p++){
                    $post[] = array('extencion' =>0, 'llamadas' => 0, 'nombre_ext' =>0);
                }
            }
            $i=0;
            $sqlCostos = "SELECT COUNT( dst) AS llamadas, dst,clid FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND LENGTH( dst ) >= ( 5 ) AND src = '$extOrigin' AND  disposition = 'ANSWERED' /*AND userfield = 'Outbound'*/ AND  billsec > 0  GROUP BY dst ORDER BY llamadas ASC LIMIT 0 , 5";

            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $extencion = $res->dst;
                $llamadas  = $res->llamadas;
                $sqlExten = "SELECT nombre_dp, nombre_ext FROM bd_departamentos,bd_extenciones WHERE cliente = '$id_us' AND bd_departamentos.cod_dp=bd_extenciones.cod_dp AND numero_ext ='$extencion' ";
                $queryExten = $this->Ejecutar($sqlExten);
                $name_dp = 'NULL';
                $name = $res->clid;
                $name = str_replace('"','',$name);
                $subname = '<';
                // localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
                $posicionsubname = strpos ($name, $subname);
                // eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
                $name_ext = substr ($name, 0,($posicionsubname));
                $name_ext = substr ($name_ext, 0,18);
                while ($obj = mysqli_fetch_object($queryExten)) {
                    $name_dp = $obj->nombre_dp;
                    $name_ext = $obj->nombre_ext;
                }

                $post[] = array('extencion' => $extencion, 'llamadas' => $llamadas, 'nombre_ext' =>$name_ext);
                $i+=1;
            }
            $r=5-$i;
            if($r>0){
                for($p=1;$p<=$r;$p++){
                    $post[] = array('extencion' =>0, 'llamadas' => 0, 'nombre_ext' =>0);
                }
            }
            $i=0;

            $sqlCostos = "SELECT SUM( CEIL( billsec /60 ) ) AS minutos, COUNT( dst) AS llamadas FROM ".$tabla." WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59' AND LENGTH( dst ) >= ( 5 )  AND src = '$extOrigin' AND  disposition = 'ANSWERED' AND  billsec > 0 /*AND userfield = 'Outbound'*/  ";
            if($row->tipo_conexion == 2 || $row->tipo_conexion == 5){
                $queryRes = $this->Ejecutar( $sqlCostos);
            }else{
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            while ($res = mysqli_fetch_object($queryRes)) {
                $minutos = $res->minutos;
                $llamadas  = $res->llamadas;

                $post[] = array('prom_minutos' => $minutos/$llamadas, 'totalllamadas' => $llamadas, 'llamadasdia' =>$llamadas/30);
            }
            $nombre=array();
            $llamadas=array();
            for($j=0;$j<10;$j++){
                if(!empty($post[$j])){
                    $nombre[$j] = $post[$j]['nombre_ext']." - ".$post[$j]['extencion'];
                    $llamadas[$j] = $post[$j]['llamadas'] + 0;
                }else{
                    $nombre[$j] = 0;
                    $llamadas[$j] = 0;
                }
            }
            $json = array();
            $json[]=array($nombre[0],$nombre[1],$nombre[2],$nombre[3],$nombre[4]);
            $json[]=array($llamadas[0],$llamadas[1],$llamadas[2],$llamadas[3],$llamadas[4]);
            $json[]=array($nombre[5],$nombre[6],$nombre[7],$nombre[8],$nombre[9]);
            $json[]=array($llamadas[5],$llamadas[6],$llamadas[7],$llamadas[8],$llamadas[9]);
            $json[]=array(number_format($post[10]['prom_minutos'],2),number_format($post[10]['totalllamadas'],0),number_format($post[10]['llamadasdia'],2));
            echo json_encode($json);

        }

    }
    public function MaxMinLlamadaEspecifica($request)
    {
        session_start();
        if ($_SESSION['rol_us'] == 2) {
            $id_us = $_SESSION['id_us'];
            $sql = "user_admin = '$id_us'";
        } else {
            $id_us = $request->cliente;
            $sql = "cod_cl = '$id_us'";
        }
        $extOrigin= $request->extencion;
        $query = "SELECT * FROM `clientes`,precios_minutos WHERE $sql AND precios_minutos.cliente=clientes.cod_cl";
        $result = $this->Ejecutar($query);
        $post = array();

        while ($row = mysqli_fetch_object($result)) {
            //$fechahoy = date('Y-m-d');
            //$fechahoy = "2016-08-31";
            $year = $request->year;
            $mont = $request->mont;

            $fechaI = $year . "-" . $mont . "-01";
            $fechaF = $year . "-" . $mont . "-31";
            if ($row->tipo_conexion == 2 || $row->tipo_conexion == 5) {
                $tabla = $row->tabla_cdr;
            } else {
                $tabla = 'cdr';
            }
            $post = array();

            $sqlCostos = "SELECT CEIL( billsec /60 ) as min, src,dst,clid FROM " . $tabla . " WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND src  = '$extOrigin' AND (LENGTH( dst ) >= ( 5 ) ) AND  disposition = 'ANSWERED' AND  billsec > 0 /*AND userfield = 'Inbound'*/  ORDER BY billsec DESC LIMIT 0 , 5";
            if ($row->tipo_conexion == 2 || $row->tipo_conexion == 5) {
                $queryRes = $this->Ejecutar($sqlCostos);
            } else {
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }
            $i = 0;
            $extencionS =0;
            $numberS    =0;
            $minS       =0;
            if($queryRes!=false) {
                while ($res = mysqli_fetch_object($queryRes)) {
                    $extencionS = $res->src;
                    $numberS = $res->dst;
                    $minS = $res->min;
                    $post[] = array('extencionS' => $extencionS, 'minS' => $minS, 'numberS' =>$numberS,'identificacion'=>'saliente');
                    $i+=1;
                }
            }
            $sqlCostos = "SELECT  CEIL( billsec /60 ) as min, src,dst,clid FROM " . $tabla . " WHERE calldate >= '$fechaI 00:00:00' AND  calldate <= '$fechaF 23:59:59'  AND dst =  '$extOrigin' AND (LENGTH( src ) > ( $row->numExt ) OR LENGTH( src ) = ( 0 ) ) AND  disposition = 'ANSWERED' AND  billsec > 0 /*AND userfield = 'Inbound'*/  ORDER BY billsec DESC LIMIT 0 , 5";
            if ($row->tipo_conexion == 2 || $row->tipo_conexion == 5) {
                $queryRes = $this->Ejecutar($sqlCostos);
            } else {
                $queryRes = $this->EjecutarDreamPbx($row->host_bd, $row->usuario_bd, $this->Desencriptar($row->contrasena_bd), $row->base_bd, $sqlCostos);
            }

            $i=0;
            $extencionE =0;
            $numberE    =0;
            $minE       =0;
            if($queryRes!=false) {
                while ($res = mysqli_fetch_object($queryRes)) {
                    $extencionE = $res->dst;
                    $numberE = $res->src;
                    $minE = $res->min;
                    $post[] = array('extencionE' => $extencionE, 'minE' => $minE, 'numberE' =>$numberE,'identificacion'=>'entrante');
                    $i+=1;
                }
            }

            echo json_encode($post);
        }
    }
}


