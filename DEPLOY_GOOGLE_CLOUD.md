# 🌐 คู่มือ Deploy SuperMax Auto บน Google Cloud VPS

คู่มือนี้สำหรับการอัพโหลดเว็บไซต์ SuperMax Auto (PHP + MySQL) ไปยัง Google Cloud Compute Engine

---

## 📋 ข้อมูลเซิร์ฟเวอร์

| รายการ | ค่า |
|--------|-----|
| **VM Name** | supermax-web |
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
# เชื่อมต่อ SSH
gcloud compute ssh supermax-web --zone=asia-northeast1-a

# หากต้องการสร้าง SSH Key ใหม่ (กด Enter สำหรับ passphrase ว่าง)
gcloud compute ssh supermax-web --zone=asia-northeast1-a --force-key-file-overwrite
```

---

## 🔄 การอัพเดทเว็บไซต์

### ขั้นตอนที่ 1: Push ขึ้น GitHub (บนเครื่อง Mac)

```bash
cd /Users/saranyoo/Ubuntu-server/Server-Ubutun-server02/Supermax_Auto
git add -A
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

### 🚀 คำสั่งรวม (One-liner)
```bash
cd /var/www/html/supermax && sudo git pull origin main && sudo chown -R www-data:www-data . && sudo chmod -R 755 .
```

---

## 🛠️ คำสั่งที่ใช้บ่อย

### จัดการ Apache
```bash
sudo systemctl start apache2      # เริ่ม Apache
sudo systemctl stop apache2       # หยุด Apache
sudo systemctl restart apache2    # รีสตาร์ท Apache
sudo systemctl status apache2     # ดูสถานะ
sudo systemctl reload apache2     # โหลด config ใหม่
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

# Backup Database
sudo mysqldump supermax_auto > ~/backup_$(date +%Y%m%d).sql
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

## 🔐 การติดตั้ง SSL Certificate (HTTPS)

### ติดตั้ง Certbot
```bash
sudo apt update
sudo apt install certbot python3-certbot-apache -y
```

### ขอ SSL Certificate (ต้องมี Domain ชี้มาที่ IP ก่อน)
```bash
# แทน yourdomain.com ด้วยชื่อโดเมนของคุณ
sudo certbot --apache -d yourdomain.com -d www.yourdomain.com
```

### ต่ออายุ Certificate อัตโนมัติ
```bash
# ทดสอบการต่ออายุ
sudo certbot renew --dry-run

# ตรวจสอบ Cron Job
sudo systemctl status certbot.timer
```

### ใช้งานกับ IP (Self-signed - สำหรับทดสอบ)
```bash
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
  -keyout /etc/ssl/private/apache-selfsigned.key \
  -out /etc/ssl/certs/apache-selfsigned.crt

# แก้ไข Apache config
sudo nano /etc/apache2/sites-available/default-ssl.conf
```

---

## 🌍 การตั้งค่า Domain

### 1. ซื้อ Domain จาก
- [Namecheap](https://www.namecheap.com)
- [GoDaddy](https://www.godaddy.com)
- [Google Domains](https://domains.google)
- [Thai Domain (.co.th)](https://www.thnic.co.th)

### 2. ชี้ Domain มาที่ VPS
สร้าง **A Record** ใน DNS:
| Type | Name | Value |
|------|------|-------|
| A | @ | 34.84.205.60 |
| A | www | 34.84.205.60 |

### 3. ตั้งค่า Virtual Host
```bash
sudo nano /etc/apache2/sites-available/supermax.conf
```

เนื้อหา:
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    DocumentRoot /var/www/html/supermax
    
    <Directory /var/www/html/supermax>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/supermax_error.log
    CustomLog ${APACHE_LOG_DIR}/supermax_access.log combined
</VirtualHost>
```

เปิดใช้งาน:
```bash
sudo a2ensite supermax.conf
sudo a2enmod rewrite
sudo systemctl reload apache2
```

---

