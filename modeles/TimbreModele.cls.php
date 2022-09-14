<?php
class TimbreModele extends AccesBd
{
    /**
     * Fait une requête à la BD et retourne tous les enregistrements de la table timbre.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     * @return object[] Un tableau d'objets représentant tous les timbres et leurs téléphones associés.
     */
    public function tout()
    {
        $sql = "SELECT * FROM timbre 
                JOIN image ON tim_id=ima_tim_id_ce 
                JOIN enchere ON tim_id=enc_tim_id_ce 
                ORDER BY tim_id";
        
        return $this->lireTout($sql, true);

    }

    /**
     * Fait une requête à la BD et retourne tous les enregistrements de la table timbre.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     * @return object[] Un tableau d'objets représentant tous les timbres et leurs téléphones associés.
     */
    public function utilisateur($uti_id)
    {

        $sql = "SELECT ctc_id, ctc_nom, ctc_prenom, ctc_categorie, telephone.*  FROM telephone JOIN timbre ON ctc_id=tel_ctc_id_ce 
                WHERE ctc_uti_id_ce = '$uti_id'
                ORDER BY ctc_prenom";
        return $this->lireTout($sql);
    }

    /**
     * Fait une requête à la BD et retourne le détail d'un timbre.
     * @param string $param Chaine représentant l'id du timbre.
     * @return object Objet représentant les détails du timbre et ses téléphones associés.
     */
    public function un($param)
    {
        $sql = "SELECT ctc_id, ctc_nom, ctc_prenom, ctc_categorie, telephone.*  FROM telephone JOIN timbre ON ctc_id=tel_ctc_id_ce 
                WHERE ctc_id = '$param'";
        return $this->lireTout($sql);
    }

    /**
     * Fait une requête à la BD et insert un nouveau timbre et ses nouveaux téléphones.
     * @param object[] $timbre Un tableau d'objets représentant toutes les informations du timbre et des téléphones.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     */
    public function ajouter($timbre, $uti_id)
    {
        extract($timbre);
        $ctc_uti_id_ce = $uti_id;
        // Variable $ctc_categorie non utilisee dans application nestor
        $ctc_categorie = 'Autre';

        // Faire une requete pour inserer un nouveau timbre
        $tel_ctc_id_ce = $this->creer(
            "INSERT INTO timbre VALUES (0, :ctc_prenom, :ctc_nom, :ctc_categorie, :ctc_uti_id_ce)"
            , [
                "ctc_prenom"      => $ctc_prenom, 
                "ctc_nom"         => $ctc_nom,
                "ctc_categorie"   => $ctc_categorie,
                "ctc_uti_id_ce"   => $ctc_uti_id_ce
            ]);

        // Créer un tableau regroupant les tableaux de données de chaque nouveau téléphone du formulaire
        $telephones = $this->creerTableauTelephones($timbre);

        // Supprimer les lignes d'input vides du tableau de téléphones qui ont pues rester dans le formulaire
        for ($i = 0; $i < count($telephones); $i++) {
            if ($telephones[$i]["tel_numero"] == '') {
                unset($telephones[$i]);
            }
        }

        // Faire une requête pour insérer chaque nouveau téléphone
        foreach ($telephones as $telephone) {
            $this->creer(
            "INSERT INTO telephone VALUES (0, :tel_numero, :tel_type, :tel_poste, :tel_ctc_id_ce)"
            , [
                "tel_numero"      => $telephone["tel_numero"], 
                "tel_type"        => $telephone["tel_type"],
                "tel_poste"       => $telephone["tel_poste"],
                "tel_ctc_id_ce"   => $tel_ctc_id_ce
            ]);
        }

    }

