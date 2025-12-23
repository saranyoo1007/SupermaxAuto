<?php
/**
 * SuperMax Auto Admin - Promotions List
 */
$pageTitle = 'จัดการโปรโมชั่น';
require_once 'header.php';

// Handle delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $pdo = getConnection();
    $stmt = $pdo->prepare("DELETE FROM promotions WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: promotions.php?deleted=1');
    exit;
}

// Get all promotions
$promotions = fetchAll("SELECT * FROM promotions ORDER BY id DESC");

$success = isset($_GET['success']) ? 'บันทึกข้อมูลเรียบร้อยแล้ว' : '';
$deleted = isset($_GET['deleted']) ? 'ลบโปรโมชั่นเรียบร้อยแล้ว' : '';
?>

<div class="page-header">
    <h1>🎁 จัดการโปรโมชั่น</h1>
    <a href="promotion-edit.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> เพิ่มโปรโมชั่น
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
                <th>ชื่อโปรโมชั่น</th>
                <th>ส่วนลด</th>
                <th>วันที่เริ่ม</th>
                <th>วันที่สิ้นสุด</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promotions as $promo): ?>
                <tr>
                    <td><?php echo htmlspecialchars($promo['title']); ?></td>
                    <td style="color: var(--primary); font-weight: 600;">
                        <?php if ($promo['discount_percent'] > 0): ?>
                            <?php echo $promo['discount_percent']; ?>%
                        <?php elseif ($promo['discount_amount'] > 0): ?>
                            ฿<?php echo number_format($promo['discount_amount']); ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?php echo $promo['start_date']; ?></td>
                    <td><?php echo $promo['end_date']; ?></td>
                    <td>
                        <?php if ($promo['is_active']): ?>
                            <span style="color: var(--success);">✅ Active</span>
                        <?php else: ?>
                            <span style="color: var(--light-gray);">❌ Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td class="actions">
                        <a href="promotion-edit.php?id=<?php echo $promo['id']; ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="promotions.php?delete=<?php echo $promo['id']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('ต้องการลบโปรโมชั่นนี้หรือไม่?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>