<?php
    
    require_once '../modelo/loginModel.php';
    

    class Login{
        
        public $modelo;
        
        public function __construct() {
            
            $this->modelo = new LoginModel();
        }
        
        public function iniciarsesion($id, $nom_user, $id_f ){
            
            session_start();
            
            $_SESSION['id'] = $id;
            $_SESSION['nombre'] = $nom_user;
            $_SESSION['facebook'] = $id_f;                                    
        }
        
        public function cerrarsesion(){
            
            session_destroy();
            
            header("Location: /Clasificados/control/index.php");
        }
        
        public function validar($email, $pass){
            
            
            $existe = $this->modelo->validaruser($email, $pass); // si existe, retorna array con datos del  usuario sino retorna null
                    
            return $existe;

        }
        
        public function registrar_usuario($id, $nombre, $correo, $id_facebook){
            
            
        }

        public function VerificarDireccionCorreo($direccion)
        {
            $Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
            if(preg_match($Sintaxis,$direccion)){
                    echo "si es un correo";
                return true;
            }else{
                echo "no es un correo";
                return false;
            }
        }
            
        
    }
    
    

    session_start();
    
    
    if(isset($_GET['email'])){
        
        $login = new Login();                
        
        if($login->VerificarDireccionCorreo($_GET['email'])){  // verifica si tiene un formato de correo -> seguridad
            
            $respuesta =  $login->validar($_GET['email'], "123");
            if($respuesta){

                $login->iniciarsesion($respuesta[0]['id'], $respuesta[0]['nombre'], $respuesta[0]['id_facebook']);
                header("Location: /Clasificados/control/perfil.php?id=".$respuesta[0]['id']);
                

            }else{  // si no existe entonces -> registrarlo



            }            

        }else{
            echo "entro po aca ";
            //header("Location: /Clasificados/control/index.php");
        }
        
        

        
        
        
    }else {        
        echo "cerrar sesion";
        if(isset($_GET['cerrar'])){
            echo "cerrar sesion2";
            $login = new Login();                
            $login->cerrarsesion();
            echo "cerrar sesion";
        }        

    }
    


?>
