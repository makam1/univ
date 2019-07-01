<?php
    require "header.php";
    require_once "classes/Loader.php";
    Loader::register();
    
    $etudiant= new Etudiants_service();
    $etudiant->find_un_boursier();
    $etudiant->find_boursiers();

    include "footer.php";
   
?>
