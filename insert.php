<?php
    function chargerClasse7($classe)
    {
    require 'class/'.$classe . '.php';
    }
 
     spl_autoload_register('chargerClasse7');
     $db = Database::connect('universite');
     $service = new EtudiantService($db);
 
     //on initialise tous nos varibles qui nous permettent l'affichage d'erreur, à vide
     $okInsertion = $bourseError = $nomError = $prenomError = $dateError = $telError = $emailError = $matriculeError = $name = $prenom = $date = $tel = $email = $matricule = "";
    if(!empty($_POST)) 
    {
        $nom       = $service->checkInput($_POST['nom']);
        $prenom    = $service->checkInput($_POST['prenom']);
        $date      = $service->checkInput($_POST['date']);
        $tel       = $service->checkInput($_POST['tel']); 
        $email     = $service->checkInput($_POST['email']);
        $matricule = $service->checkInput($_POST['matricule']);
        $isSuccess = true;
        $insert = true;
      
        //permet d'afficher un message d'ereur si le champ requis n'est pas rempli
        if(empty($nom)) 
        {
            $nomError = 'Ce champ ne peut pas être vide*';
            $isSuccess = false;
        }
        if(empty($prenom)) 
        {
            $prenomError = 'Ce champ ne peut pas être vide*';
            $isSuccess = false;
        } 
        if(empty($date)) 
        {
            $dateError = 'Ce champ ne peut pas être vide*';
            $isSuccess = false;
        } 
        if(empty($tel)) 
        {
            $telError = 'Ce champ ne peut pas être vide*';
            $isSuccess = false;
        }
        if(empty($email)) 
        {
            $emailError = 'Ce champ ne peut pas être vide*';
            $isSuccess = false;
        }
        if(empty($matricule)) 
        {
            $matriculeError = 'Ce champ ne peut pas être vide*';
            $isSuccess = false;
        }

        //si tout les champs requis sont remplis on peut alors passer a l'exécution de notre code d'insertion
        if($isSuccess) 
        {
            //verifiaction de l'email
            foreach($service->findAll() as $val) 
            {
                if($val['email']==$email)
                {
                    $emailError='Cet email existe déjà';
                    $insert = false;
                }
            }
            
            //Impossibilité de remplir les trois cases
            if(!empty($_POST['bourse']) && !empty($_POST['adresse']) && !empty($_POST['chambre']))
            {
                echo 'boulgnou yapp';
            }


            //ajout d'un étudiant boursier et non logé
            elseif((!empty($_POST['bourse']) && !empty($_POST['adresse'])) && empty($_POST['chambre']) )
            {
                $id_bourse = $service->checkInput($_POST['bourse']);
                $adresse   = $service->checkInput($_POST['adresse']);
                $etudiant  = new Non_boursier($matricule,$nom,$prenom,$email,$tel,$date,$adresse);
                $etudiant1 = new Boursier($matricule,$nom="",$prenom="",$email="",$tel="",$date="",$id_bourse);
                $service->add($etudiant);
                $service->add($etudiant1);
                
                //header("Location: index.php");
            }
            //ajout d'un étudiant logé qui est forcément boursier
            elseif(!empty($_POST['bourse']) && !empty($_POST['chambre']))
            {
                $id_bourse = $_POST['bourse'];
                //on ajoute que les étudiants qui ont une bourse entiére
                if($id_bourse == 1)
                {
                    $id_chambre = $service->checkInput($_POST['chambre']);
                    $etudiant = new Est_loge($matricule,$nom,$prenom,$email,$tel,$date,$id_bourse,$id_chambre);
                    $service->add($etudiant);
                    //header("Location: index.php");
                    
                }
                else
                {
                    echo $bourseError = 'Les étudiants bénéficiants de demi bourse ne peuvent pas logés';
                }
               
            }
            //ajout d'un étudiant non logé ou non boursier
            elseif(!empty($_POST['adresse']) && (empty($_POST['bourse']) && empty($_POST['chambre'])) )
            {
                $adresse = $service->checkInput($_POST['adresse']);
                $etudiant = new Non_boursier($matricule,$nom,$prenom,$email,$tel,$date,$adresse);
                $service->add($etudiant);
            
               // header("Location: index.php");
            }
            else
            {
                echo $bourseError = 'Saisir un type de bourse';
            }

            if($insert)
            {
                $okInsertion = '<p style = "color : green" >Inscription étudiant réussie cliquez sur <a href="index.php">retour</a></p>';
            }
            else
            {
                $okInsertion ='<p class = "help-inline" >Veuillez vérifier les données saisies !</p>';
            }
        }
    }
    Database::disconnect();
