<?php
class UtilisateurControleur extends Controleur
{

    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        if (isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('contact/tout');
        }
    }

    /**
     * Méthode invoquée par défaut.
     */

    public function index($params)
    {

    }

    /**
     * Méthode nouveau pour rediriger vers la page de nouvel utilisateur.
     */
    public function nouveau($params)
    {
        
    }

    /**
     * Méthode ajouter.
     */
    public function ajouter()
    {
        $this->modele->ajouter($_POST);
        Utilitaire::nouvelleRoute("utilisateur/index");
    }

    /**
     * Méthode connexion.
     */
    public function connexion()
    {
        $courriel = $_POST['uti_courriel'];
        $mdp = $_POST['uti_mdp'];
        $utilisateur = $this->modele->un($courriel);

        $erreur = false;
        if (!$utilisateur || !password_verify($mdp, $utilisateur->uti_mdp)) {
            $erreur = "Combinaison courriel / mot de passe erroné";
        }
        else if ($utilisateur->uti_confirmation != '') {
            $erreur = "Compte non confirmé : vérifiez vos courriels";
        }

        if (!$erreur) {
            // Sauvegarder état de connexion
            $_SESSION['utilisateur'] = $utilisateur;
            Utilitaire::nouvelleRoute('contact/tout');
        } else {
            $this->gabarit->affecter('erreur', $erreur);
            $this->gabarit->affecterActionParDefaut('index');
            $this->index([]);
        }
    }

    /**
     * Méthode déconnexion.
     */
    public function deconnexion()
    {
        unset($_SESSION['utilisateur']);
        Utilitaire::nouvelleRoute('utilisateur');
    }
}