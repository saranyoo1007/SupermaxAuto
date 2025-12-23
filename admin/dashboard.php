<?php
/**
 * SuperMax Auto Admin - Dashboard
 */
$pageTitle = 'Dashboard';
require_once 'header.php';

// Get counts
$productCount = fetchOne("SELECT COUNT(*) as count FROM products")['count'];
$serviceCount = fetchOne("SELECT COUNT(*) as count FROM services")['count'];
$promotionCount = fetchOne("SELECT COUNT(*) as count FROM promotions WHERE is_active = 1")['count'];
$categoryCount = fetchOne("SELECT COUNT(*) as count FROM categories")['count'];
$contactCount = fetchOne("SELECT COUNT(*) as count FROM contacts")['count'];
?>

<div class="page-header">
    <h1>📊 Dashboard</h1>
    <span style="color: var(--light-gray);">
        ยินดีต้อนรับ, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
    </span>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3><?php echo $productCount; ?></h3>
        <p><i class="fas fa-box"></i> สินค้า</p>
    </div>
    <div class="stat-card">
        <h3><?php echo $serviceCount; ?></h3>
        <p><i class="fas fa-wrench"></i> บริการ</p>
    </div>
    <div class="stat-card">
        <h3><?php echo $promotionCount; ?></h3>
        <p><i class="fas fa-gift"></i> โปรโมชั่น</p>
    </div>
    <div class="stat-card">
        <h3><?php echo $categoryCount; ?></h3>
        <p><i class="fas fa-tags"></i> หมวดหมู่</p>
    </div>
    <div class="stat-card">
        <h3><?php echo $contactCount; ?></h3>
        <p><i class="fas fa-envelope"></i> ข้อความติดต่อ</p>
    </div>
</div>

<h2 style="margin-bottom: 20px;">⚡ Quick Actions</h2>

<div class="stats-grid">
    <a href="products.php" class="stat-card"
        style="text-decoration: none; cursor: pointer; transition: transform 0.3s;">
        <i class="fas fa-box" style="font-size: 2rem; color: var(--primary);"></i>
        <p style="margin-top: 10px;">จัดการสินค้า</p>
    </a>
    <a href="services.php" class="stat-card"
        style="text-decoration: none; cursor: pointer; transition: transform 0.3s;">
        <i class="fas fa-wrench" style="font-size: 2rem; color: var(--primary);"></i>
        <p style="margin-top: 10px;">จัดการบริการ</p>
    </a>
    <a href="promotions.php" class="stat-card"
        style="text-decoration: none; cursor: pointer; transition: transform 0.3s;">
        <i class="fas fa-gift" style="font-size: 2rem; color: var(--primary);"></i>
        <p style="margin-top: 10px;">จัดการโปรโมชั่น</p>
    </a>
</div>

<?php require_once 'footer.php'; ?>