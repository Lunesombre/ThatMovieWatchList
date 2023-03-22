<?php

$dbConfig = parse_ini_file(__DIR__.'/../config/db.ini');
    [
        'DB_HOST' => $host,
        'DB_PORT' => $port,
        'DB_NAME' => $dbName,
        'DB_CHARSET' => $dbCharset,
        'DB_USER' => $dbUser,
        'DB_PASSWORD' => $dbPassword
    ] = $dbConfig;

    $dsn="mysql:host=$host;port=$port;dbname=$dbName;charset=$dbCharset";

    try {
        $pdo= new PDO(
            $dsn,
            $dbUser,
            $dbPassword,
            [PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        exit ('Error while connecting to database: '. $e->getMessage());
    }