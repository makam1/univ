
<?php
    require_once "Loader.php";
    Loader::register();

        class Etudiants_service{
            private $db;
            private $datas;
            private $id;


            public function __construct(){
                $this->db= new Base_de_donnees("");
                $this->datas=$this->db->Connexion();
            }
            //classe etudiants
             public function findall(){  //lister tous les étudiants
                $req = $this->datas->query("select * from etudiants");
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    echo $req["matricule"].$req["nom"].$req["prenom"].$req["telephone"].$req["email"].$req["date_de_naissance"]."<br/>";
                }   
            }
            public function find(){  //rechercher un étudiant
                $recherche= new Formulaires();
                $recherche->recherche_etudiant();
                $req = $this->datas->prepare("SELECT * FROM etudiants WHERE matricule =:matricule");
                $req->execute(array('matricule'=>$recherche->getId()));
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    echo $req["matricule"].$req["nom"].$req["prenom"].$req["telephone"].$req["email"].$req["date_de_naissance"]."<br/>";
                }

            }

            public function add_boursier() //ajouter un boursier
            {
                $form= new Formulaires();
                $form->ajout_etudiant();
                $id;
                $bourse;
                $chambre;
                $req = $this->datas->prepare("INSERT INTO etudiants (matricule,nom,prenom,email,telephone,date_de_naissance) VALUES (:matricule,:nom,:prenom,:email,:telephone,:date_de_naissance)");
                $test=$req->execute(array('matricule'=>$form->getMatricule(),
                                    'nom'=>$form->getNom(),
                                    'prenom'=>$form->getPrenom(),
                                    'email'=>$form->getMail(),
                                    'telephone'=>$form->getTel(),
                                    'date_de_naissance'=>$form->getDate()));
                if($form->getBoursier()=='boursier' && $form->getlogé()=='logé'){
                        $req = $this->datas->prepare("SELECT id_etudiant FROM etudiants WHERE matricule =:matricule");
                        $req->execute(array('matricule'=>$form->getMatricule()));
                        $result = $req->fetchAll();
                        foreach ($result as $req)
                        {
                            $id= $req["id_etudiant"];
                        }
                        $req = $this->datas->prepare("SELECT id_bourse FROM bourse WHERE libelle =:libelle");
                        $req->execute(array('libelle'=>$form->getPensionnaire()));
                        $result = $req->fetchAll();
                        foreach ($result as $req)
                        {
                            $bourse= $req["id_bourse"];
                        }
                        $req = $this->datas->prepare("SELECT id_chambre FROM chambres WHERE nom_chambre =:nom_chambre");
                        $req->execute(array('nom_chambre'=>$form->getchambre()));
                        $result = $req->fetchAll();
                        foreach ($result as $req)
                        {
                            $chambre= $req["id_chambre"];
                        }
                        $req = $this->datas->prepare("INSERT INTO boursiers (id_etudiant,id_bourse) VALUES (:id_etudiant,:id_bourse)");
                        $req->execute(array('id_etudiant'=>$id,'id_bourse'=>$bourse));
                        $req = $this->datas->prepare("INSERT INTO loges (id_etudiant,id_chambre) VALUES (:id_etudiant,:id_chambre)");
                        $req->execute(array('id_etudiant'=>$id,'id_chambre'=>$chambre));
                        
                }else{
                    if($form->getBoursier()=='boursier' && $form->getlogé()=='non_logé'){
                        $req = $this->datas->prepare("SELECT id_etudiant FROM etudiants WHERE matricule =:matricule");
                        $req->execute(array('matricule'=>$form->getMatricule()));
                        $result = $req->fetchAll();
                        foreach ($result as $req)
                        {
                            $id= $req["id_etudiant"];
                        }
                        $req = $this->datas->prepare("SELECT id_bourse FROM bourse WHERE libelle =:libelle");
                        $req->execute(array('libelle'=>$form->getPensionnaire()));
                        $result = $req->fetchAll();
                        foreach ($result as $req)
                        {
                            $bourse= $req["id_bourse"];
                        }
                        $req = $this->datas->prepare("INSERT INTO boursiers (id_etudiant,id_bourse) VALUES (:id_etudiant,:id_bourse)");
                        $req->execute(array('id_etudiant'=>$id,'id_bourse'=>$bourse));

                    }
                }

            }
            public function add_non_boursier() //ajouter un non_boursier
            {
                $form= new Formulaires();
                $form->ajout_etudiant();
                $id;
                if($form->getBoursier()=='non_boursier'){
                    
                    $req = $this->datas->prepare("INSERT INTO etudiants (matricule,nom,prenom,email,telephone,date_de_naissance) VALUES (:matricule,:nom,:prenom,:email,:telephone,:date_de_naissance)");
                    $req->execute(array('matricule'=>$form->getMatricule(),
                                    'nom'=>$form->getNom(),
                                    'prenom'=>$form->getPrenom(),
                                    'email'=>$form->getMail(),
                                    'telephone'=>$form->getTel(),
                                    'date_de_naissance'=>$form->getDate()));
                    $req = $this->datas->prepare("SELECT id_etudiant FROM etudiants WHERE matricule =:matricule");
                    $req->execute(array('matricule'=>$form->getMatricule()));
                    $result = $req->fetchAll();
                    foreach ($result as $req)
                {
                     $id= $req["id_etudiant"];
                }
                    $req = $this->datas->prepare("INSERT INTO non_boursiers (id_etudiant,adresse) VALUES (:id_etudiant,:adresse)");
                    $req->execute(array('id_etudiant'=>$id,'adresse'=>$form->getAdresse()));

                }
                
            }
            
    }

?>