<?php
require_once __DIR__ . '/functions/redirect.php';
require_once __DIR__ . '/classes/ConnexionMessages.php';

if (empty($_POST) || !isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['birthdate']) || !isset($_POST['email']) || !isset($_POST['pseudo']) || !isset($_POST['password'])) {
    redirect('register.php');
}

require_once __DIR__ . '/db/pdo.php';

$userName = $_POST['nom'];
$userFirstname = $_POST['prenom'];
$userEmail = $_POST['email'];
$userPassword = $_POST['password'];
$userBirthdate = $_POST['birthdate'];
$userPseudo = $_POST['pseudo'];

$query = "SELECT * FROM users WHERE user_email = :email";
$stmt = $pdo->prepare($query);

$stmt->execute(['email' => $userEmail]);
$testEmailUsage = $stmt->fetch();
if ($testEmailUsage) {
    redirect('register.php?msg=' . ConnexionMessages::EMAIL_ALREADY_USED);
}
$query = "SELECT * FROM users WHERE user_nickname = :pseudo";
$stmt = $pdo->prepare($query);

$stmt->execute(['pseudo' => $userPseudo]);
$testPseudoUsage = $stmt->fetch();
if ($testPseudoUsage) {
    redirect('register.php?msg=' . ConnexionMessages::PSEUDONYM_ALREADY_USED);
}

$query = "INSERT INTO users (user_nickname, user_email, user_password, user_name, user_firstname, user_birthdate) VALUES (:pseudo, :email, :password, :name, :firstname, :birthdate)";

$stmt = $pdo->prepare($query);

$insertNewUser = $stmt->execute([
    'pseudo' => $userPseudo,
    'email' => $userEmail,
    'password' => password_hash($userPassword, PASSWORD_DEFAULT),
    'name' => $userName,
    'firstname' => $userFirstname,
    'birthdate' => $userBirthdate,
]);
if ($insertNewUser === false) {
    redirect('register.php?msg=' . ConnexionMessages::REGISTRATION_FAILURE);
}
redirect('index.php?msg=' . ConnexionMessages::REGISTRATION_SUCCESS);

//NB : j'ai modifié la longueur max du stockage de password autorisé dans ma bdd selon les recommandation de la doc php en utilisant PASSWORD_DEFAULT, ils recommandent VARCHAR (255), en cas de changement d'algo de cryptage dans une version ultérieure de php.