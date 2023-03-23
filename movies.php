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
                            <img src="./assets/img/clipboard2-plus.svg" alt="Ajouter un film à la liste 'Vus'">
                        </button>
                        <button class="btn btn-danger" type="button">
                            <img src="./assets/img/heart.svg" alt="Ajouter un film à la liste 'A regarder'">
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