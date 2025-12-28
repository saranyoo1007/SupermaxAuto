<?php
$pageTitle = 'เกี่ยวกับเรา - SuperMax Auto';
require_once 'config/database.php';
require_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">หน้าแรก</a>
            <span>/</span>
            <span>เกี่ยวกับเรา</span>
        </div>
        <h1>🏢 เกี่ยวกับ SuperMax Auto</h1>
        <p>รู้จักเรามากขึ้น</p>
    </div>
</section>

<!-- About Section -->
<section class="section">
    <div class="container">
        <div class="about-content">
            <div class="about-image">
                <div class="about-img-main" style="background: linear-gradient(135deg, var(--dark-light), var(--dark-gray)); padding: 20px;">
                    <img src="Photo-Logo/Logo.jpg" alt="SuperMax Auto Logo" style="width: 100%; height: 100%; object-fit: contain; border-radius: 16px;">
                </div>
                <div class="about-badge">
                    <span class="about-badge-number">10+</span>
                    <span class="about-badge-text">ปีประสบการณ์</span>
                </div>
            </div>

            <div class="about-text">
                <span class="section-subtitle">เกี่ยวกับเรา</span>
                <h2>SuperMax Auto ศูนย์บริการรถยนต์ครบวงจร</h2>
                <p>
                    SuperMax Auto เป็นศูนย์บริการรถยนต์ครบวงจรที่มุ่งมั่นให้บริการด้วยมาตรฐานสูงสุด
                    เราเปิดให้บริการมากว่า 10 ปี ด้วยทีมช่างมืออาชีพที่ผ่านการอบรมจากศูนย์ฝึกอบรมชั้นนำ
                    พร้อมอุปกรณ์และเครื่องมือที่ทันสมัย
                </p>
                <p>
                    เรามุ่งเน้นความพึงพอใจของลูกค้าเป็นสำคัญ โดยให้บริการด้วยความรวดเร็ว ราคายุติธรรม
                    และคุณภาพที่ไว้วางใจได้ ไม่ว่าจะเป็นบริการเปลี่ยนยาง เปลี่ยนน้ำมันเครื่อง ตั้งศูนย์ล้อ
                    หรือซ่อมบำรุงอื่นๆ เรายินดีให้บริการ
                </p>

                <div class="about-features">
                    <div class="about-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>สินค้าแท้ 100%</span>
                    </div>
                    <div class="about-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>รับประกันคุณภาพ</span>
                    </div>
                    <div class="about-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>ช่างมืออาชีพ</span>
                    </div>
                    <div class="about-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>ราคายุติธรรม</span>
                    </div>
                    <div class="about-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>บริการรวดเร็ว</span>
                    </div>
                    <div class="about-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>เครื่องมือทันสมัย</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="section" style="background: var(--dark-light);">
    <div class="container">
        <div class="hero-stats" style="max-width: 800px; margin: 0 auto;">
            <div class="stat-item">
                <span class="stat-number">10+</span>
                <span class="stat-label">ปีประสบการณ์</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">50,000+</span>
                <span class="stat-label">ลูกค้าที่ไว้วางใจ</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">20+</span>
                <span class="stat-label">ทีมช่างมืออาชีพ</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">100%</span>
                <span class="stat-label">ความพึงพอใจ</span>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">💎 ค่านิยมของเรา</span>
            <h2 class="section-title">สิ่งที่เรายึดมั่น</h2>
        </div>

        <div class="why-grid">
            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h4>ใส่ใจลูกค้า</h4>
                <p>ดูแลลูกค้าเหมือนครอบครัว ให้บริการด้วยใจ</p>
            </div>

            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4>ซื่อสัตย์</h4>
                <p>โปร่งใสในทุกขั้นตอน ราคาและบริการตรงไปตรงมา</p>
            </div>

            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h4>คุณภาพ</h4>
                <p>มุ่งเน้นคุณภาพในทุกการบริการ ไม่ลดมาตรฐาน</p>
            </div>

            <div class="why-card fade-in">
                <div class="why-icon">
                    <i class="fas fa-rocket"></i>
                </div>
                <h4>พัฒนาต่อเนื่อง</h4>
                <p>พัฒนาทักษะและเทคโนโลยีอย่างต่อเนื่อง</p>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>