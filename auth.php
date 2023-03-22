<?php
require_once 'functions.php';
require_once 'classes/ConnexionMessages.php';
session_start();

if(empty($_POST) || !isset($_POST['userNickname']) || !isset($_POST['password'])){
    redirect('index.php');
}

    require_once __DIR__.'/db/pdo.php';


    $login = $_POST['userNickname'];
    $password = $_POST['password'];

    // requête préparée
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_nickname=:pseudo AND user_password=:mdp");
    
    $stmt->execute([
        "pseudo"=>$login,
        "mdp"=>$password
    ]);
    
    
    
    if ($stmt->fetch()=== false) {        
        // require_once 'layout/header.php';
        // echo "Cannot find user";
        redirect('login.php?msg=' . ConnexionMessages::INVALID_USER);
    } else {
        $_SESSION['isConnected']= true;
        // require_once 'layout/header.php';
        // echo "Successful connexion";
        redirect('index.php?msg=' . ConnexionMessages::CONNEXION_IS_VALID);
    }

    var_dump($_SESSION);

    require_once 'layout/footer.php';


