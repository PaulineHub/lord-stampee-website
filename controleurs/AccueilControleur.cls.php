<?php
class AccueilControleur extends Controleur
{
    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
    }

    /**
     * Affiche les timbres favoris du Lord Stampee.
     */
    public function index()
    {
        $stampee_id = 2;
        $this->gabarit->affecter('stampee_favoris', $this->modele->toutFavoris($stampee_id));

    }

  

}