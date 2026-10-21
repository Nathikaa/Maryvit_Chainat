<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'โรงเรียนมารีวิทย์ ชัยนาท | Maryvit Chainat School'; ?></title>

    <!-- Google Fonts: Prompt & Sarabun -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&family=Sarabun:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/new_style.css">
    <style>
        :root {
            --primary-green: #0B6623;
            --primary-dark: #064016;
            --accent-green: #16a34a;
            --light-green: #eaf6ed;
            --accent-gold: #f59e0b;
            --text-main: #1f2937;
            --text-sub: #6b7280;
            --bg-page: #f8fafc;
            --white: #ffffff;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 18px rgba(0,0,0,0.08);
            --shadow-lg: 0 12px 30px rgba(11,102,35,0.15);
            --radius-md: 14px;
            --radius-lg: 20px;
            --transition: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Prompt', 'Sarabun', sans-serif; background-color: var(--bg-page); color: var(--text-main); line-height: 1.6; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        .container { max-width: 1240px; margin: 0 auto; padding: 0 20px; }

        /* Top Bar */
        .top-bar { background-color: var(--primary-dark); color: #d1fae5; font-size: 0.85rem; padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .top-bar .container { max-width: 1380px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
        .top-info { display: flex; align-items: center; gap: 18px; flex-wrap: wrap; }
        .top-info span { display: inline-flex; align-items: center; gap: 6px; }
        .top-links { display: flex; align-items: center; gap: 15px; }
        .top-links a { color: #d1fae5; transition: var(--transition); display: inline-flex; align-items: center; gap: 6px; }
        .top-links a:hover { color: var(--accent-gold); }

        /* Navbar */
        .navbar { background: var(--white); box-shadow: var(--shadow-sm); position: sticky; top: 0; z-index: 1000; transition: var(--transition); }
        .navbar .container { max-width: 1380px; display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; gap: 15px; }
        .logo-box { display: flex; align-items: center; gap: 12px; flex-shrink: 0; white-space: nowrap; }
        .logo-emblem { width: 48px; height: 48px; background: linear-gradient(135deg, var(--primary-green), #15803d); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--white); font-size: 1.5rem; font-weight: 700; box-shadow: 0 4px 10px rgba(11,102,35,0.3); border: 2px solid var(--accent-gold); }
        .logo-title h1 { font-size: 1.18rem; font-weight: 700; color: var(--primary-green); line-height: 1.2; }
        .logo-title span { font-size: 0.75rem; color: var(--text-sub); font-weight: 400; letter-spacing: 0.5px; }
        .nav-links { display: flex; align-items: center; gap: 16px; margin: 0; padding: 0; }
        .nav-item { font-size: 0.92rem; font-weight: 500; color: var(--text-main); padding: 8px 4px; position: relative; transition: var(--transition); white-space: nowrap; }
        .nav-item::after { content: ''; position: absolute; bottom: 0; left: 0; width: 0%; height: 3px; background: var(--primary-green); border-radius: 2px; transition: var(--transition); }
        .nav-item:hover, .nav-item.active { color: var(--primary-green); }
        .nav-item:hover::after, .nav-item.active::after { width: 100%; }

        /* Header Buttons */
        .header-btn-group { display: flex; align-items: center; gap: 10px; flex-shrink: 0; white-space: nowrap; }
        .theme-btn { display: inline-flex; align-items: center; justify-content: center; gap: 6px; background: linear-gradient(135deg, var(--primary-green), #16a34a); color: #ffffff; padding: 8px 16px; border-radius: 9999px; border: none; font-size: 0.85rem; font-weight: 500; cursor: pointer; box-shadow: 0 4px 12px rgba(11,102,35,0.22); transition: var(--transition); text-decoration: none; white-space: nowrap; }
        .theme-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(11,102,35,0.32); color: #ffffff; }
        .dropdown { position: relative; display: inline-block; }
        .dropdown-menu { display: none; position: absolute; top: calc(100% + 8px); left: 0; background-color: #ffffff; min-width: 190px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.12); padding: 8px 0; z-index: 100; border: 1px solid #e2e8f0; }
        .dropdown:hover .dropdown-menu { display: block; }
        .dropdown-item { display: block; padding: 10px 18px; color: var(--text-main); font-size: 0.88rem; font-weight: 500; transition: background-color 0.2s ease; white-space: nowrap; }
        .dropdown-item:hover { background-color: var(--light-green); color: var(--primary-green); }
        .mobile-btn { display: none; font-size: 1.6rem; color: var(--primary-green); cursor: pointer; }

        /* Responsive Breakpoints */
        @media (max-width: 1180px) {
            .header-btn-group { display: none; }
            .nav-links { display: none; position: absolute; top: 100%; left: 0; width: 100%; background: var(--white); flex-direction: column; padding: 20px; box-shadow: var(--shadow-md); }
            .nav-links.active { display: flex; }
            .mobile-btn { display: block; }
        }
    </style>
</head>
<body>

    <!-- 1. Top Contact Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-info">
                <span><i class="fa-solid fa-phone"></i> 056-411-XXX</span>
                <span><i class="fa-solid fa-envelope"></i> info@maryvit-chainat.ac.th</span>
                <span><i class="fa-solid fa-location-dot"></i> อำเภอเมืองชัยนาท จังหวัดชัยนาท 17000</span>
            </div>
            <div class="top-links">
                <a href="https://pattaya.maryvit.ac.th" target="_blank"><i class="fa-solid fa-network-wired"></i> เครือโรงเรียนมารีวิทย์ (พัทยา)</a>
                <a href="admin/index.php"><i class="fa-solid fa-user-shield"></i> ระบบเจ้าหน้าที่ (Admin)</a>
            </div>
        </div>
    </div>

    <!-- 2. Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo-box">
                    <img src="assets/images/logo.png" alt="โลโก้โรงเรียนมารีวิทย์ ชัยนาท" class="site-logo-img">
                    <div class="logo-title">
                    <h1>โรงเรียนมารีวิทย์ชัยนาท</h1>
                    <span>MARYVIT CHAINAT SCHOOL</span>
                 </div>
            </a>

            <div class="mobile-btn" id="mobile-toggle-btn">
                <i class="fa-solid fa-bars"></i>
            </div>

            <ul class="nav-links" id="nav-list">
                <li><a href="index.php" class="nav-item <?php echo ($currentPage == 'home') ? 'active' : ''; ?>">หน้าแรก</a></li>
                <li><a href="about.php" class="nav-item <?php echo ($currentPage == 'about') ? 'active' : ''; ?>">เกี่ยวกับเรา</a></li>
                <li><a href="curriculum.php" class="nav-item <?php echo ($currentPage == 'curriculum') ? 'active' : ''; ?>">หลักสูตร</a></li>
                <li><a href="news.php" class="nav-item <?php echo ($currentPage == 'news') ? 'active' : ''; ?>">ข่าวประชาสัมพันธ์</a></li>
                <li><a href="admissions.php" class="nav-item <?php echo ($currentPage == 'admissions') ? 'active' : ''; ?>">รับสมัครนักเรียน</a></li>
                <li><a href="contact.php" class="nav-item <?php echo ($currentPage == 'contact') ? 'active' : ''; ?>">ติดต่อเรา</a></li>
            </ul>

            <div class="header-btn-group">
                <div class="dropdown">
                    <button class="theme-btn">
                        <i class="fa-solid fa-user-gear"></i>
                        <span>PowerSchool SIS</span>
                        <i class="fa-solid fa-chevron-down" style="font-size: 0.75rem;"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item"><i class="fa-solid fa-chalkboard-user"></i> PowerTeacher Pro</a>
                        <a href="#" class="dropdown-item"><i class="fa-solid fa-id-card-clip"></i> PowerSchool SIS</a>
                    </div>
                </div>

                <a href="#" class="theme-btn">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>ระบบ Schoology</span>
                </a>
            </div>
        </div>
    </nav>