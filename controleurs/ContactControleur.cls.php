<?php
class ContactControleur extends Controleur
{
    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        if(!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/index');
        }
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
     * Affichage de tous les contacts (et des téléphones associés) de l'utilisateur.
     *  Route associée: contact/tout
     */
    public function tout($params)
    {
        $this->gabarit->affecter('contacts', $this->modele->tout($_SESSION["utilisateur"]->uti_id));
    }

    /**
      * Affichage du détail d’un contact lorsqu’un contact particulier est cliqué.
     *  Route associée : contact/un
     */
    public function un()
    {
        // Chercher les contacts de la BD 
        $resultat = $this->modele->un($_POST['ctc_id']);

        // Injecte le résultat dans la 'vue'
        $this->gabarit->affecter('contact', $resultat);

        return $resultat;
        Utilitaire::nouvelleRoute('contact/un');
    }

    /**
     * Ajout d'un contact (et des téléphones associés).
     *  Route associée: contact/ajouter
     */
    public function ajouter() 
    {
        $this->modele->ajouter($_POST, $_SESSION["utilisateur"]->uti_id);
        Utilitaire::nouvelleRoute('contact/tout');
    }

    /**
     * Modification d'un contact (et des téléphones associés).
     *  Route associée: contact/changer
     */
    public function changer() 
    {
        $this->modele->changer($_POST, $_SESSION["utilisateur"]->uti_id);
        Utilitaire::nouvelleRoute('contact/tout');
    }

    /**
     * Suppression d'un contact (et des téléphones associés).
     *  Route associée: contact/retirer
     */
    public function retirer() 
    {
        $this->modele->retirer($_POST['ctc_id']);
        Utilitaire::nouvelleRoute('contact/tout');
    }

    /**
     * Recherche d'un contact (et des téléphones associés).
     *  Route associée: contact/retirer
     */
    public function rechercher() 
    {
        if($_POST['recherche'] != "") {
            $recherche = "%" . $_POST['recherche'] . "%";
            $this->gabarit->affecter('contacts', $this->modele->rechercher($recherche, $_SESSION["utilisateur"]->uti_id));
        }
    }

}