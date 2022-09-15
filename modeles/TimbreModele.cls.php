<?php
class TimbreModele extends AccesBd
{
    /**
     * Fait une requête à la BD et retourne tous les enregistrements de la table timbre, des photos associées, de l'enchère associée et de la mise la plus haute réalisée sur cette enchère.
     * @return object[] Un tableau d'objets représentant tous les timbres, leurs enchères et mises les plus hautes associées.
     */
    public function tout()
    {
        $sql = "SELECT * FROM timbre 
                JOIN image ON tim_id=ima_tim_id_ce 
                JOIN enchere ON tim_id=enc_tim_id_ce 
                ORDER BY tim_id";
        
        $result = $this->lireTout($sql, true);

        // Recherche de mise pour chaque enchère associée à chaque timbre
        foreach ($result as $timbres) {
            foreach($timbres as $timbre) {
                $sql = "SELECT mis_id, MAX(mis_montant) as mis_montant_max, mis_date FROM mise 
                        WHERE mis_enc_id_ce = $timbre->enc_id";
                $misesArray =  $this->lireTout($sql);
                foreach ($misesArray as $mises) {
                    foreach ($mises as $mise) {
                        $timbre->mis_montant =  $mise->mis_montant_max;
                        $timbre->mis_date =  $mise->mis_date;
                    }
                }
            }
        }
        return $result;

    }

    /**
     * Fait une requête à la BD et retourne le détail d'un timbre, sa categorie, son pays et son etat de conservation, ses images, l'enchère associée, la quantite de mises et la mise la plus haute sur celle-ci, .
     * @param string $param Chaine représentant l'id du timbre.
     * @return object Objet représentant les détails du timbre et ses téléphones associés.
     */
    public function un($idArray)
    {
        $id = (int)$idArray[0];

        $sql = "SELECT * FROM timbre 
                JOIN image ON ima_tim_id_ce=:id
                JOIN enchere ON enc_tim_id_ce=:id 
                JOIN categorie ON cat_id=tim_cat_id_ce 
                JOIN pays ON pay_id=tim_pay_id_ce
                JOIN conservation ON con_id=tim_con_id_ce
                WHERE tim_id=:id";
            
        $result = $this->lireTout($sql, true, ["id" => $id]);

        // Recherche de mise pour l'enchère associée au timbre
        foreach ($result as $timbre) {
            foreach($timbre as $info) {
                // Recherche de la mise la plus haute
                $sql = "SELECT mis_id, MAX(mis_montant) as mis_montant_max, mis_date, uti_nom 
                        FROM mise 
                        JOIN utilisateur ON uti_id=mis_uti_id_ce
                        WHERE mis_enc_id_ce = $info->enc_id";
                $misesArray =  $this->lireTout($sql);
                foreach ($misesArray as $mises) {
                    foreach ($mises as $mise) {
                        $info->mis_montant =  $mise->mis_montant_max;
                        $info->mis_date =  $mise->mis_date;
                        $info->mis_uti_nom =  $mise->uti_nom;
                    }
                }
                // Recherche de la quantite de mise
                $sql = "SELECT mis_id, COUNT(mis_id) as mis_montant_quant 
                        FROM mise 
                        WHERE mis_enc_id_ce = $info->enc_id";
                $misesArray =  $this->lireTout($sql);
                foreach ($misesArray as $mises) {
                    foreach ($mises as $mise) {
                        $info->mis_sum = $mise->mis_montant_quant;
                    }
                }
            }
        }
        return $result;
    }

    /**
     * Fait une requête à la BD et retourne tous les enregistrements de la table timbre crees par l'utilisateur.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     * @return object[] Un tableau d'objets représentant tous les timbres et leurs téléphones associés.
     */
    public function utilisateur($uti_id)
    {

        // $sql = "SELECT * FROM timbre 
        //         JOIN image ON tim_id=ima_tim_id_ce 
        //         JOIN enchere ON tim_id=enc_tim_id_ce 
        //         ORDER BY tim_id";
        
        // return $this->lireTout($sql, true);
    }

    /**
     * Fait une requête à la BD et insert un nouveau timbre et ses nouveaux téléphones.
     * @param object[] $timbre Un tableau d'objets représentant toutes les informations du timbre et des téléphones.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     */
    public function ajouter($timbre, $uti_id)
    {
        // extract($timbre);
        // $ctc_uti_id_ce = $uti_id;

        // // Faire une requete pour inserer un nouveau timbre
        // $tel_ctc_id_ce = $this->creer(
        //     "INSERT INTO timbre VALUES (0, :ctc_prenom, :ctc_nom, :ctc_categorie, :ctc_uti_id_ce)"
        //     , [
        //         "ctc_prenom"      => $ctc_prenom, 
        //         "ctc_nom"         => $ctc_nom,
        //         "ctc_categorie"   => $ctc_categorie,
        //         "ctc_uti_id_ce"   => $ctc_uti_id_ce
        //     ]);

    }

    /**
     * Fait une requête à la BD et modifie les informations d'un timbre.
     * @param object[] $timbre Un tableau d'objets représentant toutes les informations du timbre.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     */
    public function changer($timbre, $uti_id)
    {
        // extract($timbre);

        // $this->modifier("UPDATE timbre 
        //                 SET 
        //                     ctc_prenom = :ctc_prenom, 
        //                     ctc_nom = :ctc_nom, 
        //                     ctc_categorie = :ctc_categorie, 
        //                     ctc_uti_id_ce = :ctc_uti_id_ce
        //                 WHERE ctc_id = :ctc_id"
        //     , [
        //         "ctc_id"          => $ctc_id,
        //         "ctc_prenom"      => $ctc_prenom, 
        //         "ctc_nom"         => $ctc_nom,
        //         "ctc_categorie"   => $ctc_categorie,
        //         "ctc_uti_id_ce"   => $uti_id
        //     ]);

    }

    /**
     * Fait une requête à la BD et supprime un timbre.
     * @param string Une chaine de caractères représentant l'id du timbre.
     */
    public function retirer($ctc_id)
    {
        // //Supprimer les données des téléphones "enfants"
        // $this->supprimer("DELETE FROM telephone WHERE tel_ctc_id_ce=:tel_ctc_id_ce" 
        //     , ['tel_ctc_id_ce' => $ctc_id]);
        // // Supprimer le timbre "parent"
        // $this->supprimer("DELETE FROM timbre WHERE ctc_id=:ctc_id"
        //     , ['ctc_id' => $ctc_id]);

    }

    

    /**
     * Fait une requête à la BD et retourne tous les enregistrements de la table timbre correspondant à l'expression recherchée.
     * @param string $expression Chaine représentant l'expression à rechercher.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     * @return object[] Un tableau d'objets représentant tous les timbres et leur téléphones associés.
     *
     */
    public function rechercher($expression, $uti_id)
    {

        // return $this->lireTout("SELECT ctc_id, ctc_nom, ctc_prenom, ctc_categorie, telephone.*  FROM telephone 
        //                         JOIN timbre ON ctc_id=tel_ctc_id_ce 
        //                         WHERE ctc_nom LIKE :ctc_nom OR ctc_prenom LIKE :ctc_prenom OR tel_numero LIKE :tel_numero 
        //                         AND ctc_uti_id_ce = '$uti_id'
        //                         ORDER BY ctc_prenom"
        //                         , true, // on veut les données groupées par timbre
        //                         [
        //                         "ctc_nom"          => $expression,
        //                         "ctc_prenom"      => $expression, 
        //                         "tel_numero"        => $expression
        //                     ]);
    }
    

}

    