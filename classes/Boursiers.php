<?php
 
    require "Loader.php";
    Loader::register();
    $etudiant= new Etudiants_service();
    $etudiant->find_un_boursier();
    $etudiant->find_boursiers();

    class Boursiers extends Etudiants{
        protected $id_bourse;
        public function __construct($matricule="",$nom="",$prenom="",$email="",$telephone="",$date_de_naissance="",$id_bourse){
            parent::__construct($matricule,$nom,$prenom,$email,$telephone,$date_de_naissance);
            $this->id_bourse=$id_bourse;
        }
        
    }
          
   
?>