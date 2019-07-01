<?php
    require_once "Loader.php";
    Loader::register();
    class Loges extends Boursiers{
      public function __construct($matricule="",$nom="",$prenom="",$email="",$telephone="",$date_de_naissance="",$id_bourse){
        parent::__construct($matricule,$nom,$prenom,$email,$telephone,$date_de_naissance);
        $this->id_bourse=$id_bourse;
    }
      
        
    }


?>