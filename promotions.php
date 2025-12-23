<?php
$pageTitle = 'โปรโมชั่น - SuperMax Auto';
require_once 'config/database.php';

// Get active promotions
$promotions = fetchAll("SELECT * FROM promotions WHERE is_active = 1");

require_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">หน้าแรก</a>
            <span>/</span>
            <span>โปรโมชั่น</span>
        </div>
        <h1>🎁 โปรโมชั่นพิเศษ</h1>
        <p>ข้อเสนอสุดพิเศษที่คุณไม่ควรพลาด</p>
    </div>
</section>

<!-- Promotions Section -->
<section class="section">
    <div class="container">
        <div class="promotions-grid">
            <?php if (count($promotions) > 0): ?>
                <?php foreach ($promotions as $promo): ?>
                    <div class="promo-card fade-in">
                        <?php if ($promo['discount_percent'] > 0): ?>
                            <span class="promo-discount">ลด <?php echo $promo['discount_percent']; ?>%</span>
                        <?php else: ?>
                            <span class="promo-discount">🎁 พิเศษ</span>
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($promo['title']); ?></h3>
                        <p><?php echo htmlspecialchars($promo['description']); ?></p>
                        <?php if ($promo['end_date']): ?>
                            <p style="font-size: 0.9rem; opacity: 0.8; margin-bottom: 20px;">
                                <i class="far fa-calendar-alt"></i>
                                หมดเขต: <?php echo date('j F Y', strtotime($promo['end_date'])); ?>
                            </p>
                        <?php endif; ?>
                        <a href="contact.php" class="btn">
                            <i class="fas fa-gift"></i>
                            รับโปรโมชั่น
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 60px;">
                    <p style="color: var(--light-gray);">ยังไม่มีโปรโมชั่นในขณะนี้</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Benefits -->
<section class="section" style="background: var(--dark-light);">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">สิทธิประโยชน์สำหรับลูกค้า</h2>
        </div>

        <div class="why-grid">
            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-percent"></i>
                </div>
                <h4>ส่วนลดสมาชิก</h4>
                <p>สมาชิกประจำรับส่วนลดพิเศษเพิ่มอีก 5%</p>
            </div>

            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <h4>ของแถมพิเศษ</h4>
                <p>รับของแถมพิเศษเมื่อซื้อสินค้าครบตามที่กำหนด</p>
            </div>

            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <h4>ติดตั้งฟรี</h4>
                <p>ฟรีค่าติดตั้งสำหรับสินค้าที่ร่วมรายการ</p>
            </div>

            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4>รับประกันสินค้า</h4>
                <p>รับประกันสินค้าตามเงื่อนไขของแต่ละแบรนด์</p>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>