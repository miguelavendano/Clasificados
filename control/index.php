<?php

    require_once '../vista/indexvista.php';
    require_once '../modelo/Conexion.php';
    require_once '../modelo/index.php';
    

    class ControlIndex{
        
        public $vista;
        public $model;
        
        
        
        public function ControlIndex(){
            
            $this->vista = new IndexVista();
            $this->model = new Conexion();
            $this->model2 = new IndexModel();
            
        }
        
        
        public function datos(){

            $query =    "SELECT cl.id,
                        cl.descripcion_1 as descripcion_1, 
                        cl.fecha_publicacion as fecha, 
                        cl.titulo as titulo, 
                        ft.ruta as imagen,
                        cl.id_seccion
                        FROM clasificados.clasificado cl, clasificados.foto ft
                        WHERE cl.id = ft.id_clasificados
                        group by id_seccion;";
            
            
            $datos = $this->model->get_resultados_query($query);
            
            //print_r($datos);
            
            
            return $datos;
        }
        
        
        public function conten_secciones(){
            
            $contenido = "";            
            
            $cant_sec = $this->model2->contar_secciones();            
            
            //print_r($cant_sec);
            
            foreach($cant_sec as $clave){                                        
                                
                $datos = $this->model2->traer_advs_seccion($clave['id']);  // trae los advs de una seccion                
                $advs = $this->vista->refactory_advs_seccion($datos);  // refactoriza los adv de una seccion y retorna el html de los resultados                
                $seccion = $this->vista->refactory_seccion($clave['id'], $clave['descripcion'], $advs); // retorna el html de la seccio
                $contenido .=$seccion; //concatena todas las secciones                
            }
            
            return $contenido;
            
            

            
            
        }
        
        

        public function main($nombre_usuario){
            
            $this->vista->refactory_encabezado($nombre_usuario);
            $this->vista->set_contenido($this->conten_secciones());            
            $this->vista->refactory_total();            
            
        }
        
        
    }
    
    session_start();
    
    
    $index = new ControlIndex();
    
    if(isset($_SESSION['nombre'])){        
        
        $index->main($_SESSION['nombre']);    
    }else{
        $index->main(false);    
    }

?>