<?php
    require "header.php";
    require_once "classes/Loader.php";
    Loader::register();
    
    $etudiant= new Etudiants_service();
    $etudiant->un_logé();
    $etudiant->logés();

    include "footer.php";
   
?>
