<?php
require_once '../database/db.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticket_id = $_POST['ticket_id'];
    $user_id = $_SESSION['user_id'];

    // Fetch to verify permissions
    $stmt = $pdo->prepare("SELECT * FROM tickets WHERE id = ?");
    $stmt->execute([$ticket_id]);
    $ticket = $stmt->fetch();

    if (!$ticket) die("Ticket not found");

    $is_author = ($ticket['created_by'] == $user_id);
    $is_assignee = ($ticket['assigned_to'] == $user_id);

    if (isset($_POST['delete']) && $is_author) {
        $del = $pdo->prepare("UPDATE tickets SET deleted_at = NOW() WHERE id = ?");
        $del->execute([$ticket_id]);
        header("Location: ../frontend/index.php");
        exit();
    }

    $status = $_POST['status'];
    $completed_at = ($status == 'completed' && $ticket['status'] != 'completed') ? date('Y-m-d H:i:s') : $ticket['completed_at'];

    if ($is_author) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $assigned_to = !empty($_POST['assigned_to']) ? $_POST['assigned_to'] : NULL;
        $assigned_at = ($assigned_to != $ticket['assigned_to']) ? date('Y-m-d H:i:s') : $ticket['assigned_at'];

        $update = $pdo->prepare("UPDATE tickets SET title=?, description=?, status=?, assigned_to=?, assigned_at=?, completed_at=? WHERE id=?");
        $update->execute([$title, $description, $status, $assigned_to, $assigned_at, $completed_at, $ticket_id]);
    } elseif ($is_assignee) {
        $update = $pdo->prepare("UPDATE tickets SET status=?, completed_at=? WHERE id=?");
        $update->execute([$status, $completed_at, $ticket_id]);
    }

    header("Location: ../frontend/view_ticket.php?id=$ticket_id&msg=updated");
    exit();
}
?>
