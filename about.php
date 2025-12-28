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
                <div class="about-img-main" style="
                    background: linear-gradient(145deg, #2D2D2D 0%, #1A1A1A 50%, #2D2D2D 100%);
                    padding: 30px;
                    position: relative;
                    overflow: hidden;
                    box-shadow: 
                        0 25px 50px rgba(0,0,0,0.5),
                        0 0 80px rgba(255,107,0,0.15),
                        inset 0 0 60px rgba(255,107,0,0.05);
                    border: 2px solid rgba(255,107,0,0.3);
                ">
                    <!-- Decorative Corner Elements -->
                    <div
                        style="position: absolute; top: 0; left: 0; width: 60px; height: 60px; border-top: 3px solid var(--primary); border-left: 3px solid var(--primary);">
                    </div>
                    <div
                        style="position: absolute; top: 0; right: 0; width: 60px; height: 60px; border-top: 3px solid var(--primary); border-right: 3px solid var(--primary);">
                    </div>
                    <div
                        style="position: absolute; bottom: 0; left: 0; width: 60px; height: 60px; border-bottom: 3px solid var(--primary); border-left: 3px solid var(--primary);">
                    </div>
                    <div
                        style="position: absolute; bottom: 0; right: 0; width: 60px; height: 60px; border-bottom: 3px solid var(--primary); border-right: 3px solid var(--primary);">
                    </div>

                    <!-- Animated Glow Ring -->
                    <div style="
                        position: absolute;
                        top: 50%; left: 50%;
                        transform: translate(-50%, -50%);
                        width: 320px; height: 320px;
                        border-radius: 50%;
                        border: 2px solid rgba(255,107,0,0.2);
                        animation: pulse-ring 3s ease-in-out infinite;
                    "></div>

                    <!-- Logo Image with Effects -->
                    <img src="Photo-Logo/Logo.jpg" alt="SuperMax Auto Logo" style="
                        width: 100%; 
                        height: 100%; 
                        object-fit: contain; 
                        border-radius: 16px;
                        position: relative;
                        z-index: 2;
                        filter: drop-shadow(0 10px 30px rgba(255,107,0,0.3));
                        transition: all 0.4s ease;
                    " onmouseover="this.style.transform='scale(1.05)'; this.style.filter='drop-shadow(0 15px 40px rgba(255,107,0,0.5))'"
                        onmouseout="this.style.transform='scale(1)'; this.style.filter='drop-shadow(0 10px 30px rgba(255,107,0,0.3))'">

                    <!-- Floating Particles -->
                    <div
                        style="position: absolute; top: 20%; left: 10%; width: 8px; height: 8px; background: var(--primary); border-radius: 50%; opacity: 0.6; animation: float 4s ease-in-out infinite;">
                    </div>
                    <div
                        style="position: absolute; top: 70%; right: 15%; width: 6px; height: 6px; background: var(--secondary); border-radius: 50%; opacity: 0.5; animation: float 5s ease-in-out infinite 1s;">
                    </div>
                    <div
                        style="position: absolute; bottom: 25%; left: 20%; width: 10px; height: 10px; background: var(--primary); border-radius: 50%; opacity: 0.4; animation: float 3s ease-in-out infinite 0.5s;">
                    </div>
                </div>
                <div class="about-badge" style="
                    box-shadow: 0 10px 40px rgba(255,107,0,0.5);
                    animation: float 3s ease-in-out infinite;
                ">
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