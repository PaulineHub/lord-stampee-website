<?php
class Utilitaire
{
    public static function nouvelleRoute($route)
    {
        header('Location: '.BASE_SERVEUR.$route);
    }
}