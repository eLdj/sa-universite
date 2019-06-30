<?php require 'menu.php';?>
            <div class="container admin">
            <div class="row">
                <h1><strong>Liste des étudiants</strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
                <table id="table" class="table table-striped table-bordered display" style="width:100%">
                  <thead>
                    <tr>
                      <th>Matricule</th> 
                      <th>Prénom</th>
                      <th>Nom</th>
                      <th>Date de naissance</th>
                      <th>Tel</th>
                      <th>E-mail</th>
                      <th>Modifications</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                       //fonction autoload pour le chargement automatique de nos class       
                      function chargerClasse5($classe)
                      {
                        require 'class/'.$classe.'.php';
                      }
                      spl_autoload_register('chargerClasse5');

                      //connection a notre base de données
                      $db = Database::connect('universite');

                      //la classe EtudiantService doit recevoir la variable ($db) de connection pour pouvoir exécuter les requêtes
                      $service = new EtudiantService($db);
                      
                      //Une fonction foreach pour l'affichage de la table etudiant
                      foreach($service->findAll() as $val) 
                      {
                        echo '<tr>';
                        echo '<td>'."ET".$val['matricule'].'</td>';
                        echo '<td>'.$val['prenom'].'</td>';
                        echo '<td>'.$val['nom'].'</td>';
                        echo '<td>'.$val['date_naissance'].'</td>';
                        echo '<td>'.$val['tel'].'</td>';
                        echo '<td>'.$val['email'].'</td>';
                        echo '<td>';
                        echo '<a class="btn btn-primary" href="update.php?matricule='.$val['matricule'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="delete.php?matricule='.$val['matricule'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                        echo '</td>';
                        echo '</tr>';
                      }
                      Database::disconnect();
                    ?>
                  </tbody>
                </table>
            </div>
        </div>
        </div>
    </body>
</html>

