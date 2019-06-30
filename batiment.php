<?php 
    function chargerClasse9($classe)
    {
    require 'class/'.$classe.'.php';
    }
    spl_autoload_register('chargerClasse9');
    $newbat = new Batiment();
    $db = Database::connect('universite');
    $service = new EtudiantService($db);
    
    $batError2 = $batError = $chambreError =  "";
    $insert = true;

    if(isset($_POST['submit1']))
    {
        $nombat = $service->checkInput($_POST['bat']);
        

        if(empty($_POST['bat']))
        {
            $batError ='<p class = "help-inline" > Veuillez sasir un nom de Batiment !</p>';
        }

        if(!empty($nombat))
        {
            foreach($newbat->findBat() as $val) 
            {
                if($val['nom_batiment']==strtoupper($nombat))
                {
                    $batError ='<p class = "help-inline" > Ce nom de batiment existe déjà !</p>';
                    $insert   = false;
                }
            }
            if($insert)
            {
                $newbat->addbat($nombat);
                $batError= '<p style = "color : green" > Batiment créé avec succés<p/>';
            }
        }
         
    }
    
    
    
    if(isset($_POST['submit2']))
    {
        $idbat = $service->checkInput($_POST['idbat']);
        $num   = $service->checkInput($_POST['num']);
        
        
        if(empty($idbat) && empty($num))
        {
            $batError2     = '<p class = "help-inline" >Selectionnez un nom de Batiment*</p>';
            $chambreError  = '<p class = "help-inline" >Veuillez sasir un numero de chambre*</p>';
        }
    
        if(!empty($num) && !empty($idbat))
        {
            //$idbat = $_POST['idbat'];
            //$num   = $_POST['num'];

            foreach($newbat->findChambre() as $val) 
            {
                if($val['numero']==$num && $val['id_batiment']==$idbat)
                {
                    $chambreError ='<p class = "help-inline" > Ce numero de chambre existe déjà sur ce batiment !</p>';
                    $insert   = false;
                }
            }
            if($insert)
            {
                $newbat->addchambre($num,$idbat);
                $chambreError  = '<p style = "color : green" > Chambre ajoutée avec succés <p/>';  
            }
        }
         
    }
    Database::disconnect();
    
?>

<?php require 'menu.php';?>
<div class="container admin">
    <div class="logement" style="display:block">
        <div class="meme" style="float:right;width:40%">
            <table id="table3" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Numero Chambre</th> 
                    <th>Nom Batiment</th>
                    <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $statut = "-";
                    //fonction autoload pour le chargement automatique de nos class       
                    foreach($newbat->findChambreBat() as $val) 
                    {
                        echo '<tr>';
                        echo '<td>'.$val['numero'].'</td>';
                        echo '<td>'.$val['nom_batiment'].'</td>';
                        echo '<td>';
                            echo $statut;
                        echo '</td>';
                        echo '</tr>';
                    }
                    Database::disconnect();
                ?>
                </tbody>
            </table>
        </div>
        <div class="clear"></div>
        <div class="meme" style="float:right;width:40%">
            <form class="form" method="post" role="form" action="batiment.php">
                <div class="row"> 
                    <div class="col-lg-5"></div>
                        <div class="form-group col-sm-8">
                            <label for="bat">Créer un nouveau batiment</label>
                            <input type="text" class="form-control" id="bat" placeholder="Donner le nom du batiment" name="bat" value="<?php if(isset($_POST['bat'])){echo $_POST['bat'];}?>">
                            <?php echo $batError;?>
                            <br/>
                            <button type="submit" name="submit1" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Créer </button>
                        </div>
                    </div>
                    <br/>
                    <div class="col-lg-5"></div>
                        <div class="form-group col-sm-8">
                            <label for="batiment">Batiment</label>
                            <select class="form-control" id="batiment" name="idbat">
                                <option value="" readonly selected>Choisir un Batiment</option>
                                <?php
                                    //affichage de données récupérer sur notre base de données dans la table chambre
                                    $db = Database::connect("universite");
                                    foreach ($db->query('SELECT * FROM batiment') as $row) 
                                    {
                                        echo '<option value="'.$row['id'].'">'."Batiment &nbsp &nbsp ". $row['nom_batiment'].'</option>';
                                    }
                                    Database::disconnect();
                                ?>
                            </select>
                            <?php echo $batError2;?>
                            <br/>
                            <label for="num">Chambre</label>
                            <input type="number" class="form-control" id="num" placeholder="Ajouter une chambre" name="num" value="<?php if(isset($_POST['num'])){echo $_POST['num'];}?>">
                            <?php echo $chambreError; ?>
                            <br/>               
                            <div class="row">  
                                <div class="col-lg-10"></div>
                                <button type="submit" name="submit2" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter </button>
                                <a class="btn btn-primary" href="insert.php"><span class="glyphicon glyphicon-arrow-left"></span>Inscription</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>    
</div>
</body>
</html>