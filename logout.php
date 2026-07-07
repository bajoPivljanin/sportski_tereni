<?php
    require_once 'app/config/db_config.php';
    require_once 'app/classes/User.php';

    $userObj = new User($pdo);
    $userObj->logout();
    header("Location: index.php");
    exit;
?>