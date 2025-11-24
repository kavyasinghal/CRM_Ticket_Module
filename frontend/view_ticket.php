<?php
require_once '../database/db.php';
require_login();

$ticket_id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM tickets WHERE id = ?");
$stmt->execute([$ticket_id]);
$ticket = $stmt->fetch();

$user_stmt = $pdo->query("SELECT id, name, role FROM users");
$users = $user_stmt->fetchAll();

$is_author = ($ticket['created_by'] == $_SESSION['user_id']);
$is_assignee = ($ticket['assigned_to'] == $_SESSION['user_id']);

include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success">Updated successfully!</div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between">
                <h4>Ticket #<?php echo $ticket['id']; ?></h4>
                <a href="index.php" class="btn btn-sm btn-outline-secondary">Back</a>
            </div>
            <div class="card-body">
                <form action="../backend/ticket_update.php" method="POST">
                    <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($ticket['title']); ?>" <?php echo !$is_author ? 'readonly' : ''; ?>>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5" <?php echo !$is_author ? 'readonly' : ''; ?>><?php echo htmlspecialchars($ticket['description']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" <?php echo $ticket['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="inprogress" <?php echo $ticket['status'] == 'inprogress' ? 'selected' : ''; ?>>In Progress</option>
                            <option value="completed" <?php echo $ticket['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                        </select>
                    </div>
                    
                    <?php if ($is_author): ?>
                        <div class="mb-3">
                            <label class="form-label">Assign To</label>
                            <select name="assigned_to" class="form-select">
                                <option value="">-- Unassigned --</option>
                                <?php foreach($users as $u): ?>
                                    <option value="<?php echo $u['id']; ?>" <?php echo $ticket['assigned_to'] == $u['id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($u['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Delete?');">Delete</button>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
