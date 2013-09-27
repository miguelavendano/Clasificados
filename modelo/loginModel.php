<?php
    
    require_once "Conexion.php";

   class LoginModel{
       
        public $conexion;
        
        
        public function __construct() {
            
            $this->conexion = new Conexion();
            
        }
        
        
        public function validaruser($email, $pass){
            
            
            $query = "select id, nombre, correo, id_facebook
                        from usuario
                        where correo='".$email."'";
            
            $usuario = $this->conexion->get_resultados_query($query);
            
            print_r($usuario);
            echo "<h1>".$usuario[0]['id']."</h1>";
            
            return $usuario;
            

            
        }
        
        
        
        
    }


?>
