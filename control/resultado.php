<?php

    require_once '../vista/resultadoVista.php';
    require_once '../modelo/resultadoModel.php';    
    

    class ControlResultado{
        
        public $vista;
        public $model;
        
        
        
        public function __construct() {
            
            $this->vista = new ResultadoVista();
            $this->model = new ResultadoModel();
            
        }
        
        

        public function main(){
            
            $this->vista->refactory_encabezado("");
            $this->vista->refactory_advs($this->model->datos());
            $this->vista->refactory_contenido();
            $this->vista->refactory_total();
            
            
            
        }
        
        
    }
    
    
    session_start();
    
    
        
    $index = new ControlResultado();
    $index->main();        
    

    
?>