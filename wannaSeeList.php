<?php
// ----------------------------------------------------------------
// quand on clique sur le petit coeur
// 1 - le coeur passe en version remplie
// 2 - le film en question est enregistré dans la liste de films à voir
// TODO: 2b - s'il est déjà enregistré, il faut l'en enlever
// TODO: 3 - il devient affichable dans la dashboard de l'utilisateur




$query="SELECT * FROM l_users_movie_wanna WHERE movie_id=$movie_id AND user_id=$user_id";
    $stmt=$pdo->prepare($query);
    $stmt->execute();
    $checkifEmpty=$stmt->fetch();
    if(empty($checkifEmpty)){
        echo "<a href='movies.php?movie_id=$movie_id#movie_$movie_id' class='btn btn-warning' type='button'>
        <img src='./assets/img/clipboard2-plus";
    }else{
        echo "<a href='#movie_$movie_id' class='btn btn-warning' type='button'>
        <img src='./assets/img/clipboard2-plus-fill";
    }
    echo ".svg' title='Ajouter un film à la liste <em>Déja vus</em>'> 
    </a>";
    
    // requête pour DELETE la ligne. TODO: voir comment la placer.
    // $stmt3 = $pdo->query("DELETE FROM l_users_movie_wanna WHERE (user_id=$user_id AND movie_id=$movie_id)");
    // $delete=$stmt3->fetch();