<?php
$title = 'Résultats de recherche';
session_start();
// $_SESSION['fromWhichPage'] = 'searchResults.php';
require_once __DIR__ . '/db/pdo.php';
require_once __DIR__ . '/functions/redirect.php';
require_once __DIR__ . '/classes/ConnexionMessages.php';
require_once __DIR__ . '/layout/header.php';

$search = strtolower($_GET['search']);

$query = "SELECT * FROM movie WHERE (movie_name LIKE :search OR movie_name_ov LIKE :search ) ORDER BY movie_id LIMIT 50";
$query2 = "SELECT * FROM actor WhERE (actor_name LIKE :search OR actor_firstname LIKE :search) ORDER BY actor_name LIMIT 50";
$query3 = "SELECT * FROM director WhERE (director_name LIKE :search OR director_firstname LIKE :search) ORDER BY director_name LIMIT 50";

$stmt = $pdo->prepare($query);
$stmt->execute([
    'search' => '%' . $search . '%'
]);

$stmt2 = $pdo->prepare($query2);
$stmt2->execute([
    'search' => '%' . $search . '%'
]);

$stmt3 = $pdo->prepare($query3);
$stmt3->execute([
    'search' => '%' . $search . '%'
]);

$BackToThatPage = $_SESSION['fromWhichPage'];

$movieResults = $stmt->fetchAll();
$actorResults = $stmt2->fetchAll();
$directorResults = $stmt3->fetchAll();
if (empty($movieResults) && empty($actorResults) && empty($directorResults)) {
    // redirect($BackToThatPage . '?msg=' . ConnexionMessages::SEARCH_ERROR);
?>
    <div class="alert alert-warning my-1 mx-auto" role="alert">
        Aucun résultat ne correspond à votre recherche
    </div>
<?php } ?>
<div class="container background d-flex flex-column flex-wrap align-item-start">
        <h1>Vous avez recherché : "<?php echo $search ?>"</h1>
    <div>
        <?php
        if (!empty($movieResults)) { ?>
            <h2>Films correspondants à votre recherche :</h2>
            <div class="d-flex flex-row flex-wrap">
                <?php foreach ($movieResults as $result) {     ?>
                    <div class="searchResults d-flex align-items-around p-3 m-2 rounded-3">
                        <div class="d-flex flex-column justify-content-between">
                            <h3><?php echo $result['movie_name'] ?></h3>
                            <div class="minipic rounded">
                                <img <?php echo $result['movie_poster'] ?> class="img-fluid rounded" alt="poster du film <?php echo $result['movie_name'] ?>">
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

    </div>
    <div>
        <?php if (!empty($actorResults)) { ?>
            <h2>Acteurs correspondants à votre recherche :</h2>
            <div class="d-flex flex-row flex-wrap">
                <?php foreach ($actorResults as $result) {     ?>
                    <div class="searchResults d-flex align-items-around p-3 m-2 rounded-3">
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
                    </div>
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
                    <div class="searchResults d-flex align-items-around p-3 m-2 rounded-3">
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
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>



<?php require_once __DIR__ . '/layout/footer.php';
