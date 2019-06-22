<?php
    require_once "Loader.php";
    Loader::register();
       
    class Etudiants{
        protected $matricule;
        protected $nom;
        protected $prenom;
        protected $email;
        protected $telephone;
        protected $date_de_naissance;

        public function __construct($matricule,$nom,$prenom,$email,$telephone,$date_de_naissance){
            $this->matricule=$matricule;
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->email= $email;
            $this->telephone=$telephone;
            $this->date_de_naissance=$date_de_naissance;

        }

        public function donnees(){
          return $this->matricule. ", ".$this->nom. ", ".$this->prenom.", ".$this->email. ", ".$this->telephone.", ".$this->date_de_naissance;
      }
  }

?>