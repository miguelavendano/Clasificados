<?php

/*
 * modelo de la parte de perfil de los usuario
 */

require_once 'Conexion.php';





/**
 * Description of perfilModelo
 *
 * @author miguel
 */
class perfilModelo {
    //enclace con la base de datos 
    var $model;
    
    
    public function __construct() {
        $this->model=new Conexion();
    }
    
    
    
    
    /**
     * trae la informaccion de los datos primarios de los clasificados 
     * de un usuario.
     * 
     * los datos que se muestran de los clasificados 
     * @param int $idUsuario identificacion del usuario
     * 
     */
         public function datosPrimariosClasificados($idUsuario){

            $query =    "SELECT cl.id,
                        cl.descripcion_1 as descripcion_1, 
                        cl.fecha_publicacion as fecha, 
                        cl.titulo as titulo, 
                        ft.ruta as imagen                        
                        FROM clasificado cl, foto ft
                        WHERE cl.id = ft.id_clasificados and cl.id_usuario ={$idUsuario}
                        group by cl.id;";
            
            
            $datos = $this->model->get_resultados_query($query);
            
            //print_r($datos);
            
          
            return $datos;
        }
    
    
    
}

?>
