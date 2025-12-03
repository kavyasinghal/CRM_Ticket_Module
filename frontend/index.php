<?php
require_once '../database/db.php';
require_login();

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($role == 'admin') {
    $stmt = $pdo->prepare("
        SELECT t.*, u.name as assigned_name 
        FROM tickets t 
        LEFT JOIN users u ON t.assigned_to = u.id 
        WHERE t.deleted_at IS NULL
        ORDER BY t.created_at DESC
    ");
    $stmt->execute();
} else {
    $stmt = $pdo->prepare("
        SELECT t.*, u.name as assigned_name 
        FROM tickets t 
        LEFT JOIN users u ON t.assigned_to = u.id 
        WHERE (t.created_by = ? OR t.assigned_to = ?) 
        AND t.deleted_at IS NULL
        ORDER BY t.created_at DESC
    ");
    $stmt->execute([$user_id, $user_id]);
}

$tickets = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Ticket Dashboard</h2>
    <a href="create_ticket.php" class="btn btn-primary">+ Create New Ticket</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th> 
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tickets as $ticket): ?>
                        <tr>
                            <td>#<?php echo $ticket['id']; ?></td>
                            <td class="fw-bold"><?php echo htmlspecialchars($ticket['title']); ?></td>
                            <td>
                                <?php 
                                    $desc = htmlspecialchars($ticket['description']);
                                    echo strlen($desc) > 50 ? substr($desc, 0, 50) . '...' : $desc; 
                                ?>
                            </td>
                            <td><?php echo $ticket['assigned_name'] ? htmlspecialchars($ticket['assigned_name']) : '<span class="text-muted">Unassigned</span>'; ?></td>
                            <td><span class="badge bg-secondary"><?php echo $ticket['status']; ?></span></td>
                            <td><a href="view_ticket.php?id=<?php echo $ticket['id']; ?>" class="btn btn-sm btn-outline-primary">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
