<?php
    require "header.php";
    require_once "classes/Loader.php";
    Loader::register();
    
    $etudiant= new Etudiants_service();
    $etudiant->update();
    $etudiant->findall();

    require "footer.php";
   
?>
