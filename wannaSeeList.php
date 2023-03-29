<?php
require_once __DIR__ . '/functions/user.php';

$svg = "heart.svg";
$getParam = "?addToWannaSee=" . $movie_id;

if (wannaSee($pdo, $movie_id, $user_id)) {
    $svg = "heart-fill.svg";
    $getParam = "?removeFromWannaSee=" . $movie_id;
} ?>

<a href="movies.php<?php echo $getParam; ?>#movie_<?php echo $movie_id ?>" class="btn btn-danger">
    <img src='./assets/img/<?php echo $svg; ?>' title='Liste "Je veux voir"'>
</a>