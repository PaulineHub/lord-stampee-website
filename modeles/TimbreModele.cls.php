<?php
class TimbreModele extends AccesBd
{
    /**
     * Fait une requête à la BD et retourne tous les enregistrements de la table timbre, des images associées, de l'enchère associée et de la mise la plus haute réalisée sur cette enchère.
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
                // Recherche de la première image pour chaque timbre
                $timbre->ima_path = $this->premiereImage($timbre->enc_tim_id_ce);
                // Recherche de mise pour chaque enchère associée à chaque timbre
                $misesArray = $this->miseMax($timbre->enc_id);
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
     * Fait une requête à la BD et retourne tous les timbres et enchères créés par un utilisateur donné, la première image associée au timbre et la mise la plus haute réalisée sur cette enchère.
     * @param string $id id de l'utilisateur auquel appartient enchères créés.
     * @return object[] Un tableau d'objets représentant tous les timbres et enchères créés par un utilisateur donné.
     */
    public function toutEncheresCrees($idUti)
    {
        $sql = "SELECT * FROM timbre 
                JOIN enchere ON tim_id=enc_tim_id_ce 
                WHERE enc_uti_id_ce=$idUti
                ORDER BY tim_id";
        
        $result = $this->lireTout($sql, true);
        
        foreach ($result as $timbres) {
            foreach($timbres as $timbre) {
                // Recherche de la première image pour chaque timbre
                $timbre->ima_path = $this->premiereImage($timbre->enc_tim_id_ce);
                // Recherche de mise pour chaque enchère associée à chaque timbre
                $misesArray = $this->miseMax($timbre->enc_id);
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
     * Fait une requête à la BD et retourne toutes les enchères (et timbres associés) sur lesquel un utilisateur donné a misé au moins une fois, ainsi que la mise maximum actuelle sur chaque enchère.
     * @param string $id id de l'utilisateur auquel appartient enchères créés.
     * @return object[] Un tableau d'objets représentant toutes les enchères (et timbres associés) sur lesquel un utilisateur donné a misé, ainsi que la mise maximum actuelle sur chaque enchère.
     */
    public function toutMises($idUti)
    {
        $sql = "SELECT * FROM timbre 
                JOIN enchere ON tim_id=enc_tim_id_ce 
                JOIN mise ON mis_enc_id_ce=tim_id
                WHERE mis_uti_id_ce=$idUti
                GROUP BY tim_id
                ORDER BY tim_id";
        
        $result = $this->lireTout($sql, true);
        foreach ($result as $timbres) {
            foreach($timbres as $timbre) {
                // Recherche de la première image pour chaque timbre
                $timbre->ima_path = $this->premiereImage($timbre->enc_tim_id_ce);
                // Recherche de mise pour chaque enchère associée à chaque timbre
                $misesArray = $this->miseMax($timbre->enc_id);
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
     * Fait une requête à la BD et retourne tous les timbres et enchères associées ajoutées en favoris par un utilisateur donné, la première image associée au timbre et la mise la plus haute réalisée sur cette enchère.
     * @param string $id id de l'utilisateur auquel appartient enchères créés.
     * @return object[] Un tableau d'objets représentant tous les timbres ajoutés en favoris par un utilisateur donné.
     */
    public function toutFavoris($idUti)
    {
        $sql = "SELECT * FROM timbre 
                JOIN enchere ON tim_id=enc_tim_id_ce 
                JOIN favoris ON fav_tim_id_ce=tim_id
                WHERE fav_uti_id_ce=$idUti
                ORDER BY tim_id";
        
        $result = $this->lireTout($sql, true);
        
        foreach ($result as $timbres) {
            foreach($timbres as $timbre) {
                // Recherche de la première image pour chaque timbre
                $timbre->ima_path = $this->premiereImage($timbre->enc_tim_id_ce);
                // Recherche de mise pour chaque enchère associée à chaque timbre
                $misesArray = $this->miseMax($timbre->enc_id);
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
     * Fait une requête à la BD et retourne toutes les catégories.
     * @return object[] Un tableau d'objets représentant toutes les catégories.
     */
    public function toutCategories()
    {
        $sql = "SELECT * FROM categorie ORDER BY cat_nom";
        $result = $this->lireTout($sql, false);
        return $result;
    }

    /**
     * Fait une requête à la BD et retourne tous les états de conservation possibles.
     * @return object[] Un tableau d'objets représentant tous les états de conservation possibles.
     */
    public function toutConservations()
    {
        $sql = "SELECT * FROM conservation ORDER BY con_id";
        $result = $this->lireTout($sql, false);
        return $result;
    }

    /**
     * Fait une requête à la BD et retourne tous les pays.
     * @return object[] Un tableau d'objets représentant tous les pays.
     */
    public function toutPays()
    {
        $sql = "SELECT * FROM pays ORDER BY pay_nom";
        $result = $this->lireTout($sql, false);
        return $result;
    }

    /**
     * Fait une requête à la BD et retourne le détail d'un timbre, sa catégorie, son pays et son état de conservation, ses images, l'enchère associée, la quantité de mises et la mise la plus haute sur celle-ci, .
     * @param array $idArray Tableau contenant l'id du timbre en chaine de caractères.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     * @return object Objet représentant les détails du timbre.
     */
    public function un($idArray, $uti_id='no user logged')
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
                $misesArray = $this->miseMax($info->enc_id);
                // Ajouter la mise la plus haute à l'objet de résultats
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
                // Ajouter la quantité de mises à l'objet de résultats
                foreach ($misesArray as $mises) {
                    foreach ($mises as $mise) {
                        $info->mis_sum = $mise->mis_montant_quant;
                    }
                }
                if ($uti_id == 'no user logged') {
                     $info->favoris = false;
                } else {
                     // Recherche de favoris
                    $sql = "SELECT *  
                            FROM favoris 
                            WHERE fav_tim_id_ce = $info->enc_tim_id_ce AND fav_uti_id_ce=$uti_id";
                    $favoris =  $this->lireUn($sql);
                    if ($favoris) $info->favoris = true;
                    else $info->favoris = false;
                }
            }
        }
        return $result;
    }

    /**
     * Fait une requête à la BD et retourne les images d'un timbre.
     * @param string $idArray Tableau contenant l'id du timbre en chaine de caractères.
     * @return object Objet représentant les images du timbre.
     */
    public function unImages($idArray)
    {
        $id = (int)$idArray[0];
        // Recherche d'images associées au timbre
        $sql = "SELECT * FROM image 
                WHERE ima_tim_id_ce = :id";
        $result = $this->lireTout($sql, true, ["id" => $id]);
        return $result;
    }

    /**
     * Fait une requête à la BD et insert un nouveau timbre, son enchère et ses images.
     * @param object[] $timbre Un tableau d'objets représentant toutes les informations du timbre et de l'enchère.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     * @param object[] $image Un tableau d'objets représentant toutes les informations des images.
     */
    public function ajouter($timbre, $uti_id, $image)
    {
        extract($timbre);
        extract($image);
        // Faire une requête pour insérer un nouveau timbre
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
        // Faire une requête pour insérer une nouvelle enchère
        $this->creer(
            "INSERT INTO enchere VALUES (0, :enc_date_debut, :enc_date_fin, :enc_tim_id_ce, :enc_uti_id_ce)"
            , [
                "enc_date_debut"  => $enc_date_debut, 
                "enc_date_fin"    => $enc_date_fin,
                "enc_tim_id_ce"   => $tim_id,
                "enc_uti_id_ce"   => $uti_id
            ]);
        // Faire une requête pour insérer plusieurs nouvelles images
        for ($i = 0; $i < count($name); $i++) {
            $path = 'ressources/images/timbres/' . $name[$i];
            $this->creer(
                "INSERT INTO image VALUES (0, :ima_nom, :ima_path, :ima_tim_id_ce)"
                , [
                    "ima_nom"         => $name[$i], 
                    "ima_path"        => $path,
                    "ima_tim_id_ce"   => $tim_id
            ]);
        }
        
    }

    /**
     * Fait une requête à la BD et modifie les informations d'un timbre, de son enchère et de ses images.
     * @param object[] $timbre Un tableau d'objets représentant toutes les informations du timbre.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     * @param object[] $image Un tableau d'objets représentant toutes les informations des images.
     */
    public function changer($timbre, $uti_id, $image)
    {
        extract($timbre);
        extract($image);
        // Faire une requête pour modifier le timbre
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
        // Faire une requête pour modifier l'enchère
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
         // Faire une requête pour insérer plusieurs nouvelles images
        for ($i = 0; $i < count($name); $i++) {
            $path = 'ressources/images/timbres/' . $name[$i];
            $this->creer(
                "INSERT INTO image VALUES (0, :ima_nom, :ima_path, :ima_tim_id_ce)"
                , [
                    "ima_nom"         => $name[$i], 
                    "ima_path"        => $path,
                    "ima_tim_id_ce"   => $tim_id
            ]);
        }
    }

    /**
     * Fait une requête à la BD et supprime un timbre, son enchère, ses mises, ses images et ses favoris associés.
     * @param array Tableau représentant l'id du timbre et de l'enchère associée.
     */
    public function retirer($idArray)
    {
        $tim_id = (int)$idArray[0];
        $enc_id = (int)$idArray[1];
        //Supprimer les mises associées à l'enchère
        $this->supprimer("DELETE FROM mise WHERE mis_enc_id_ce=:mis_enc_id_ce" 
            , ['mis_enc_id_ce' => $enc_id]);
        //Supprimer l'enchère associée au timbre
        $this->supprimer("DELETE FROM enchere WHERE enc_id=:enc_id" 
            , ['enc_id' => $enc_id]);
        //Supprimer les favoris associés au timbre
        $this->supprimer("DELETE FROM favoris WHERE fav_tim_id_ce=:fav_tim_id_ce" 
            , ['fav_tim_id_ce' => $tim_id]);
        //Supprimer les images associées au timbre
        $this->supprimer("DELETE FROM image WHERE ima_tim_id_ce=:ima_tim_id_ce" 
            , ['ima_tim_id_ce' => $tim_id]);
        // Supprimer le timbre 
        $this->supprimer("DELETE FROM timbre WHERE tim_id=:tim_id"
            , ['tim_id' => $tim_id]);
    }

    /**
     * Fait une requête à la BD et insert une nouvelle mise.
     * @param object[] $mise Un tableau d'objets représentant toutes les informations de la mise.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     * @return string Le dernier id de mise inséré
     */
    public function miser($mise, $uti_id)
    {
        extract($mise);
        // Faire une requête pour insérer une nouvelle mise
        $result = $this->creer(
            "INSERT INTO mise VALUES (0, :mis_montant, NOW(), :mis_uti_id_ce, :mis_enc_id_ce)"
            , [
                "mis_montant"    => $mis_montant, 
                "mis_uti_id_ce"  => $uti_id,
                "mis_enc_id_ce"  => $mis_enc_id_ce
            ]);
        return $result;
    }

    /**
     * Si le favoris existe, le supprime de la BD, sinon l'ajoute à la BD.
     * @param object[] $mise Un tableau d'objets représentant toutes les informations de la mise.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     */
    public function aimer($favoris, $uti_id)
    {
        extract($favoris);
        if ($fav_exist == "true") {
            $this->supprimer("DELETE FROM favoris WHERE fav_tim_id_ce=:fav_tim_id_ce" 
            , ['fav_tim_id_ce' => $fav_tim_id_ce]);
        } else {
            $this->creer(
            "INSERT INTO favoris VALUES (0, :fav_tim_id_ce, :fav_uti_id_ce)"
            , [
                "fav_tim_id_ce"  => $fav_tim_id_ce, 
                "fav_uti_id_ce"  => $uti_id
            ]);
        }
    }

    
    /**
     * Fait une requête à la BD et retourne tous les enregistrements de la table timbre correspondant à l'expression recherchée.
     * @param string $expression Chaine représentant l'expression à rechercher.
     * @return object[] Un tableau d'objets représentant tous les timbres associés correspondant à l'expression recherchée.
     */
    public function rechercher($expression)
    {
        $sql = "SELECT * FROM timbre  
                JOIN enchere ON tim_id=enc_tim_id_ce
                WHERE tim_nom LIKE :tim_nom OR tim_id LIKE :tim_id  
                ORDER BY tim_id";
         $result = $this->lireTout($sql
                                , true, // on veut les données groupées par timbre
                                [
                                "tim_nom"          => $expression,
                                "tim_id"      => $expression
                            ]);

        foreach ($result as $timbres) {
            foreach($timbres as $timbre) {
                // Recherche de la première image pour chaque timbre
                $timbre->ima_path = $this->premiereImage($timbre->enc_tim_id_ce);
                // Recherche de mise pour chaque enchère associée à chaque timbre
                $misesArray = $this->miseMax($timbre->enc_id);
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
     * Fait une requête à la BD et retourne la première image enregistrée pour l'id du timbre donné.
     * @param string $id id du timbre auquel appartiennent les images.
     * @return string le path de la première image associée au timbre donné.
     */
    public function premiereImage($id) {
        $sql = "SELECT ima_path FROM image 
                        WHERE ima_tim_id_ce = $id";
                $imagesArray =  $this->lireTout($sql, false);
        return $imagesArray[0]->ima_path;
    }

    /**
     * Fait une requête à la BD et retourne la mise maximum et ses informations faite sur un timbre donné.
     * @param string $id id du timbre dont on cherche la mise la plus haute.
     * @return object[] Un tableau d'objets représentant la mise la plus haute et ses informations associées.
     */
    public function miseMax($id) {
        $sql = "SELECT mis_id, MAX(mis_montant) as mis_montant_max, mis_date, uti_nom FROM mise 
                    JOIN utilisateur ON uti_id=mis_uti_id_ce
                    WHERE mis_enc_id_ce = $id";
        return $this->lireTout($sql);
    }
    

}

    