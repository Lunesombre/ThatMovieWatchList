<?php


class ConnexionMessages
{
    public const CONNEXION_IS_VALID = 1;
    public const INVALID_USER = 2;
    public const PSEUDONYM_ALREADY_USED = 3;
    public const EMAIL_ALREADY_USED = 4;
    public const REGISTRATION_FAILURE = 5;
    public const REGISTRATION_SUCCESS = 6;
    public const SUCCESSFUL_FILE_REGISTRATION = 7;
    public const INVALID_FILE_REGISTRATION = 8;
    public const PROFILE_UPDATE_FAILURE = 9;



    public static function getConnexionMessage(int $code): string
    {
        switch ($code) {
            case ConnexionMessages::CONNEXION_IS_VALID:
                return "Connexion authorisée.";
                break;
            case ConnexionMessages::INVALID_USER:
                return "Echec de connexion";
                break;
            case ConnexionMessages::PSEUDONYM_ALREADY_USED:
                return "Pseudonyme déjà utilisé, veuillez en choisir un autre";
                break;
            case ConnexionMessages::EMAIL_ALREADY_USED:
                return "Impossible de s'inscrire avec un email déjà utilisé.";
                break;
            case ConnexionMessages::REGISTRATION_FAILURE:
                return "Une erreur s’est produite lors de l'inscription";
                break;
            case ConnexionMessages::REGISTRATION_SUCCESS:
                return "Inscription réussie !";
                break;
            case ConnexionMessages::SUCCESSFUL_FILE_REGISTRATION:
                return "Enregistrement de fichier réussi";
                break;
            case ConnexionMessages::INVALID_FILE_REGISTRATION:
                return "Echec de l'enregistrement de fichier";
                break;
            case ConnexionMessages::PROFILE_UPDATE_FAILURE:
                return "Echec mise à jour du profil";
                break;
            default:
                return "Une erreur est survenue, merci de contacter l'administrateur.";
        }
    }
}