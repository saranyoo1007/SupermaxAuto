<?php
$pageTitle = 'SuperMax Auto - บริการเปลี่ยนยางรถยนต์ น้ำมันเครื่อง ตั้งศูนย์ล้อ';
require_once 'config/database.php';

// Get featured services
$services = fetchAll("SELECT * FROM services WHERE is_featured = 1 LIMIT 4");

// Get featured products
$products = fetchAll("SELECT p.*, c.name as category_name FROM products p 
                      LEFT JOIN categories c ON p.category_id = c.id 
                      WHERE p.is_featured = 1 LIMIT 8");

// Get active promotions
$promotions = fetchAll("SELECT * FROM promotions WHERE is_active = 1 LIMIT 3");

require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1>
                    บริการรถยนต์ครบวงจร
                    <span>SuperMax Auto</span>
                </h1>
                <p>บริการเปลี่ยนยางรถยนต์ น้ำมันเครื่อง ตั้งศูนย์ล้อ และอื่นๆ ด้วยทีมช่างมืออาชีพ อุปกรณ์ทันสมัย รวดเร็ว
                    ราคายุติธรรม</p>
                <div class="hero-buttons">
                    <a href="services.php" class="btn btn-primary">
                        <i class="fas fa-wrench"></i>
                        ดูบริการ
                    </a>
                    <a href="contact.php" class="btn btn-outline">
                        <i class="fas fa-phone"></i>
                        ติดต่อเรา
                    </a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-card">
                    <div class="floating-badge top-right">🔥 ลด 30%</div>
                    <div class="floating-badge bottom-left">✨ ฟรีตรวจเช็ค</div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number">10+</span>
                            <span class="stat-label">ปีประสบการณ์</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50K+</span>
                            <span class="stat-label">ลูกค้าไว้วางใจ</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">ความพึงพอใจ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">🔧 บริการของเรา</span>
            <h2 class="section-title">บริการที่เราพร้อมให้บริการ</h2>
            <p class="section-desc">บริการครบวงจรเกี่ยวกับรถยนต์ ด้วยทีมช่างมืออาชีพและอุปกรณ์ที่ทันสมัย</p>
        </div>

        <div class="services-grid">
            <?php foreach ($services as $service): ?>
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas <?php echo $service['icon'] ?: 'fa-cog'; ?>"></i>
                    </div>
                    <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                    <p><?php echo htmlspecialchars($service['description']); ?></p>
                    <div class="service-price">
                        <?php if ($service['price_start'] > 0): ?>
                            เริ่มต้น ฿<?php echo number_format($service['price_start']); ?>
                            <?php if ($service['price_end'] > $service['price_start']): ?>
                                - ฿<?php echo number_format($service['price_end']); ?>
                            <?php endif; ?>
                        <?php else: ?>
                            ฟรี!
                        <?php endif; ?>
                    </div>
                    <div class="service-duration">
                        <i class="far fa-clock"></i> <?php echo htmlspecialchars($service['duration']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-4">
            <a href="services.php" class="btn btn-primary">
                ดูบริการทั้งหมด
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="section" style="background: var(--dark-light);">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">🛒 สินค้าแนะนำ</span>
            <h2 class="section-title">สินค้าคุณภาพจากแบรนด์ชั้นนำ</h2>
            <p class="section-desc">ยางรถยนต์ น้ำมันเครื่อง แบตเตอรี่ และอะไหล่คุณภาพสูง ราคาคุ้มค่า</p>
        </div>

        <div class="products-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card fade-in">
                    <div class="product-image">
                        <?php if (!empty($product['image'])): ?>
                            <img src="<?php echo htmlspecialchars($product['image']); ?>"
                                alt="<?php echo htmlspecialchars($product['name']); ?>"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <i class="fas fa-tire"></i>
                        <?php endif; ?>
                        <?php if ($product['original_price'] > $product['price']): ?>
                            <span class="product-badge">ลดราคา!</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <div class="product-category"><?php echo htmlspecialchars($product['category_name']); ?></div>
                        <h4 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h4>
                        <div class="product-brand"><?php echo htmlspecialchars($product['brand']); ?></div>
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
        </div>

        <div class="text-center mt-4">
            <a href="products.php" class="btn btn-primary">
                ดูสินค้าทั้งหมด
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Promotions Section -->
<section class="section section-promo">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">🎁 โปรโมชั่นพิเศษ</span>
            <h2 class="section-title">ข้อเสนอสุดพิเศษสำหรับคุณ</h2>
            <p class="section-desc">โปรโมชั่นลดราคาและข้อเสนอพิเศษที่คุณไม่ควรพลาด</p>
        </div>

        <div class="promotions-grid">
            <?php foreach ($promotions as $promo): ?>
                <div class="promo-card fade-in">
                    <?php if ($promo['discount_percent'] > 0): ?>
                        <span class="promo-discount">ลด <?php echo $promo['discount_percent']; ?>%</span>
                    <?php else: ?>
                        <span class="promo-discount">🎁 พิเศษ</span>
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($promo['title']); ?></h3>
                    <p><?php echo htmlspecialchars($promo['description']); ?></p>
                    <a href="contact.php" class="btn">
                        <i class="fas fa-gift"></i>
                        รับโปรโมชั่น
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-4">
            <a href="promotions.php" class="btn btn-outline" style="border-color: white; color: white;">
                ดูโปรโมชั่นทั้งหมด
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">⭐ ทำไมต้องเลือกเรา</span>
            <h2 class="section-title">ข้อดีของ SuperMax Auto</h2>
            <p class="section-desc">เหตุผลที่ลูกค้ากว่า 50,000 คนไว้วางใจเรา</p>
        </div>

        <div class="why-grid">
            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <h4>คุณภาพระดับพรีเมียม</h4>
                <p>สินค้าแท้ 100% จากแบรนด์ชั้นนำระดับโลก รับประกันคุณภาพ</p>
            </div>

            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-users-cog"></i>
                </div>
                <h4>ช่างมืออาชีพ</h4>
                <p>ทีมช่างผ่านการอบรม มีประสบการณ์มากกว่า 10 ปี</p>
            </div>

            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h4>บริการรวดเร็ว</h4>
                <p>ให้บริการรวดเร็ว ไม่ต้องรอนาน ด้วยระบบจัดคิวที่ทันสมัย</p>
            </div>

            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h4>ราคายุติธรรม</h4>
                <p>ราคาโปร่งใส เหมาะสมกับคุณภาพ ไม่มีค่าใช้จ่ายแอบแฝง</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: var(--gradient-primary); text-align: center;">
    <div class="container">
        <h2 style="margin-bottom: 16px;">พร้อมให้บริการคุณแล้ววันนี้!</h2>
        <p style="opacity: 0.9; margin-bottom: 30px;">โทรนัดหมายหรือเข้ามาใช้บริการได้ทันที ไม่ต้องจองล่วงหน้า</p>
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="tel:021234567" class="btn btn-white">
                <i class="fas fa-phone"></i>
                โทร 02-123-4567
            </a>
            <a href="contact.php" class="btn" style="background: rgba(0,0,0,0.3); color: white;">
                <i class="fas fa-map-marker-alt"></i>
                ดูแผนที่
            </a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>