## 🔧 แก้ไขปัญหาที่พบบ่อย

### ❌ Database connection failed
```bash
# ตรวจสอบ MySQL ทำงาน
sudo systemctl status mysql

# ตรวจสอบ config
cat /var/www/html/supermax/config/database.php

# รีสตาร์ท MySQL
sudo systemctl restart mysql
```

### ❌ Error 403 Forbidden
```bash
sudo chown -R www-data:www-data /var/www/html/supermax
sudo chmod -R 755 /var/www/html/supermax
```

### ❌ Error 500 Internal Server Error
```bash
# ดู Error Log
sudo tail -f /var/log/apache2/error.log

# ตรวจสอบ PHP syntax
php -l /var/www/html/supermax/index.php
```

### ❌ Git pull ไม่ได้
```bash
cd /var/www/html/supermax
sudo git reset --hard HEAD
sudo git pull origin main
```

### ❌ SSH Connection Timeout
```bash
# ตรวจสอบ VM ทำงานอยู่ใน Google Cloud Console
# หรือ restart VM
gcloud compute instances start supermax-web --zone=asia-northeast1-a
```

### ❌ Permission denied (publickey)
```bash
# สร้าง SSH key ใหม่
gcloud compute ssh supermax-web --zone=asia-northeast1-a --force-key-file-overwrite
```

---

## 📦 การติดตั้งใหม่ตั้งแต่ต้น

### 1. สร้าง VM Instance
```bash
gcloud compute instances create supermax-web \
  --zone=asia-northeast1-a \
  --machine-type=e2-small \
  --image-family=ubuntu-2404-lts-amd64 \
  --image-project=ubuntu-os-cloud \
  --boot-disk-size=20GB \
  --tags=http-server,https-server
```

### 2. ติดตั้ง LAMP Stack
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install apache2 mysql-server php php-mysql php-mbstring php-xml php-curl php-zip libapache2-mod-php git -y
sudo systemctl start apache2
sudo systemctl enable apache2
sudo systemctl start mysql
sudo systemctl enable mysql
```

### 3. สร้าง Database
```bash
sudo mysql -e "CREATE DATABASE IF NOT EXISTS supermax_auto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sudo mysql -e "CREATE USER IF NOT EXISTS 'supermax'@'localhost' IDENTIFIED BY 'supermax123';"
sudo mysql -e "GRANT ALL PRIVILEGES ON supermax_auto.* TO 'supermax'@'localhost'; FLUSH PRIVILEGES;"
```

### 4. Clone โปรเจค
```bash
cd /var/www/html
sudo git clone https://github.com/saranyoo1007/SupermaxAuto.git supermax
sudo chown -R www-data:www-data supermax
sudo chmod -R 755 supermax
```

### 5. Import Database
```bash
sudo mysql supermax_auto < /var/www/html/supermax/sql/database.sql
```

### 6. ตั้งค่า Firewall
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
| e2-medium | ~$25-30 |
| Storage 20GB | ~$1 |
| Static IP | ~$3 (ถ้า VM ปิด) |

### 💡 เคล็ดลับประหยัด
- ใช้ **e2-micro** ใน **us-west1** หรือ **us-central1** สำหรับ Free Tier
- ปิด VM เมื่อไม่ใช้งาน
- ใช้ Preemptible/Spot VM สำหรับงาน Dev/Test

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
- [ ] ตั้งค่า Domain (Optional)
- [ ] ติดตั้ง SSL Certificate (Optional)
- [ ] ตั้งค่า Backup อัตโนมัติ (Optional)

---

## 📚 ลิงค์ที่เป็นประโยชน์

- [Google Cloud Console](https://console.cloud.google.com)
- [GitHub Repository](https://github.com/saranyoo1007/SupermaxAuto)
- [Let's Encrypt](https://letsencrypt.org)
- [Apache Documentation](https://httpd.apache.org/docs/)

---

**อัพเดทล่าสุด:** 28 ธันวาคม 2567
