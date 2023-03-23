<?php
session_start();
require_once 'functions.php';
if (!isset($_SESSION['pseudo'])){
    redirect('index.php');
}
$title='Page de '.$_SESSION['pseudo'];
require_once __DIR__ .'/layout/header.php';
require_once __DIR__.'/db/pdo.php';
require_once __DIR__ . '/classes/ConnexionMessages.php';

?>

<div class="container d-flex flex-column">
    <h1>Bienvenue <?php echo $_SESSION['pseudo'];?></h1>
    <?php
    if (array_key_exists('msg', $_GET)){ ?>
        <div class="alert alert-warning my-1 mx-auto" role="alert">
            <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msg'])); ?>
        </div>
    <?php } ?>
    <div class="profile_pic">
        <img class="img-fluid rounded-4" src="
        <?php 
        $query="SELECT user_picture FROM users WHERE user_nickname=:pseudo";
        $stmt=$pdo->prepare($query);
        $stmt->execute([':pseudo' => $_SESSION['pseudo']]);
        $userPicture=$stmt->fetch();
        if($userPicture['user_picture']===null){
            echo './assets/img/default_user_pic.jpg';
        }else echo './assets/img/profile_pictures/'.$userPicture['user_picture'];
        ?>">
    </div>
    <!-- <?php var_dump($userPicture['user_picture']);?> -->
    <p>
        <button class="btn btn-outline-warning btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
            <img class="py-1" src="./assets/img/gear.svg" alt="Paramètres">
        </button>
    </p>
    <div style="min-height: 120px;">
        <div class="collapse collapse-horizontal" id="collapseWidthExample">
            <div class="card card-body" style="min-width: 300px;">
                <form enctype="multipart/form-data" action="pictureChangeManagement.php" method="POST">
                    <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
                    <label for="picture" class="form-label " placeholder="image de profil">Changer votre image de profil :</label>
                    <input name="picture" class="form-control mb-2" type="file" id="picture" placeholder="profile picture">
                    <button type="submit" class="col-2 btn btn-outline-warning" value="Valider">Valider</button>
                </form>
                    <br>
                    <!-- pseudo -->
                    <!-- penser à modifier le $_SESSION avec le nouveau pseudo le cas échéant -->
                    <br>
                    <!-- password -->
                    <br>
                <div class="">
                    Pour toute autre demande, veuillez contacter l'admin.
                </div>
            </div>
        </div>
    </div>
</div>
























<?php
require_once __DIR__ .'/layout/footer.php';