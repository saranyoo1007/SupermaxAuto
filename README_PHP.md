# SuperMax Auto - PHP Version

เว็บไซต์ร้านบริการรถยนต์ครบวงจร พร้อมระบบ MySQL Database

## ฟีเจอร์
- 🚗 หน้าแสดงบริการ (เปลี่ยนยาง, น้ำมันเครื่อง, ตั้งศูนย์ล้อ)
- 🛒 หน้าแสดงสินค้า (ยาง, น้ำมัน, แบตเตอรี่)
- 🎁 ระบบโปรโมชั่น
- 📞 หน้าติดต่อพร้อมฟอร์มส่งข้อความ
- 📱 Responsive Design

---

## การติดตั้งบน Shared Hosting

### ขั้นตอนที่ 1: อัพโหลดไฟล์
อัพโหลดไฟล์ทั้งหมดไปยังโฟลเดอร์ `public_html` ของ hosting:
- `index.php`, `services.php`, `products.php`, `promotions.php`, `about.php`, `contact.php`
- โฟลเดอร์ `assets/`, `config/`, `includes/`, `sql/`

### ขั้นตอนที่ 2: สร้าง MySQL Database
1. เข้า cPanel → MySQL Databases
2. สร้าง Database ชื่อ `supermax_auto`
3. สร้าง User และกำหนดสิทธิ์

### ขั้นตอนที่ 3: Import Database
1. เข้า phpMyAdmin
2. เลือก Database ที่สร้าง
3. Import ไฟล์ `sql/database.sql`

### ขั้นตอนที่ 4: แก้ไข Config
แก้ไขไฟล์ `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database_name');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

---

## การทดสอบบนเครื่อง Local

### ต้องการ
- PHP 7.4+ 
- MySQL 5.7+ หรือ MariaDB

### วิธีรัน
```bash
# เข้าโฟลเดอร์โปรเจกต์
cd /Users/saranyoo/Ubuntu-server/Supermax_Auto

# รัน PHP built-in server
php -S localhost:8000

# เปิด http://localhost:8000
```

---

## โครงสร้างไฟล์
```
Supermax_Auto/
├── index.php           # Homepage
├── services.php        # Services page
├── products.php        # Products page
├── promotions.php      # Promotions page
├── about.php           # About page
├── contact.php         # Contact page
├── config/
│   └── database.php    # MySQL connection
├── includes/
│   ├── header.php      # Header navigation
│   └── footer.php      # Footer
├── assets/
│   ├── css/styles.css  # Orange-Black theme
│   └── js/main.js      # Frontend scripts
└── sql/
    └── database.sql    # MySQL schema + data
```

## เทคโนโลยี
- **Backend**: PHP 7.4+
- **Database**: MySQL / MariaDB
- **Frontend**: Vanilla JS, CSS
- **Theme**: Orange (#FF6B00) + Black (#1A1A1A)


