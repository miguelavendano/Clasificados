<?php

    require_once 'Conexion.php';
    

    class ResultadoModel{
        
        public $conexion;
        
        
        public function __construct() {
            
            $this->conexion = new Conexion();
        }
        
        
        public function datos(){

            $query =    "SELECT cl.id,
                        cl.descripcion_1 as descripcion_1, 
                        cl.fecha_publicacion as fecha, 
                        cl.titulo as titulo, 
                        ft.ruta as imagen                        
                        FROM clasificado cl, foto ft
                        WHERE cl.id = ft.id_clasificados and cl.id_usuario = 1
                        group by cl.id;";
            
            
            $datos = $this->conexion->get_resultados_query($query);
            
            
            
            return $datos;
        }        
        
        
    }

?>
