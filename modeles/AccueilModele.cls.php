<?php
class AccueilModele extends AccesBd
{
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
                // Recherche de la premiere image pour chaque timbre
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

    public function premiereImage($id) {
        $sql = "SELECT ima_path FROM image 
                        WHERE ima_tim_id_ce = $id";
                $imagesArray =  $this->lireTout($sql, false);
        return $imagesArray[0]->ima_path;
    }

    public function miseMax($id) {
        $sql = "SELECT mis_id, MAX(mis_montant) as mis_montant_max, mis_date, uti_nom FROM mise 
                    JOIN utilisateur ON uti_id=mis_uti_id_ce
                    WHERE mis_enc_id_ce = $id";
        return $this->lireTout($sql);
    }

   

}