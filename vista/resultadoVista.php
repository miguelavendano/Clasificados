<?php

    require_once '../core/global_var.php';

    class ResultadoVista{
        
        private $base;
        private $encabezado;
        private $seccion;
        private $adv;
        private $dic_base;
        private $login;
        private $contenido;
        
        
        public function __construct() {
            
            $this->base = file_get_contents('../templates/base.html');
            $this->encabezado = file_get_contents('../templates/encabezadoperfil.html');
            $this->adv = file_get_contents('../templates/adv.html');
            $this->perfil = file_get_contents('../templates/perfil.html');

            
            $this->dic_base = array('encabezado'=>$this->encabezado,
                                    'contenido'=>$this->perfil);
            
            
        }

        public function actualizar_diccionarios(){            
            
            
            $this->dic_base = array('encabezado'=>$this->encabezado,
                                    'contenido'=>$this->perfil);      
            
            
        }
        
        public function refactory_encabezado($nombre_user){
            
            
            
            $this->encabezado = str_ireplace("{nombre_usuario}", $nombre_user, $this->encabezado );
            
            $this->actualizar_diccionarios();
            
        }
        

      
        
        
        public function refactory_advs($datos){            
            
            $resultados="";
            $adv = $this->adv;                                   

            foreach($datos as $calve => $valor){
                $sitio=array_shift($datos);
                $aux = $adv;

                $aux = str_ireplace("{fecha}", $sitio["fecha"], $aux);
                $aux = str_ireplace("{titulo_adv}", $sitio["titulo"], $aux);
                $aux = str_ireplace("{img}", $sitio["imagen"], $aux);                
                $aux = str_ireplace("{descripcion}", $sitio["descripcion_1"], $aux);
                $resultados .= $aux;
            }

            $this->adv = $resultados;
            $this->actualizar_diccionarios();
    
            
            
        }
        
        public function refactory_contenido(){
            
            $this->perfil = str_ireplace("{advs}", $this->adv, $this->perfil );
            
        }
        
        
        
        
        public function refactory_total(){
            
            $this->actualizar_diccionarios();
            $globales = new Global_var();
            
            $result_consulta = "";            
            
         
            $this->actualizar_diccionarios();
            
            foreach ($this->dic_base as $clave=>$valor){
                    
                $this->base = str_ireplace('{'.$clave.'}', $valor, $this->base);
                
            }
            
            foreach ($globales->global_var as $clave => $valor){
                $this->base = str_ireplace('{'.$clave.'}', $valor, $this->base);
            }            
            
            
            echo $this->base;
            
            
            
        }

    }
        
?>