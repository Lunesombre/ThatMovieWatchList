<?php
require_once __DIR__ . '/functions/user.php';
// ----------------------------------------------------------------
// quand on clique sur le petit dossier
// 1 - le dossier passe en version remplie
// 2 - le film en question est enregistré dans la liste de films à voir
// TODO: 2b - s'il est déjà enregistré, il faut l'en enlever
// TODO: 3 - il devient affichable dans la dashboard de l'utilisateur




$svg = "clipboard2-plus.svg";
$getParam = "?addToSeen=" . $movie_id;

if (hasSeen($pdo, $movie_id, $user_id)) {
    $svg = "clipboard2-plus-fill.svg";
    $getParam = "?removeFromSeen=". $movie_id;
}
?>

<a href="movies.php<?php echo $getParam; ?>#movie_<?php echo $movie_id ?>" class="btn btn-warning">
    <img src='./assets/img/<?php echo $svg; ?>' title='Liste "Déja vus"'>
</a>


<?php
// requête pour DELETE la ligne. TODO: voir comment la placer.
    // changement d'idée : au lieu de rediriger vers movies.php avec un paramètre $_GET, je vais rediriger ici directement avec un $paramètre $_GET









// $stmt3 = $pdo->query("DELETE FROM l_users_movie_seen WHERE (user_id=$user_id AND movie_id=$movie_id)");
// $delete=$stmt3->fetch();