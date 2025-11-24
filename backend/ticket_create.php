<?php
require_once '../database/db.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $assigned_to = !empty($_POST['assigned_to']) ? $_POST['assigned_to'] : NULL;
    $assigned_at = $assigned_to ? date('Y-m-d H:i:s') : NULL;
    
    $file_path = NULL;
    if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $target_dir = "../frontend/uploads/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
        $file_path = "uploads/" . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . basename($_FILES["file"]["name"]));
    }

    $stmt = $pdo->prepare("INSERT INTO tickets (title, description, created_by, assigned_to, assigned_at, file_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $_SESSION['user_id'], $assigned_to, $assigned_at, $file_path]);

    header("Location: ../frontend/index.php");
    exit();
}
?>
