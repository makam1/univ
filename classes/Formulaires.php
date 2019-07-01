<!DOCTYPE html>
<html>
    <title></title>
</head>
<body>
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
        private $adresse='Mermoz';
        private $logé='non';
        private $pensionnaire='oui';
        private $chambre='oui';
        private $ch;
        private $id;
        private $idbat;


        public function __construct(){
            
           
        }

        public function ajout_etudiant(){
        ?>
        <div class="container formulaire">
        <div class="row inf">
        <div class="col-md-12">
            <form method='post' action=''>
            <input class="champ" type='text' name='matricule' placeholder='Matricule' required/><br><br>
            <input class="champ" type='text' name='nom' placeholder='Nom' required/><br><br>
            <input class="champ" type='text' name='prenom' placeholder='Prénom' required/><br><br>
            <input class="champ" type='date' name='datenaissance' placeholder='Date de naissance' required/><br><br>
            <input class="champ" type='number' name='tel' placeholder='Téléphone' required/><br><br>
            <input class="champ" type='mail' name='mail' placeholder='E-mail' required/><br><br>
        </div>
        </div>
        <div class="row" id='type_etudiant'>
        <div class="col-md-6">
                <label for='boursier'>Boursier</label>
                <input type='radio' id='boursier' name='boursier' value='boursier' required><br><br>
        </div>
        <div class="col-md-6">  
                <label for='non_boursier'>Non_boursier</label>
                <input type='radio' id='non_boursier' name='boursier' value='non_boursier' required><br><br>
        </div> 
        </div> 
        <div class="row" >
        <div class="col-md-6" id='type_bourse'>
            <label for='pensionnaire'>Type de Bourse</label> 
                <select id="pensionnaire" name='pensionnaire' class='form-control' >
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
                        </select> <br><br>
                </div>
                <div class="col-md-6" id='pas_de_bourse'>
                <label for='adresse'>Adresse</label> <br>
                 <input  id='adresse' type='text' name='adresse' placeholder='adresse' /><br>
                </div>
                </div>
                <div class="row" id='type_boursier'>
                <div class="col-md-6">    
                <label for='logé'>Type de Boursier</label>  <br>

            <input type='radio' id='logé' name='logé' value='logé' >
            <label for='logé'>Logé</label>   
            
            <input type='radio' id='non_logé' name='logé' value='non_logé' >
            <label for='non_logé'>Non_logé</label> <br><br><br>
            </div>
                </div>
            
                <div class="row" id='logement'>
                <div class="col-md-6">  
            <label for='chambre'>Chambre du logé</label> <br>
            <select id="chambre" name='chambres' class='form-control' >
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
                </div>
                </div>
                <div class="row ajouter">
                <div class="col-md-12"> 
                <input type='submit' name='ajouter' value='Ajouter' classe=''><br><br>
                </div>
                </div>
                
            </form>
            </div>
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
            echo "
                <form method='post' action=''>
                <input type='text' id='champ' name='matricule'placeholder='Entrer le matricule' required/>
                <input type='submit' name='rechercher' value='Envoyer' classe='' ><br><br>
                </form>";


            if (isset($_POST['rechercher'])){
                $this->id=$_POST['matricule'];
                }
                
        }

        public function add_chambre(){

                ?>
                
                <form method='post' action=''>
                <div class="container">
                <div class='row chambres'>
                <div class='col-md-12'>
                <select id="ch" name='ch' class='form-control' required>
                        <?php
                                $db= new Base_de_donnees("");
                                $datas=$db->Connexion();
                                $req = $datas->query("select * from batiments");
                                $result = $req->fetchAll();
                                foreach ($result as $req)
                                {
                                        $idbat=$req['id_batiments'];
                                        $res=$req['nom_batiment'];
                                        echo "<option value=$res required>".$res."</option>";
                                }  
                        ?>
                </select>
                </div>
                </div>
                <div class='row ajouter'>
                <div class='col-md-12'>
                <input type='submit' name='add' value='Ajouter' id='ajouter' >
                </div>
                </div>
                </div>
                </form>
                <?php
                if (isset($_POST['add'])){
                $this->ch=$_POST['ch'];
                $this->idbat=$idbat;
                }
        
        }
        

        public function table(){
                ?>

        <div class="container">
       
       <div class="row">
       <div class="col-md-12"> 
       <table id="example" class="display" style="width:100%">
               <thead>
                   <tr classe='table'>
                       <th scope='col' classe='table'>Matricule</th>
                       <th scope='col' classe='table'>Nom</th>
                       <th scope='col' classe='table'>Prénom</th>
                       <th scope='col' classe='table'>E-mail</th>
                       <th scope='col' classe='table'>Téléphone</th>
                       <th scope='col' classe='table'>Date de naissance</th>
                   </tr>
                   </thead>

                        
                <?php
                
        }
        public function table_boursier(){
                ?>

        <div class="container">
       
       <div class="row">
       <div class="col-md-12"> 
       <table class='table table-striped  table-responsive'>
               <thead>
                   <tr classe='table'>
                       <th scope='col' classe='table'>Matricule</th>
                       <th scope='col' classe='table'>Nom</th>
                       <th scope='col' classe='table'>Prénom</th>
                       <th scope='col' classe='table'>E-mail</th>
                       <th scope='col' classe='table'>Téléphone</th>
                       <th scope='col' classe='table'>Date de naissance</th>
                       <th scope='col' classe='table'>Type de boursier</th>
                       <th scope='col' classe='table'>Montant bourse</th>


                   </tr>
                   </thead>

                        
                <?php
                
        }
        public function table_non_boursier(){
                ?>

        <div class="container">
       
       <div class="row">
       <div class="col-md-12"> 
       <table class='table table-striped  table-responsive'>
               <thead>
                   <tr classe='table'>
                       <th scope='col' classe='table'>Matricule</th>
                       <th scope='col' classe='table'>Nom</th>
                       <th scope='col' classe='table'>Prénom</th>
                       <th scope='col' classe='table'>E-mail</th>
                       <th scope='col' classe='table'>Téléphone</th>
                       <th scope='col' classe='table'>Date de naissance</th>
                       <th scope='col' classe='table'>Adresse</th>

                   </tr>
                   </thead>

                        
                <?php
                
        }
        public function table_logé(){
                ?>

        <div class="container">
       <div class="row">
       <div class="col-md-12"> 
       <table class='table table-striped  table-responsive'>
               <thead>
                   <tr classe='table'>
                       <th scope='col' classe='table'>Matricule</th>
                       <th scope='col' classe='table'>Nom</th>
                       <th scope='col' classe='table'>Prénom</th>
                       <th scope='col' classe='table'>E-mail</th>
                       <th scope='col' classe='table'>Téléphone</th>
                       <th scope='col' classe='table'>Date de naissance</th>
                       <th scope='col' classe='table'>Nom Chambre</th>

                   </tr>
                   </thead>

                        
                <?php
                
        }

      
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getMatricule()
        {
                return $this->matricule;
        }

        public function setMatricule($matricule)
        {
                $this->matricule = $matricule;

                return $this;
        }

        public function getNom()
        {
                return $this->nom;
        }

        public function setNom($nom)
        {
                $this->nom = $nom;

                return $this;
        }

        public function getPrenom()
        {
                return $this->prenom;
        }

        public function setPrenom($prenom)
        {
                $this->prenom = $prenom;

                return $this;
        }

        public function getDate()
        {
                return $this->date;
        }

        public function setDate($date)
        {
                $this->date = $date;

                return $this;
        }

        public function getTel()
        {
                return $this->tel;
        }

        public function setTel($tel)
        {
                $this->tel = $tel;

                return $this;
        }

        public function getMail()
        {
                return $this->mail;
        }

       
        public function setMail($mail)
        {
                $this->mail = $mail;

                return $this;
        }

        public function getBoursier()
        {
                return $this->boursier;
        }

        public function setBoursier($boursier)
        {
                $this->boursier = $boursier;

                return $this;
        }

        public function getAdresse()
        {
                return $this->adresse;
        }

       
        public function setAdresse($adresse)
        {
                $this->adresse = $adresse;

                return $this;
        }

        public function getLogé()
        {
                return $this->logé;
        }

        public function setLogé($logé)
        {
                $this->logé = $logé;

                return $this;
        }

        public function getPensionnaire()
        {
                return $this->pensionnaire;
        }

        public function setPensionnaire($pensionnaire)
        {
                $this->pensionnaire = $pensionnaire;

                return $this;
        }

        public function getChambre()
        {
                return $this->chambre;
        }

        public function setChambre($chambre)
        {
                $this->chambre = $chambre;

                return $this;
        }

        public function getCh()
        {
                return $this->ch;
        } 
        public function setCh($ch)
        {
                $this->ch = $ch;

                return $this;
        }

        public function getIdbat()
        {
                return $this->idbat;
        }
        public function setIdbat($idbat)
        {
                $this->idbat = $idbat;

                return $this;
        }
}
?>
               
 


        </body>
</html>