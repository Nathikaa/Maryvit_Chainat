<?php
require_once 'config.php';
checkAuth();

// ตั้งชื่อไฟล์พร้อมวันที่ดาวน์โหลด
$filename = "Maryvit_Admissions_" . date('Y-m-d_His') . ".csv";

// ตั้งค่า Header ให้บราวเซอร์ดาวน์โหลดไฟล์ CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// สร้าง Output stream
$output = fopen('php://output', 'w');

// ใส่ BOM เพื่อให้ Microsoft Excel อ่านภาษาไทยออก ไม่เป็นภาษาต่างดาว
fputs($output, "\xEF\xBB\xBF");

// ใส่หัวตาราง
fputcsv($output, ['รหัสสมัคร', 'ชื่อ-นามสกุล นักเรียน', 'ระดับชั้นที่สมัคร', 'เบอร์โทรศัพท์ผู้ปกครอง', 'LINE ID', 'สถานะ', 'วันที่สมัคร']);

// ดึงข้อมูลทั้งหมดจาก Database
$stmt = $conn->query("SELECT * FROM admissions ORDER BY id DESC");
$rows = $stmt->fetchAll();

$status_map = [
    'pending'   => 'รอดำเนินการ',
    'contacted' => 'ติดต่อแล้ว',
    'approved'  => 'ยืนยันสิทธิ์แล้ว',
    'rejected'  => 'สละสิทธิ์/ไม่ผ่าน'
];

foreach ($rows as $row) {
    fputcsv($output, [
        '#' . $row['id'],
        $row['student_name'],
        $row['grade_level'],
        $row['parent_phone'],
        $row['parent_line'] ?: '-',
        $status_map[$row['status']] ?? $row['status'],
        date('d/m/Y H:i', strtotime($row['created_at']))
    ]);
}

fclose($output);
exit;
?>