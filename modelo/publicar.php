<?php
   
    require_once "Conexion.php";
    
    class PublicarModel{
        
        public $conexion;


        public function __construct() {

            $this->conexion = new Conexion();
         }
         
        public function insertar_img($id_adv, $archivo){
            
            $insert_img = "INSERT INTO foto (id_clasificados, ruta) 
            VALUES (".$id_adv.", '".$archivo."');";                
            
            
            $confirmar = $this->conexion->ejecutar_query($insert_img);
            
            return $confirmar;

        }   
        
         
        public function insertar_adv($descrip_1, $descrip_det, $lugar, $valor, $id, $titulo){           


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
                    '".$descrip_1."', 
                    '".$descrip_det."', 
                    '".$lugar."',
                    ".$valor.",
                    '".date('d/m/ 20y')."', 
                    ".$id.", 
                    2, 
                    '".$titulo."');";
                                                               
                
                $confirmar = $this->conexion->ejecutar_query($insert_adv);                                
                

                return $confirmar;
        }
        
        
        public function consultarId($id){
            
                $consulta_id= "SELECT max(cl.id) id_clasificado
                                FROM clasificados.clasificado as cl, clasificados.usuario as us
                                WHERE cl.id_usuario = ".$id."
                                ";                    

                $id_adv_user = $this->conexion->get_resultados_query($consulta_id); // consulta el id del ultimo adv qeu se acaba de insertar                
                
                return $id_adv_user[0]['id_clasificado'];
                
            
        }
    }


?>
