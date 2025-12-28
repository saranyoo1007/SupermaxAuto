<?php
$pageTitle = 'ติดต่อเรา - SuperMax Auto';
require_once 'config/database.php';

// Handle form submission
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $msg = trim($_POST['message'] ?? '');

    if ($name && $phone && $msg) {
        try {
            insert(
                "INSERT INTO contacts (name, phone, email, message) VALUES (?, ?, ?, ?)",
                [$name, $phone, $email, $msg]
            );
            $message = 'ส่งข้อความสำเร็จ! เราจะติดต่อกลับโดยเร็ว';
            $messageType = 'success';
        } catch (Exception $e) {
            $message = 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง';
            $messageType = 'error';
        }
    } else {
        $message = 'กรุณากรอกข้อมูลให้ครบถ้วน';
        $messageType = 'error';
    }
}

require_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">หน้าแรก</a>
            <span>/</span>
            <span>ติดต่อเรา</span>
        </div>
        <h1>📞 ติดต่อเรา</h1>
        <p>พร้อมให้บริการคุณทุกวัน</p>
    </div>
</section>

<!-- Contact Section -->
<section class="section">
    <div class="container">
        <div class="contact-content">
            <div class="contact-info">
                <span class="section-subtitle">ติดต่อเรา</span>
                <h2>ยินดีให้บริการ</h2>
                <p>มีคำถามหรือต้องการสอบถามข้อมูลเพิ่มเติม? ติดต่อเราได้ตลอดเวลาทำการ</p>

                <div class="contact-list">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4>ที่อยู่</h4>
                            <p>ในปั๊มบางจาก ตรงข้ามบ้านเอื้ออาทร<br>บางบัวทอง นนทบุรี</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4>โทรศัพท์ (ช่างบอย)</h4>
                            <p><a href="tel:0849027778" style="color: var(--primary);">084-902-7778</a></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4>อีเมล</h4>
                            <p>info@supermaxauto.com</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4>เวลาทำการ</h4>
                            <p>วันจันทร์ - เสาร์: 08:00 - 20:00 น.<br>วันอาทิตย์: 09:00 - 18:00 น.</p>
                        </div>
                    </div>
                </div>

                <div class="footer-social" style="justify-content: flex-start;">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-line"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="contact-form">
                <h3 style="margin-bottom: 24px;">ส่งข้อความถึงเรา</h3>

                <?php if ($message): ?>
                    <div style="padding: 15px; border-radius: 8px; margin-bottom: 20px; 
                            background: <?php echo $messageType === 'success' ? 'rgba(0,200,83,0.2)' : 'rgba(255,82,82,0.2)'; ?>; 
                            color: <?php echo $messageType === 'success' ? '#00c853' : '#ff5252'; ?>;">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">ชื่อ-นามสกุล *</label>
                        <input type="text" id="name" name="name" placeholder="กรุณากรอกชื่อ" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">เบอร์โทรศัพท์ *</label>
                        <input type="tel" id="phone" name="phone" placeholder="08X-XXX-XXXX" required>
                    </div>

                    <div class="form-group">
                        <label for="email">อีเมล</label>
                        <input type="email" id="email" name="email" placeholder="example@email.com">
                    </div>

                    <div class="form-group">
                        <label for="message">ข้อความ *</label>
                        <textarea id="message" name="message" placeholder="รายละเอียดที่ต้องการสอบถาม..."
                            required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        ส่งข้อความ
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="section" style="padding-top: 0;">
    <div class="container">
        <div class="section-header" style="margin-bottom: 30px;">
            <span class="section-subtitle">📍 แผนที่ร้าน</span>
            <h2 class="section-title">Super Max Auto บางบัวทอง</h2>
            <p class="section-desc">ในปั๊มบางจาก ตรงข้ามบ้านเอื้ออาทร บางบัวทอง นนทบุรี</p>
        </div>
        <div
            style="background: var(--dark-light); border-radius: var(--border-radius-lg); overflow: hidden; height: 450px; border: 2px solid var(--primary);">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3872.8!2d100.4!3d13.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDQ1JzIyLjciTiAxMDDCsDMzJzMxLjciRQ!5e0!3m2!1sth!2sth!4v1234567890"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="https://maps.app.goo.gl/hKZS1CEd4zRHznUN7" target="_blank" class="btn btn-primary">
                <i class="fas fa-map-marked-alt"></i>
                เปิดใน Google Maps
            </a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>