<?php

    $connexion = new PDO('mysql:host=localhost;dbname=universite;charset=utf8', 'root', 'passer');
    $requete = $connexion->query("SELECT * FROM bourse");
    $result = $requete->fetchAll();
    $bourse=[];
    foreach ($result as $requete)
    {
        $bourse[] =$requete['Montant'];
    }

    for ($i=0;$i<count($bourse);$i++){
        echo $bourse[$i].'<br />';
    }


    class Bourses{
        public $montant;

        public function __construct($montant){
            $bourses[]=$bourse=[];
            for ($i=0;$i<count($bourses);$i++){
                $this->montant=$bourses[$i];
            }   

        }
        public function donnees()
            {   
                return $this->montant;
            }
    }

?>