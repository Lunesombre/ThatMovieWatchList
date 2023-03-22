<?php
$title="Films";
session_start();
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/db/pdo.php';
?>

<div class="container-fluid p-5">
    <div class="row justify-content-evenly">

<?php
$stmt = $pdo->query("SELECT * FROM movie NATURAL JOIN l_director_movie NATURAL JOIN director");

while($row=$stmt->fetch()) {?>
    <div class="movie_card row d-flex border border-4 border-warning border-opacity-75 rounded-4 bg-warning-subtle m-2 ">
    <div class="movie_card_upperpart row pb-3 border border-3 align-items-evenly mx-auto">
        <div class="col-6 pt-2 border border-3 border-primary p-3">
            <img class="poster img-fluid rounded-4" <?php echo $row['movie_poster'] ?>>
            <div class="text-end pt-1">
            <button class="btn btn-warning" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16">
                    <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
                    <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
                    <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5V6.5Z"/>
                </svg>
            </button>
            <button class="btn btn-danger" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                </svg>
            </button>
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
                    echo $row['director_firstname'].' '.$row['director_name'];
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
require_once __DIR__. '/layout/footer.php';