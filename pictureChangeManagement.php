<?php 
session_start();
var_dump($_SESSION);
require_once __DIR__ .'/functions.php';
require_once __DIR__ . '/classes/ConnexionMessages.php';
require_once __DIR__ . '/db/pdo.php';
// var_dump($_FILES);

if(isset($_FILES['picture'])){
    $file = $_FILES['picture'];
}
$error=$file['error'];
if($error!==0){
    redirect('dashboard.php?msg='.ConnexionMessages::INVALID_FILE_REGISTRATION);
}
// prévoir de mieux gérer les différentes erreurs possibles.

$filename=$file['name'];

$destination = __DIR__."/assets/img/profile_pictures/".$filename;
$pseudo=$_SESSION['pseudo'];
if(move_uploaded_file($file['tmp_name'], $destination)) {
    $query="UPDATE users SET user_picture = :picture WHERE user_nickname = '$pseudo'";
    $stmt=$pdo->prepare($query);
    $updateDbUser_picture=$stmt->execute([
        'picture' => $filename
    ]);
    if($updateDbUser_picture===false) {
        redirect('dashboard.php?msg='.ConnexionMessages::PROFILE_UPDATE_FAILURE);
    }
    redirect('dashboard.php?msg='.ConnexionMessages::SUCCESSFUL_FILE_REGISTRATION);
}
redirect('dashboard.php?msg='.ConnexionMessages::INVALID_FILE_REGISTRATION);
