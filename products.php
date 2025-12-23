<?php
$pageTitle = 'สินค้า - SuperMax Auto';
require_once 'config/database.php';

// Get categories
$categories = fetchAll("SELECT * FROM categories");

// Get products (with optional category filter)
$selectedCategory = isset($_GET['category']) ? (int) $_GET['category'] : null;

if ($selectedCategory) {
    $products = fetchAll("SELECT p.*, c.name as category_name FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.id 
                          WHERE p.category_id = ?", [$selectedCategory]);
} else {
    $products = fetchAll("SELECT p.*, c.name as category_name FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.id");
}

require_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">หน้าแรก</a>
            <span>/</span>
            <span>สินค้า</span>
        </div>
        <h1>🛒 สินค้าของเรา</h1>
        <p>ยางรถยนต์ น้ำมันเครื่อง แบตเตอรี่ และอะไหล่คุณภาพสูง</p>
    </div>
</section>

<!-- Products Section -->
<section class="section">
    <div class="container">
        <!-- Filter -->
        <div class="products-filter">
            <a href="products.php" class="filter-btn <?php echo !$selectedCategory ? 'active' : ''; ?>">ทั้งหมด</a>
            <?php foreach ($categories as $cat): ?>
                <a href="products.php?category=<?php echo $cat['id']; ?>"
                    class="filter-btn <?php echo $selectedCategory == $cat['id'] ? 'active' : ''; ?>">
                    <?php echo htmlspecialchars($cat['name']); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Products Grid -->
        <div class="products-grid">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card fade-in">
                        <div class="product-image">
                            <?php if (!empty($product['image'])): ?>
                                <img src="<?php echo htmlspecialchars($product['image']); ?>"
                                    alt="<?php echo htmlspecialchars($product['name']); ?>"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <?php
                                $icon = 'fa-cog';
                                if ($product['category_name'] == 'ยางรถยนต์')
                                    $icon = 'fa-circle';
                                elseif ($product['category_name'] == 'น้ำมันเครื่อง')
                                    $icon = 'fa-oil-can';
                                elseif ($product['category_name'] == 'แบตเตอรี่')
                                    $icon = 'fa-car-battery';
                                ?>
                                <i class="fas <?php echo $icon; ?>"></i>
                            <?php endif; ?>
                            <?php if ($product['original_price'] > $product['price']): ?>
                                <span class="product-badge">ลด
                                    <?php echo round((1 - $product['price'] / $product['original_price']) * 100); ?>%</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <div class="product-category"><?php echo htmlspecialchars($product['category_name']); ?></div>
                            <h4 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h4>
                            <div class="product-brand"><i class="fas fa-tag"></i>
                                <?php echo htmlspecialchars($product['brand']); ?></div>
                            <?php if ($product['specs']): ?>
                                <div class="product-specs"><?php echo htmlspecialchars($product['specs']); ?></div>
                            <?php endif; ?>
                            <div class="product-price">
                                <span class="price-current">฿<?php echo number_format($product['price']); ?></span>
                                <?php if ($product['original_price'] > $product['price']): ?>
                                    <span class="price-original">฿<?php echo number_format($product['original_price']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 60px;">
                    <p style="color: var(--light-gray);">ไม่พบสินค้าในหมวดหมู่นี้</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section" style="background: var(--dark-light); text-align: center;">
    <div class="container">
        <h2 style="margin-bottom: 16px;">ต้องการสอบถามเพิ่มเติม?</h2>
        <p style="color: var(--light-gray); margin-bottom: 30px;">ติดต่อเราเพื่อขอใบเสนอราคาหรือสอบถามรายละเอียดสินค้า
        </p>
        <a href="contact.php" class="btn btn-primary">
            <i class="fas fa-envelope"></i>
            ติดต่อเรา
        </a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>