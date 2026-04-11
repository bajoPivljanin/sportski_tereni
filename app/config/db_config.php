<?php
try {
    $connection = new PDO(
        "mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME . ";charset=utf8mb4",
        Config::DB_USER,
        Config::DB_PASSWORD
    );

    // Throw exceptions on database errors
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Return associative arrays by default
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Disable emulated prepared statements
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    // Log detailed error for developer
    error_log($e->getMessage());

    // Show generic message to user
    die("Database connection error.");
}