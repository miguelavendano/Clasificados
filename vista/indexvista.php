<?php

    require_once '../core/global_var.php';

    class IndexVista{
        
        private $base;
        private $encabezado;
        private $seccion;
        private $adv;
        private $dic_base;
        private $login;

        
        
        public function __construct() {
            
            $this->base = file_get_contents('../templates/base.html');
            $this->encabezado = file_get_contents('../templates/encabezado.html');
            $this->seccion = file_get_contents('../templates/seccion.html');
            $this->adv = file_get_contents('../templates/adv.html');
            $this->login = file_get_contents('../templates/nologin.html');

            
            $this->dic_base = array('encabezado'=>$this->encabezado,
                                    'contenido'=>$this->seccion,
                                    'login' =>$this->login);            
            
            
        }

        public function actualizar_diccionarios(){            
            
            
            $this->dic_base = array('encabezado'=>$this->encabezado,
                                    'contenido'=>$this->seccion,
                                    'login' =>$this->login);            
            
            
        }
        
        public function refactory_encabezado($nombre_usuario){
            
            if($nombre_usuario){
                $this->login = file_get_contents('../templates/login.html');
                
                $this->login  = str_ireplace("{nombre_usuario}", $nombre_usuario, $this->login  );
                $this->actualizar_diccionarios();
            }
            
            
        }
        

      
        
        
        public function refactory_contenido($datos){            
            
            $resultados="";
            $adv = $this->adv;                       
            
            //for($c=1; count($datos)+1; $c++){                
                
                $resultados .= '<div class="section s1 centrado" >
                                    <div class="inner">
                                        <h1>prueba</h1>
                                    </div>

                                    <div class="avisos og-grid" id="og-grid">';                                            
                foreach($datos as $calve => $valor){
                    $sitio=array_shift($datos);
                    $aux = $adv;
                    
                    $aux = str_ireplace("{fecha}", $sitio["fecha"], $aux);
                    $aux = str_ireplace("{titulo_adv}", $sitio["titulo"], $aux);
                    $aux = str_ireplace("{img}", $sitio["imagen"], $aux);                
                    $aux = str_ireplace("{descripcion}", $sitio["descripcion_1"], $aux);
                    $resultados .= $aux;
                }
                    
            
                
                
                $resultados .= '    </div>
                                    <a href="#" class="button button-rounded button-flat-action">Ver mas</a>
                                </div>';
            //}
            
            
            
            $this->seccion = $resultados;
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