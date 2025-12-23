<?php
/**
 * SuperMax Auto Admin - Services List
 */
$pageTitle = 'จัดการบริการ';
require_once 'header.php';

// Handle delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $pdo = getConnection();
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: services.php?deleted=1');
    exit;
}

// Get all services
$services = fetchAll("SELECT * FROM services ORDER BY id DESC");

$success = isset($_GET['success']) ? 'บันทึกข้อมูลเรียบร้อยแล้ว' : '';
$deleted = isset($_GET['deleted']) ? 'ลบบริการเรียบร้อยแล้ว' : '';
?>

<div class="page-header">
    <h1>🔧 จัดการบริการ</h1>
    <a href="service-edit.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> เพิ่มบริการ
    </a>
</div>

<?php if ($success): ?>
    <div class="success-msg"><?php echo $success; ?></div>
<?php endif; ?>

<?php if ($deleted): ?>
    <div class="success-msg"><?php echo $deleted; ?></div>
<?php endif; ?>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>ชื่อบริการ</th>
                <th>ราคาเริ่มต้น</th>
                <th>ราคาสูงสุด</th>
                <th>ระยะเวลา</th>
                <th>Featured</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td>
                        <i class="fas <?php echo $service['icon'] ?: 'fa-cog'; ?>"
                            style="color: var(--primary); margin-right: 8px;"></i>
                        <?php echo htmlspecialchars($service['name']); ?>
                    </td>
                    <td style="color: var(--primary); font-weight: 600;">
                        ฿<?php echo number_format($service['price_start']); ?>
                    </td>
                    <td style="color: var(--light-gray);">
                        ฿<?php echo number_format($service['price_end']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($service['duration']); ?></td>
                    <td>
                        <?php if ($service['is_featured']): ?>
                            <span style="color: var(--success);">✅</span>
                        <?php else: ?>
                            <span style="color: var(--light-gray);">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="actions">
                        <a href="service-edit.php?id=<?php echo $service['id']; ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="services.php?delete=<?php echo $service['id']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('ต้องการลบบริการนี้หรือไม่?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>