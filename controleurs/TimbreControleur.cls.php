<?php
class TimbreControleur extends Controleur
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
        $result = $this->modele->un($tim_id);
        $images = $this->modele->unImages($tim_id);
        $ima_main = $images[1][0]->ima_path;
        // Injecte le résultat dans la 'vue'
        $this->gabarit->affecter('timbre', $result);
        $this->gabarit->affecter('images', $images);
        $this->gabarit->affecter('ima_princ_path', $ima_main);

        return $result;

        Utilitaire::nouvelleRoute('timbre/un');
    }

    /**
     * Affichage de tous les timbres d'un utilisateur.
     *  Route associée: timbre/utilisateur
     */
    public function utilisateur($params)
    {
        if(!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/index');
        }
        $this->gabarit->affecter('uti_encheres', $this->modele->toutEncheresCrees($_SESSION["utilisateur"]->uti_id));
        $this->gabarit->affecter('uti_mises', $this->modele->toutMises($_SESSION["utilisateur"]->uti_id));
        $this->gabarit->affecter('uti_favoris', $this->modele->toutFavoris($_SESSION["utilisateur"]->uti_id));
    }

    /**
     * Affichage du formulaire de creation d'un timbre et de son enchere.
     *  Route associée: timbre/creation
     */
    public function creation($params)
    {
        if(!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/index');
        }
        $this->gabarit->affecter('uti_id', $_SESSION["utilisateur"]->uti_id);
        $this->gabarit->affecter('categories', $this->modele->toutCategories());
        $this->gabarit->affecter('conservations', $this->modele->toutConservations());
        $this->gabarit->affecter('pays', $this->modele->toutPays());
    }

    /**
     * Affichage du formulaire de modification d'un timbre et de son enchere.
     *  Route associée: timbre/modification
     */
    public function modification($tim_id)
    {
        if(!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/index');
        }
        $this->gabarit->affecter('uti_id', $_SESSION["utilisateur"]->uti_id);
        $this->gabarit->affecter('categories', $this->modele->toutCategories());
        $this->gabarit->affecter('conservations', $this->modele->toutConservations());
        $this->gabarit->affecter('pays', $this->modele->toutPays());
        $this->gabarit->affecter('timbre', $this->modele->un($tim_id));
    }

    /**
     * Ajout d'un timbre, de ses images et de l'enchere associee.
     *  Route associée: timbre/ajouter
     */
    public function ajouter() 
    {
        $this->modele->ajouter($_POST, $_SESSION["utilisateur"]->uti_id, $_FILES['tim_ima']);
        Utilitaire::nouvelleRoute('timbre/utilisateur');
    }

    /**
     * Modification d'un timbre, de ses images et de l'enchere associee.
     *  Route associée: timbre/changer
     */
    public function changer() 
    {
        $this->modele->changer($_POST, $_SESSION["utilisateur"]->uti_id, $_FILES['tim_ima']);
        Utilitaire::nouvelleRoute('timbre/utilisateur');
    }

    /**
     * Suppression d'un timbre, de ses images et de l'enchere associee.
     *  Route associée: timbre/retirer
     */
    public function retirer($params) 
    {
        $this->modele->retirer($params);
        Utilitaire::nouvelleRoute('timbre/utilisateur');
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