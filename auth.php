<?php
$title="Authentification";
require_once 'functions.php';
require_once 'classes/ConnexionMessages.php';
session_start();

if(!empty($_POST) && isset($_POST['userNickname']) && isset($_POST['password'])){
    
    $dbConfig = parse_ini_file('config/db.ini');
    [
        'DB_HOST' => $host,
        'DB_PORT' => $port,
        'DB_NAME' => $dbName,
        'DB_CHARSET' => $dbCharset,
        'DB_USER' => $dbUser,
        'DB_PASSWORD' => $dbPassword
    ] = $dbConfig;

    $dsn="mysql:host=$host;port=$port;dbname=$dbName;charset=$dbCharset";

    try {
        $pdo= new PDO(
            $dsn,
            $dbUser,
            $dbPassword,
            [PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        exit ('Error while connecting to database: '. $e->getMessage());
    }

    $login = $_POST['userNickname'];
    $password = $_POST['password'];

    // requête préparée
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_nickname=:pseudo AND user_password=:mdp");
    
    $stmt->execute([
        ":pseudo"=>$login,
        ":mdp"=>$password
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
}else{
    echo "Za n'a pas fonczionné, ach !";
}

