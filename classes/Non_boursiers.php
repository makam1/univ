<?php
    require "Loader.php";
    loader::register();
    class Non_boursiers extends Etudiants{
        protected $adresse;
        public function __construct($matricule="",$nom="",$prenom="",$email="",$telephone="",$date_de_naissance="",$adresse){
            parent::__construct($matricule,$nom,$prenom,$email,$telephone,$date_de_naissance);
            $this->adresse=$adresse;
        }
    }

?>