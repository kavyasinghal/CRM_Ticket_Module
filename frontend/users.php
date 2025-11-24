<?php
require_once '../database/db.php';
require_login();

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();

include 'includes/header.php';
?>
<h2>Users</h2>
<table class="table">
    <tr><th>ID</th><th>Name</th><th>Role</th></tr>
    <?php foreach($users as $u): ?>
        <tr>
            <td><?php echo $u['id']; ?></td>
            <td><?php echo htmlspecialchars($u['name']); ?></td>
            <td><?php echo $u['role']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php include 'includes/footer.php'; ?>
