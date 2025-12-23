<?php
/**
 * SuperMax Auto Admin - Products List
 */
$pageTitle = 'จัดการสินค้า';
require_once 'header.php';

// Handle delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $pdo = getConnection();
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: products.php?deleted=1');
    exit;
}

// Get all products
$products = fetchAll("SELECT p.*, c.name as category_name FROM products p 
                      LEFT JOIN categories c ON p.category_id = c.id 
                      ORDER BY p.id DESC");

$success = isset($_GET['success']) ? 'บันทึกข้อมูลเรียบร้อยแล้ว' : '';
$deleted = isset($_GET['deleted']) ? 'ลบสินค้าเรียบร้อยแล้ว' : '';
?>

<div class="page-header">
    <h1>📦 จัดการสินค้า</h1>
    <a href="product-edit.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> เพิ่มสินค้า
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
                <th>รูป</th>
                <th>ชื่อสินค้า</th>
                <th>แบรนด์</th>
                <th>หมวดหมู่</th>
                <th>ราคา</th>
                <th>ราคาเดิม</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td>
                        <?php if ($product['image']): ?>
                            <img src="../<?php echo htmlspecialchars($product['image']); ?>" alt="">
                        <?php else: ?>
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='50' height='50' fill='%23666'%3E%3Crect width='50' height='50' fill='%23333'/%3E%3Ctext x='25' y='30' text-anchor='middle' fill='%23666'%3E📦%3C/text%3E%3C/svg%3E"
                                alt="">
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['brand']); ?></td>
                    <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                    <td style="color: var(--primary); font-weight: 600;">
                        ฿<?php echo number_format($product['price']); ?>
                    </td>
                    <td style="color: var(--light-gray); text-decoration: line-through;">
                        ฿<?php echo number_format($product['original_price']); ?>
                    </td>
                    <td class="actions">
                        <a href="product-edit.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="products.php?delete=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('ต้องการลบสินค้านี้หรือไม่?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>