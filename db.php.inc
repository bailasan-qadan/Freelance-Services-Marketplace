<?php
$connString = "mysql:host=localhost;dbname=web1220687_1220687";
$user = "web1220687_dbuser";
$pass = "8sM3vg9@8g";

try {
    $pdo = new PDO($connString, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed");
}
