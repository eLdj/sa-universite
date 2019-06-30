<?php 
    
    function chargerClasse2($classe)
    {
        require $classe . '.php';
    }
    spl_autoload_register('chargerClasse2');



    class Boursier extends Etudiant 
    {
        //protected $matricule_etudiant;
        protected $id_bourse;
      

        public function __construct($matricule,$nom,$prenom,$email,$tel,$date_naissance,$id_bourse)
        {
            parent::__construct($matricule,$nom,$prenom,$email,$tel,$date_naissance);
            $this->setId_bourse($id_bourse);
        }

        public function getId_bourse()
        {
            return $this->id_bourse;
        }


        public function setId_bourse($id_bourse)
        {
            $this->id_bourse = $id_bourse;
            return $this;
        }
    }
?>