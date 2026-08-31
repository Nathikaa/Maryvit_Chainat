<?php 
// 1. โหลด config และเชื่อมต่อฐานข้อมูลก่อนส่ง Output ใดๆ
require_once 'admin/config.php';

$pageTitle = "ข่าวประชาสัมพันธ์ & กิจกรรม | โรงเรียนมารีวิทย์ ชัยนาท (Maryvit Chainat School)";
$currentPage = "news";

// 2. ดึงรายการข่าวสารทั้งหมดจากฐานข้อมูล
$stmt = $conn->query("SELECT * FROM news ORDER BY id DESC");
$news_items = $stmt->fetchAll();

// หมวดหมู่และสไตล์สีการ์ด
$cat_names = [
    'general'  => 'ประชาสัมพันธ์',
    'academic' => 'วิชาการ',
    'activity' => 'ภาพกิจกรรม',
    'pride'    => 'ความภาคภูมิใจ'
];

$cat_gradients = [
    'general'  => 'linear-gradient(45deg, #0B6623, #15803d)',
    'academic' => 'linear-gradient(45deg, #b45309, #f59e0b)',
    'activity' => 'linear-gradient(45deg, #7c3aed, #a855f7)',
    'pride'    => 'linear-gradient(45deg, #1e3a8a, #3b82f6)'
];

$cat_icons = [
    'general'  => 'fa-school',
    'academic' => 'fa-book-open',
    'activity' => 'fa-volleyball',
    'pride'    => 'fa-award'
];

// 3. เรียกใช้ Header ของหน้าเว็บ
include 'header.php'; 
?>

<!-- Header Banner -->
<section class="page-header">
    <div class="container">
        <div class="header-content">
            <div class="header-badge"><i class="fa-solid fa-bullhorn"></i> News & Announcements</div>
            <h2>ข่าวสาร & <span>กิจกรรมประชาสัมพันธ์</span></h2>
            <p>เกาะติดทุกความเคลื่อนไหว ประกาศสำคัญ ผลงานนักเรียน และภาพบรรยากาศกิจกรรมในโรงเรียน</p>
            <div class="breadcrumb">
                <a href="index.php"><i class="fa-solid fa-house"></i> หน้าแรก</a>
                <span>/</span>
                <span>ข่าวประชาสัมพันธ์</span>
            </div>
        </div>
    </div>
</section>

<!-- Filter & Search Controls -->
<div class="filter-section">
    <div class="container">
        <div class="filter-container">
            <div class="category-tabs">
                <button class="cat-btn active" onclick="filterNews('all')">ทั้งหมด</button>
                <button class="cat-btn" onclick="filterNews('general')">ข่าวประชาสัมพันธ์</button>
                <button class="cat-btn" onclick="filterNews('academic')">วิชาการ</button>
                <button class="cat-btn" onclick="filterNews('activity')">ภาพกิจกรรม</button>
                <button class="cat-btn" onclick="filterNews('pride')">ความภาคภูมิใจ</button>
            </div>

            <div class="search-box">
                <input type="text" id="newsSearch" placeholder="ค้นหาข่าวสาร..." onkeyup="searchNews()">
                <i class="fa-solid fa-magnifying-glass" style="color: var(--text-sub);"></i>
            </div>
        </div>
    </div>
</div>

<!-- News Grid -->
<section class="news-section">
    <div class="container">
        <div class="news-grid" id="news-grid">
            <?php if (count($news_items) > 0): ?>
                <?php foreach ($news_items as $news): ?>
                    <?php 
                        $catKey = $news['category'] ?? 'general';
                        $catLabel = $cat_names[$catKey] ?? 'ประชาสัมพันธ์';
                        $bgGrad = $cat_gradients[$catKey] ?? $cat_gradients['general'];
                        $iconClass = $cat_icons[$catKey] ?? 'fa-school';
                    ?>
                    <div class="news-card" data-category="<?php echo htmlspecialchars($catKey); ?>">
                        <div class="news-banner" style="background: <?php echo $bgGrad; ?>;">
                            <i class="fa-solid <?php echo $iconClass; ?> fa-3x"></i>
                            <span class="news-date"><i class="fa-regular fa-clock"></i> <?php echo date('d M Y', strtotime($news['created_at'])); ?></span>
                        </div>
                        <div class="news-content">
                            <span class="news-cat"><?php echo htmlspecialchars($catLabel); ?></span>
                            <h4 class="news-heading"><?php echo htmlspecialchars($news['title']); ?></h4>
                            <p class="news-detail"><?php echo nl2br(htmlspecialchars($news['detail'])); ?></p>
                            <div class="news-meta">
                                <span><i class="fa-regular fa-eye"></i> <?php echo intval($news['views']); ?> ครั้ง</span>
                                <span style="color: var(--primary-green); font-weight: 600;">โรงเรียนมารีวิทย์</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--text-sub); background: #fff; border-radius: var(--radius-md);">
                    <i class="fa-regular fa-newspaper fa-3x" style="color: #cbd5e1; margin-bottom: 12px;"></i>
                    <p>ยังไม่มีรายการข่าวสารในระบบ (สามารถเพิ่มได้ที่ระบบแอดมิน)</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- JavaScript Filter Tabs & Search -->
<script>
    function filterNews(category) {
        const buttons = document.querySelectorAll('.cat-btn');
        buttons.forEach(btn => btn.classList.remove('active'));
        if (event && event.target) {
            event.target.classList.add('active');
        }

        const cards = document.querySelectorAll('.news-card');
        cards.forEach(card => {
            if (category === 'all' || card.getAttribute('data-category') === category) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function searchNews() {
        const input = document.getElementById('newsSearch').value.toLowerCase();
        const cards = document.querySelectorAll('.news-card');

        cards.forEach(card => {
            const title = card.querySelector('.news-heading').innerText.toLowerCase();
            const detail = card.querySelector('.news-detail').innerText.toLowerCase();

            if (title.includes(input) || detail.includes(input)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

<?php include 'footer.php'; ?>