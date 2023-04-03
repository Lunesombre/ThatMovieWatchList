<?php
function userHasSeen(PDO $pdo, int $movie_id, int $user_id): bool
{
    $query = "SELECT * FROM l_users_movie_seen WHERE movie_id=:movieID AND user_id=:userID";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'userID' => $user_id,
        'movieID' => $movie_id
    ]);
    return $stmt->fetch() !== false;
}

function userWannaSee(PDO $pdo, int $movie_id, int $user_id): bool
{
    $query = "SELECT * FROM l_users_movie_wanna WHERE movie_id=:movieID AND user_id=:userID";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'userID' => $user_id,
        'movieID' => $movie_id
    ]);
    return $stmt->fetch() !==false;
}

function addToListsInDatabase(PDO $pdo, int $user_id, int $movie_ID,  string $query) :bool
{
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'userID' => $user_id,
        'movieID' => $movie_ID
    ]);
    return $stmt->fetch() !==false;
}

function removeFromListsInDB(PDO $pdo, int $user_id, int $movie_ID,  string $query) :bool
{
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'userID' => $user_id,
        'movieID' => $movie_ID
    ]);
    return $stmt->fetch() !==false;
}