    /**
     * Fait une requête à la BD et modifie les informations d'un timbre.
     * @param object[] $timbre Un tableau d'objets représentant toutes les informations du timbre.
     * @param string $uti_id Chaine représentant l'id de l'utilisateur.
     */
    public function changer($timbre, $uti_id)
    {
        extract($timbre);

        // Variable $ctc_categorie non utilisée dans l'application nestor
        $ctc_categorie = 'Autre';

        $this->modifier("UPDATE timbre 
                        SET 
                            ctc_prenom = :ctc_prenom, 
                            ctc_nom = :ctc_nom, 
                            ctc_categorie = :ctc_categorie, 
                            ctc_uti_id_ce = :ctc_uti_id_ce
                        WHERE ctc_id = :ctc_id"
            , [
                "ctc_id"          => $ctc_id,
                "ctc_prenom"      => $ctc_prenom, 
                "ctc_nom"         => $ctc_nom,
                "ctc_categorie"   => $ctc_categorie,
                "ctc_uti_id_ce"   => $uti_id
            ]);

        // Créer un tableau regroupant les tableaux de données de chaque nouveau téléphone du formulaire
        $telephones = $this->creerTableauTelephones($timbre);

        // Créer un tableau regroupant les tableaux d'id d'éventuels téléphones supprimés
        $telephonesASupprimer = $this->creerTableauTelephonesASup($timbre);
        // Supprimer les lignes vierges supprimées dont l'id est systématiquement "0" pour ne garder que les id générés par la BD
        for ($i = 0; $i < count($telephonesASupprimer); $i++) {
            if ($telephonesASupprimer[$i]["tel_id_deleted"] == "0") {
                unset($telephonesASupprimer[$i]);
            }
        }

        // Transférer dans un autre tableau d'éventuels téléphones ajoutés
        $telephonesACreer = array();
        for ($i = 0; $i < count($telephones); $i++) {
            if ($telephones[$i]["tel_id"] == '0') {
                $telephonesACreer[$i] = $telephones[$i];
                unset($telephones[$i]);
            }
        }

        // Faire une requête pour supprimer les téléphones indésirables
        foreach ($telephonesASupprimer as $telephone) {
            $this->supprimer("DELETE FROM telephone WHERE tel_id=:tel_id" 
            , ['tel_id' => $telephone["tel_id_deleted"]]);
        }

        // Faire une requête pour insérer chaque nouveau téléphone
        foreach ($telephonesACreer as $telephone) {
            $this->creer(
            "INSERT INTO telephone VALUES (0, :tel_numero, :tel_type, :tel_poste, :tel_ctc_id_ce)"
            , [
                "tel_numero"      => $telephone["tel_numero"], 
                "tel_type"        => $telephone["tel_type"],
                "tel_poste"       => $telephone["tel_poste"],
                "tel_ctc_id_ce"   => $tel_ctc_id_ce
            ]);
        }

        // Faire une requête pour changer les téléphones modifiés
        foreach ($telephones as $telephone) {
           $this->modifier("UPDATE telephone 
                            SET 
                                tel_numero = :tel_numero, 
                                tel_type = :tel_type, 
                                tel_poste = :tel_poste, 
                                tel_ctc_id_ce = :tel_ctc_id_ce 
                            WHERE tel_id = :tel_id"
            , [
                "tel_id"          => $telephone["tel_id"],
                "tel_numero"      => $telephone["tel_numero"], 
                "tel_type"        => $telephone["tel_type"],
                "tel_poste"       => $telephone["tel_poste"],
                "tel_ctc_id_ce"   => $tel_ctc_id_ce
            ]);
        }

    }

    /**
     * Fait une requête à la BD et supprime un timbre.
     * @param string Une chaine de caractères représentant l'id du timbre.
     */
    public function retirer($ctc_id)
    {
        //Supprimer les données des téléphones "enfants"
        $this->supprimer("DELETE FROM telephone WHERE tel_ctc_id_ce=:tel_ctc_id_ce" 
            , ['tel_ctc_id_ce' => $ctc_id]);
        // Supprimer le timbre "parent"
        $this->supprimer("DELETE FROM timbre WHERE ctc_id=:ctc_id"
            , ['ctc_id' => $ctc_id]);
    }

    /**
     * Créer un tableau de tableaux des informations de chaque téléphones liés a un timbre
     * @param array Un tableau de toutes les informations du timbre.
     * @return array[] Un tableau de tableaux regroupant les informations par téléphone.
     */
    public function creerTableauTelephones($array)
    {
        $telephones = array();
        $i = 0;
        foreach ($array as $key => $value) {
            if (preg_match("/tel_id/", $key)) {
                $telephones[$i] = array();
            }
            if (preg_match("/tel_id/", $key) || preg_match("/tel_numero/", $key) || preg_match("/tel_poste/", $key) || preg_match("/tel_type/", $key)) {
                $keyReplaced = preg_replace("/_[0-9]+/", "", $key ); 
                $telephones[$i][$keyReplaced] = $value;
            }
            if (preg_match("/tel_type/", $key)) {
                $i++;
            }
        }

        return $telephones;
    }

    /**
     * Créer un tableau de tableaux des id de chaque téléphone à supprimer
     * @param array Un tableau de toutes les informations du timbre.
     * @return array[] Un tableau de tableaux regroupant les id des téléphones à supprimer.
     */
    public function creerTableauTelephonesASup($array)
    {
        $telephones = array();
        $i = 0;
        foreach ($array as $key => $value) {
            if (preg_match("/tel_id_deleted/", $key)) {
                $telephones[$i] = array();
                $keyReplaced = preg_replace("/_[0-9]+/", "", $key ); 
                $telephones[$i][$keyReplaced] = $value;
                $i++;
            }
        }

        return $telephones;
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

        return $this->lireTout("SELECT ctc_id, ctc_nom, ctc_prenom, ctc_categorie, telephone.*  FROM telephone 
                                JOIN timbre ON ctc_id=tel_ctc_id_ce 
                                WHERE ctc_nom LIKE :ctc_nom OR ctc_prenom LIKE :ctc_prenom OR tel_numero LIKE :tel_numero 
                                AND ctc_uti_id_ce = '$uti_id'
                                ORDER BY ctc_prenom"
                                , true, // on veut les données groupées par timbre
                                [
                                "ctc_nom"          => $expression,
                                "ctc_prenom"      => $expression, 
                                "tel_numero"        => $expression
                            ]);
    }
    

}

    