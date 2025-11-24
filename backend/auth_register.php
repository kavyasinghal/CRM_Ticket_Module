<?php
require_once '../database/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, username, password, role) VALUES (?, ?, ?, 'user')");
        $stmt->execute([$name, $username, $password]);
        header("Location: ../frontend/login.php?msg=registered");
        exit();
    } catch (PDOException $e) {
        header("Location: ../frontend/register.php?error=Username already exists");
        exit();
    }
}
?>
