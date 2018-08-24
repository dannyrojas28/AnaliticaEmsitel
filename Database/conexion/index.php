    <?php


require_once 'Config/vars.php';
class Conexion extends Variables{

    
   	function __Construct()
    {
    	# code...
     //   session_start();
        date_default_timezone_set('America/Bogota');
    	$var   = new Variables();
    }

    public function Conectar(){
        $connect = mysqli_connect($this->host,$this->user,$this->pass,$this->db) 
            or die ("Error ". mysqli_error($connect));
        return $connect;   
    }

    
    public function Ejecutar($sql){
        $connect = $this->Conectar();
        $result = $connect->query($sql);
        if (!$result) {
                $bug = $connect->error;
                
                $bug = str_replace("'", '`', $bug);
                $sql = str_replace("'", '`', $sql);
                //echo $bug;
                $connect->query("INSERT INTO `logs`( `bug`, `state`,`sql`) VALUES ('$bug','0','$sql') ") or die ("Error". mysqli_error($connect));
                return  false;
        }else{
                return $result;
        }
    }

    public function ConectarDreamPbx($host,$user,$pass,$bd){
        $connect = mysqli_connect($host,$user,$pass,$bd)
        or die ("Error ". mysqli_error($connect));
        return $connect;
    }


    public function EjecutarDreamPbx($host,$user,$pass,$bd,$sql){
        $connect = $this->ConectarDreamPbx($host,$user,$pass,$bd);
        $result = $connect->query($sql);
        if (!$result) {
            $bug = $connect->error;

            $bug = str_replace("'", '`', $bug);
            $sql = str_replace("'", '`', $sql);
            //echo $bug;
            $connect = $this->Conectar();
            $connect->query("INSERT INTO `logs`( `bug`, `state`,`sql`) VALUES ('DREAMPBX $bug','0','$sql') ") or die ("Error". mysqli_error($connect));
            return  false;
        }else{
            return $result;
        }
    }
    public function ConectarLlamadas(){
        $connect = mysqli_connect($this->hostLL,$this->userLL,$this->passLL,$this->dbLL) 
            or die ("Error ". mysqli_error($connect));
        return $connect;   
    }

    
    public function EjecutarLlamadas($sql){
        $connect = $this->ConectarLlamadas();
        $result = $connect->query($sql);
        if (!$result) {
                $bug = $connect->error;
                
                $bug = str_replace("'", '`', $bug);
                $sql = str_replace("'", '`', $sql);
                //echo $bug;
                $connect->query("INSERT INTO `logs`( `bug`, `state`,`sql`) VALUES ('$bug','0','$sql') ") or die ("Error". mysqli_error($connect));
                return  false;
            }else{
                return $result;
            }
    }

    public function ValidateSession(){
        # code...
        if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
       $time = 100000000000; // una hora en mili-segundos 

// verificamos si existe la sesión 
// el nombre "session_name" es como ejemplo 

      // verificamos si existe la sesión que se encarga del tiempo 
      // si existe, y el tiempo es mayor que una hora, expiramos la sesión  
      if(isset($_SESSION["time_us"]) && time() > $_SESSION["time_us"] + $time) { 
      		unset($_SESSION["time_us"]);
      } 
        if(empty($_SESSION["time_us"])){
        	
           return TRUE;
        }else{
           return FALSE;
        }
    }

    public function CreateSession($result){
       if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
        if(mysqli_num_rows($result)> 0){
            $i=0;
            while ($res = mysqli_fetch_object($result)) {
                # code...
                
               // if($i == 0){
                    $_SESSION['token_us']          = time();
                    $_SESSION['time_us']           = time();
                    $_SESSION['name_us']           = utf8_encode($res->name_us);
                    $_SESSION['id_us']             = $res->id_us;
                    $_SESSION['rol_us']            = $res->rol_us;
                    $_SESSION['tipo_rol']          = $res->tipo_rol;
                    $_SESSION['imagen_us']         = $res->logo_us;
              /*  }
                    $_SESSION['rol'][$i]            = $res->rol;
                    $_SESSION['tipo_rol'][$i]       = $res->nombre_rol;

                    $i = $i +1;*/
            }
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function DeleteSession(){
        # code...
      if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
        session_destroy();
                    $_SESSION['token_us']          = "";
                    $_SESSION['time_us']           = "";
                    $_SESSION['name_us']           = "";
                    $_SESSION['id_us']             = "";
                    $_SESSION['rol_us']            = "";
                    $_SESSION['tipo_rol']          = "";
                    $_SESSION['imagen_us']         = "";
    }

    public function UpdateSession($result){
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        if(mysqli_num_rows($result)> 0){
            $i=0;
               // $_SESSION['rol']            = "";
               // $_SESSION['tipo_rol']       = "";
            while ($res = mysqli_fetch_object($result)) {
                # code...
              //  if($i == 0){

                    $_SESSION['time_us']           = time();
                    $_SESSION['name_us']           = utf8_encode($res->name_us);
                    $_SESSION['id_us']             = $res->id_us;
                    $_SESSION['rol_us']            = $res->rol_us;
                    $_SESSION['tipo_rol']          = $res->tipo_rol;
                    $_SESSION['imagen_us']         = $res->logo_us;
               /* }
                    $_SESSION['rol'][$i]            = $res->rol;
                    $_SESSION['tipo_rol'][$i]       = $res->nombre_rol;

                    $i = $i +1;*/
            }
            return TRUE;
        }else{
            return FALSE;
        }
    }
}

?>