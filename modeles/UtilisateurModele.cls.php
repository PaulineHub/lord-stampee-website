<?php
class UtilisateurModele extends AccesBd
{
    /**
     * Obtenir les données d'un utilisateur à partir de son courriel
     * 
     * @param string $courriel Chaine représentant le courriel de l'utilisateur.
     * 
     * @return object Objet représentant les données de l'utilisateur.
     */
    public function un($courriel)
    {
        return $this->lireUn("SELECT * FROM utilisateur 
                            WHERE uti_courriel=:email"
                            , ['email'=>$courriel]);

    }

    /**
     * Ajouter un utilisateur à la BD
     * 
     * @param object[] $utilisateur Un tableau d'objets représentant les données de l'utilisateur.
     */
    public function ajouter($utilisateur)
    {
        extract($utilisateur);
        // création du code de confirmation de 23 caractères (param true), avec préfixe de 5 caractères (stampee))
        $cc = uniqid("stampee", true);
        $pri_id = 2; // statut privilege membre
        $this->creer("INSERT INTO utilisateur VALUES (0, :nom, :courriel, :mdp, NOW(), '$cc', $pri_id)", 
                    [
                        "nom" => $uti_nom,
                        "courriel" => $uti_courriel,
                        "mdp"      => password_hash($uti_mdp, PASSWORD_DEFAULT)
                    ]
                    );
    }

}