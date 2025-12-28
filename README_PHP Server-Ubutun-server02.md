
อัพโหลดเว็บไซต์ SuperMax Auto ไปยัง Ubuntu Server 192.168.2.3


# วิธีอัพโหลดเว็บไซต์ไปยัง Ubuntu Server

เมื่อแก้ไขไฟล์แล้ว ให้ทำตามขั้นตอนนี้เพื่ออัพโหลดขึ้น server

## ขั้นตอนที่ 1: อัพโหลดไฟล์ที่แก้ไข

// turbo
```bash
multipass transfer -r /Users/saranyoo/Ubuntu-server/Server-Ubutun-server02/Supermax_Auto/. protected-croaker:/home/ubuntu/Supermax_Auto/
```

## ขั้นตอนที่ 2: ตั้งค่า Permission

// turbo
```bash
multipass exec protected-croaker -- sudo chmod -R 755 /home/ubuntu/Supermax_Auto
```

## ขั้นตอนที่ 3: เปิดเว็บไซต์

เปิดเบราว์เซอร์ไปที่: http://192.168.2.3/supermax/

---

## หมายเหตุ

- ไม่ต้อง restart Apache เพราะ PHP อ่านไฟล์ใหม่อัตโนมัติ
- ถ้าแก้ไข database schema ต้อง import ใหม่:
  ```bash
  multipass exec protected-croaker -- bash -c "sudo mysql supermax_auto < /home/ubuntu/Supermax_Auto/sql/database.sql"
  ```
http://192.168.2.3/supermax/index.php