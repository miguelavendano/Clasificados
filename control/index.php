<?php

    require_once '../vista/indexvista.php';
    require_once '../modelo/Conexion.php';
    

    class ControlIndex{
        
        public $vista;
        public $model;
        
        
        
        public function ControlIndex(){
            
            $this->vista = new IndexVista();
            $this->model = new Conexion();
            
        }
        
        
        public function datos(){

            $query =    "SELECT cl.id,
                        cl.descripcion_1 as descripcion_1, 
                        cl.fecha_publicacion as fecha, 
                        cl.titulo as titulo, 
                        ft.ruta as imagen                        
                        FROM clasificados.clasificado cl, clasificados.foto ft
                        WHERE cl.id = ft.id_clasificados
                        group by cl.id;";
            
            
            $datos = $this->model->get_resultados_query($query);
            
            //print_r($datos);
            
            
            return $datos;
        }
        
        

        public function main($nombre_usuario){
            
            $this->vista->refactory_encabezado($nombre_usuario);
            $this->vista->refactory_contenido($this->datos());
            $this->vista->refactory_total();
            
            
        }
        
        
    }
    
    session_start();
    session_destroy();
    
    $index = new ControlIndex();
    
    if(isset($_SESSION['nombre'])){        
        
        $index->main($_SESSION['nombre']);    
    }else{
        $index->main(false);    
    }

?>