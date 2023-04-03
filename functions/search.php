<?php
function search(PDO $pdo, string $query, string $search) : array
{
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'search' => '%' . $search . '%'
    ]);
    return $stmt->fetchAll();
}
