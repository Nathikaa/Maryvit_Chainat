<?php
// 1. เริ่มต้น Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. ตั้งค่าการเชื่อมต่อฐานข้อมูล
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'maryvit_db';

try {
    // สร้างตัวแปร $conn ก่อนเรียกใช้งาน
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage());
}

// 3. ฟังก์ชันตรวจสอบสิทธิ์การเข้าใช้งาน
function checkAuth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: index.php");
        exit;
    }
}
?>