<?php 
    
    function chargerClasse($classe)
    {
    require $classe .'.php';
    }

    spl_autoload_register('chargerClasse');

    $db = Database::connect("universite");

    class EtudiantService 
    {
        private $_db;

        //Cette constructeur permet a notre classe EtudiantService de se connecter à notre base de donneé
        public function __construct($db)
        {
            $this->setDb($db);
        }
        
        public function setDb(PDO $db)
        {
            $this->_db = $db;
            return $this;
        }
        
        //Fonction ajout d'un étudiant
        public function add(Etudiant $etudiant)
        {
            try
            {
                $q = $this->_db->prepare('INSERT INTO etudiant(matricule, nom, prenom, email, tel, date_naissance) 
                                         VALUES (?,?,?,?,?,?)');
                $q->execute(array($etudiant->getMatricule(),$etudiant->getNom(),$etudiant->getPrenom(),$etudiant->getEmail(),$etudiant->getTel(),$etudiant->getDate_naissance()));
            }
            catch(Exception $e)
            {

            } 
            //Ajout d'un etudiant boursier
            if(get_class($etudiant)=='Boursier')
            { 
                try
                {
                $q = $this->_db->prepare('INSERT INTO boursier(matricule_etudiant,id_bourse) 
                                         VALUES (?,?)');

                $q->execute(array($etudiant->getMatricule(),$etudiant->getId_bourse()));
                }
                catch(Exception $e)
                {
                    
                }
            }  
            
            //Ajout d'un etudiant non boursier 
            elseif(get_class($etudiant)=='Non_boursier')
            {
                try
                {
                    $q = $this->_db->prepare('INSERT INTO non_boursier(matricule_etudiant,adresse) 
                    VALUES (?,?)');
    
                    $q->execute(array($etudiant->getMatricule(),$etudiant->getAdresse()));
                }
                catch(Exception $e)
                {
                   
                }
               
            }
            
            //Ajout d'un etudiant logé
            elseif(get_class($etudiant)=='Est_loge')
            {
                try
                {
                    $q = $this->_db->prepare('INSERT INTO boursier(matricule_etudiant,id_bourse) 
                                              VALUES (?,?)');
                    $q->execute(array($etudiant->getMatricule(),$etudiant->getId_bourse()));
                    
                    $q1 = $this->_db->prepare('INSERT INTO  est_loge(etu_boursier,id_chambre)
                                               VALUES (?,?)');
                    $q1->execute(array($etudiant->getMatricule(),$etudiant->getId_chambre()));
                    
                }
                catch(Exception $e)
                {
                    
                }
               
            }                
            return;
        } 

        //Cette methode permet de mettre a jour les données des étudiant
        public function update($matricule,$nom,$prenom,$date,$tel,$email)
        {
            try
            {
                $q = $this->_db->prepare("UPDATE etudiant SET nom = ?, prenom = ?, date_naissance = ?, tel= ?, email = ?
                                      WHERE matricule = ?");
                $q->execute(array($nom,$prenom,$date,$tel,$email,$matricule));
            }
            catch(Exception $e)
            {
                
            }
            
            return;     
        }
        
        //supprimer un étudiant
        public function delete($matricule)
        {
            try
            {
                $q = $this->_db->prepare('DELETE FROM etudiant WHERE matricule = ?');
                $q->execute(array($matricule));
            }
            
            catch(Exception $e)
            {
             
            }
            return;
        }
        
        //Permet de récupérer le matricule auto_incrément et de l'afficher sur un input
        public function autoIncrement()
        {
            try
            {
                $result = $this->_db->query("SHOW TABLE STATUS LIKE 'etudiant'");
                $get = $result->fetch();
                echo $get['Auto_increment'];                
            }
            catch(Exception $e)
            {
               
            }
            return;
           
        }
        
        //Recherche d'un étudiant via son matricule
        public function find($matricule)
        {
            try
            {
                $matricule = (int) $matricule;
                $q = $this->_db->query('SELECT * FROM etudiant WHERE matricule ='.$matricule); 
            }
            catch(Exception $e)
            {
               
            }
                      
            return $q->fetch(PDO::FETCH_ASSOC);          
        }
        
        //Affiche tous les étudiants de notre base
        public function findAll()
        {
            try
            {
                $q = $this->_db->query('SELECT * FROM etudiant');
                
                //comme on doit afficher un tableau on crée une variable tableau qui recevra le résultat du tableau
                $etudiants = [];
                
                while($donnees = $q->fetch(PDO::FETCH_ASSOC))
                {
                    $etudiants[] = $donnees; 
                }
            }
            catch(Exception $e)
            {
               
            }
            
            return $etudiants;
        }

        //On recherche un etudiant boursier c'est pourquoi on fait une requête avec jointure de la table boursier
        public function findBoursier($matricule)
        {
            $matricule = (int) $matricule;
            try
            {
                $q = $this->_db->query('SELECT matricule,prenom,nom,date_naissance,email,tel 
                                    FROM etudiant 
                                    INNER JOIN boursier  
                                    ON etudiant.matricule = boursier.matricule_etudiant 
                                    WHERE etudiant.matricule='.$matricule);
                $donnees = $q->fetch(PDO::FETCH_ASSOC);
            }
            catch(Exception $e)
            {
                
            }
            
            return $donnees;
        }
        
        //Même logique que la fonction find()
        public function findAllBoursier()
        {
            $q = $this->_db->query('SELECT matricule_etudiant,prenom,nom,date_naissance,email,tel,montant 
                                    FROM etudiant JOIN boursier 
                                    ON etudiant.matricule = boursier.matricule_etudiant
                                    INNER JOIN bourse
                                    ON boursier.id_bourse = bourse.id ');
           
           $etudiants = [];

           while($donnees = $q->fetch(PDO::FETCH_ASSOC))
           {
               $etudiants[] = $donnees; 
           }

           return $etudiants;
        }

        //fonction pour lister tous les non logés
        public function nonLoge()
        {
            $q = $this->_db->query('SELECT matricule_etudiant,prenom,nom,date_naissance,email,tel,adresse 
                                    FROM etudiant INNER JOIN non_boursier 
                                    ON etudiant.matricule = non_boursier.matricule_etudiant');
           
           $etudiants = [];

           while($donnees = $q->fetch(PDO::FETCH_ASSOC))
           {
               $etudiants[] = $donnees; 
           }

           return $etudiants;
        }
        public function findNonBoursier()
        {
            $q = $this->_db->query('SELECT matricule_etudiant,prenom,nom,date_naissance,email,tel,adresse 
                                    FROM etudiant INNER JOIN non_boursier 
                                    ON etudiant.matricule = non_boursier.matricule_etudiant
                                    WHERE NOT EXISTS (select * FROM boursier WHERE boursier.matricule_etudiant = etudiant.matricule)');
           
           $etudiants = [];

           while($donnees = $q->fetch(PDO::FETCH_ASSOC))
           {
               $etudiants[] = $donnees; 
           }

           return $etudiants;
        }

        public function estLoge()
        {
            $q = $this->_db->query('SELECT matricule,prenom,nom,tel,email,numero,nom_batiment
                                    FROM etudiant INNER JOIN boursier
                                    ON etudiant.matricule = boursier.matricule_etudiant
                                    INNER JOIN est_loge
                                    ON boursier.matricule_etudiant = est_loge.etu_boursier
                                    INNER JOIN chambre
                                    ON est_loge.id_chambre = chambre.id
                                    INNER JOIN batiment 
                                    ON chambre.id_batiment = batiment.id');

            $etudiants = [];

            while($donnees = $q->fetch(PDO::FETCH_ASSOC))
            {
                $etudiants[] = $donnees; 
            }

            return $etudiants;
        }

        //verification des données transmises
        function checkInput($data) 
        {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
        public function checkStatut()
        {

        }
    }

    //$sup = new EtudiantService($db);
    //$test=$sup->update(5,'Dieng','Souleymaneaa','2014-06-20',775211412,'jul@jul.sn');
   // var_dump($test);
?>