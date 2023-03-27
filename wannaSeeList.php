<?php

$query = "SELECT * FROM l_users_movie_wanna WHERE movie_id=$movie_id AND user_id=$user_id";
$stmt = $pdo->prepare($query);
$stmt->execute();
$checkifEmpty = $stmt->fetch();
if (empty($checkifEmpty)) {
    echo "<a href='movies.php?wanna_id=$movie_id#movie_$movie_id' class='btn btn-danger' type='button'>
        <img src='./assets/img/heart";
} else {
    echo "<a href='#movie_$movie_id' class='btn btn-danger' type='button'>
        <img src='./assets/img/heart-fill";
}
echo ".svg' title='Ajouter un film à la liste <em>Je veux voir</em>'> 
    </a>";
