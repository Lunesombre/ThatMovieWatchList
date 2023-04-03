<?php
session_start();
require_once __DIR__ . '/functions/redirect.php';
require_once __DIR__ . '/classes/ConnexionMessages.php';

if (empty($_POST) || empty($_POST['pseudo']) && empty($_POST['newPassword'])) {
    redirect('dashboard.php');
}
require_once __DIR__ . '/db/pdo.php';

var_dump($_POST);

$currentPassword = $_POST['currentPassword'];

if (!empty($_POST['pseudo'])) {
    $newPseudo = $_POST['pseudo'];
    echo 'nouveau pseudo ok';
}

if (!empty($_POST['newPassword'])) {
    $newPassword = $_POST['newPassword'];
    echo 'nouveau mot de passe ok';
}
// var_dump($newPseudo);
// // var_dump($newPassword);
// var_dump($_SESSION);
//vérification du mot de passe actuel
$stmt = $pdo->prepare("SELECT user_password FROM users WHERE user_nickname=:nickname");
$stmt->execute(['nickname' => $_SESSION['pseudo']]);
$passwordCheck = $stmt->fetch();
if ($passwordCheck === false) {
    $_SESSION = [];
    session_destroy();
    redirect('index.php?msg=' . ConnexionMessages::PROFILE_UPDATE_FAILURE);
}
var_dump($passwordCheck);
$hashedPassword = $passwordCheck['user_password'];

if (password_verify($currentPassword, $hashedPassword) === false) {
    redirect('dashboard.php?msg=' . ConnexionMessages::WRONG_PASSWORD);
}

// enregistrement du nouveau pseudo
if (isset($newPseudo) === true) {
    $query = "UPDATE users SET user_nickname = :pseudo WHERE user_password = :pass";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'pseudo' => $newPseudo,
        'pass' => $hashedPassword
    ]);
    $stmt->fetch();
    $_SESSION['pseudo'] = $newPseudo;
    redirect('dashboard.php?msg=' . ConnexionMessages::PROFILE_UPDATE_SUCCESS);
}

//enregistrement du nouveau mot de passe
if (isset($newPassword) === true) {
    $query = "UPDATE users SET user_password = :pass WHERE user_nickname = :pseudo";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'pass' => password_hash($newPassword, PASSWORD_DEFAULT),
        'pseudo' => $_SESSION['pseudo']
    ]);
    $stmt->fetch();
    redirect('dashboard.php?msg=' . ConnexionMessages::PROFILE_UPDATE_SUCCESS);
}
