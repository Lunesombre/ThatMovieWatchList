<?php
$title = 'Résultats de recherche';
session_start();
$_SESSION['fromWhichPage'] = 'searchResults.php';
require_once __DIR__ . '/db/pdo.php';
require_once __DIR__ . '/classes/Utils.php.php';
require_once __DIR__ . '/classes/ConnexionMessages.php';
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/functions/search.php';

if (!isset($_GET['search'])) {
    $search = '';
} else {
    $search = strtolower($_GET['search']);
}

$BackToThatPage = $_SESSION['fromWhichPage'];

$movieSearch = "SELECT * FROM movie WHERE (movie_name LIKE :search OR movie_name_ov LIKE :search ) ORDER BY movie_name"; 
$actorSearch = "SELECT * FROM actor WhERE (actor_name LIKE :search OR actor_firstname LIKE :search) ORDER BY actor_name";
$directorSearch = "SELECT * FROM director WhERE (director_name LIKE :search OR director_firstname LIKE :search) ORDER BY director_name";

$movieResults=search($pdo,$movieSearch,$search);
$actorResults=search($pdo,$actorSearch,$search);
$directorResults=search($pdo,$directorSearch,$search);
?>
<div class="container background d-flex flex-column flex-wrap align-item-start">
    <?php if ($search === '') { ?>
        <h1>Liste des films et artistes.</h1>
    <?php } else { ?>
        <h1>Vous avez recherché : "<?php echo $search ?>"</h1>
    <?php }
    if (empty($movieResults) && empty($actorResults) && empty($directorResults)) {
        // Utils::redirect($BackToThatPage . '?msg=' . ConnexionMessages::SEARCH_ERROR);
    ?>
        <div class="alert alert-warning my-1 mx-auto" role="alert">
            Aucun résultat ne correspond à votre recherche
        </div>
    <?php } ?>
    <div>
        <?php
        if (!empty($movieResults)) { ?>
            <h2>Films correspondants à votre recherche :</h2>
            <div class="d-flex flex-row flex-wrap">
                <?php foreach ($movieResults as $result) {     ?>
                    <a href="movie.php?movie_id=<?php echo $result['movie_id'] ?>" class="searchResults text-decoration-none d-flex align-items-around p-3 m-2 rounded-3">
                        <div class="d-flex flex-column justify-content-between">
                            <h3><?php echo $result['movie_name'] ?></h3>
                            <div class="minipic rounded">
                                <img src="<?php echo $result['movie_poster'] ?>" class="img-fluid rounded" alt="poster du film <?php echo $result['movie_name'] ?>">
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div>
        <?php if (!empty($actorResults)) { ?>
            <h2>Acteurs correspondants à votre recherche :</h2>
            <div class="d-flex flex-row flex-wrap">
                <?php foreach ($actorResults as $result) {     ?>
                    <a href="artist.php?actor_id=<?php echo $result['actor_id'] ?>" class="searchResults text-decoration-none d-flex align-items-around p-3 m-2 rounded-3">
                        <div class="d-flex flex-column justify-content-between">
                            <h3><?php echo $result['actor_firstname'] . ' ';
                                if (isset($result['actor_middlename'])) {
                                    echo $result['actor_middlename'] . ' ';
                                }
                                echo $result['actor_name'] ?>
                            </h3>
                            <div class="minipic rounded">
                                <img src="<?php echo $result['actor_picture'] ?>" class="img-fluid rounded" alt="<?php echo $result['actor_name'] ?> picture">
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div>
        <?php
        if (!empty($directorResults)) { ?>
            <h2>Réalisateurs correspondants à votre recherche :</h2>
            <div class="d-flex flex-row flex-wrap">
                <?php foreach ($directorResults as $result) {     ?>
                    <a href="artist.php?director_id=<?php echo $result['director_id'] ?>" class="searchResults text-decoration-none d-flex align-items-around p-3 m-2 rounded-3">
                        <div class="d-flex flex-column justify-content-between">
                            <h3><?php echo $result['director_firstname'] . ' ';
                                if (isset($result['director_middlename'])) {
                                    echo $result['director_middlename'] . ' ';
                                }
                                echo $result['director_name'] ?>
                            </h3>
                            <div class="minipic rounded">
                                <img src="<?php echo $result['director_picture'] ?>" class="img-fluid rounded" alt="<?php echo $result['director_name'] ?> picture">
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>



<?php require_once __DIR__ . '/layout/footer.php';
