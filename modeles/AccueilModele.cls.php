<?php
class AccueilModele extends AccesBd
{
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