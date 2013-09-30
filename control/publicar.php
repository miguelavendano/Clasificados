<?php

    require_once '../vista/publicarvista.php';   
    require_once '../modelo/publicar.php';
    require_once '../core/global_var.php';
    


    class ControlPublicar{
        
        public $vista;
        public $model;
    
        public function __construct() {                   
            
            $this->vista = new PublicarVista();
            $this->model = new PublicarModel();
            
        }
        
        public function agradecer(){
            
            $this->vista->refactory_agradecer();
            
        }
        
        public function error(){
            $this->vista->refactory_error();
        }
                
        public function verfomulario($nombre_usuario){
            
            $this->vista->refactory_formulario($nombre_usuario);
            


        }
        
        public function mostrarlogin(){
            
            $this->vista->refactory_login();
            
        }
        
        
        public function subir_imagenes($id_adv){
            

            $archivo = $_FILES["archivo"]["name"];
            $destino =  "../estaticos/img/".$archivo;

            if(!copy($_FILES["archivo"]["tmp_name"],$destino)){
                echo "<h1>Error al copiar el archivo </h1>";
            }else{

                $confirmar = $this->model->insertar_img($id_adv, $archivo);
            }

        }   
         
        
        
        public function insertar_adv(){
            
            
            $descrip_1 = $_POST["descrip_1"];
            $descrip_det = $_POST["descrip_det"]; 
            $lugar = $_POST["lugar"];
            $valor = $_POST["valor"];
            $id = $_SESSION["id"]; 
            $titulo = $_POST["titulo"];                       
            
            
            
            $confirmar = $this->model->insertar_adv($descrip_1, $descrip_det, $lugar, $valor, $id, $titulo);
            
            if($confirmar){
                $id_adv_user = $this->model->consultarId($id);
                $this->subir_imagenes($id_adv_user);
            }else{
                
                return false;
            }
            
            return true;
            
            
        }
        
        
    }
    
    
    
    session_start();
    
    $obj = new ControlPublicar();
    
    if(isset($_POST["enviar"])){   
        
        if($obj->insertar_adv()){
            $obj->agradecer();
        }else{
            $obj->error();
        }      

    }else{
        
        if(isset($_SESSION['nombre'])){            
            $obj->verfomulario($_SESSION['nombre']);            
     
        }else{
            // mostrar modal de registro.
            //echo "<h1>No esta logeaddo</h1>";
            
            $obj->mostrarlogin();
            
        }
    }
    


?>