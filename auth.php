<?php
session_start();
require_once __DIR__.'/functions/redirect.php';
require_once 'classes/ConnexionMessages.php';

if (empty($_POST) || !isset($_POST['userNickname']) || !isset($_POST['password'])) {
    redirect('index.php');
}

require_once __DIR__ . '/db/pdo.php';


$login = $_POST['userNickname'];
$password = $_POST['password'];

// requête préparée
$stmt = $pdo->prepare("SELECT user_password FROM users WHERE user_nickname=:pseudo");

$stmt->execute(["pseudo" => $login]);
$userPasswordCheck = $stmt->fetch();

if ($userPasswordCheck === false) {
    redirect('index.php?msg=' . ConnexionMessages::INVALID_USER);
}

$hashedPassword = $userPasswordCheck['user_password'];
if (password_verify($password, $hashedPassword) === false) {
    redirect('index.php?msg=' . ConnexionMessages::INVALID_USER);
}

$_SESSION['isConnected'] = true;
$_SESSION['pseudo'] = $login;
$goBackToThatPage = $_SESSION['fromWhichPage'];
redirect($goBackToThatPage . '?msg=' . ConnexionMessages::CONNEXION_IS_VALID);
