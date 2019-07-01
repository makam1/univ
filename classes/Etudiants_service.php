<?php
    require_once "Loader.php";
    Loader::register();

        class Etudiants_service{
            private $db;
            private $datas;
            private $id;

            public function __construct(){  //connexion à la base de données
                $this->db= new Base_de_donnees("");
                $this->datas=$this->db->Connexion();
            }

            //gestion des étudiants etudiants
             public function findall(){  //lister tous les étudiants
                
                $form= new Formulaires();
                
                $req = $this->datas->query("select * from etudiants");
                $result = $req->fetchAll();
                $form->table();
                foreach ($result as $req)
                {
                    
                    echo "<tr><td>".$req["matricule"]."</td>".
                    "<td>".$req["nom"]."</td>".
                    "<td>".$req["prenom"]."</td>".
                    "<td>".$req["telephone"]."</td>".
                    "<td>".$req["email"]."</td>".
                    "<td>".$req["date_de_naissance"]."</td></tr>";
                          
                } 
                echo"
                </table>
             </div>
             </div>
             </div>";  
            }

            public function find(){  //rechercher un étudiant
                $recherche= new Formulaires(); //instancier objet de la classe formulaires
                echo "<div class='card-title titre'> <h1>Rechercher Etudiant</h1></div>
                ";
                $recherche->recherche_etudiant(); // appel méthode formulaire recherche d'étudiant
                $req = $this->datas->prepare("SELECT * FROM etudiants WHERE matricule =:matricule");
                $req->execute(array('matricule'=>$recherche->getId()));
                $result = $req->fetchAll();

                if($recherche->getId()!=''){
                $recherche->table();
                }
                foreach ($result as $req)
                {
                    echo "<tr class='bg-success'><td>".$req["matricule"]."</td>".
                    "<td>".$req["nom"]."</td>".
                    "<td>".$req["prenom"]."</td>".
                    "<td>".$req["telephone"]."</td>".
                    "<td>".$req["email"]."</td>".
                    "<td>".$req["date_de_naissance"]."</td></tr>";
                          
                } 
                    echo"
                    </table>
                    </div>
                    </div>
                    </div>"; 

            }
            public function add() //ajouter un étudiant
            {
                $form= new Formulaires(); 
                echo "  <div class='card-title titre'> <h1>Ajouter Etudiant</h1></div>
                ";
                $form->ajout_etudiant(); // appel méthode formulaire ajouter d'étudiant
                $id;
                $bourse;
                $chambre; 
                //insérer les données dans la table etudiants
                $req = $this->datas->prepare("INSERT INTO etudiants (matricule,nom,prenom,email,telephone,date_de_naissance) VALUES (:matricule,:nom,:prenom,:email,:telephone,:date_de_naissance)");
                $test=$req->execute(array('matricule'=>$form->getMatricule(),
                                    'nom'=>$form->getNom(),
                                    'prenom'=>$form->getPrenom(),
                                    'email'=>$form->getMail(),
                                    'telephone'=>$form->getTel(),
                                    'date_de_naissance'=>$form->getDate()));


                 //récupérer l'id de l'etudiant inseré
                $req = $this->datas->prepare("SELECT id_etudiant FROM etudiants WHERE matricule =:matricule");
                $req->execute(array('matricule'=>$form->getMatricule()));
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    $id= $req["id_etudiant"];
                }

                //récupérer le type de boursier
                $req = $this->datas->prepare("SELECT id_bourse FROM bourse WHERE libelle =:libelle");
                        $req->execute(array('libelle'=>$form->getPensionnaire()));
                        $result = $req->fetchAll();
                        foreach ($result as $req)
                        {
                            $bourse= $req["id_bourse"];
                        }


                //ajouter un boursier logé
                if($form->getBoursier()=='boursier' && $form->getlogé()=='logé'){
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

                    //ajouter un bousier non logé
                    if($form->getBoursier()=='boursier' && $form->getlogé()=='non_logé'){
                        $req = $this->datas->prepare("INSERT INTO boursiers (id_etudiant,id_bourse) VALUES (:id_etudiant,:id_bourse)");
                        $req->execute(array('id_etudiant'=>$id,'id_bourse'=>$bourse));

                    }
                }

                //ajouter un non boursier
                if($form->getBoursier()=='non_boursier'){
                    $req = $this->datas->prepare("INSERT INTO non_boursiers (id_etudiant,adresse) VALUES (:id_etudiant,:adresse)");
                    $req->execute(array('id_etudiant'=>$id,'adresse'=>$form->getAdresse()));
                }

            }   
            
            //gestion des boursiers
            public function find_boursiers(){
                $form= new Formulaires();
                $req = $this->datas->prepare("SELECT DISTINCT etudiants.matricule,
                etudiants.nom,etudiants.prenom,etudiants.email,etudiants.telephone,
                etudiants.date_de_naissance,bourse.libelle,bourse.Montant from etudiants,
                bourse,boursiers where etudiants.id_etudiant=boursiers.id_etudiant and 
                bourse.id_bourse=boursiers.id_bourse
                ");
                $req->execute(array());
                $result = $req->fetchAll();
                $form->table_boursier();
                foreach ($result as $req)
                {
                    
                    echo "<tr><td>".$req["matricule"]."</td>".
                    "<td>".$req["nom"]."</td>".
                    "<td>".$req["prenom"]."</td>".
                    "<td>".$req["telephone"]."</td>".
                    "<td>".$req["email"]."</td>".
                    "<td>".$req["date_de_naissance"]."</td>".
                    "<td>".$req["libelle"]."</td>".
                    "<td>".$req["Montant"]."</td></tr>";
    
                } 
                    echo"
                    </table>
                    </div>
                    </div>
                    </div>"; 
                

            }
            public function find_un_boursier(){
                $id=1;
                $vrai=false;
                $recherche= new Formulaires(); //instancier objet de la classe formulaires
                echo "  <div class='card-title titre'> <h1>Rechercher Boursier</h1></div>";
                $recherche->recherche_etudiant();
                $req = $this->datas->prepare("SELECT * FROM etudiants WHERE matricule =:matricule");
                $req->execute(array('matricule'=>$recherche->getId()));
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    $id=$req["id_etudiant"];
                }
                $req = $this->datas->prepare("SELECT id_etudiant FROM boursiers where id_etudiant=:id_etudiant");
                $req->execute(array('id_etudiant'=>$id));
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    
                    if($id==$req["id_etudiant"]){
                        $vrai=true;
                    }
                }
                if($vrai==true){
                    $req = $this->datas->prepare(" SELECT DISTINCT etudiants.matricule,etudiants.nom,
                    etudiants.prenom,etudiants.email,etudiants.telephone,etudiants.date_de_naissance,
                    bourse.libelle,bourse.Montant from etudiants,bourse,boursiers where etudiants.id_etudiant=:id_etudiant
                     and bourse.id_bourse=(select boursiers.id_bourse from boursiers where boursiers.id_etudiant=:id_etudiant)");
                    $req->execute(array('id_etudiant'=>$id));
                    $result = $req->fetchAll();
                    if($recherche->getId()!=''){
                        $recherche->table_boursier();
                        }
                    foreach ($result as $req)
                    {
                        
                        echo "<tr class='bg-success'><td>".$req["matricule"]."</td>".
                        "<td>".$req["nom"]."</td>".
                        "<td>".$req["prenom"]."</td>".
                        "<td>".$req["telephone"]."</td>".
                        "<td>".$req["email"]."</td>".
                        "<td>".$req["date_de_naissance"]."</td>".
                        "<td>".$req["libelle"]."</td>".
                        "<td>".$req["Montant"]."</td></tr>";
        
                    } 
                        echo"
                        </table>
                        </div>
                        </div>
                        </div>"; 

                } 
            }
            public function find_non_boursiers(){
                $form= new Formulaires();
                $req = $this->datas->prepare("SELECT DISTINCT etudiants.matricule,
                etudiants.nom,etudiants.prenom,etudiants.email,etudiants.telephone,
                etudiants.date_de_naissance,non_boursiers.adresse from etudiants,non_boursiers where etudiants.id_etudiant=non_boursiers.id_etudiant 
                ");
                $req->execute(array());
                $result = $req->fetchAll();
                $form->table_non_boursier();
                foreach ($result as $req)
                {
                    
                    echo "<tr><td>".$req["matricule"]."</td>".
                    "<td>".$req["nom"]."</td>".
                    "<td>".$req["prenom"]."</td>".
                    "<td>".$req["telephone"]."</td>".
                    "<td>".$req["email"]."</td>".
                    "<td>".$req["date_de_naissance"]."</td>".
                    "<td>".$req["adresse"]."</td></tr>";
    
                } 
                    echo"
                    </table>
                    </div>
                    </div>
                    </div>"; 
            }

            public function find_un_non_boursier(){
                $id=0;
                $vrai=false;
                echo "<div class='card-title titre'> <h1>Rechercher un Non Boursier</h1></div>
                ";
                $recherche= new Formulaires(); //instancier objet de la classe formulaires
                $recherche->recherche_etudiant();
                $req = $this->datas->prepare("SELECT * FROM etudiants WHERE matricule =:matricule");
                $req->execute(array('matricule'=>$recherche->getId()));
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    $id=$req["id_etudiant"];
                }
                $req = $this->datas->prepare("SELECT id_etudiant FROM non_boursiers where id_etudiant=:id_etudiant");
                $req->execute(array('id_etudiant'=>$id));
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    
                    if($id==$req["id_etudiant"]){
                        $vrai=true;
                    }
                }
                if($vrai==true){
                    $req = $this->datas->prepare("SELECT DISTINCT etudiants.matricule,etudiants.nom,
                    etudiants.prenom,etudiants.email,etudiants.telephone,etudiants.date_de_naissance,
                    non_boursiers.adresse from etudiants,non_boursiers where etudiants.id_etudiant=$id
                     and non_boursiers.id_etudiant=$id");
                    $req->execute(array());
                    $result = $req->fetchAll();
                    if($recherche->getId()!=''){
                        $recherche->table_non_boursier();
                        }
                    foreach ($result as $req)
                    {
                        
                        echo "<tr class='bg-success'><td>".$req["matricule"]."</td>".
                        "<td>".$req["nom"]."</td>".
                        "<td>".$req["prenom"]."</td>".
                        "<td>".$req["telephone"]."</td>".
                        "<td>".$req["email"]."</td>".
                        "<td>".$req["date_de_naissance"]."</td>".
                        "<td>".$req["adresse"]."</td></tr>";
        
                    } 
                        echo"
                        </table>
                        </div>
                        </div>
                        </div>"; 

                }

            }

            public function logés(){
                $form= new Formulaires();
                $req = $this->datas->prepare("SELECT DISTINCT etudiants.matricule,
                etudiants.nom,etudiants.prenom,etudiants.email,etudiants.telephone,
                etudiants.date_de_naissance,chambres.nom_chambre from etudiants,loges,
                chambres where etudiants.id_etudiant=loges.id_etudiant and 
                chambres.id_chambre=loges.id_chambre");
                $req->execute(array());
                $result = $req->fetchAll();
                $form->table_logé();
                foreach ($result as $req)
                {
                    
                    echo "<tr><td>".$req["matricule"]."</td>".
                    "<td>".$req["nom"]."</td>".
                    "<td>".$req["prenom"]."</td>".
                    "<td>".$req["telephone"]."</td>".
                    "<td>".$req["email"]."</td>".
                    "<td>".$req["date_de_naissance"]."</td>".
                    "<td>".$req["nom_chambre"]."</td></tr>";
    
                } 
                    echo"
                    </table>
                    </div>
                    </div>
                    </div>"; 

            }
            public function un_logé(){
                $id=0;
                $vrai=false;
                echo "<div class='card-title titre'> <h1>Rechercher un Logé</h1></div>
                ";
                $recherche= new Formulaires(); //instancier objet de la classe formulaires
                $recherche->recherche_etudiant();
                $req = $this->datas->prepare("SELECT * FROM etudiants WHERE matricule =:matricule");
                $req->execute(array('matricule'=>$recherche->getId()));
                $result = $req->fetchAll();
                
                foreach ($result as $req)
                {
                    $id=$req["id_etudiant"];
                }
                $req = $this->datas->prepare("SELECT id_etudiant FROM loges where id_etudiant=:id_etudiant");
                $req->execute(array('id_etudiant'=>$id));
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    
                    if($id==$req["id_etudiant"]){
                        $vrai=true;
                    }
                }
                if($vrai==true){
                    $req = $this->datas->prepare(" SELECT DISTINCT etudiants.matricule,etudiants.nom,
                    etudiants.prenom,etudiants.email,etudiants.telephone,etudiants.date_de_naissance,
                    chambres.nom_chambre from etudiants,loges,chambres where etudiants.id_etudiant=$id
                     and chambres.id_chambre=(select loges.id_chambre from loges where loges.id_etudiant=$id)");
                    $req->execute(array());
                    $result = $req->fetchAll();
                    if($recherche->getId()!=''){
                        $recherche->table_logé();
                    }
                    foreach ($result as $req)
                    {
                        
                        echo "<tr class='bg-success'><td>".$req["matricule"]."</td>".
                        "<td>".$req["nom"]."</td>".
                        "<td>".$req["prenom"]."</td>".
                        "<td>".$req["telephone"]."</td>".
                        "<td>".$req["email"]."</td>".
                        "<td>".$req["date_de_naissance"]."</td>".
                        "<td>".$req["nom_chambre"]."</td></tr>";
        
                    } 
                        echo"
                        </table>
                        </div>
                        </div>
                        </div>"; 
                }
            }
            public function non_logés(){
                $form= new Formulaires();
                $req = $this->datas->prepare("SELECT DISTINCT etudiants.matricule,
                etudiants.nom,etudiants.prenom,etudiants.email,etudiants.telephone,
                etudiants.date_de_naissance from etudiants,loges
                 where etudiants.id_etudiant NOT IN (select loges.id_etudiant from loges) ");
                $req->execute(array());
                $result = $req->fetchAll();
                $form->table();
                foreach ($result as $req)
                {
                    echo "<tr><td>".$req["matricule"]."</td>".
                    "<td>".$req["nom"]."</td>".
                    "<td>".$req["prenom"]."</td>".
                    "<td>".$req["telephone"]."</td>".
                    "<td>".$req["email"]."</td>".
                    "<td>".$req["date_de_naissance"]."</td></tr>";
                          
                } 
                    echo"
                    </table>
                    </div>
                    </div>
                    </div>"; 
            }
            public function un_non_logé(){
                $id=0;
                echo "<div class='card-title titre'> <h1>Rechercher un Non logé</h1></div>
                ";
                $recherche= new Formulaires(); //instancier objet de la classe formulaires
                $recherche->recherche_etudiant();
                $req = $this->datas->prepare("SELECT * FROM etudiants WHERE matricule =:matricule");
                $req->execute(array('matricule'=>$recherche->getId()));
                $result = $req->fetchAll();
                if($recherche->getId()!=''){
                    $recherche->table();
                }
                foreach ($result as $req)
                {
                    $id=$req["id_etudiant"];
                }
                
                    $req = $this->datas->prepare(" SELECT DISTINCT etudiants.matricule,
                    etudiants.nom,etudiants.prenom,etudiants.email,etudiants.telephone,
                    etudiants.date_de_naissance from etudiants,loges
                    where etudiants.id_etudiant=$id and $id NOT IN (select loges.id_etudiant from loges)");
                    $req->execute(array());
                    $result = $req->fetchAll();
                    foreach ($result as $req)
                    {
                        echo "<tr class='bg-success'><td>".$req["matricule"]."</td>".
                        "<td>".$req["nom"]."</td>".
                        "<td>".$req["prenom"]."</td>".
                        "<td>".$req["telephone"]."</td>".
                        "<td>".$req["email"]."</td>".
                        "<td>".$req["date_de_naissance"]."</td></tr>";
                            
                    } 
                        echo"
                        </table>
                        </div>
                        </div>
                        </div>"; 

            }
            public function checkstatut(){
                $id=0;
                echo "<div class='card-title titre'> <h1>Vérifier statut de l'étudiant</h1></div>
                ";
                $recherche= new Formulaires(); //instancier objet de la classe formulaires
                $recherche->recherche_etudiant();
                $req = $this->datas->prepare("SELECT * FROM etudiants WHERE matricule =:matricule");
                $req->execute(array('matricule'=>$recherche->getId()));
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    $id=$req["id_etudiant"];
                }
                $req = $this->datas->prepare("SELECT id_etudiant FROM boursiers
                 WHERE id_etudiant =$id and boursiers.id_etudiant IN
                  (select loges.id_etudiant from loges where loges.id_etudiant=$id)");
                $req->execute(array());
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    if($id==$req['id_etudiant']){
                        echo "<div class='card-title statut'><h3>L'etudiant est boursier et logé</h3></div>";
                    }
                }
                $req = $this->datas->prepare("SELECT id_etudiant FROM boursiers
                 WHERE id_etudiant =$id and boursiers.id_etudiant NOT IN
                  (select loges.id_etudiant from loges where loges.id_etudiant=$id)");
                $req->execute(array());
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    if($id==$req['id_etudiant']){
                        echo "<div class='statut'><h3>L'etudiant est boursier non logé</h3></div>";
                    }
                }
                $req = $this->datas->prepare("SELECT id_etudiant FROM non_boursiers WHERE id_etudiant =:id_etudiant");
                $req->execute(array('id_etudiant'=>$id));
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    if($id==$req['id_etudiant']){
                        echo "<div class='statut'> <h3>L'étudiant n'est pas boursier</h3></div>
                ";
                    }
                }
            }

            public function add_chambre(){
                $id;
                echo "<div class='card-title titre'> <h1>Ajouter une Chambre</h1></div>
                ";
                echo "<div class='card-title titre'> <h4>Sélectionner le bâtiment où vous voulez ajouter une chambre</h4></div>
                ";
                $recherche= new Formulaires(); //instancier objet de la classe formulaires
                $recherche->add_chambre();
                $req = $this->datas->prepare("SELECT id_chambre FROM chambres
                ORDER BY id_chambre DESC
                LIMIT 1");
                $req->execute(array());
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    $id= $req["id_chambre"]+1;
                }
                if($recherche->getCh()=='MAK'){
                    $req = $this->datas->prepare("INSERT INTO chambres (id_chambre,id_batiment,nom_chambre)
                     values (:id_chambre,:id_batiment,:nom_chambre)");
                    $req->execute(array('id_chambre'=>$id,
                    'id_batiment'=>1,
                    'nom_chambre'=>'A'.$id,));
                }
                else{
                    $req = $this->datas->prepare("INSERT INTO chambres (id_chambre,id_batiment,nom_chambre)
                     values (:id_chambre,:id_batiment,:nom_chambre)");
                    $req->execute(array('id_chambre'=>$id,
                    'id_batiment'=>2,
                    'nom_chambre'=>'B'.$id,));
                }
            }
            public function delete(){
                $id=0;
                echo "<div class='card-title titre'> <h1>Supprimer un Etudiant</h1></div>
                ";
                $recherche= new Formulaires(); //instancier objet de la classe formulaires
                $recherche->recherche_etudiant();
                $req = $this->datas->prepare("SELECT * FROM etudiants WHERE matricule =:matricule");
                $req->execute(array('matricule'=>$recherche->getId()));
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    $id=$req["id_etudiant"];
                }
                $req = $this->datas->prepare("DELETE from non_boursiers WHERE id_etudiant =$id;
                DELETE from loges WHERE id_etudiant =$id;
                DELETE from boursiers WHERE id_etudiant =$id;
                DELETE from etudiants WHERE id_etudiant =$id;  ");
                $req->execute();
                
            }


            public function update(){
                $id=0; $mat;$nom;$prenom;$date;$tel;$email;
                echo "<div class='card-title titre'> <h2>Modifier les informations d'un étudiants</h2></div>
                ";
                $recherche= new Formulaires(); //instancier objet de la classe formulaires
                $recherche->recherche_etudiant();
                $req = $this->datas->prepare("SELECT * FROM etudiants WHERE matricule =:matricule");
                $req->execute(array('matricule'=>$recherche->getId()));
                $result = $req->fetchAll();
                foreach ($result as $req)
                {
                    $id=$req["id_etudiant"];
                    $mat=$req["matricule"];
                    $nom= $req["nom"];
                    $prenom= $req["prenom"];
                    $tel= $req["telephone"];
                    $email= $req["email"];
                    $date= $req["date_de_naissance"];
                    ?> 
            
                <div class="container formulaire">
                <div class="row inf">
                <div class="col-md-12">
                    <form method='post' action=''>
                    <input class="champ" type='text' name='matricule' value=<?php echo $mat;?> required readonly /><br><br>
                    <input class="champ" type='text' name='nom' value=<?php echo $nom;?>  required/><br><br>
                    <input class="champ" type='text' name='prenom' value=<?php echo $prenom;?>  required/><br><br>
                    <input class="champ" type='date' name='datenaissance' value=<?php echo $date;?> required/><br><br>
                    <input class="champ" type='number' name='tel' value=<?php echo $tel;?> required/><br><br>
                    <input class="champ" type='mail' name='mail' value=<?php echo $email;?>  required/><br><br>
                </div>
                </div>
              
                        <div class="row ajouter">
                        <div class="col-md-12"> 
                        <input type='submit' name='modifier' value='Modifier' classe=''><br><br>
                        </div>
                        </div> 
                    </form>
                    </div>
                    <?php
                   
                     }
                    if(isset($_POST['modifier'])){
                        
                        $m=$_POST['matricule']; $n=$_POST['nom']; $p=$_POST['prenom']; $e=$_POST['mail'];
                        $t=$_POST['tel']; $d=$_POST['datenaissance'];

                        $req = $this->datas->prepare("SELECT * FROM etudiants WHERE matricule =:matricule");
                        $req->execute(array('matricule'=>$m));
                        $result = $req->fetchAll();
                        foreach ($result as $req)
                        {
                            $id=$req["id_etudiant"];
                        }
                        $req = $this->datas->prepare("UPDATE etudiants set matricule='$m',nom='$n',prenom='$p',email='$e', telephone='$t', date_de_naissance='$d' where id_etudiant=$id");
                        $req->execute(array());                  
                }
               
                } 
    }

?>