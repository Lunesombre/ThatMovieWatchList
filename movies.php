<?php
$title = "Films";
session_start();
$_SESSION['fromWhichPage'] = 'movies.php';
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/db/pdo.php';
require_once __DIR__ . '/classes/ConnexionMessages.php';
require_once __DIR__ . '/functions/user.php';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
?>

<div class="container-fluid p-5 d-flex flex-column justify-content-center">
    <?php if (array_key_exists('msg', $_GET)) { ?>
        <div class="alert alert-warning my-1 mx-auto" role="alert">
            <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msg'])); ?>
        </div>
    <?php } ?>

    <div class="row justify-content-evenly">
        <?php
        // faire un switchcase pour récupérer le paramètre du $_GET et définir la colonne ciblée dans la requête.
        if (!empty($_GET)) {
            switch ($_GET) {
                case (isset($_GET['addToWannaSee'])):
                    $movie_ID = $_GET['addToWannaSee'];
                    $table = 'l_users_movie_wanna';
                    addToListsInDatabase($pdo, $user_id, $movie_ID, $table);
                    break;
                case (isset($_GET['addToSeen'])):
                    $movie_ID = $_GET['addToSeen'];
                    $table = 'l_users_movie_seen';
                    addToListsInDatabase($pdo, $user_id, $movie_ID, $table);
                    break;
                case (isset($_GET['removeFromWannaSee'])):
                    $movie_ID = $_GET['removeFromWannaSee'];
                    $table = 'l_users_movie_wanna';
                    removeFromListsInDB($pdo, $user_id, $movie_ID, $table);
                    break;
                case (isset($_GET['removeFromSeen'])):
                    $movie_ID = $_GET['removeFromSeen'];
                    $table = 'l_users_movie_seen';
                    addToListsInDatabase($pdo, $user_id, $movie_ID, $table);
                    break;
            }
        }


        // if (isset($_GET['addToWannaSee'])) {
        //     $movie_ID = $_GET['addToWannaSee'];
        //     $insertIntoWannaSeeQuery = "INSERT INTO l_users_movie_wanna VALUES (:userID, :movieID)";
        //     addToListsInDatabase($pdo, $user_id, $movie_ID, $insertIntoWannaSeeQuery);
        // }

        // if (isset($_GET['addToSeen'])) {
        //     $movie_ID = $_GET['addToSeen'];
        //     $insertInSeenQuery = "INSERT INTO l_users_movie_seen VALUES (:userID, :movieID)";
        //     addToListsInDatabase($pdo, $user_id, $movie_ID, $insertInSeenQuery);
        // }

        // if (isset($_GET['removeFromWannaSee'])) {
        //     $movie_ID = $_GET['removeFromWannaSee'];
        //     $deleteFromWannaSeeQuery = "DELETE FROM l_users_movie_wanna WHERE (user_id=:userID AND movie_id=:movieID)";
        //     removeFromListsInDB($pdo, $user_id, $movie_ID, $deleteFromWannaSeeQuery);
        // }

        // if (isset($_GET['removeFromSeen'])) {
        //     $movie_ID = $_GET['removeFromSeen'];
        //     $deleteFromSeenQuery = "DELETE FROM l_users_movie_seen WHERE (user_id=:userID AND movie_id=:movieID)";
        //     removeFromListsInDB($pdo, $user_id, $movie_ID, $deleteFromSeenQuery);
        // }



        $stmt = $pdo->query("SELECT * FROM movie");

        while ($row = $stmt->fetch()) {
            $movie_id = $row['movie_id']; ?>
            <div id="<?php echo 'movie_' . $movie_id ?>" class="movie_card row d-flex rounded-4 m-2 ">
                <div class="movie_card_upperpart row pb-3 align-items-evenly mx-auto">
                    <div class="col-6 p-3">
                        <a href="movie.php?movie_id=<?php echo $movie_id ?>" class="text-decoration-non">
                            <img class="poster img-fluid rounded-4" src="<?php echo $row['movie_poster'] ?>" alt="Poster <?php echo $row['movie_name'] ?>">
                            <div class="text-end pt-1">
                                <?php
                                if (!isset($user_id)) { ?>
                                    <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#Modale_connexion'>
                                        <img src='./assets/img/clipboard2-plus.svg' title='Ajouter un film à la liste Déja vus'>
                                    </button>
                                    <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#Modale_connexion'>
                                        <img src='./assets/img/heart.svg' title='Ajouter un film à la liste A regarder'>
                                    </button>
                                <?php } else {
                                    require __DIR__ . '/seenList.php';
                                    require __DIR__ . '/wannaSeeList.php';
                                } ?>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-between align-items-end pt-2">
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
                                $query2 = "SELECT * FROM l_director_movie NATURAL JOIN director WHERE movie_id = $movie_id";
                                $stmt2 = $pdo->query($query2);
                                $directors = $stmt2->fetchAll();
                                foreach ($directors as $director) {
                                    echo substr($director['director_firstname'], 0, 1) . '. ' . $director['director_name'] . '</br>';
                                } ?>
                            </div>
                            <div class="">
                                <?php
                                echo $row['movie_year'];
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="movie.php?movie_id=<?php echo $movie_id ?>" class="text-decoration-none movie_card_lowerpart mx-auto mt-3">
                    <p class="p-3 movie_overview rounded-3">
                        <?php
                        $truncatedOverview = substr($row['movie_overview'], 0, 210); // tronque si ça dépasse 210 caractères
                        $paddedTo210Overview = str_pad($truncatedOverview, 210, " "); // rajoute des espaces si nécessaire pour atteindre 210 caractères
                        echo str_pad($paddedTo210Overview, 213, '.'); // rajoute '...' pour finir
                        ?>
                    </p>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
require_once __DIR__ . '/layout/footer.php';
