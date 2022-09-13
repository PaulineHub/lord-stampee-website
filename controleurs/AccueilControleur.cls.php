<?php
class AccueilControleur extends Controleur
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
        

    }

   /**
     * Fait une requête à la BD et retourne tous les enregistrements de la table contact.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     * @return object[] Un tableau d'objets représentant tous les contacts et leurs téléphones associés.
     */
    // public function tout($uti_id)
    // {

    //     $sql = "SELECT ctc_id, ctc_nom, ctc_prenom, ctc_categorie, telephone.*  FROM telephone JOIN contact ON ctc_id=tel_ctc_id_ce 
    //             WHERE ctc_uti_id_ce = '$uti_id'
    //             ORDER BY ctc_prenom";
    //     return $this->lireTout($sql);
    // }

    
    // /**
    //  * Recherche d'un contact (et des téléphones associés).
    //  *  Route associée: contact/retirer
    //  */
    // public function rechercher() 
    // {
    //     if($_POST['recherche'] != "") {
    //         $recherche = "%" . $_POST['recherche'] . "%";
    //         $this->gabarit->affecter('contacts', $this->modele->rechercher($recherche, $_SESSION["utilisateur"]->uti_id));
    //     }
    // }

}