# 🌐 คู่มือ Deploy SuperMax Auto บน Google Cloud VPS

คู่มือนี้สำหรับการอัพโหลดเว็บไซต์ SuperMax Auto (PHP + MySQL) ไปยัง Google Cloud Compute Engine

---

## 📋 ข้อมูลเซิร์ฟเวอร์

| รายการ | ค่า |
|--------|-----|
| **IP Address** | 34.84.205.60 |
| **Zone** | asia-northeast1-a |
| **OS** | Ubuntu 24.04 LTS |
| **SSH User** | saranyoo_jong |

### 🌐 URLs

| หน้า | URL |
|------|-----|
| หน้าแรก | http://34.84.205.60/supermax/ |
| Admin Panel | http://34.84.205.60/supermax/admin/ |

### 🔑 Admin Login
- **Username:** `admin`
- **Password:** `supermax2023`

---

## 📌 การเชื่อมต่อ SSH

### วิธี A: ผ่าน Google Cloud Console (แนะนำ)
1. ไปที่ [Google Cloud Console](https://console.cloud.google.com/compute/instances)
2. คลิกปุ่ม **SSH** ข้างชื่อ VM `supermax-web`

### วิธี B: ผ่าน gcloud CLI
```bash
gcloud compute ssh supermax-web --zone=asia-northeast1-a
```

---

## 🔄 การอัพเดทเว็บไซต์

### ขั้นตอนที่ 1: Push ขึ้น GitHub (บนเครื่อง Mac)

```bash
cd "/Users/saranyoo/Ubuntu-server/Server-Ubutun-server02/Supermax_Auto V1.1"
git add .
git commit -m "อัพเดทเว็บไซต์"
git push origin main
```

### ขั้นตอนที่ 2: Pull บน VPS (SSH Console)

```bash
cd /var/www/html/supermax
sudo git pull origin main
sudo chown -R www-data:www-data /var/www/html/supermax
sudo chmod -R 755 /var/www/html/supermax
```

---

## 🛠️ คำสั่งที่ใช้บ่อย

### จัดการ Apache
```bash
sudo systemctl start apache2      # เริ่ม Apache
sudo systemctl stop apache2       # หยุด Apache
sudo systemctl restart apache2    # รีสตาร์ท Apache
sudo systemctl status apache2     # ดูสถานะ
```

### จัดการ MySQL
```bash
sudo systemctl start mysql        # เริ่ม MySQL
sudo systemctl stop mysql         # หยุด MySQL
sudo systemctl restart mysql      # รีสตาร์ท MySQL
sudo mysql                        # เข้า MySQL Console
```

### ดู Log
```bash
sudo tail -f /var/log/apache2/error.log    # Apache Error Log
sudo tail -f /var/log/apache2/access.log   # Apache Access Log
sudo tail -f /var/log/mysql/error.log      # MySQL Error Log
```

### แก้ไขไฟล์
```bash
sudo nano /var/www/html/supermax/config/database.php
sudo nano /var/www/html/supermax/index.php
```

---

## 🗄️ ข้อมูล Database

| รายการ | ค่า |
|--------|-----|
| **Host** | localhost |
| **Database** | supermax_auto |
| **User** | supermax |
| **Password** | supermax123 |

### คำสั่ง MySQL ที่ใช้บ่อย
```bash
# เข้า Database
sudo mysql supermax_auto

# ดูข้อมูล Admin
sudo mysql supermax_auto -e "SELECT * FROM admin_users;"

# ดูข้อมูลสินค้า
sudo mysql supermax_auto -e "SELECT * FROM products;"

# Import Database ใหม่
sudo mysql supermax_auto < /var/www/html/supermax/sql/database.sql
```

---

## 🔒 Firewall (UFW)

### ดูสถานะ
```bash
sudo ufw status
```

### Port ที่เปิด
| Port | ใช้งาน |
|------|--------|
| 22 | SSH |
| 80 | HTTP |
| 443 | HTTPS |

---

## 🔧 แก้ไขปัญหาที่พบบ่อย

### ❌ Database connection failed
```bash
# ตรวจสอบ MySQL ทำงาน
sudo systemctl status mysql

# ตรวจสอบ config
cat /var/www/html/supermax/config/database.php
```

### ❌ Error 403 Forbidden
```bash
sudo chown -R www-data:www-data /var/www/html/supermax
sudo chmod -R 755 /var/www/html/supermax
```

### ❌ Error 500 Internal Server Error
```bash
sudo tail -f /var/log/apache2/error.log
```

### ❌ Git pull ไม่ได้
```bash
cd /var/www/html/supermax
sudo git reset --hard HEAD
sudo git pull origin main
```

---

## 📦 การติดตั้งใหม่ตั้งแต่ต้น

### 1. ติดตั้ง LAMP Stack
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install apache2 mysql-server php php-mysql php-mbstring php-xml php-curl libapache2-mod-php -y
sudo systemctl start apache2
sudo systemctl enable apache2
sudo systemctl start mysql
sudo systemctl enable mysql
```

### 2. สร้าง Database
```bash
sudo mysql -e "CREATE DATABASE IF NOT EXISTS supermax_auto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sudo mysql -e "CREATE USER IF NOT EXISTS 'supermax'@'localhost' IDENTIFIED BY 'supermax123';"
sudo mysql -e "GRANT ALL PRIVILEGES ON supermax_auto.* TO 'supermax'@'localhost'; FLUSH PRIVILEGES;"
```

### 3. Clone โปรเจค
```bash
cd /var/www/html
sudo git clone https://github.com/saranyoo1007/SupermaxAuto.git supermax
sudo chown -R www-data:www-data supermax
sudo chmod -R 755 supermax
```

### 4. Import Database
```bash
sudo mysql supermax_auto < /var/www/html/supermax/sql/database.sql
```

### 5. ตั้งค่า Firewall
```bash
sudo apt install ufw -y
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw --force enable
```

---

## 💰 ค่าใช้จ่าย Google Cloud

| Resource | ประมาณราคา/เดือน |
|----------|------------------|
| e2-micro (Free Tier) | $0 (ฟรี 1 VM ใน US regions) |
| e2-small | ~$13-15 |
| Storage 20GB | ~$1 |

---

## 📝 Checklist การ Deploy

- [x] สร้าง VM Instance บน Google Cloud
- [x] เชื่อมต่อ SSH
- [x] ติดตั้ง Apache, MySQL, PHP
- [x] สร้าง Database และ User
- [x] Clone โปรเจคจาก GitHub
- [x] แก้ไข config/database.php
- [x] Import database.sql
- [x] ตั้งค่า Firewall (UFW)
- [x] ทดสอบเว็บไซต์

---

**อัพเดทล่าสุด:** 28 ธันวาคม 2567
