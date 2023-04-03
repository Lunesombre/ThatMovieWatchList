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
    return $stmt->fetch() !== false;
}

function isAlreadyInList(PDO $pdo, int $movie_ID, int $user_ID, string $table): bool
{
    $query = "SELECT * FROM $table WHERE movie_id=:movie_ID AND user_id=:user_ID";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'movie_ID' => $movie_ID,
        'user_ID' => $user_ID
    ]);
    return $stmt->fetch() !== false;
}

function addToListsInDatabase(PDO $pdo, int $user_id, int $movie_ID,  string $table): bool
{
    if (isAlreadyInList($pdo, $movie_ID, $user_id, $table) === false) {
        $query = "INSERT INTO $table VALUES (:userID, :movieID)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'userID' => $user_id,
            'movieID' => $movie_ID
        ]);
        return $stmt->fetch() !== false;
    }
}

function removeFromListsInDB(PDO $pdo, int $user_id, int $movie_ID,  string $table): bool
{
    $query = "DELETE FROM $table WHERE (user_id=:userID AND movie_id=:movieID)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'userID' => $user_id,
        'movieID' => $movie_ID
    ]);
    return $stmt->fetch() !== false;
}
