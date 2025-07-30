# EBS Generate Application

## ภาพรวม
EBS Generate เป็นระบบการจัดการและสร้างข้อมูล EBS (Electronic Business System) ที่พัฒนาด้วย PHP

## คุณสมบัติหลัก
- การสร้างและจัดการข้อมูล EBS
- ระบบการคำนวณ Formula
- การส่งออกข้อมูลเป็น CSV และ Excel
- ระบบจัดการ Toyota calculations
- การสร้างรายงานต่างๆ
- การส่งออกข้อมูลเป็น PDF

## เทคโนโลยีที่ใช้
- PHP
- JavaScript
- jQuery & jQuery UI
- TCPDF (สำหรับการสร้าง PDF)
- PHPMailer (สำหรับการส่งอีเมล)
- CSS/HTML

## โครงสร้างโปรเจค
```
ebs_generate/
├── index.php                 # หน้าหลัก
├── functions/               # ฟังก์ชันต่างๆ
├── views/                   # หน้าต่างๆ ของระบบ
├── includes/               # ไฟล์ที่ถูก include
│   ├── css/               # Stylesheets
│   ├── PHPMailer/         # ไลบรารี PHPMailer
│   └── tcpdf/             # ไลบรารี TCPDF
├── javascript/             # JavaScript files
├── images/                 # รูปภาพและไอคอน
└── db/                     # ไฟล์ฐานข้อมูล
```

## การติดตั้ง
1. Clone โปรเจคนี้
2. วางไฟล์ในโฟลเดอร์ web server (เช่น htdocs สำหรับ XAMPP)
3. ตั้งค่าฐานข้อมูลตามไฟล์ใน db/
4. ปรับแต่งการตั้งค่าในไฟล์ configure.php

## ข้อกำหนดระบบ
- PHP 5.6 หรือสูงกว่า
- Web Server (Apache/Nginx)
- MySQL Database
- Web Browser ที่รองรับ JavaScript

## การใช้งาน
1. เข้าสู่ระบบผ่าน index.php
2. เลือกเมนูที่ต้องการจากระบบ
3. จัดการข้อมูลตามต้องการ

## ผู้พัฒนา
- kaisornphrmfueal (kaisorn.pomfueal@gmail.com)

## License
สงวนลิขสิทธิ์
