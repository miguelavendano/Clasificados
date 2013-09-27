<?php

    require_once '../vista/indexvista.php';
    require_once '../modelo/index.php';
    

    class ControlIndex{
        
        public $vista;
        public $model;
        
        
        
        public function ControlIndex(){ // inicializa instancias de vista y modelo.
            
            $this->vista = new IndexVista();            
            $this->model = new IndexModel();
            
        }
        
        
       
        
        public function conten_secciones(){ // arma cada seccion con su contenido
            
            $contenido = "";            
            
            $cant_sec = $this->model->contar_secciones();            
            
            //print_r($cant_sec);
            
            foreach($cant_sec as $clave){                                        
                                
                $datos = $this->model->traer_advs_seccion($clave['id']);  // trae los advs de una seccion                
                $advs = $this->vista->refactory_advs_seccion($datos);  // refactoriza los adv de una seccion y retorna el html de los resultados                
                $seccion = $this->vista->refactory_seccion($clave['id'], $clave['descripcion'], $advs); // retorna el html de la seccio
                $contenido .=$seccion; //concatena todas las secciones                
            }
            
            return $contenido;
            
        }
        
        

        public function main($nombre_usuario){
            
            $this->vista->refactory_encabezado($nombre_usuario); // refactoriz el encabezado con el nombre del usuario
            $this->vista->set_contenido($this->conten_secciones()); // genera el contenido de adv por ccada secsion
            $html = $this->vista->refactory_total(); // refactori toda la pagina.
            echo $html;
            
        }
        
        
    }
    
    
    session_start(); 
    
    
    $index = new ControlIndex();
    
    if(isset($_SESSION['nombre'])){        // pregunta si la variable de session esta acitva
        
        $index->main($_SESSION['nombre']);    // ejecuta al controlador->  y nuestra datos de usuario logiado
    }else{
        $index->main(false);    // muestra la interfaz sin estar logiado.
    }

?>