?> 

<?php require 'menu.php' ?>
        <div class="container admin">
            <div class="row">
                <?php echo $okInsertion; ?>
                <h1><strong>Inscription Etudiant</strong></h1>
                <form class="form" action="insert.php" role="form" method="post">
                    <br>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" value="<?php if(isset($_POST['nom'])){echo $_POST['nom'];} ?>">
                            <span class="help-inline"><?php echo $nomError;?></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" placeholder="Prenom" name="prenom" value="<?php if(isset($_POST['prenom'])){echo $_POST['prenom'];} ?>" >
                            <span class="help-inline"><?php echo $prenomError;?></span>
                        </div>
                        <!-- </div> -->
                        <div class="form-group col-sm-6">
                            <label for="date">Date de naissance</label>
                            <input type="date" class="form-control" id="date" placeholder="Date de naissance" name="date" value="<?php if(isset($_POST['date'])){echo $_POST['date'];} ?>">
                            <span class="help-inline"><?php echo $dateError;?></span>
                        </div>
                        <!-- <div class="form-row"> -->
                        <div class="form-group col-sm-6">
                            <label for="tel">Téléphone</label>
                            <input type="tel" class="form-control" id="tel" placeholder="Téléphone" name="tel" value="<?php if(isset($_POST['tel'])){echo $_POST['tel'];} ?>">
                            <span class="help-inline"><?php echo $telError;?></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <i class="fas fa-envelope prefix"></i>
                            <label for="prenom">E-mail</label>
                            <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" >
                            <span class="help-inline"><?php echo $emailError;?></span> 
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="matricule">Matricule</label>
                            <input type="number" class="form-control" id="matricule" name="matricule" value="<?php  $db = Database::connect("universite");        
                                                                                                                   $req = new EtudiantService($db);
                                                                                                                   $req->autoIncrement(); 
                                                                                                                   Database::disconnect();                               
                                                                                                            ?>" readonly>
                            <span  style="color : green"><?php echo $matriculeError="Matricule remplie automatiquement*";?></span>
                        </div>
                        <br/>
                        
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" id="rbourse">
                                <label class="form-check-input1" for="rbourse" >Boursier</label>
                                <select class="mdb-select md-form" id="sbourse" name="bourse">
                                    <option disabled selected>Tyde de bourse</option>
                                    <?php
                                        //affichage de données récupérer sur notre base de données dans la table bourse
                                        $db = Database::connect("universite");
                                        foreach ($db->query('SELECT * FROM bourse') as $row) 
                                        {
                                            echo '<option value="'. $row['id'] .'">'. $row['libelle'] . '</option>';
                                        }
                                        Database::disconnect();
                                    ?>
                                </select>
                                <span class="help-inline"><?php echo $bourseError;?></span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" id="nbourse" value="non_boursier">
                                <label class="form-check-label" for="nbourse">Non boursier/Non logé</label>
                                <input class="form-control-plaintex" type ="text" name="adresse" id="adresse" placeholder="Adresse">     
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="loge" name="radio">
                                <label class="form-check-label" for="loge">Logé</label>
                                <select class="mdb-select" id="chambre" name="chambre">
                                    <option value="" disabled selected>Chambres &nbsp &nbsp &nbspBatiments</option>
                                    <?php
                                        //affichage de données récupérer sur notre base de données dans la table chambre
                                        $db = Database::connect("universite");
                                        foreach ($db->query('SELECT * FROM chambre') as $row) 
                                        {
                                            echo '<option value="'. $row['id'] .'">'."Chambre ". $row['numero'] ."  &nbsp &nbsp Batiment ". $row['id_batiment'] . '</option>';
                                        }
                                        Database::disconnect();
                                    ?>
                                </select>
                            </div>
                        </div>        
                        <br/>
                        <br/>
                    </div>
                   
                    <div class="row">  
                        <div class="col-lg-5"></div>
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </form>
            </div>
        </div>  
    </body>
</html>