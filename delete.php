<?php
    function chargerClasse5($classe)
    {
    require 'class/'.$classe. '.php';
    }
    spl_autoload_register('chargerClasse5');
    $db = Database::connect("universite");
    $delete = new EtudiantService($db);
   
    $reussie = "Etes vous sur de vouloir supprimer cet étudiant ?";
    $id = 0;
    $oui = '<button type="submit" class="btn btn-warning">Oui</button>';
    $non = '<a class="btn btn-default" href="index.php">Non</a>';

    /*on récupére la matricule envoyé par a page index.php via le GET et on l'affecte a $id
    ensuite on affiche cette valeur dans un input qu'on va caher pour pouvoir le récuppérer
    et faire notre traiment avec*/
    if(!empty($_GET['matricule'])) 
    {
        $id = $delete->checkInput($_GET['matricule']);
    }

    if(!empty($_POST)) 
    {
        //on récupére la valeur de la matricule depuis l'input caché et on l'affecte a nouveau a notre $id
        $id = $delete->checkInput($_POST['matricule']);
        $delete->delete($id);
        Database::disconnect();
        //header("Location: index.php"); 
        $oui = "";
        $non = "";
        $reussie = 'Etudiant supprimer';
    }

?>

<!DOCTYPE html>
<html>
<head>
        <title>SA UNIVERSITE</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>     
        <script type="text/javascript" charset="utf8" src="js/script.js"></script>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    
    <body>
        <h1 class="text-logo"> SA UNIVERSITE </h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Supprimer un étudiant</strong></h1>
                <br>
                <form class="form" action="delete.php" role="form" method="post">
                    <input type="hidden" name="matricule" value="<?php echo $id;?>"/>
                    <p class="alert alert-warning"><?php echo $reussie; ?></p>
                    <div class="form-actions">
                      <?php echo $oui; ?>
                      <?php echo $non; ?>
                      <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>

