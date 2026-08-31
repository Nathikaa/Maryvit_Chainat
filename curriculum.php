<?php 
$pageTitle = "หลักสูตรการศึกษา | โรงเรียนมารีวิทย์ชัยนาท (Maryvit Chainat School)";
$currentPage = "curriculum";
include 'header.php'; 
?>

<!-- 3. Header Banner -->
<section class="page-header">
    <div class="container">
        <div class="header-content">
            <div class="header-badge"><i class="fa-solid fa-graduation-cap"></i> Academic Excellence & Global Mindset</div>
            <h2>หลักสูตร <span>การเรียนรู้ที่ไร้ขีดจำกัด</span></h2>
            <p>มุ่งเน้นการจัดการเรียนรู้บูรณาการภาษาอังกฤษ เทคโนโลยีดิจิทัล และทักษะศตวรรษที่ 21 ภายใต้มาตรฐานการศึกษาเครือมารีวิทย์</p>
            <div class="breadcrumb">
                <a href="index.php"><i class="fa-solid fa-house"></i> หน้าแรก</a>
                <span>/</span>
                <span>หลักสูตรการศึกษา</span>
            </div>
        </div>
    </div>
</section>

<!-- 4. Interactive Level Tabs -->
<div class="tab-nav-wrapper">
    <div class="container">
        <div class="tab-nav-container">
            <button class="tab-btn active" onclick="openTab(event, 'kindergarten')">
                <i class="fa-solid fa-shapes"></i> แผนกปฐมวัย
            </button>
            <button class="tab-btn" onclick="openTab(event, 'primary')">
                <i class="fa-solid fa-book-open"></i> แผนกประถมศึกษา
            </button>
            <button class="tab-btn" onclick="openTab(event, 'secondary')">
                <i class="fa-solid fa-flask"></i> แผนกมัธยมศึกษา
            </button>
        </div>
    </div>
</div>

