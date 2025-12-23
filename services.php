<?php
$pageTitle = 'บริการของเรา - SuperMax Auto';
require_once 'config/database.php';

// Get all services
$services = fetchAll("SELECT * FROM services ORDER BY is_featured DESC, id ASC");

require_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">หน้าแรก</a>
            <span>/</span>
            <span>บริการ</span>
        </div>
        <h1>🔧 บริการของเรา</h1>
        <p>บริการครบวงจรเกี่ยวกับรถยนต์ ด้วยทีมช่างมืออาชีพและอุปกรณ์ที่ทันสมัย</p>
    </div>
</section>

<!-- Services Section -->
<section class="section">
    <div class="container">
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
                            <span style="color: var(--success);">ฟรี!</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-duration">
                        <i class="far fa-clock"></i> <?php echo htmlspecialchars($service['duration']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section" style="background: var(--gradient-primary); text-align: center;">
    <div class="container">
        <h2 style="margin-bottom: 16px;">ต้องการใช้บริการ?</h2>
        <p style="opacity: 0.9; margin-bottom: 30px;">โทรนัดหมายหรือเข้ามาใช้บริการได้ทันที</p>
        <a href="tel:021234567" class="btn btn-white">
            <i class="fas fa-phone"></i>
            โทร 02-123-4567
        </a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>