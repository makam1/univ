<?php
    require_once "Loader.php";
    Loader::register();
    $etu = new Etudiants_service();
    $etu ->add_boursier();
  

?>