<?php
require_once 'config.php';
checkAuth();

$msg = '';

// อัปเดตสถานะของเคสติดต่อ
if (isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $ticket_id = intval($_POST['ticket_id'] ?? 0);
    $status = $_POST['status'] ?? 'new';

    if ($ticket_id > 0) {
        $stmt = $conn->prepare("UPDATE contact_tickets SET status = ? WHERE id = ?");
        $stmt->execute([$status, $ticket_id]);
        $msg = "อัปเดตสถานะการดำเนินเรื่องเรียบร้อยแล้ว";
    }
}

// ลบเคสติดต่อ
if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM contact_tickets WHERE id = ?");
    $stmt->execute([$del_id]);
    header("Location: tickets_manage.php");
    exit;
}

// ตัวกรองตามสถานะ
$filter_status = $_GET['status'] ?? 'all';
if ($filter_status !== 'all' && !empty($filter_status)) {
    $stmt = $conn->prepare("SELECT * FROM contact_tickets WHERE status = ? ORDER BY id DESC");
    $stmt->execute([$filter_status]);
    $tickets_list = $stmt->fetchAll();
} else {
    $tickets_list = $conn->query("SELECT * FROM contact_tickets ORDER BY id DESC")->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการเรื่องติดต่อสอบถาม | Admin โรงเรียนมารีวิทย์ ชัยนาท</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include 'sidebar.php'; ?>

    <main>
        <h2>จัดการเรื่องติดต่อสอบถาม (Helpdesk Tickets)</h2>

        <?php if (!empty($msg)): ?>
            <div class="alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo $msg; ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="filter-bar">
                <h3 style="color: var(--primary-green); font-size: 1.1rem; margin-bottom: 0;">
                    <i class="fa-solid fa-envelope-open-text"></i> รายการเรื่องติดต่อ (<?php echo count($tickets_list); ?> เรื่อง)
                </h3>

                <form method="GET">
                    <label style="font-size: 0.88rem; color: var(--text-sub); margin-right: 6px;">กรองตามสถานะ:</label>
                    <select name="status" class="filter-select" onchange="this.form.submit()">
                        <option value="all" <?php echo $filter_status === 'all' ? 'selected' : ''; ?>>ทั้งหมดทุกสถานะ</option>
                        <option value="new" <?php echo $filter_status === 'new' ? 'selected' : ''; ?>>เรื่องใหม่</option>
                        <option value="in_progress" <?php echo $filter_status === 'in_progress' ? 'selected' : ''; ?>>กำลังประสานงาน</option>
                        <option value="resolved" <?php echo $filter_status === 'resolved' ? 'selected' : ''; ?>>ตอบกลับเรียบร้อย</option>
                    </select>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width: 130px;">รหัส Ticket</th>
                        <th style="width: 140px;">หัวข้อ / แผนก</th>
                        <th style="width: 100px;">ความเร่งด่วน</th>
                        <th>ผู้ติดต่อ & ข้อมูลติดต่อ</th>
                        <th>ข้อความ / รายละเอียด</th>
                        <th style="width: 150px;">สถานะดำเนินการ</th>
                        <th style="width: 100px; text-align: center;">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($tickets_list) > 0): ?>
                        <?php foreach ($tickets_list as $ticket): ?>
                            <tr>
                                <td>
                                    <strong style="color: var(--primary-green); font-family: monospace; font-size: 0.85rem;"><?php echo htmlspecialchars($ticket['ticket_code']); ?></strong>
                                    <div style="font-size: 0.75rem; color: var(--text-sub);"><?php echo date('d/m/y H:i', strtotime($ticket['created_at'])); ?></div>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($ticket['topic']); ?></strong>
                                </td>
                                <td>
                                    <?php 
                                        $urgencyClass = 'badge-normal';
                                        if ($ticket['urgency'] === 'Urgent') $urgencyClass = 'badge-urgent';
                                        elseif ($ticket['urgency'] === 'Fast') $urgencyClass = 'badge-fast';
                                    ?>
                                    <span class="badge-pill <?php echo $urgencyClass; ?>">
                                        <?php echo htmlspecialchars($ticket['urgency']); ?>
                                    </span>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($ticket['sender_name']); ?></strong><br>
                                    <small style="color: var(--text-sub);">
                                        <i class="fa-solid fa-phone"></i> <?php echo htmlspecialchars($ticket['sender_phone']); ?>
                                        <?php if (!empty($ticket['sender_line'])): ?>
                                            | LINE: <?php echo htmlspecialchars($ticket['sender_line']); ?>
                                        <?php endif; ?>
                                    </small>
                                </td>
                                <td style="max-width: 250px; line-height: 1.4;">
                                    <div style="font-size: 0.88rem; color: var(--text-main);"><?php echo nl2br(htmlspecialchars($ticket['message'])); ?></div>
                                </td>
                                <td>
                                    <form method="POST" style="margin: 0;">
                                        <input type="hidden" name="action" value="update_status">
                                        <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                                        <select name="status" class="status-select status-<?php echo $ticket['status']; ?>" onchange="this.form.submit()">
                                            <option value="new" <?php echo $ticket['status'] === 'new' ? 'selected' : ''; ?>>เรื่องใหม่</option>
                                            <option value="in_progress" <?php echo $ticket['status'] === 'in_progress' ? 'selected' : ''; ?>>กำลังประสานงาน</option>
                                            <option value="resolved" <?php echo $ticket['status'] === 'resolved' ? 'selected' : ''; ?>>ตอบกลับแล้ว</option>
                                        </select>
                                    </form>
                                </td>
                                <td style="text-align: center;">
                                    <a href="tickets_manage.php?delete=<?php echo $ticket['id']; ?>" class="btn-del" onclick="return confirm('ต้องการลบเรื่องติดต่อนี้ใช่หรือไม่?')">
                                        <i class="fa-solid fa-trash-can"></i> ลบ
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" style="text-align: center; color: var(--text-sub); padding: 30px;">ไม่พบรายการเรื่องติดต่อในสถานะที่เลือก</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>