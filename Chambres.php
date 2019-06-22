<?php
    require "classes.php";
    loader::register();
        class chambres extends batiments{
          public $id_chambre;
        public function __construct($batiment="",$id_chambre){
            parent::__construct();
            $this->id_chambre=$id_chambre;
        }
 
    }

?>