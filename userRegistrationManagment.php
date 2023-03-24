<?php
require_once __DIR__.'/functions.php';
require_once __DIR__.'/classes/ConnexionMessages.php';

if (empty($_POST) || !isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['birthdate']) || !isset($_POST['email']) || !isset($_POST['pseudo']) || !isset($_POST['password'])) {
    redirect('register.php');
}

require_once __DIR__.'/db/pdo.php';

/*
- Je veux : récupérer les valeurs transmises par le formulaire et les stocker dans des variables
*/
$userName = $_POST['nom'];
$userFirstname = $_POST['prenom'];
$userEmail = $_POST['email'];
$userPassword = $_POST['password'];
$userBirthdate = $_POST['birthdate'];
$userPseudo = $_POST['pseudo'];
if (empty($_POST['picture'])) 
{
    $userPicture=null;
}else{
$userPicture = $_POST['picture'];
}
/*
- Vérifier si certaines valeurs sont déjà dans la base de données pour éviter que les utilisateurs puissent les utiliser plusieurs fois : le pseudo et l'email devront être uniques (ces colonnes ont bien l'index UNIQUE dans la base de données)
- Renvoyer un message d'erreur adapté si l'un ou l'autre de ces critères n'est pas rempli
*/
$query = "SELECT * FROM users WHERE user_email = :email";
$stmt = $pdo->prepare($query);

$stmt->execute(['email' => $userEmail]);
$testEmailUsage=$stmt->fetch();
if($testEmailUsage){
    redirect('register.php?msg='. ConnexionMessages::EMAIL_ALREADY_USED);
}
$query = "SELECT * FROM users WHERE user_nickname = :pseudo";
$stmt = $pdo->prepare($query);

$stmt->execute (['pseudo' => $userPseudo]);
$testPseudoUsage=$stmt->fetch();
if($testPseudoUsage){
    redirect('register.php?msg='. ConnexionMessages::PSEUDONYM_ALREADY_USED);
}
/*
- Vérifier que les valeurs transmises correspondent à celles attendues (un email pour un email, la taille du nom, etc)
- Renvoyer des messages d'erreurs adaptés si les critères ne sont pas remplis
*/
//A faire
/*
- Hasher le mot de passe
- Si tout est bon, envoyer les données vers ma base de données avec une requête préparés
*/
$query = "INSERT INTO users (user_nickname, user_email, user_password, user_name, user_firstname, user_birthdate, user_picture) VALUES (:pseudo, :email, :password, :name, :firstname, :birthdate, :picture)";

$stmt = $pdo->prepare($query);

$insertNewUser = $stmt->execute([
    'pseudo' => $userPseudo, 
    'email' => $userEmail, 
    'password' => password_hash($userPassword, PASSWORD_DEFAULT),
    'name' => $userName, 
    'firstname' => $userFirstname, 
    'birthdate' => $userBirthdate, 
    'picture' => $userPicture
]);
if ($insertNewUser===false)
{
    redirect('register.php?msg='. ConnexionMessages::REGISTRATION_FAILURE);
}
redirect('index.php?msg='. ConnexionMessages::REGISTRATION_SUCCESS);

//NB : j'ai modifié la longueur max du stockage de password autorisé dans ma bdd selon les recommandation de la doc php en utilisant PASSWORD_DEFAULT, ils recommandent VARCHAR (255), en cas de changement d'algo de cryptage dans une version ultérieure de php.