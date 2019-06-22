<?php
    require_once "Loader.php";
    Loader::register();

    class Formulaires{
        private $matricule;
        private $nom;
        private $prenom;
        private $date;
        private $tel;
        private $mail;
        private $boursier;
        private $adresse;
        private $logé;
        private $pensionnaire;
        private $chambre;
        private $id;

        public function __construct(){
            
           
        }

        public function ajout_etudiant(){
        ?>
            <form method='post' action=''>
            <input  type='text' name='matricule' placeholder='matricule' required/><br>
            <input  type='text' name='nom' placeholder='nom' required/><br>
            <input  type='text' name='prenom' placeholder='prénom' required/><br>
            <input  type='date' name='datenaissance' placeholder='date de naissance' required/><br>
            <input  type='number' name='tel' placeholder='téléphone' required/><br>
            <input  type='mail' name='mail' placeholder='mail' required/><br>

            <input type='radio' id='boursier' name='boursier' value='boursier' required>
            <label for='boursier'>Boursier</label>    
                <select name='pensionnaire' class='form-control' required>
                <?php
                        $db= new Base_de_donnees("");
                        $datas=$db->Connexion();
                        $req = $datas->query("select libelle from bourse");
                        $result = $req->fetchAll();
                        foreach ($result as $req)
                        {
                                $res=$req['libelle'];
                                echo "<option value=$res required>".$res."</option>";
                        }  

                ?>
                        </select>

            <input type='radio' id='logé' name='logé' value='logé' required>
            <label for='logé'>Logé</label>   
            
            <input type='radio' id='non_logé' name='logé' value='non_logé' required>
            <label for='non_logé'>Non_logé</label> 

            <select name='chambres' class='form-control' required>

                <?php
                        $db= new Base_de_donnees("");
                        $datas=$db->Connexion();
                        $req = $datas->query("select nom_chambre from chambres");
                        $result = $req->fetchAll();
                        foreach ($result as $req)
                        {
                                $res=$req['nom_chambre'];
                                echo "<option value=$res required>".$res."</option>";
                        }  

                ?>
                </select>

            
            <input type='radio' id='non_boursier' name='boursier' value='non_boursier' required>
            <label for='non_boursier'>Non_boursier</label>
            <input  type='text' name='adresse' placeholder='adresse' required/><br>

            
            <input type='submit' name='ajouter' value='Ajouter' id='con' ><br><br>

            </form>
            <?php
            if(isset($_POST['ajouter'])){
                $this->nom=$_POST['nom'];
                $this->prenom=$_POST['prenom'];
                $this->date=$_POST['datenaissance'];
                $this->tel=$_POST['tel'];
                $this->mail=$_POST['mail'];
                $this->matricule=$_POST['matricule'];
                $this->boursier=$_POST['boursier'];
                $this->adresse=$_POST['adresse'];
                $this->pensionnaire=$_POST['pensionnaire'];
                $this->logé=$_POST['logé'];
                $this->chambre=$_POST['chambres'];

               
                }

        }

        public function recherche_etudiant(){
            echo "<form method='post' action=''>
                <input type='text' name='matricule'required/><br>
                <input type='submit' name='rechercher' value='rechercher' id='con' ><br><br>

            </form>";
            if (isset($_POST['rechercher'])){
                $this->id=$_POST['matricule'];
        }
        
    }

        /**
         * Get the value of matricule
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of matricule
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of matricule
         */ 
        public function getMatricule()
        {
                return $this->matricule;
        }

        /**
         * Set the value of matricule
         *
         * @return  self
         */ 
        public function setMatricule($matricule)
        {
                $this->matricule = $matricule;

                return $this;
        }

        /**
         * Get the value of nom
         */ 
        public function getNom()
        {
                return $this->nom;
        }

        /**
         * Set the value of nom
         *
         * @return  self
         */ 
        public function setNom($nom)
        {
                $this->nom = $nom;

                return $this;
        }

        /**
         * Get the value of prenom
         */ 
        public function getPrenom()
        {
                return $this->prenom;
        }

        /**
         * Set the value of prenom
         *
         * @return  self
         */ 
        public function setPrenom($prenom)
        {
                $this->prenom = $prenom;

                return $this;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
                $this->date = $date;

                return $this;
        }

        /**
         * Get the value of tel
         */ 
        public function getTel()
        {
                return $this->tel;
        }

        /**
         * Set the value of tel
         *
         * @return  self
         */ 
        public function setTel($tel)
        {
                $this->tel = $tel;

                return $this;
        }

        /**
         * Get the value of mail
         */ 
        public function getMail()
        {
                return $this->mail;
        }

        /**
         * Set the value of mail
         *
         * @return  self
         */ 
        public function setMail($mail)
        {
                $this->mail = $mail;

                return $this;
        }

        /**
         * Get the value of boursier
         */ 
        public function getBoursier()
        {
                return $this->boursier;
        }

        /**
         * Set the value of boursier
         *
         * @return  self
         */ 
        public function setBoursier($boursier)
        {
                $this->boursier = $boursier;

                return $this;
        }

        /**
         * Get the value of adresse
         */ 
        public function getAdresse()
        {
                return $this->adresse;
        }

        /**
         * Set the value of adresse
         *
         * @return  self
         */ 
        public function setAdresse($adresse)
        {
                $this->adresse = $adresse;

                return $this;
        }

        /**
         * Get the value of logé
         */ 
        public function getLogé()
        {
                return $this->logé;
        }

        /**
         * Set the value of logé
         *
         * @return  self
         */ 
        public function setLogé($logé)
        {
                $this->logé = $logé;

                return $this;
        }

        /**
         * Get the value of pensionnaire
         */ 
        public function getPensionnaire()
        {
                return $this->pensionnaire;
        }

        /**
         * Set the value of pensionnaire
         *
         * @return  self
         */ 
        public function setPensionnaire($pensionnaire)
        {
                $this->pensionnaire = $pensionnaire;

                return $this;
        }

        /**
         * Get the value of chambre
         */ 
        public function getChambre()
        {
                return $this->chambre;
        }

        /**
         * Set the value of chambre
         *
         * @return  self
         */ 
        public function setChambre($chambre)
        {
                $this->chambre = $chambre;

                return $this;
        }
}



?>