<?php



?>
            <form method="post" action="">
                <input  type="text" name="matricule" placeholder="matricule" required/><br>
                <input  type="text" name="nom" placeholder=" nom" required/><br>
                <input  type="text" name="prenom" placeholder="prénom" required/><br>
                <input  type="date" name="datenaissance" placeholder="date de naissance" required/><br>
                <input  type="number" name="tel" placeholder="téléphone" required/><br>
                <input  type="mail" name="mail" placeholder="mail" required/><br>
                
                <input type="radio" id="boursier" name="boursier" value="boursier"  class="form-control" required>
                <label for="admin">Boursier</label></div>
                <input type="radio" id="pensionnaire" name="pensionnaire" value="pensionnaire"  class="form-control" required>
                <label for="admin">Pensionnaire</label></div>

                <div class="col-md-6"><input type="radio" id="demi-pensionnaire" name="pensionnaire" value="demi-pensionnaire"  class="form-control" required>
                <label for="user">Demi-Pensionnaire</label></div><br><br>

                <div class="col-md-6"><input type="radio" id="non_boursier" name="boursier" value="non_boursier"  class="form-control" required>
                <label for="user">Non_boursier</label></div><br><br>
                <input class="form-control" type="text" name="adresse" placeholder="Entrer votre adresse" required/><br>
                <input type="radio" id="logé" name="logé" value="logé"  class="form-control" required>
                <label for="admin">Logé</label></div>
                <select name="chambres" class="form-control">
                <?php
                     
                ?>
                </select><br>
                <select name="batiments" class="form-control">
                <?php
                     
                ?>
                </select><br>
                <div class="col-md-6"><input type="radio" id="logé" name="logé" value="non_logé"  class="form-control" required>
                <label for="user">Non_Logé</label></div><br><br>
                
                
                <input type='submit' name='ajouter' value='Ajouter' id='con' ><br><br>

            </form>
        <?php
            if(isset($_POST['ajouter'])){
                $nom=$_POST['nom'];
                $prenom=$_POST['prenom'];
                $date=$_POST['datenaissance'];
                $tel=$_POST['tel'];
                $mail=$_POST['mail'];
                $matricule=$_POST['matricule'];
                $boursier=$_POST['boursier'];
                $logé=$_POST['logé'];
                }
        ?>