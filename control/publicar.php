<?php

    require_once '../vista/publicarvista.php';
    require_once '../modelo/Conexion.php';
    require_once '../core/global_var.php';
    


    class ControlPublicar{
        
        public $vista;
        public $model;
    
        public function __construct() {          
            
            
            $this->vista = new PublicarVista();
            $this->model = new Conexion();
            
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
        
        
        public function subir_imagenes($id_user){
            

            $archivo = $_FILES["archivo"]["name"];
            $destino =  "../estaticos/img/".$archivo;

            if(!copy($_FILES["archivo"]["tmp_name"],$destino)){
                echo "<h1>Error al copiar el archivo </h1>";
            }else{

                $insert_img = "INSERT INTO foto (id_clasificados, ruta) 
                VALUES (".$id_user.", '".$archivo."');";                
                $confirmar = $this->model->ejecutar_query($insert_img);
            }

        }








        public function insertar_adv(){           


                $consulta_id= "SELECT max(cl.id) id_clasificado
                                FROM clasificados.clasificado as cl, clasificados.usuario as us
                                WHERE cl.id_usuario = ".$_SESSION["id"]."
                                ";
                
                
                $insert_adv= "
                    INSERT INTO clasificado (
                    descripcion_1, 
                    descripcion_detallada, 
                    lugar, 
                    valor,
                    fecha_publicacion,
                    id_usuario, 
                    id_seccion,
                    titulo) 
                    VALUES (
                    '".$_POST["descrip_1"]."', 
                    '".$_POST["descrip_det"]."', 
                    '".$_POST["lugar"]."',
                    ".$_POST["valor"].",
                    '".date('d/m/ 20y')."', 
                    ".$_SESSION["id"].", 
                    2, 
                    '".$_POST["titulo"]."');";                               
                
                
                $confirmar = $this->model->ejecutar_query($insert_adv);
                $id_adv_user = $this->model->get_resultados_query($consulta_id); // consulta el id del ultimo adv qeu se acaba de insertar                
                
                
                
                $this->subir_imagenes($id_adv_user[0]['id_clasificado']);

                

            
            
            return $confirmar;
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
            $obj->verfomulario(isset($_SESSION['nombre']));            
     
        }else{
            // mostrar modal de registro.
            //echo "<h1>No esta logeaddo</h1>";
            
            $obj->mostrarlogin();
            
        }
    }
    


?>