<!-- 5. Main Curriculum Sections (Tab Content) -->
<section class="curriculum-detail-section">
    <div class="container">

        <!-- TAB 1: KINDERGARTEN (ปฐมวัย) -->
        <div id="kindergarten" class="tab-pane active">
            <div class="curriculum-hero-card">
                <div class="curriculum-hero-info">
                    <span class="curriculum-tag">ระดับเตรียมอนุบาล - อนุบาล 3 (อายุ 2 - 6 ปี)</span>
                    <h3>แผนกปฐมวัย (Early Childhood Program)</h3>
                    <p>มุ่งเน้นการพัฒนาการทั้ง 4 ด้าน (ร่างกาย อารมณ์ สังคม และสติปัญญา) ผ่านการเรียนรู้เชิงรุก <strong>Play-based Learning</strong> และการสืบเสาะหาความรู้ตามแนวทาง <em>Project Approach</em> พร้อมซึมซับภาษาอังกฤษอย่างเป็นธรรมชาติกับคุณครูชาวต่างชาติ</p>
                    
                    <div class="curriculum-highlights-list">
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> เรียนภาษาอังกฤษทุกวันกับ Native Speakers</div>
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> ฝึกกล้ามเนื้อมัดเล็ก-มัดใหญ่และประสาทสัมผัส</div>
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> กิจกรรมว่ายน้ำและดนตรีเสริมสร้างสุนทรียภาพ</div>
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> ระบบดูแลความปลอดภัยและโภชนาการเข้มงวด</div>
                    </div>
                </div>

                <div class="curriculum-visual-box">
                    <i class="fa-solid fa-puzzle-piece"></i>
                    <h4>จุดเน้นสำคัญของปฐมวัย</h4>
                    <p style="font-size: 0.88rem; color: var(--text-sub);">
                        "สร้างความสุขในการมาโรงเรียน ปลูกฝังระเบียบวินัย และส่งเสริมทักษะ EF (Executive Functions)"
                    </p>
                </div>
            </div>

            <div class="pillar-grid">
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-comments"></i></div>
                    <h4>English Phonics</h4>
                    <p>ปูพื้นฐานการออกเสียงภาษาอังกฤษให้ถูกต้องตามหลักสากล สร้างความคุ้นเคยและกล้าสื่อสารตั้งแต่เยาว์วัย</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-brain"></i></div>
                    <h4>Project Approach</h4>
                    <p>เปิดโอกาสให้เด็กเลือกหัวข้อที่สนใจ ลงมือสำรวจ ค้นคว้า และนำเสนออย่างสร้างสรรค์</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-heart-pulse"></i></div>
                    <h4>Physical & Sensory Play</h4>
                    <p>เสริมสร้างสุขภาพและสุขอนามัยที่ดี พร้อมกิจกรรมกลางแจ้ง สระว่ายน้ำ และสนามเด็กเล่นมาตรฐาน</p>
                </div>
            </div>
        </div>

        <!-- TAB 2: PRIMARY (ประถมศึกษา) -->
        <div id="primary" class="tab-pane">
            <div class="curriculum-hero-card">
                <div class="curriculum-hero-info">
                    <span class="curriculum-tag">ระดับประถมศึกษาปีที่ 1 - 6</span>
                    <h3>แผนกประถมศึกษา (Primary Education Program)</h3>
                    <p>สร้างรากฐานทางวิชาการที่แข็งแกร่ง เสริมทักษะการคิดวิเคราะห์เชิงตรรกะ ผ่านการจัดการเรียนรู้ภาษาอังกฤษเข้มข้น <strong>Intensive English Program (IEP)</strong> และหลักสูตรวิทยาการคำนวณ (Coding & Robotics) เพื่อสร้างความพร้อมสู่ระดับมัธยมศึกษา</p>
                    
                    <div class="curriculum-highlights-list">
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> Intensive English & Chinese Program</div>
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> การเรียนรู้วิทยาศาสตร์ผ่านการทดลองจริง</div>
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> ระบบการเรียนรู้ดิจิทัล Schoology</div>
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> ส่งเสริมวงดนตรีออร์เคสตราและกีฬาเพื่อความเป็นเลิศ</div>
                    </div>
                </div>

                <div class="curriculum-visual-box">
                    <i class="fa-solid fa-laptop-code"></i>
                    <h4>จุดเน้นสำคัญของประถม</h4>
                    <p style="font-size: 0.88rem; color: var(--text-sub);">
                        "แม่นยำวิชาการ สื่อสารหลายภาษา มีทักษะดิจิทัล และเปี่ยมด้วยวินัยคุณธรรม"
                    </p>
                </div>
            </div>

            <div class="pillar-grid">
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-globe"></i></div>
                    <h4>Multilingual Mastery</h4>
                    <p>ยกระดับการใช้ภาษาอังกฤษและภาษาจีนเพื่อการสื่อสาร วิชาการ และการเตรียมสอบวัดระดับมาตรฐานสากล</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-square-root-variable"></i></div>
                    <h4>STEM & Logical Thinking</h4>
                    <p>บูรณาการวิทยาศาสตร์ เทคโนโลยี วิศวกรรม และคณิตศาสตร์ ผ่านการประดิษฐ์และแก้โจทย์ปัญหา</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-music"></i></div>
                    <h4>Arts & Athletic Skills</h4>
                    <p>ส่งเสริมดนตรีสากล นาฏศิลป์ ศิลปะ และกีฬาหลากชนิด พัฒนาบุคลิกภาพและความมั่นใจ</p>
                </div>
            </div>
        </div>

        <!-- TAB 3: SECONDARY (มัธยมศึกษา) -->
        <div id="secondary" class="tab-pane">
            <div class="curriculum-hero-card">
                <div class="curriculum-hero-info">
                    <span class="curriculum-tag">ระดับมัธยมศึกษาปีที่ 1 - 6</span>
                    <h3>แผนกมัธยมศึกษา (Secondary Education Program)</h3>
                    <p>เตรียมความพร้อมสู่มหาวิทยาลัยชั้นนำทั้งในและต่างประเทศ ด้วยแผนการเรียนที่ตอบโจทย์ความสนใจของผู้เรียน (วิทย์-คณิต, ศิลป์-ภาษา, เทคโนโลยี) เสริมทักษะการทำโครงงานวิจัย การใช้ภาษาอังกฤษระดับสูง และการเตรียมตัวสอบ TCAS</p>
                    
                    <div class="curriculum-highlights-list">
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> แผนการเรียน วิทย์-คณิต / ศิลป์-คำนวณ / ศิลป์-ภาษา</div>
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> เตรียมความพร้อมสอบ IELTS / CEFR / HSK</div>
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> กิจกรรมค้นหาตัวเองและแนะแนวการศึกษาต่อ</div>
                        <div class="highlight-item"><i class="fa-solid fa-circle-check"></i> โครงงานนวัตกรรมและฝึกทักษะการเป็นผู้นำ</div>
                    </div>
                </div>

                <div class="curriculum-visual-box">
                    <i class="fa-solid fa-user-graduate"></i>
                    <h4>จุดเน้นสำคัญของมัธยม</h4>
                    <p style="font-size: 0.88rem; color: var(--text-sub);">
                        "มุ่งสู่มหาวิทยาลัยชั้นนำ มีความรู้รอบด้าน มีทัศนคติผู้นำ และเป็นพลเมืองโลกที่มีคุณภาพ"
                    </p>
                </div>
            </div>

            <div class="pillar-grid">
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-microscope"></i></div>
                    <h4>Health & Science Track</h4>
                    <p>เน้นปฏิบัติการวิทยาศาสตร์ขั้นสูง เคมี ชีววิทยา ฟิสิกส์ รองรับสายแพทย์ เภสัชกรรม และวิศวกรรมศาสตร์</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-earth-americas"></i></div>
                    <h4>Global Language & Business</h4>
                    <p>เน้นภาษาอังกฤษธุรกิจ ภาษาจีน และการสื่อสารข้ามวัฒนธรรม สู่สายบริหาร บัญชี และความสัมพันธ์ระหว่างประเทศ</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-code-branch"></i></div>
                    <h4>Tech & Digital Media</h4>
                    <p>ปูพื้นฐานสู่สายงานดิจิทัล เทคโนโลยีสารสนเทศ การเขียนโปรแกรม และกราฟิกดีไซน์</p>
                </div>
            </div>
        </div>

        <!-- 6. SPECIAL ACADEMIC HIGHLIGHTS -->
        <div class="special-focus-wrap">
            <div class="special-focus-head">
                <h3>จุดเด่นหลักสูตรเฉพาะ <span>เครือโรงเรียนมารีวิทย์</span></h3>
                <p>ส่งเสริมศักยภาพทางปัญญาและเทคโนโลยีระดับสากลอย่างไร้รอยต่อ</p>
            </div>

            <div class="special-grid">
                <div class="special-card">
                    <i class="fa-solid fa-comments"></i>
                    <h4>Native English Immersion</h4>
                    <p>จัดการเรียนการสอนภาษาอังกฤษกับอาจารย์เจ้าของภาษา Native Speakers มุ่งเน้นการฟัง พูด อ่าน และเขียนอย่างเป็นธรรมชาติ</p>
                </div>

                <div class="special-card">
                    <i class="fa-solid fa-network-wired"></i>
                    <h4>Schoology Learning Platform</h4>
                    <p>ระบบบริหารจัดการการเรียนรู้ออนไลน์มาตรฐานระดับสากล ติดตามการบ้าน บทเรียนย้อนหลัง และผลการเรียนได้แบบเรียลไทม์</p>
                </div>

                <div class="special-card">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <h4>Moral & Discipline Cultivation</h4>
                    <p>สอดแทรกคุณธรรมจริยธรรม ระเบียบวินัย ความซื่อสัตย์ และความกตัญญูกตเวทีในทุกช่วงวัยของการเรียนรู้</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- JavaScript Tab Switching -->
<script>
    function openTab(evt, tabId) {
        const tabPanes = document.querySelectorAll('.tab-pane');
        tabPanes.forEach(pane => pane.classList.remove('active'));

        const tabButtons = document.querySelectorAll('.tab-btn');
        tabButtons.forEach(btn => btn.classList.remove('active'));

        document.getElementById(tabId).classList.add('active');
        evt.currentTarget.classList.add('active');
    }
</script>

<?php include 'footer.php'; ?>
```[cite: 12]