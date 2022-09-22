<?php
class AccueilControleur extends Controleur
{
    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
    }

    /**
     * Méthode invoquée par défaut si aucune action n'est indiquée.
     */
    public function index($params)
    {
        $stampee_id = 2;
        $this->gabarit->affecter('stampee_favoris', $this->modele->toutFavoris($stampee_id));

    }

  

}