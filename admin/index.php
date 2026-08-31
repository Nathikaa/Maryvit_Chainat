<?php
require_once 'config.php';

// หากยังไม่มีตาราง หรือไม่มี User แอดมิน ให้สร้างให้อัตโนมัติด้วย Hash ของเครื่องนี้
$checkAdmin = $conn->query("SELECT * FROM admins WHERE username = 'admin' LIMIT 1")->fetch();
if (!$checkAdmin) {
    $defaultPass = password_hash('admin1234', PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO admins (username, password, fullname, role) VALUES ('admin', ?, 'ผู้ดูแลระบบส่วนกลาง', 'SuperAdmin')");
    $stmt->execute([$defaultPass]);
}

// ถ้าล็อกอินค้างไว้อยู่แล้ว ให้ไปหน้า dashboard ทันที
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        // ตรวจสอบรหัสผ่าน หรืออัปเดต Hash ให้อัตโนมัติหากตรงกับรหัสเริ่มต้น
        if ($admin) {
            $is_correct = password_verify($password, $admin['password']);
            
            // กรณี Hash เก่าไม่แมตช์ แต่พิมพ์ admin1234 มาถูกต้อง
            if (!$is_correct && $username === 'admin' && $password === 'admin1234') {
                $newHash = password_hash('admin1234', PASSWORD_DEFAULT);
                $updateStmt = $conn->prepare("UPDATE admins SET password = ? WHERE username = 'admin'");
                $updateStmt->execute([$newHash]);
                $is_correct = true;
            }

            if ($is_correct) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_user'] = $admin['username'];
                $_SESSION['admin_name'] = $admin['fullname'];
                $_SESSION['admin_role'] = $admin['role'];

                header("Location: dashboard.php");
                exit;
            } else {
                $error = "รหัสผ่านไม่ถูกต้อง";
            }
        } else {
            $error = "ไม่พบชื่อผู้ใช้งานนี้ในระบบ";
        }
    } else {
        $error = "กรุณากรอกข้อมูลให้ครบถ้วน";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบเจ้าหน้าที่ (Admin) | โรงเรียนมารีวิทย์ชัยนาท</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-green: #0B6623;
            --primary-dark: #064016;
            --accent-gold: #f59e0b;
            --bg-page: #f8fafc;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Prompt', sans-serif; }
        body {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-green) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 40px 32px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            text-align: center;
        }
        .logo-emblem {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-green), #15803d);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 700;
            border: 2px solid var(--accent-gold);
            margin-bottom: 14px;
        }
        h2 { color: var(--primary-green); font-size: 1.35rem; font-weight: 700; margin-bottom: 4px; }
        p.subtitle { font-size: 0.85rem; color: #64748b; margin-bottom: 24px; }
        .form-group { text-align: left; margin-bottom: 16px; }
        label { display: block; font-size: 0.88rem; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .input-box {
            display: flex;
            align-items: center;
            border: 1.5px solid #d1d5db;
            border-radius: 10px;
            padding: 0 14px;
            background: var(--bg-page);
        }
        .input-box:focus-within {
            border-color: var(--primary-green);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(11,102,35,0.15);
        }
        .input-box i { color: #9ca3af; margin-right: 10px; width: 16px; text-align: center; }
        .input-box input {
            width: 100%;
            padding: 12px 0;
            border: none;
            background: transparent;
            outline: none;
            font-size: 0.95rem;
            color: #1f2937;
        }
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--primary-green), #15803d);
            border: none;
            border-radius: 10px;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s ease;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(11,102,35,0.35); }
        .error-msg {
            background: #fee2e2;
            color: #dc2626;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 18px;
            text-align: left;
            border-left: 4px solid #ef4444;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 22px;
            font-size: 0.85rem;
            color: #64748b;
            text-decoration: none;
        }
        .back-link:hover { color: var(--primary-green); }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo-emblem">M</div>
        <h2>ระบบเจ้าหน้าที่ (Admin)</h2>
        <p class="subtitle">โรงเรียนมารีวิทย์ชัยนาท (Maryvit Chainat)</p>

        <?php if (!empty($error)): ?>
            <div class="error-msg">
                <i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="username">ชื่อผู้ใช้งาน (Username)</label>
                <div class="input-box">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" id="username" name="username" value="admin" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">รหัสผ่าน (Password)</label>
                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="กรอกรหัสผ่าน" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-right-to-bracket"></i> เข้าสู่ระบบ
            </button>
        </form>

        <a href="../index.php" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> กลับสู่หน้าหลักของโรงเรียน
        </a>
    </div>

</body>
</html>