<?php

    require_once '../vista/perfilvista.php';
    require_once '../modelo/Conexion.php';
    

    class ControlPerfil{
        
        public $vista;
        public $model;
        
        
        
        public function __construct() {
            
            $this->vista = new PerfilVista();
            $this->model = new Conexion();
            
        }
        
        
        public function datos(){

            $query =    "SELECT cl.id,
                        cl.descripcion_1 as descripcion_1, 
                        cl.fecha_publicacion as fecha, 
                        cl.titulo as titulo, 
                        ft.ruta as imagen                        
                        FROM clasificados.clasificado cl, clasificados.foto ft
                        WHERE cl.id = ft.id_clasificados and cl.id_usuario = 2
                        group by cl.id;";
            
            
            $datos = $this->model->get_resultados_query($query);
            
            //print_r($datos);
            
            
            return $datos;
        }
        
        

        public function main(){
            
            $this->vista->refactory_encabezado($_SESSION['nombre']);
            $this->vista->refactory_advs($this->datos());
            $this->vista->refactory_contenido();
            $this->vista->refactory_total();
            
            
            
        }
        
        
    }
    
    
    session_start();
    
    if($_SESSION['nombre']){
        
        $index = new ControlPerfil();
        $index->main();        
    }else{
        //header("Location: /Clasificados/control/index.php");
    }
    
?>