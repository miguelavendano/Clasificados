<?php

    require_once 'Conexion.php';

     class IndexModel{
         
         public $coneccion;
         
        public function __construct() {
            
            $this->coneccion= new Conexion();
            
        }
        
        
        
        public function traer_advs_seccion($id_seccion){
            
            $query = " SELECT cl.id,
                        cl.descripcion_1 as descripcion_1, 
                        cl.fecha_publicacion as fecha, 
                        cl.titulo as titulo, 
                        ft.ruta as imagen,
                        cl.id_seccion as seccion
                        FROM clasificados.clasificado cl, clasificados.foto ft
                        WHERE cl.id = ft.id_clasificados and cl.id_seccion = ".$id_seccion."
                        group by cl.id;";
            
            
            $resultado = $this->coneccion->get_resultados_query($query);
            
            
            return $resultado;
            
        }        
        
        
        public function contar_secciones(){
            
            
            $query = "SELECT sc.id, sc.descripcion
                    FROM clasificados.seccion sc;";
            
            $resultado = $this->coneccion->get_resultados_query($query);
            
            return $resultado;
            
        }
        
         
         
     }
?>
