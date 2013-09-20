<?php

    require_once '../core/global_var.php';

    class IndexVista{
        
        private $base;
        private $encabezado;
        private $seccion;
        private $adv;
        private $dic_base;
        private $login;
        private $contenido;
        
        
        public function __construct() {
            
            $this->base = file_get_contents('../templates/base.html');
            $this->encabezado = file_get_contents('../templates/encabezado.html');
            $this->seccion = file_get_contents('../templates/seccion.html');
            $this->adv = file_get_contents('../templates/adv.html');
            $this->login = file_get_contents('../templates/nologin.html');

            
            $this->dic_base = array('encabezado'=>$this->encabezado,
                                    'contenido'=>$this->contenido,
                                    'login' =>$this->login);            
            
            
        }

        public function actualizar_diccionarios(){            
            
            
            $this->dic_base = array('encabezado'=>$this->encabezado,
                                    'contenido'=>$this->contenido,
                                    'login' =>$this->login);            
            
            
        }
        
        public function refactory_encabezado($nombre_usuario){
            
            if($nombre_usuario){
                $this->login = file_get_contents('../templates/login.html');
                
                $this->login  = str_ireplace("{nombre_usuario}", $nombre_usuario, $this->login  );
                $this->actualizar_diccionarios();
            }
            
            
        }
        

      
        
        
        public function refactory_advs_seccion($datos){            
            
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
            
            return $resultados;
            
            
        }
        
        public function refactory_seccion($id_seccion, $descripcin, $html_advs){
            
            
            $sec = $this->seccion;  // realizo una copia del html de la seccion
            
            $sec = str_ireplace("{n_seccion}",$id_seccion , $sec);
            $sec = str_ireplace("{titulo_seccion}", $descripcin, $sec);
            $sec = str_ireplace("{advs}", $html_advs, $sec);                
            
            return $sec;            
            
        }
        
        
        public function set_contenido($contendohtml){
            
            $this->contenido = $contendohtml;
            
            $this->actualizar_diccionarios();
            
            
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