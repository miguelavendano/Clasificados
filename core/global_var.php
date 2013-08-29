<?php

    class Global_var{
        
        public $IMG_SYS;

        public $CSS;
        public $JS;         
        public $global_var;
        public $TITULO;
        public $IMG_ADV;
        
        
        public function __construct() {
            
            $this->IMG_SYS = '/Clasificados/estaticos/img';
            $this->IMG_ADV = '/Clasificados/estaticos/img';
            $this->CSS = '/Clasificados/estaticos/css';
            $this->JS = '/Clasificados/estaticos/js';
            $this->TITULO = "Clasificados TuADV";
            

            $this->global_var = array('IMG_SYS'=>$this->IMG_SYS,'IMG_ADV'=> $this->IMG_ADV,
                                    'CSS'=>$this->CSS, 'JS'=>$this->JS, 'TITULO' => $this->TITULO,);
            
            
        }
        
    }





?>