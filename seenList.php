<?php
require_once __DIR__ . '/functions/user.php';

$svg = "clipboard2-plus.svg";
$getParam = "?addToSeen=" . $movie_id;

if (hasSeen($pdo, $movie_id, $user_id)) {
    $svg = "clipboard2-plus-fill.svg";
    $getParam = "?removeFromSeen=" . $movie_id;
}
?>

<a href="movies.php<?php echo $getParam; ?>#movie_<?php echo $movie_id ?>" class="btn btn-warning">
    <img src='./assets/img/<?php echo $svg; ?>' title='Liste "Déja vus"'>
</a>