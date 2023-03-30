<?php
session_start();
require_once __DIR__ . '/functions/redirect.php';
require_once 'classes/ConnexionMessages.php';

if (empty($_POST) || !isset($_POST['userNickname']) || !isset($_POST['password'])) {
    redirect('index.php');
}

require_once __DIR__ . '/db/pdo.php';


$login = $_POST['userNickname'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT user_password FROM users WHERE user_nickname=:pseudo");

$stmt->execute(["pseudo" => $login]);
$userPasswordCheck = $stmt->fetch();

$BackToThatPage = $_SESSION['fromWhichPage'];
if ($userPasswordCheck === false) {
    redirect($BackToThatPage . '?msg=' . ConnexionMessages::INVALID_USER);
}

$hashedPassword = $userPasswordCheck['user_password'];
if (password_verify($password, $hashedPassword) === false) {
    redirect($BackToThatPage . '?msg=' . ConnexionMessages::WRONG_PASSWORD);
}

$_SESSION['isConnected'] = true;
$_SESSION['pseudo'] = $login;
redirect($BackToThatPage . '?msg=' . ConnexionMessages::CONNEXION_IS_VALID);
