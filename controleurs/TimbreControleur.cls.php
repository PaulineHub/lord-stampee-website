<?php
class TimbreControleur extends Controleur
{
    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        /* if(!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/index');
        } */
    }

    /**
     * Méthode invoquée par défaut si aucune action n'est indiquée.
     */
    public function index($params)
    {
        $this->gabarit->affecterActionParDefaut('tout');
        $this->tout($params);

    }

    /**
     * Affichage de tous les timbres.
     *  Route associée: timbre/tout
     */
    public function tout($params)
    {
        $this->gabarit->affecter('timbres', $this->modele->tout());
    }

    /**
      * Affichage du détail d’un timbre lorsqu’un timbre particulier est cliqué.
     *  Route associée : timbre/un
     */
    public function un($tim_id)
    {
        // Chercher les timbres de la BD 
        $resultat = $this->modele->un($tim_id);

        // Injecte le résultat dans la 'vue'
        $this->gabarit->affecter('timbre', $resultat);

        return $resultat;
        Utilitaire::nouvelleRoute('timbre/un');
    }

    /**
     * Affichage de tous les timbres d'un utilisateur.
     *  Route associée: timbre/utilisateur
     */
    public function utilisateur($params)
    {
        $this->gabarit->affecter('uti_timbres', $this->modele->tout($_SESSION["utilisateur"]->uti_id));
    }

    /**
     * Ajout d'un timbre.
     *  Route associée: timbre/ajouter
     */
    public function ajouter() 
    {
        $this->modele->ajouter($_POST, $_SESSION["utilisateur"]->uti_id);
        Utilitaire::nouvelleRoute('timbre/tout');
    }

    /**
     * Modification d'un timbre.
     *  Route associée: timbre/changer
     */
    public function changer() 
    {
        $this->modele->changer($_POST, $_SESSION["utilisateur"]->uti_id);
        Utilitaire::nouvelleRoute('timbre/tout');
    }

    /**
     * Suppression d'un timbre.
     *  Route associée: timbre/retirer
     */
    public function retirer() 
    {
        $this->modele->retirer($_POST['ctc_id']);
        Utilitaire::nouvelleRoute('timbre/tout');
    }

    /**
     * Recherche d'un timbre.
     *  Route associée: timbre/rechercher
     */
    public function rechercher() 
    {
        if($_POST['recherche'] != "") {
            $recherche = "%" . $_POST['recherche'] . "%";
            $this->gabarit->affecter('timbres', $this->modele->rechercher($recherche, $_SESSION["utilisateur"]->uti_id));
        }
    }

}