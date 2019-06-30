<?php

    function chargerClasse4($classe)
    {
        require $classe . '.php';
    }
    spl_autoload_register('chargerClasse4');

class Est_loge extends Boursier
{
    private $id_chambre;

    //création de notre constructeur qui doit doit prendre en paramétre tous les paramétres de sont parents plus les tiens
    public function __construct($matricule,$nom,$prenom,$email,$tel,$date_naissance,$id_bourse,$id_chambre)
    {
        parent::__construct($matricule,$nom,$prenom,$email,$tel,$date_naissance,$id_bourse);
            $this->setId_chambre($id_chambre);
    }

    public function getId_chambre()
    {
        return $this->id_chambre;
    }

    public function setId_chambre($id_chambre)
    {
        $this->id_chambre = $id_chambre;

        return $this;
    }
}
?>