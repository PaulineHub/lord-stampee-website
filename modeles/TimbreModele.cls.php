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
                JOIN enchere ON tim_id=enc_tim_id_ce 
                ORDER BY tim_id";
        $result = $this->lireTout($sql, true);
        
        foreach ($result as $timbres) {
            foreach($timbres as $timbre) {
                // Recherche de la premiere image pour chaque timbre
                $sql = "SELECT ima_path FROM image 
                        WHERE ima_tim_id_ce = $timbre->enc_tim_id_ce";
                $imagesArray =  $this->lireTout($sql, false);
                $timbre->ima_path = $imagesArray[0]->ima_path;
                // Recherche de mise pour chaque enchère associée à chaque timbre
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

    public function toutEncheresCrees($idUti)
    {
        $sql = "SELECT * FROM timbre 
                JOIN image ON tim_id=ima_tim_id_ce 
                JOIN enchere ON tim_id=enc_tim_id_ce 
                WHERE enc_uti_id_ce=$idUti
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

    public function toutMises($idUti)
    {
        $sql = "SELECT * FROM timbre 
                JOIN image ON tim_id=ima_tim_id_ce 
                JOIN enchere ON tim_id=enc_tim_id_ce 
                JOIN mise ON mis_enc_id_ce=tim_id
                WHERE mis_uti_id_ce=$idUti
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

    public function toutFavoris($idUti)
    {
        $sql = "SELECT * FROM timbre 
                JOIN image ON tim_id=ima_tim_id_ce 
                JOIN enchere ON tim_id=enc_tim_id_ce 
                JOIN favoris ON fav_tim_id_ce=tim_id
                WHERE fav_uti_id_ce=$idUti
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

    public function toutCategories()
    {
        $sql = "SELECT * FROM categorie ORDER BY cat_nom";
        $result = $this->lireTout($sql, false);
        return $result;
    }

    public function toutConservations()
    {
        $sql = "SELECT * FROM conservation ORDER BY con_id";
        $result = $this->lireTout($sql, false);
        return $result;
    }

    public function toutPays()
    {
        $sql = "SELECT * FROM pays ORDER BY pay_nom";
        $result = $this->lireTout($sql, false);
        return $result;
    }

    /**
     * Fait une requête à la BD et retourne le détail d'un timbre, sa categorie, son pays et son etat de conservation, ses images, l'enchère associée, la quantite de mises et la mise la plus haute sur celle-ci, .
     * @param string $param Chaine représentant l'id du timbre.
     * @return object Objet représentant les détails du timbre.
     */
    public function un($idArray)
    {
        $id = (int)$idArray[0];

        $sql = "SELECT * FROM timbre 
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
                // Ajouter la mise la plus haute a l'objet de resultats
                foreach ($misesArray as $mises) {
                    foreach ($mises as $mise) {
                        $info->mis_montant =  $mise->mis_montant_max;
                        $info->mis_date =  $mise->mis_date;
                        $info->mis_uti_nom =  $mise->uti_nom;
                    }
                }
                // Recherche de la quantite de mises
                $sql = "SELECT mis_id, COUNT(mis_id) as mis_montant_quant 
                        FROM mise 
                        WHERE mis_enc_id_ce = $info->enc_id";
                $misesArray =  $this->lireTout($sql);
                // Ajouter la quantite de mises a l'objet de resultats
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
     * Fait une requête à la BD et retourne les images d'un timbre.
     * @param string $param Chaine représentant l'id du timbre.
     * @return object Objet représentant les images du timbre.
     */
    public function unImages($idArray)
    {
        $id = (int)$idArray[0];
        // Recherche d'images associees au timbre
        $sql = "SELECT * FROM image 
                WHERE ima_tim_id_ce = :id";
        $result = $this->lireTout($sql, true, ["id" => $id]);
        return $result;
    }

    /**
     * Fait une requête à la BD et insert un nouveau timbre et ses nouveaux téléphones.
     * @param object[] $timbre Un tableau d'objets représentant toutes les informations du timbre et des téléphones.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     */
    public function ajouter($timbre, $uti_id, $image)
    {
        extract($timbre);
        extract($image);
        // Faire une requete pour inserer un nouveau timbre
        $tim_id = $this->creer(
            "INSERT INTO timbre VALUES (0, :tim_nom, :tim_tirage, :tim_dimensions, :tim_prix_dep, :tim_certificat, :tim_cat_id_ce, :tim_con_id_ce, :tim_pay_id_ce, :tim_uti_id_ce)"
            , [
                "tim_nom"         => $tim_nom, 
                "tim_tirage"      => $tim_tirage,
                "tim_dimensions"  => $tim_dimensions,
                "tim_prix_dep"    => $tim_prix_dep,
                "tim_certificat"  => $tim_certificat,
                "tim_cat_id_ce"   => $tim_cat,
                "tim_con_id_ce"   => $tim_con,
                "tim_pay_id_ce"   => $tim_pay,
                "tim_uti_id_ce"   => $uti_id
            ]);
        // Faire une requete pour inserer une nouvelle enchere
        $this->creer(
            "INSERT INTO enchere VALUES (0, :enc_date_debut, :enc_date_fin, :enc_tim_id_ce, :enc_uti_id_ce)"
            , [
                "enc_date_debut"  => $enc_date_debut, 
                "enc_date_fin"    => $enc_date_fin,
                "enc_tim_id_ce"   => $tim_id,
                "enc_uti_id_ce"   => $uti_id
            ]);
        // Faire une requete pour inserer plusieurs nouvelles images
        
        $path = 'ressources/images/timbres/' . $name;
        $this->creer(
            "INSERT INTO image VALUES (0, :ima_nom, :ima_path, :ima_tim_id_ce)"
            , [
                "ima_nom"         => $name, 
                "ima_path"        => $path,
                "ima_tim_id_ce"   => $tim_id
            ]);
    }

    /**
     * Fait une requête à la BD et modifie les informations d'un timbre, de son enchere et de ses images.
     * @param object[] $timbre Un tableau d'objets représentant toutes les informations du timbre.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     */
    public function changer($timbre, $uti_id, $image)
    {
        extract($timbre);
        extract($image);
        // Faire une requete pour modifier le timbre
        $this->modifier("UPDATE timbre SET 
                tim_nom = :tim_nom, 
                tim_tirage = :tim_tirage, 
                tim_dimensions = :tim_dimensions, 
                tim_prix_dep = :tim_prix_dep, 
                tim_certificat = :tim_certificat, 
                tim_cat_id_ce = :tim_cat_id_ce, 
                tim_con_id_ce = :tim_con_id_ce, 
                tim_pay_id_ce = :tim_pay_id_ce, 
                tim_uti_id_ce = :tim_uti_id_ce
                WHERE tim_id = :tim_id"
            , [
                "tim_nom"         => $tim_nom, 
                "tim_tirage"      => $tim_tirage,
                "tim_dimensions"  => $tim_dimensions,
                "tim_prix_dep"    => $tim_prix_dep,
                "tim_certificat"  => $tim_certificat,
                "tim_cat_id_ce"   => $tim_cat,
                "tim_con_id_ce"   => $tim_con,
                "tim_pay_id_ce"   => $tim_pay,
                "tim_uti_id_ce"   => $uti_id,
                "tim_id"          => $tim_id
            ]);
        // Faire une requete pour modifier l'enchere
        $this->modifier("UPDATE enchere SET 
                enc_date_debut = :enc_date_debut, 
                enc_date_fin = :enc_date_fin, 
                enc_tim_id_ce = :enc_tim_id_ce, 
                enc_uti_id_ce = :enc_uti_id_ce
                WHERE enc_tim_id_ce = :enc_tim_id_ce"
            , [
                "enc_date_debut"  => $enc_date_debut, 
                "enc_date_fin"    => $enc_date_fin,
                "enc_tim_id_ce"   => $tim_id,
                "enc_uti_id_ce"   => $uti_id
            ]);
        // Faire une requete pour l'image
        $path = 'ressources/images/timbres/' . $name;
        $this->modifier("UPDATE image SET 
                ima_nom = :ima_nom, 
                ima_path = :ima_path, 
                ima_tim_id_ce = :ima_tim_id_ce
                WHERE ima_tim_id_ce = :ima_tim_id_ce"
            , [
                "ima_nom"         => $name, 
                "ima_path"        => $path,
                "ima_tim_id_ce"   => $tim_id
            ]);
    }

    /**
     * Fait une requête à la BD et supprime un timbre.
     * @param string Une chaine de caractères représentant l'id du timbre.
     */
    public function retirer($idArray)
    {
        $tim_id = (int)$idArray[0];
        $enc_id = (int)$idArray[1];
        //Supprimer les mises associees a l'enchere
        $this->supprimer("DELETE FROM mise WHERE mis_enc_id_ce=:mis_enc_id_ce" 
            , ['mis_enc_id_ce' => $enc_id]);
        //Supprimer l'enchere associee au timbre
        $this->supprimer("DELETE FROM enchere WHERE enc_id=:enc_id" 
            , ['enc_id' => $enc_id]);
        //Supprimer les favoris associes au timbre
        $this->supprimer("DELETE FROM favoris WHERE fav_tim_id_ce=:fav_tim_id_ce" 
            , ['fav_tim_id_ce' => $tim_id]);
        //Supprimer l'image associee au timbre
        $this->supprimer("DELETE FROM image WHERE ima_tim_id_ce=:ima_tim_id_ce" 
            , ['ima_tim_id_ce' => $tim_id]);
        // Supprimer le timbre 
        $this->supprimer("DELETE FROM timbre WHERE tim_id=:tim_id"
            , ['tim_id' => $tim_id]);

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

    