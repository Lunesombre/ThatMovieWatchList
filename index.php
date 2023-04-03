<?php
$title = "Accueil";
require_once __DIR__ . '/classes/ConnexionMessages.php';
session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
}
$_SESSION['fromWhichPage'] = 'index.php';
require_once __DIR__ . '/db/pdo.php';
require_once __DIR__ . '/layout/header.php';
?>

<div class="container-fluid d-flex flex-column justify-content-center">
    <?php if (array_key_exists('msg', $_GET)) { ?>
        <div class="alert alert-warning my-1 mx-auto" role="alert">
            <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msg'])); ?>
        </div>
    <?php } ?>
    <div>

        <h2 class="pt-5 pb-3 text-center">Les derniers films ajoutés : </h2>
        <div id="landingPageCarousel" class="carousel slide p-3" data-bs-ride="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#landingPageCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#landingPageCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#landingPageCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner ">
                <?php 
                function countTotalMoviesInDB (PDO $pdo) :int
                {
                $query = "SELECT movie_id FROM movie";
                $stmt = $pdo->query($query);
                $results = $stmt->fetchAll();
                $countMovies = count($results);
                return $countMovies;
                }
                $count=countTotalMoviesInDB($pdo);
                $query = "SELECT * FROM movie ORDER BY movie_id DESC LIMIT 3";
                $stmt = $pdo->query($query);
                $results = $stmt->fetchAll();
                foreach ($results as $row) { ?>
                    <div class="carousel-item 
                    <?php if (in_array($count, $row)) {
                        echo 'active';
                    }; ?> 
                    ">
                        <div class="d-flex">
                            <div class="col-6 d-flex justify-content-end me-1">
                                <img src="<?php echo $row['movie_poster'] ?>" class="d-block rounded-3" alt="Poster <?php echo $row['movie_name'] ?>" class="img-fluid">
                            </div>
                            <div class="col-6 d-none d-md-block">
                                <div class="col-6 p-4 ms-1 bg-dark text-light rounded-3 h-100 d-flex flex-column justify-content-between">
                                    <h3><?php echo $row['movie_name'] ?></h3>
                                    <p>
                                        <?php $query = "SELECT * FROM l_style_movie NATURAL JOIN style WHERE movie_id = " . $row['movie_id'];
                                        $stmt = $pdo->query($query);
                                        $result = $stmt->fetchALL();
                                        foreach ($result as $style) { ?>
                                            <button class="btn btn-info btn-sm">
                                                <?php echo $style['style_name'] . '</br>'; ?>
                                            </button>
                                        <?php } ?>
                                    </p>
                                    <p>
                                        <?php echo $row['movie_overview'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#landingPageCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#landingPageCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . '/layout/footer.php';
