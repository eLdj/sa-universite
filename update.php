<?php
     function chargerClasse7($classe)
     {
     require 'class/'.$classe . '.php';
     }
 
     spl_autoload_register('chargerClasse7');
     $db = Database::connect('universite');
     $service = new EtudiantService($db);
 
     //on initialise tous nos varibles qui nous permettent l'affichage d'erreur, à vide
     $bourseError = $nomError = $prenomError = $dateError = $telError = $emailError = $matriculeError = $name = $prenom = $date = $tel = $email = $matricule = "";
     $message="";
    if(!empty($_GET['matricule']))
    {
        //je récuppére la matricule que j'ai envoyé et le stok sur une varible
        $matricule = $service->checkInput($_GET['matricule']);
        //j'appelle ma méthode find() pour extraire les données d'un étudiant que je stock dans des variables pour les afficher dans les inputs text
        $etudiant   = $service->find($matricule);
        
        $matricule  = $etudiant['matricule'];
        $nom        = $etudiant['nom'];
        $prenom     = $etudiant['prenom'];
        $date       = $etudiant['date_naissance'];
        $tel        = $etudiant['tel'];
        $email      = $etudiant['email'];
    }
    
     if(!empty($_POST)) 
    {
        $nom       = $service->checkInput($_POST['nom']);
        $prenom    = $service->checkInput($_POST['prenom']);
        $date      = $service->checkInput($_POST['date']);
        $tel       = $service->checkInput($_POST['tel']); 
        $email     = $service->checkInput($_POST['email']);
        $matricule = $service->checkInput($_POST['matricule']);
        $isSuccess = true;
        
        //permet d'afficher un message d'ereur si le champ requis n'est pas rempli
        if(empty($nom)) 
        {
            $nomError = 'Ce champ ne peut pas être vide*';
            $isSuccess = false;
        }
        if(empty($prenom)) 
        {
            $prenomError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($date)) 
        {
            $dateError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($tel)) 
        {
            $telError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($email)) 
        {
            $emailError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($matricule)) 
        {
            $matriculeError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }

        //si tout les champs requis sont remplis on peut alors passer a l'exécution de notre code d'insertion
        if($isSuccess) 
        {
           $service->update($matricule,$nom,$prenom,$date,$tel,$email);
           $message="Modifications effectuées avec succés cliquez sur retour";
        }
    }
    Database::disconnect();
?> 

<?php require 'menu.php' ?>
        <div class="container admin">
            <div class="row">
                <h1><strong>Modification données Etudiant</strong></h1>
                <form class="form" action="update.php" role="form" method="post">
                    <br>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" value="<?php echo $nom; ?>">
                            <span class="help-inline"><?php echo $nomError;?></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" placeholder="Prenom" name="prenom" value="<?php echo $prenom ?>" >
                            <span class="help-inline"><?php echo $prenomError;?></span>
                        </div>
                        <!-- </div> -->
                        <div class="form-group col-sm-6">
                            <label for="date">Date de naissance</label>
                            <input type="date" class="form-control" id="date" placeholder="Date de naissance" name="date" value="<?php echo $date; ?>">
                            <span class="help-inline"><?php echo $dateError;?></span>
                        </div>
                        <!-- <div class="form-row"> -->
                        <div class="form-group col-sm-6">
                            <label for="tel">Téléphone</label>
                            <input type="tel" class="form-control" id="tel" placeholder="Téléphone" name="tel" value="<?php echo $tel; ?>">
                            <span class="help-inline"><?php echo $telError;?></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <i class="fas fa-envelope prefix"></i>
                            <label for="prenom">E-mail</label>
                            <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php echo $email; ?>" >
                            <span class="help-inline"><?php echo $emailError;?></span> 
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="matricule">Matricule</label>
                            <input type="number" class="form-control" id="matricule" name="matricule" value="<?php echo $matricule; ?>" readonly>
                            <span class="" style="color : green"><?php echo $matriculeError;?></span>
                        </div>  
                        <p style="color: green"><?php echo $message; ?> </p>    
                        <br/>
                        <br/>
                    </div>
                    <div class="row">                       
                    </div>
                    <div class="row">  
                        <div class="col-lg-5"></div>
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier </button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour </a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>