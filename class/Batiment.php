<?php
    function chargerClasse8($classe)
    {
        require $classe.'.php';
    }
    spl_autoload_register('chargerClasse8');

    class Batiment
    {
        public function addbat($donne)
        {
           $donnee = strtoupper($donne);
           $db=Database::connect("universite");

           try
           {
            
            $bat = $db->prepare('INSERT INTO batiment(nom_batiment) VALUES(?)');
            $bat->execute(array($donnee));
           }
           catch(Exception $e)
           {
               //die();
           }
           
           return;
        }
        public function addchambre($num,$idbat)
        {
           $num = (int) $num;
           $idbat = (int) $idbat;
           $db=Database::connect("universite");

           try
           {
            
            $bat = $db->prepare('INSERT INTO chambre(numero,id_batiment) VALUES(?,?)');
            $bat->execute(array($num,$idbat));
           }
           catch(Exception $e)
           {
               
           }
           
           return;
        }
        public function findBat()
        {
            try
            {
                $db=Database::connect("universite");
                $q = $db->query('SELECT * FROM batiment');
                
                //comme on doit afficher un tableau on crée une variable tableau qui recevra le résultat du tableau
                $etudiants = [];
                
                while($donnees = $q->fetch(PDO::FETCH_ASSOC))
                {
                    $etudiants[] = $donnees; 
                }
            }
            catch(Exception $e)
            {
               echo 'Erreur';
            }
            
            return $etudiants;
        }

        public function findChambre()
        {
            try
            {
                $db=Database::connect("universite");
                $q = $db->query('SELECT * FROM chambre');
                
                //comme on doit afficher un tableau on crée une variable tableau qui recevra le résultat du tableau
                $etudiants = [];
                
                while($donnees = $q->fetch(PDO::FETCH_ASSOC))
                {
                    $etudiants[] = $donnees; 
                }
            }
            catch(Exception $e)
            {
               echo 'Erreur';
            }
            
            return $etudiants;
        }

        public function findChambrebat()
        {
            try
            {
                $db=Database::connect("universite");
                $q = $db->query('SELECT numero,nom_batiment 
                                 FROM batiment 
                                 LEFT JOIN chambre 
                                 ON batiment.id = chambre.id_batiment');
                
                //comme on doit afficher un tableau on crée une variable tableau qui recevra le résultat du tableau
                $etudiants = [];
                
                while($donnees = $q->fetch(PDO::FETCH_ASSOC))
                {
                    $etudiants[] = $donnees; 
                }
            }
            catch(Exception $e)
            {
               echo 'Erreur';
            }
            
            return $etudiants;
        }
    }

?>