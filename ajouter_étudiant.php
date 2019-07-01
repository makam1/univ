<?php
    require_once "header.php";
    require_once "classes/Loader.php";
    Loader::register();

    $etudiant= new Etudiants_service();
    $etudiant->add();

    include "footer.php";
   
?>