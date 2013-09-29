<?php
   
    require_once "Conexion.php";
    
    class PublicarModel{
        
        public $conexion;


        public function __construct() {

            $this->conexion = new Conexion();
         }
         
         
         
        public function insertar_adv(){           


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
                
                
                $this->subir_imagenes($id_adv_user[0]['id_clasificado']);

                return $confirmar;
        }
        
        
        public function consultarId($id){
            
                $consulta_id= "SELECT max(cl.id) id_clasificado
                                FROM clasificados.clasificado as cl, clasificados.usuario as us
                                WHERE cl.id_usuario = ".$id."
                                ";                    

                $id_adv_user = $this->model->get_resultados_query($consulta_id); // consulta el id del ultimo adv qeu se acaba de insertar                
                
                return $id_adv_user[0]['id_clasificado'];
                
            
        }
    }


?>
