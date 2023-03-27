<?php
$title = "Films";
session_start();
$_SESSION['fromWhichPage'] = 'movies.php';
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/db/pdo.php';
?>

<div class="container-fluid p-5">
    <div class="row justify-content-evenly">

        <?php
        if (isset($_SESSION['pseudo'])) {
            $pseudo = $_SESSION['pseudo'];
            $query = "SELECT user_id FROM users WHERE user_nickname='$pseudo'";
            $stmt = $pdo->query($query);
            $user_test = $stmt->fetch();
            $user_id = $user_test['user_id'];
        }

        // var_dump($_SESSION);
        if (isset($_GET['wanna_id'])) {
            $movie_ID = $_GET['wanna_id'];
            $query = "INSERT INTO l_users_movie_wanna VALUES (:userId, :movieID)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                'userId' => $user_id,
                'movieID' => $movie_ID
            ]);
            $addToWannaSeeList = $stmt->fetch();
        }

        if (isset($_GET['seen_id'])) {
            $movie_ID = $_GET['seen_id'];
            $query = "INSERT INTO l_users_movie_seen VALUES (:userId, :movieID)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                'userId' => $user_id,
                'movieID' => $movie_ID
            ]);
            $addToSeenList = $stmt->fetch();
        }

        $stmt2 = $pdo->query("SELECT * FROM movie NATURAL JOIN l_director_movie NATURAL JOIN director");

        while ($row = $stmt2->fetch()) {
            $movie_id = $row['movie_id']; ?>
            <div id="<?php echo 'movie_' . $movie_id ?>" class="movie_card row d-flex border border-4 border-warning border-opacity-75 rounded-4 bg-warning-subtle m-2 ">
                <div class="movie_card_upperpart row pb-3 border border-3 align-items-evenly mx-auto">
                    <div class="col-6 pt-2 border border-3 border-primary p-3">
                        <img class="poster img-fluid rounded-4" <?php echo $row['movie_poster'] ?>>
                        <div class="text-end pt-1">
                            <?php
                            if (!isset($user_id)) {
                                echo "<button class='btn btn-warning' type='button' data-bs-toggle='modal' data-bs-target='#Modale_connexion'>
                                    <img src='./assets/img/clipboard2-plus.svg' title='Ajouter un film à la liste Déja vus'>
                                </button>
                                <button class='btn btn-danger' type='button' data-bs-toggle='modal' data-bs-target='#Modale_connexion'>
                                    <img src='./assets/img/heart.svg' title='Ajouter un film à la liste A regarder'>
                                </button>";
                            } else {
                                require __DIR__ . '/wannaSeeList.php';
                                require __DIR__ . '/seenList.php';
                            } ?>
                        </div>
                    </div>
                    <div class="border border-3 border-success col-6 d-flex flex-column justify-content-between align-items-end pt-2">
                        <h3 class="text-center">
                            <?php
                            echo $row['movie_name'];
                            ?>
                        </h3>
                        <div class="text-end">
                            <h5 class="">
                                <?php
                                echo $row['movie_name_ov'];
                                ?>
                            </h5>
                            <div class="">
                                <?php
                                echo $row['director_firstname'] . ' ' . $row['director_name'];
                                ?>
                            </div>
                            <div class="">
                                <?php
                                echo $row['movie_year'];
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="movie_card_lowerpart mx-auto mt-3 ">
                    <p class="p-3 movie_overview rounded-3">
                        <?php
                        echo $row['movie_overview'];
                        ?>
                    </p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>


<?php
require_once __DIR__ . '/layout/footer.php';
