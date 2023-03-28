<?php
function hasSeen(PDO $pdo, int $movie_id, int $user_id): bool
{
    $query = "SELECT * FROM l_users_movie_seen WHERE movie_id=:movieID AND user_id=:userID";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'userID' => $user_id,
        'movieID' => $movie_id
    ]);
    return $stmt->fetch() !== false;
}

function wannaSee(PDO $pdo, int $movie_id, int $user_id): bool
{
    $query = "SELECT * FROM l_users_movie_wanna WHERE movie_id=:movieID AND user_id=:userID";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'userID' => $user_id,
        'movieID' => $movie_id
    ]);
    return $stmt->fetch() !==false;
}
