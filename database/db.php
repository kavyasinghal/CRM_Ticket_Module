<?php
$host = 'localhost';
$dbname = 'crm_ticket_db';
$username = 'root'; 
$password = 'kavy123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

session_start();

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../frontend/login.php");
        exit();
    }
}
?>
