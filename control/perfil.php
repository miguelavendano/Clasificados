<?php
session_start();
    require_once '../vista/perfilvista.php';
    require_once '../modelo/perfilModelo.php';
    
    
    

    class ControlPerfil{
        
        public $vista;
        public $model;
        
        
        
        public function __construct() {
            
            $this->vista = new PerfilVista();
            $this->model = new perfilModelo();
            
        }
        
        
        
   
        
        

        public function main(){
            
            $idUsuario="2";// por el momento por defecto es 2
            
            
            
            $this->vista->refactory_encabezado($_SESSION['nombre']);
            $this->vista->refactory_advs($this->model->datosPrimariosClasificados($idUsuario));
            $this->vista->refactory_contenido();
            $this->vista->refactory_total();
            
            
            
        }
        
        
    }
    
    
    
    if($_SESSION['nombre']){
        
        $index = new ControlPerfil();
        $index->main();        
    }else{
        //header("Location: /Clasificados/control/index.php");     $index->main(); 
        
        $index = new ControlPerfil();
        $index->main();  
    }
    
    
    
?>