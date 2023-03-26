<?php
session_start();
require_once 'functions.php';
if (!isset($_SESSION['pseudo'])){
    redirect('index.php');
}
$_SESSION['fromWhichPage']='dashboard.php';
$title='Page de '.$_SESSION['pseudo'];
require_once __DIR__ .'/layout/header.php';
require_once __DIR__.'/db/pdo.php';
require_once __DIR__ . '/classes/ConnexionMessages.php';

?>

<div class="background container d-flex flex-column">
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
    <!-- <?php //var_dump($userPicture['user_picture']);?> -->
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
                    <label for="picture" class="form-label " placeholder="image de profil">Changer votre image de profil (max 3Mb) :</label>
                    <input name="picture" class="form-control mb-2" type="file" id="picture" placeholder="profile picture">
                    <button type="submit" class="col-2 btn btn-outline-warning" value="Valider">Valider</button>
                </form>
                <form action="userSettingsManagement.php" method="POST" class="form-floating">
                    <div class="form-floating my-2">
                        <input type="text" name="pseudo" id="pseudo" class="form-control my-2" placeholder="Modifier votre pseudo">
                        <label for="pseudo" class="form-label " placeholder="Votre nouveau pseudo">Nouveau pseudo</label>
                    </div>
                    <div class="form-floating my-2">
                        <input type="password" name="currentPassword" id="currentPassword" class="form-control" placeholder="Mot de passe actuel">
                        <label for="currentPassword" class="form-label " placeholder="Mot de passe actuel">Confirmez votre mot de passe pour valider.</label>   
                    </div>
                    <button type="submit" class="col-2 btn btn-outline-warning" value="Ok">Ok</button>
                </form>
                <form action="userSettingsManagement.php" method="POST" class="">
                    <div class="form-floating my-2">
                        <input type="password" name="currentPassword" id="currentPassword" class="form-control" placeholder="Mot de passe actuel">
                        <label for="currentPassword" class="form-label " placeholder="Mot de passe actuel">Mot de passe actuel</label>   
                    </div>
                    <div class="form-floating my-2">
                        <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="Nouveau mot de passe">
                        <label for="newPassword" class="form-label " placeholder="Votre nouveau mot de passe">Nouveau mot de passe</label>
                    </div>
                    <button type="submit" class="col-2 btn btn-outline-warning" value="Ok">Ok</button>
                </form>
                <div class="">
                    Pour toute autre demande, veuillez contacter l'admin.
                </div>
            </div>
        </div>
    </div>
</div>
























<?php
require_once __DIR__ .'/layout/footer.php';