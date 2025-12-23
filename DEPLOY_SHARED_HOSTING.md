# คู่มือการอัพโหลดเว็บไซต์ SuperMax Auto ขึ้น Shared Hosting

คู่มือนี้สำหรับการอัพโหลดเว็บไซต์ SuperMax Auto (PHP + MySQL) ไปยัง Shared Hosting เช่น Hostinger, GoDaddy, Bluehost หรือ Hosting ไทย

ระบบ admin
http://192.168.2.3/Supermax_Auto/admin/
Username: admin
Password: supermax2023

---

## 📋 สิ่งที่ต้องมี

- บัญชี Hosting ที่รองรับ PHP 7.4+ และ MySQL
- FTP Client (เช่น FileZilla) หรือ File Manager ใน cPanel
- ข้อมูล FTP/SFTP (Host, Username, Password)

---

## ขั้นตอนที่ 1: เตรียมไฟล์

ไฟล์ที่ต้องอัพโหลด:
```
Supermax_Auto/
├── index.php
├── services.php
├── products.php
├── promotions.php
├── about.php
├── contact.php
├── config/
│   └── database.php      ⚠️ ต้องแก้ไขก่อนอัพโหลด
├── includes/
│   ├── header.php
│   └── footer.php
├── assets/
│   ├── css/styles.css
│   └── js/main.js
└── sql/
    └── database.sql      📋 สำหรับ Import
```

---

## ขั้นตอนที่ 2: สร้าง MySQL Database

### วิธี A: ผ่าน cPanel

1. เข้าสู่ระบบ **cPanel**
2. ไปที่ **MySQL Databases**
3. สร้าง Database ใหม่:
   - Database Name: `supermax_auto`
4. สร้าง User ใหม่:
   - Username: `supermax`
   - Password: `รหัสผ่านที่ต้องการ`
5. เพิ่ม User เข้า Database:
   - เลือก User และ Database ที่สร้าง
   - ให้สิทธิ์ **ALL PRIVILEGES**

---

## ขั้นตอนที่ 3: Import Database

1. เปิด **phpMyAdmin** (ใน cPanel)
2. เลือก Database `supermax_auto`
3. คลิกแท็บ **Import**
4. เลือกไฟล์ `sql/database.sql`
5. คลิก **Go** หรือ **Import**

---

## ขั้นตอนที่ 4: แก้ไขไฟล์ config/database.php

เปิดไฟล์ `config/database.php` และแก้ไขข้อมูลให้ตรงกับ Hosting:

```php
<?php
define('DB_HOST', 'localhost');           // ปกติเป็น localhost
define('DB_NAME', 'cpanel_username_supermax_auto');  // ชื่อ Database เต็ม
define('DB_USER', 'cpanel_username_supermax');       // ชื่อ User เต็ม
define('DB_PASS', 'รหัสผ่านของคุณ');      // รหัสผ่านที่ตั้งไว้
define('DB_CHARSET', 'utf8mb4');
// ... (ส่วนที่เหลือไม่ต้องแก้)
?>
```

> ⚠️ **หมายเหตุ**: ชื่อ Database และ User ใน Shared Hosting มักมี prefix เป็น username ของ cPanel

---

## ขั้นตอนที่ 5: อัพโหลดไฟล์

### วิธี A: ใช้ FileZilla (FTP)

1. เปิด FileZilla
2. กรอกข้อมูล:
   - Host: `ftp.yourdomain.com`
   - Username: `FTP Username`
   - Password: `FTP Password`
   - Port: `21`
3. คลิก **Quickconnect**
4. ไปที่โฟลเดอร์ `public_html`
5. อัพโหลดไฟล์ทั้งหมด (ยกเว้น `sql/` ถ้าไม่ต้องการ)

### วิธี B: ใช้ cPanel File Manager

1. เข้าสู่ระบบ cPanel
2. คลิก **File Manager**
3. ไปที่ `public_html`
4. คลิก **Upload** และเลือกไฟล์ทั้งหมด

---

## ขั้นตอนที่ 6: ทดสอบเว็บไซต์

เปิดเบราว์เซอร์และไปที่:
```
https://yourdomain.com/
```

หรือถ้าอัพโหลดในโฟลเดอร์ย่อย:
```
https://yourdomain.com/supermax/
```

---

## 🔧 แก้ไขปัญหาที่พบบ่อย

### ❌ Error: Database connection failed
- ตรวจสอบชื่อ Database, User, Password ใน `config/database.php`
- ตรวจสอบว่า User มีสิทธิ์เข้าถึง Database

### ❌ Error 500 Internal Server Error
- ตรวจสอบ PHP version (ต้องเป็น 7.4+)
- ตรวจสอบ error log ใน cPanel → Error Log

### ❌ หน้าเว็บเปล่า
- เปิด PHP error display: เพิ่มบรรทัดนี้ในไฟล์ PHP
  ```php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  ```

### ❌ CSS/JS ไม่โหลด
- ตรวจสอบ path ใน `includes/header.php`
- อาจต้องเปลี่ยนเป็น absolute path: `/assets/css/styles.css`

---

## 📝 Checklist

- [ ] สร้าง MySQL Database
- [ ] สร้าง MySQL User และให้สิทธิ์
- [ ] Import `database.sql`
- [ ] แก้ไข `config/database.php`
- [ ] อัพโหลดไฟล์ทั้งหมดไปยัง `public_html`
- [ ] ทดสอบเปิดเว็บไซต์
- [ ] ทดสอบฟอร์มติดต่อ

---

## 🔄 การอัพเดทเว็บไซต์

เมื่อแก้ไขไฟล์แล้ว ให้:
1. อัพโหลดไฟล์ที่แก้ไขทับไฟล์เดิม
2. ถ้าแก้ไข Database schema → Import `database.sql` ใหม่

---

**URL เว็บไซต์:** https://yourdomain.com/
