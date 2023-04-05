<?php
session_start();
$backToThatPage = $_SESSION['fromWhichPage'];
require_once __DIR__ . '/classes/Utils.php';
require_once __DIR__ . '/db/pdo.php';

if ((empty($_GET)) || (!isset($_GET['movie_id']))) {
    Utils::redirect($backToThatPage);
}
$movie_id = $_GET['movie_id'];

if (isset($movie_id)) {
    $query = "SELECT * FROM movie where movie_id=:movie_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'movie_id' => $movie_id
    ]);

    $movie = $stmt->fetch();
    if ($movie === false) {
        Utils::redirect($backToThatPage);
    }
}
$title = $movie['movie_name'];
require_once __DIR__ . '/layout/header.php';
?>

<div class="container d-flex">
    <div class="m-5">
        <div class="movie_poster">
            <img src="<?php echo $movie['movie_poster'] ?>" alt="Poster du film <?php echo $movie['movie_name'] ?>" class="img-fluid rounded-5">
        </div>
    </div>
    <div class="m-5">
        <h1 class="text-center"><?php echo $movie['movie_name']; ?></h1>
        <?php if (isset($movie['movie_name_ov'])) { ?>
            <h2 class="text-center"><?php echo $movie['movie_name_ov']; ?></h2>
        <?php } ?>
        <h3 class="text-end">Année de sortie : <?php echo $movie['movie_year']; ?></h3>
        <p><?php echo $movie['movie_overview'] ?></p>
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-column p-3">
                <h3>Réalisé par :</h3>
                <p>
                    <?php $query = "SELECT * FROM  director  NATURAL JOIN l_director_movie WHERE movie_id=$movie_id";
                    $stmt = $pdo->query($query);
                    $thisMovieDirector = $stmt->fetchAll(); ?>
                <div class="d-flex flex-row flex-wrap">
                    <?php foreach ($thisMovieDirector as $result) {
                        // var_dump($result);    
                    ?>
                        <a href="artist.php?director_id=<?php echo $result['director_id'] ?>" class="searchResults text-decoration-none d-flex align-items-around p-3 m-2 rounded-3">
                            <div class="d-flex flex-column justify-content-between">
                                <h3><?php echo $result['director_firstname'] . ' ' . $result['director_name'] ?></h3>
                                <div class="minipic rounded">
                                    <img src="<?php echo $result['director_picture'] ?>" class="img-fluid rounded" alt="Photo de  <?php echo $result['director_firstname'] . ' ' . $result['director_name'] ?>">
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                </p>
            </div>
            <div class="d-flex flex-column p-3">

                <h3>Ils ont joué dedans :</h3>
                <p>
                    <?php $query = "SELECT * FROM l_actor_movie NATURAL JOIN actor WHERE movie_id=$movie_id";
                    $stmt = $pdo->query($query);
                    $thisMovieActors = $stmt->fetchAll(); ?>
                <div class="d-flex flex-row flex-wrap">
                    <?php foreach ($thisMovieActors as $result) {     ?>
                        <a href="artist.php?actor_id=<?php echo $result['actor_id'] ?>" class="searchResults text-decoration-none d-flex align-items-around p-3 m-2 rounded-3">
                            <div class="d-flex flex-column justify-content-between">
                                <h3><?php echo $result['actor_firstname'] . ' ' . $result['actor_name'] ?></h3>
                                <div class="minipic rounded">
                                    <img src="<?php echo $result['actor_picture'] ?>" class="img-fluid rounded" alt="Photo de  <?php echo $result['actor_firstname'] . ' ' . $result['actor_name'] ?>">
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                </p>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <?php switch ($backToThatPage) { 
                case ($backToThatPage === 'dashboard.php'): ?>
                    <a href="dashboard.php" class="align-self-end btn btn-outline-dark btn-sm">Retour à mon profil</a>
                    <?php break;
                case($backToThatPage === 'movies.php'):?>
                    <a href="movies.php" class="align-self-end btn btn-outline-dark btn-sm">Revenir à 'parcourir les films'</a>
                    <?php break;
                default : ?>
                    <a href='searchResults.php' class="align-self-end btn btn-outline-dark btn-sm">Retour à la page de recherche</a>
                    <?php break; 
                } ?>
        </div>
        <!-- <div class="d-flex justify-content-end"> -->
            <?php // if ($backToThatPage !== 'dashboard.php') { ?>
                <!-- <a href='searchResults.php' class="align-self-end btn btn-outline-dark btn-sm">Retour à la page de recherche</a> -->
            <?php // } else { ?>
                <!-- <a href="dashboard.php" class="align-self-end btn btn-outline-dark btn-sm">Retour à mon profil</a> -->
            <?php //} ?>
        <!-- </div> -->
    </div>

</div>