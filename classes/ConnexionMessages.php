<?php


class ConnexionMessages
{
    public const CONNEXION_IS_VALID = 1;
    public const INVALID_USER = 2;



    public static function getConnexionMessage(int $code): string
    {
        switch ($code) {
            case ConnexionMessages::CONNEXION_IS_VALID:
                return "Connexion authorisée.";
                break;
            case ConnexionMessages::INVALID_USER:
                return "Echec de connexion";
                break;
            default:
                return "Une erreur est survenue, merci de contacter l'administrateur.";
        }
    }
}