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
        <script type="text/javascript">
            $(document).ready(function() 
            {
                $('#sbourse').hide();
                $('#adresse').hide();
                $('#chambre').hide();

                $("#rbourse").click(function()
                {
                    $('#sbourse').show();
                    $('#adresse').show();
                });

                $("#loge").click(function()
                {
                    $('#chambre').show();
                    $('#adresse').hide();
                });

                $("#nbourse").click(function()
                {
                    $('#adresse').show();
                    $('#chambre').hide();
                    $('#sbourse').hide();
                  
                });
            });

            
        </script>
    </head>
    
    
    <body>
        <div class="container site">
            <h1 class="text-logo"> SA UNIVERSITE </h1>
            <nav>
                <ul class="nav nav-pills">
                    <li class="after" ><a href="index.php" >Etudiants</a></li>
                    <li><a href="insert.php" >Inscription </a></li>
                    <li><a href="boursier.php" >Boursiers</a></li>
                    <li><a href="non_boursier.php" >Non Boursiers</a></li>
                    <li><a href="loge.php" >Logés</a></li>
                    <li><a href="non_loge.php" >Non logés</a></li>
                    <li><a href="batiment.php" >Logements</a></li>
                </ul>
            </nav>
        </div>