<?php
    require "header.php";
    require_once "classes/Loader.php";
    Loader::register();

    $etudiant= new Etudiants_service();
    $etudiant->checkstatut();
    $etudiant->find();
    $etudiant->findall();

    include "footer.php";
   
?>
