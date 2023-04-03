<?php
session_start();
require_once __DIR__ . '/functions/redirect.php';
require_once __DIR__ . '/db/pdo.php';
if (!isset($_SESSION['pseudo'])) {
    redirect('index.php');
}
$pseudo = $_SESSION['pseudo'];
$query = "SELECT user_id FROM users WHERE user_nickname='$pseudo'";
$stmt = $pdo->query($query);
$user_test = $stmt->fetch();
$user_id = $user_test['user_id'];


$_SESSION['fromWhichPage'] = 'dashboard.php';
$title = 'Profil de ' . $_SESSION['pseudo'];
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/db/pdo.php';
require_once __DIR__ . '/classes/ConnexionMessages.php';
?>

<div class="background container d-flex flex-column">
    <?php
    if (array_key_exists('msg', $_GET)) { ?>
        <div class="alert alert-warning my-1 mx-auto" role="alert">
            <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msg'])); ?>

        </div>
    <?php } ?>
    <h1 class="p-3">Bienvenue <?php echo $_SESSION['pseudo']; ?></h1>
    <div class="d-flex">
        <div class="leftSide col-4 p-4">
            <div class="profile_pic">
                <img class="img-fluid rounded-4" src="
            <?php
            $query = "SELECT user_picture FROM users WHERE user_nickname=:pseudo";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':pseudo' => $_SESSION['pseudo']]);
            $userPicture = $stmt->fetch();
            if ($userPicture['user_picture'] === null) {
                echo './assets/img/default_user_pic.jpg';
            } else echo './assets/img/profile_pictures/' . $userPicture['user_picture'];
            ?>">
            </div>
            <p>
                <button class="btn btn-outline-warning btn-sm mx-3 mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapsableSettings" aria-expanded="false" aria-controls="collapsableSettings">
                    <img class="py-1" src="./assets/img/gear.svg" alt="Paramètres">
                </button>
            </p>
            <div class="mb-5">
                <div class="collapse collapse-horizontal" id="collapsableSettings">
                    <div class="card card-body" style="width:400px">
                        <h3>Paramètres</h3>
                        <form enctype="multipart/form-data" action="pictureChangeManagement.php" method="POST">
                            <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
                            <label for="picture" class="form-label " placeholder="image de profil">Changer votre image de profil (max 3Mb) :</label>
                            <input name="picture" class="form-control mb-2" type="file" id="picture" placeholder="profile picture">
                            <button type="submit" class="col-2 btn btn-outline-warning" value="Valider">Ok</button>
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
        <div class="rightSide p-4 col-8">
            <h2 class="text-center">Ma liste de film "A regarder"</h2>
            <div class="d-flex flex-wrap justify-content-evenly">
                <?php
                $query = "SELECT * FROM movie WHERE movie_id IN (SELECT movie_id FROM l_users_movie_wanna WHERE l_users_movie_wanna.user_id =$user_id)";
                $stmt = $pdo->query($query);
                if (empty($moviesOnWannaSeeList = $stmt->fetchAll())) { ?>
                    <div> Vous n'avez aucun film sur votre liste.</div>
                <?php }
                foreach ($moviesOnWannaSeeList as $row) { ?>
                    <a href="movie.php?movie_id=<?php echo $row['movie_id'] ?>" class="searchResults text-decoration-none d-flex align-items-around p-3 m-2 rounded-3">
                        <div class="d-flex flex-column justify-content-between">
                            <h3><?php echo $row['movie_name'] ?></h3>
                            <div class="minipic rounded">
                                <img src="<?php echo $row['movie_poster'] ?>" class="img-fluid rounded" alt="poster du film <?php echo $row['movie_name'] ?>">
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
            <h2 class="text-center mt-5">Films déjà vus</h2>
            <div class="d-flex flex-wrap justify-content-evenly mb-5">
                <?php $query = "SELECT * FROM movie WHERE movie_id IN (SELECT movie_id FROM l_users_movie_seen WHERE user_id =$user_id)";
                $stmt = $pdo->query($query);
                if (empty($moviesAlreadySeen = $stmt->fetchAll())) { ?>
                    <div> Vous n'avez vu aucun film ?</div>
                <?php }
                foreach ($moviesAlreadySeen as $row) { ?>
                    <a href="movie.php?movie_id=<?php echo $row['movie_id'] ?>" class="searchResults text-decoration-none d-flex align-items-around p-3 m-2 rounded-3">
                        <div class="d-flex flex-column justify-content-between">
                            <h3><?php echo $row['movie_name'] ?></h3>
                            <div class="minipic rounded">
                                <img src="<?php echo $row['movie_poster'] ?>" class="img-fluid rounded" alt="poster du film <?php echo $row['movie_name'] ?>">
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
























<?php
require_once __DIR__ . '/layout/footer.php';
