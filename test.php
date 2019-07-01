<?php
    require_once "Loader.php";
    Loader::register();
       
        $etudiant= new Etudiants_service();
        //$etudiant->find_un_non_boursier();
        //$etudiant->find_non_boursiers();
        //$etudiant->un_logé();

        //$etudiant->logés();
        //$etudiant->checkstatut();

        //$etudiant->un_non_logé();

        //$etudiant->non_logés();
        //$etudiant->add_chambre();
        //$etudiant->delete();
        $etudiant->update();




        //$etudiant->findall();

        include "footer.php";
         
        
    
  
        
?>