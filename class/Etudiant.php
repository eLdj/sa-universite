<?php
    
    abstract class Etudiant
    {
        protected $matricule;
        protected $nom;
        protected $prenom;
        protected $email;
        protected $tel;
        protected $date_naissance;

        public function __construct($matricule,$nom,$prenom,$email,$tel,$date_naissance)
        {
            $this->setMatricule($matricule);
            $this->setNom($nom);
            $this->setPrenom($prenom);
            $this->setEmail($email);
            $this->setTel($tel);
            $this->setDate_naissance($date_naissance);
        }

        public function getMatricule()
        {
            return $this->matricule;
        }

        public function setMatricule($matricule)
        {
            $this->matricule = $matricule;

            return $this;
        }

        
        public function getNom()
        {
            return $this->nom;
        }

        
        public function setNom($nom)
        {
            $this->nom = $nom;

            return $this;
        }

        public function getPrenom()
        {
            return $this->prenom;
        }

        public function setPrenom($prenom)
        {
            $this->prenom = $prenom;

            return $this;
        }

        public function getEmail()
        {
            return $this->email;
        }

        
        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

      
        public function getTel()
        {
            return $this->tel;
        }

        
        public function setTel($tel)
        {
            $this->tel = $tel;

            return $this;
        }

       
        public function getDate_naissance()
        {
            return $this->date_naissance;
        }

       
        public function setDate_naissance($date_naissance)
        {
            $this->date_naissance = $date_naissance;

            return $this;
        }
    }

?>