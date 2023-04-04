<?php
session_start();
$backToThatPage = $_SESSION['fromWhichPage'];
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/functions/redirect.php';
require_once __DIR__ . '/db/pdo.php';
// var_dump($_GET);

if (empty($_GET)) {
    redirect('index.php');
}
if (isset($_GET['actor_id'])) {
    $actor_id = $_GET['actor_id'];
} elseif (isset($_GET['director_id'])) {
    $director_id = $_GET['director_id'];
} else {
    redirect($backToThatPage);
}

if (isset($actor_id)) {
    $query = "SELECT * FROM actor where actor_id=:actor_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'actor_id' => $actor_id
    ]);

    $actor = $stmt->fetch();

    if ($actor === false) {
        redirect($backToThatPage);
    } ?>

    <div class="container d-flex">
        <div class="m-5">
            <h1 class="text-center"><?php echo $actor['actor_firstname'] ?></br><?php echo $actor['actor_name']; ?></h1>
            <div class="profile_pic">
                <img src="<?php echo $actor['actor_picture'] ?>" alt="photo de <?php echo $actor['actor_firstname'] . ' ' . $actor['actor_name'] ?>" class="img-fluid rounded-5">
            </div>
        </div>
        <div class="m-5 align-items-between">
            <h2 class="text-end">
                <?php echo $actor['actor_firstname'] . ' ' . $actor['actor_name']; ?> est
                <?php if ($actor['actor_gender'] === 1) { ?>
                    une actrice.
            </h2>
            <h3>Elle a notamment joué dans :</h3>
        <?php } else { ?>
            un acteur.
            </h2>
            <h3>Il a notamment joué dans :</h3>
        <?php } ?>
        <p>
            <?php $query = "SELECT * FROM l_actor_movie NATURAL JOIN movie WHERE actor_id=$actor_id";
            $stmt = $pdo->query($query);
            $thisActorMovies = $stmt->fetchAll(); ?>
        <div class="d-flex flex-row flex-wrap">
            <?php foreach ($thisActorMovies as $result) {     ?>
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
        </p>
        <div class="d-flex justify-content-end">
            <?php if ($backToThatPage !== 'dashboard.php') { ?>
                <a href='searchResults.php' class="align-self-end btn btn-outline-dark btn-sm">Retour à la page de recherche</a>
            <?php } else { ?>
                <a href="dashboard.php" class="align-self-end btn btn-outline-dark btn-sm">Retour à mon profil</a>
            <?php } ?>
        </div>
        </div>
    </div>
<?php
} else {
    $query = "SELECT * FROM director where director_id=:director_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'director_id' => $director_id
    ]);
    $director = $stmt->fetch();
    if ($director === false) {
        redirect($backToThatPage);
    }

?>

    <div class="container d-flex">
        <div class="m-5">
            <h1 class="text-center"><?php echo $director['director_firstname'] . ' ' . $director['director_name']; ?></h1>
            <div class="profile_pic">
                <img src="<?php echo $director['director_picture'] ?>" alt="photo de <?php echo $director['director_firstname'] . ' ' . $director['director_name'] ?>" class="img-fluid rounded-5">
            </div>
        </div>
        <div class="m-5 align-items-between">
            <h2 class="text-end">
                <?php echo $director['director_firstname'] . ' ' . $director['director_name'] ?> est
                <?php if ($director['director_gender'] === 1) { ?>
                    une réalisatrice.
            </h2>
            <h3>Elle a notamment réalisé :</h3>
        <?php } else { ?>
            un réalisateur.
            </h2>
            <h3>Il a notamment réalisé :</h3>
        <?php } ?>
        <p>
            <?php $query = "SELECT * FROM l_director_movie NATURAL JOIN movie WHERE director_id=$director_id";
            $stmt = $pdo->query($query);
            $thisDirectorMovies = $stmt->fetchAll(); ?>
        <div class="d-flex flex-row flex-wrap">
            <?php foreach ($thisDirectorMovies as $result) {     ?>
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
        </p>
        <div class="d-flex justify-content-end">
            <?php switch ($backToThatPage) {
                case ($backToThatPage === 'dashboard.php'): ?>
                    <a href="dashboard.php" class="align-self-end btn btn-outline-dark btn-sm">Retour à mon profil</a>
                <?php break;
                case ($backToThatPage === 'movies.php'): ?>
                    <a href="movies.php" class="align-self-end btn btn-outline-dark btn-sm">Revenir à 'parcourir les films'</a>
                <?php break;
                default: ?>
                    <a href='searchResults.php' class="align-self-end btn btn-outline-dark btn-sm">Retour à la page de recherche</a>
            <?php break;
            } ?>
        </div>
        </div>
    </div>
<?php } ?>

<?php
require_once __DIR__ . '/layout/footer.php';
