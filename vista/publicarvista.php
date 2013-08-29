<?php

    require_once '../core/global_var.php';

    class PublicarVista{
        
        public $base;
        public $encabezado;
        public $dic_encabezado;
        
        public $adv;
        public $dic_base;
        public $seccion;
        public $login;

        
        
        public function __construct() {
            
            $this->base = file_get_contents('../templates/base.html');
            $this->encabezado = file_get_contents('../templates/encabezado2.html');            
            $this->login = file_get_contents('../templates/login.html');

            
            $this->dic_base = array('encabezado'=>$this->encabezado,
                                    'contenido'=>$this->seccion,
                                    'login' =>$this->login);
            

            
            $this->dic_encabezado = array('mensaje'=>"",
                                    'boton'=>"");            
            
            
        }

        public function actualizar_diccionarios(){            
            
            
            $this->dic_base = array('encabezado'=>$this->encabezado,
                                    'contenido'=>$this->seccion,
                                    'login' =>$this->login);               
            
            
        }
        
        public function refactory_agradecer(){
            
            $this->dic_encabezado["mensaje"] = "Tu Anuncio a sido publicado satisfactoria mente !!";
            $this->dic_encabezado["boton"] = '<a href="index.php" >Volver</a> ';
            $this->refactory_total();
            
        }
        
        public function refactory_error(){

            $this->dic_encabezado["mensaje"] = "Tu Anuncio a sido publicado satisfactoria mente !!";
            $this->dic_encabezado["boton"] = '<a href="index.php" >Volver</a> ';
            $this->refactory_total();
            
        }
        

        
        public function refactory_formulario($nombre_usuario){
            
            $globales = new Global_var();
            $this->seccion = file_get_contents('../templates/fpublicar.html');           
            $this->dic_encabezado["mensaje"] = "Ingresa tu ADV, pronto lograras negociar";            
            
            $this->login  = str_ireplace("{nombre_usuario}", $nombre_usuario, $this->login);          
            
            $this->actualizar_diccionarios();
            
            $this->refactory_total();
            
            
        }

        public function refactory_total(){
            
            $this->actualizar_diccionarios();
            $globales = new Global_var();
            
            $result_consulta = "";            
            
         
            
            
            foreach ($this->dic_encabezado as $clave=>$valor){                    
                
                $this->encabezado = str_ireplace('{'.$clave.'}', $valor, $this->encabezado);
                
            }
            
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