<?php 
 
 function chargerClasse1($classe)
 {
     require $classe . '.php';
 }
 
 spl_autoload_register('chargerClasse1');

class Non_boursier extends Etudiant
{
    private $adresse; 
    //création de notre constructeur qui doit doit prendre en paramétre tous les paramétres de sont parents plus les tiens
    public function __construct($matricule,$nom,$prenom,$email,$tel,$date_naissance,$adresse)
    {
        parent::__construct($matricule,$nom,$prenom,$email,$tel,$date_naissance);
        $this->setAdresse($adresse);
    }
    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

}

?>