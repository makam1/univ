<?php
    require "header.php";
    require_once "classes/Loader.php";
    Loader::register();
    
    $etudiant= new Etudiants_service();
    $etudiant->un_non_logé();
    $etudiant->non_logés();

    require "footer.php";
   
?>
