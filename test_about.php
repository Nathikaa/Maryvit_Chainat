<?php
$pageTitle = "เกี่ยวกับเรา | โรงเรียนมารีวิทย์ชัยนาท (Maryvit Chainat School)";
$currentPage = "about";
include 'header.php';
?>

<style>
    /* ===== ประวัติโรงเรียน ===== */
    .history-header {
        gap: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 35px;
        padding-bottom: 15px;
    }

    .section-content {
        position: relative;
        isolation: isolate;
    }

    .section-content img {
        width: 100%;
        height: auto;
        display: block;
        clip-path: polygon(10% 0, 100% 0, 90% 100%, 0 100%);
    }

    /* ===== Image Wall ===== */
    :root {
        --page: #e6e6e6;
        --stage: #ffffff;
        --card: #f5f5f5;
        box-sizing: border-box;
        padding-top: env(safe-area-inset-top, 0px);
        padding-bottom: env(safe-area-inset-bottom, 0px);
    }

    @media (prefers-color-scheme: dark) {
        :root:not([data-theme="light"]) {
            --page: #1c1c1c;
        }
    }

    :root[data-theme="dark"] {
        --page: #1c1c1c;
    }

    .wrap {
        width: 100%;
        max-width: none;
        max-height: 1558;
        margin: 0;
        padding: 0;
        container-type: inline-size;
        box-sizing: border-box;
    }

    .stage {
        --u: calc(100cqw / 1558);
        position: relative;
        width: 100%;
        aspect-ratio: 1558 / 508;
        /* background: var(--stage); */
        overflow: hidden;
        /* border-radius: 12px; */
    }
    

    /* ภาพหลักตรงกลาง */
    .center {
        position: absolute;
        left: calc(410 * var(--u));
        top: calc(27 * var(--u));
        width: calc(738 * var(--u));
        height: calc(449 * var(--u));
        border-radius: calc(16 * var(--u));
        background: var(--card) center / cover no-repeat;
        box-shadow: calc(2 * var(--u)) calc(4 * var(--u)) calc(7 * var(--u)) rgba(0, 0, 0, .3);
        z-index: 2;
    }

    /* คอลัมน์ภาพเล็ก 4 คอลัมน์ */
    .col {
        position: absolute;
        top: 0;
        height: 100%;
        width: calc(228 * var(--u));
        left: calc(var(--x) * var(--u));
    }

    .track {
        will-change: transform;
    }

    .card {
        height: calc(var(--h) * var(--u));
        margin-bottom: calc(26 * var(--u));
        border-radius: calc(16 * var(--u));
        background: var(--card) center / cover no-repeat;
        box-shadow: calc(2 * var(--u)) calc(4 * var(--u)) calc(6 * var(--u)) rgba(0, 0, 0, .3);
        /* cursor: pointer; */
    }

    .card:focus-visible {
        outline: 3px solid #fff;
        outline-offset: 3px;
    }
</style>

<section class="bg-section" style="margin: 0 auto;">

    <!-- ===== Image Wall: คงโครงสร้างเดิม ===== -->
    <div class="wrap">
        <div class="stage" id="stage">
            <div
                class="center"
                id="center"
                role="img"
                aria-label="ภาพที่เลือก">
            </div>
        </div>
    </div>

    <!-- ===== เนื้อหาประวัติโรงเรียน ===== -->
    <div class="container">
        <div style="margin: 0 auto; text-align: center; margin-top: 2rem;">
            <div>
                <!-- สามารถใส่หัวข้อเพิ่มเติมตรงนี้ได้ -->
            </div>
        </div>

        <br>

        <div class="history-header row align-items-center">

            <!-- ฝั่งซ้าย: เนื้อหา -->
            <div class="section-title col-md-6">
                <h3 style="color:var(--white)">
                    ประวัติและความเป็นมา
                </h3>

                <p style="color:var(--white)">
                    โรงเรียนมารีวิทย์ ชัยนาท เป็นส่วนหนึ่งของเครือข่ายสถานศึกษาเอกชนคาทอลิกชั้นนำ
                    "เครือโรงเรียนมารีวิทย์" ซึ่งมีจุดเริ่มต้นและศูนย์กลางแห่งความสำเร็จอยู่ที่
                    โรงเรียนมารีวิทย์ พัทยา และขยายสาขาสู่ สัตหีบ, บ่อวิน, ระยอง และ ชัยนาท
                </p>

                <div class="quote-box">
                    <i class="fa-solid fa-quote-left"></i>
                    "การเรียนรู้ไม่ใช่เพียงการสะสมความรู้ แต่ต้องปลูกฝังจริยธรรมและความรับผิดชอบในตนเอง
                    วินัยคือรากฐานสำคัญของการพัฒนาอย่างยั่งยืน"
                </div>

                <p style="color:var(--white)">
                    โรงเรียนมารีวิทย์ ชัยนาทก่อตั้งขึ้นเพื่อส่งต่อมาตรฐานการศึกษาชั้นเลิศ
                    สู่เยาวชนในลุ่มน้ำเจ้าพระยาและภาคกลาง โดยนำหลักสูตรเข้มข้น
                    นวัตกรรมการเรียนการสอนที่ทันสมัย ตลอดจนบุคลากรผู้ทรงคุณวุฒิ
                    มาหล่อหลอมนักเรียนให้เป็นคนเก่ง คนดี และมีความสุข
                </p>
            </div>

            <!-- ฝั่งขวา: รูปภาพ -->
            <div class="section-content col-md-6">
                <img
                    src="assets/images/image2.jpg"
                    alt="โรงเรียนมารีวิทย์ชัยนาท">
            </div>

        </div>
    </div>

</section>

<script src="assets/js/main.js"></script>

<script>
    // ===== 1) รายการรูปภาพ =====
    const IMAGES = [
        "assets/images/image1.jpg",
        "assets/images/image4.jpg",
        "assets/images/image5.jpg",
        "assets/images/image6.jpg",
        "assets/images/image7.jpg",
        "assets/images/image8.jpg",
        "assets/images/image9.jpg",
    ];

    // ===== 2) ตำแหน่งและความเร็วของคอลัมน์ =====
    // คงค่าเดิมทั้งหมด ไม่เปลี่ยนตำแหน่งการ์ด
    const COLS = [{
            x: -106,
            speed: 34,
            start: 49,
            heights: [297, 297, 297, 297]
        },
        {
            x: 152,
            speed: 26,
            start: 199,
            heights: [297, 297, 297, 297]
        },
        {
            x: 1178,
            speed: 30,
            start: 189,
            heights: [297, 297, 297, 297]
        },
        {
            x: 1436,
            speed: 38,
            start: 28,
            heights: [297, 297, 297, 297]
        }
    ];

    const stage = document.getElementById("stage");
    const center = document.getElementById("center");
    const REF_W = 1558;

    // สร้างภาพตัวอย่างเมื่อยังไม่ได้ใส่รูปจริง
    function placeholder(i) {
        const h = (i * 47) % 360;

        const svg = `
            <svg xmlns="http://www.w3.org/2000/svg" width="600" height="600">
                <defs>
                    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0" stop-color="hsl(${h},70%,62%)"/>
                        <stop offset="1" stop-color="hsl(${(h + 50) % 360},70%,40%)"/>
                    </linearGradient>
                </defs>
                <rect width="600" height="600" fill="url(#g)"/>
                <text x="300" y="340" font-size="160"
                    font-family="sans-serif" fill="#fff"
                    fill-opacity=".85" text-anchor="middle">${i + 1}</text>
            </svg>`;

        return "data:image/svg+xml;charset=utf-8," + encodeURIComponent(svg);
    }

    const srcOf = i =>
        IMAGES.length ? IMAGES[i % IMAGES.length] : placeholder(i);

    // ===== 3) เปลี่ยนภาพหลักเมื่อคลิกการ์ด =====
    function show(src) {
        center.style.backgroundImage = `url("${src}")`;

        if (typeof center.animate === "function") {
            center.animate(
                [{
                    opacity: 0.4
                }, {
                    opacity: 1
                }], {
                    duration: 250
                }
            );
        }
    }

    show(srcOf(0));

    // ===== 4) สร้างคอลัมน์และทำซ้ำ 2 ชุด =====
    const cols = COLS.map((c, ci) => {
        const col = document.createElement("div");
        col.className = "col";
        col.style.setProperty("--x", c.x);

        const track = document.createElement("div");
        track.className = "track";
        col.appendChild(track);

        for (let copy = 0; copy < 2; copy++) {
            c.heights.forEach((h, k) => {
                const src = srcOf(ci * c.heights.length + k + 1);

                const card = document.createElement("div");
                card.className = "card";
                card.tabIndex = 0;
                card.setAttribute("role", "button");
                card.setAttribute("aria-label", "เลือกภาพ");

                card.style.setProperty("--h", h);
                card.style.backgroundImage = `url("${src}")`;
                track.appendChild(card);
            });
        }

        stage.appendChild(col);

        return {
            ...c,
            track,
            n: c.heights.length,
            pos: c.start,
            setH: 1
        };
    });

    // ===== 5) วัดระยะของชุดภาพ =====
    function measure() {
        const u = stage.clientWidth / REF_W;

        if (!u) return;

        cols.forEach(c => {
            const kids = c.track.children;

            c.setH =
                (kids[c.n].offsetTop - kids[0].offsetTop) / u;

            if (!Number.isFinite(c.setH) || c.setH <= 0) {
                c.setH = 1;
            }

            c.pos %= c.setH;
        });
    }

    const resizeObserver = new ResizeObserver(measure);
    resizeObserver.observe(stage);
    measure();

    // ===== 6) เลื่อนขึ้นและวนซ้ำ =====
    let last = performance.now();

    function tick(now) {
        const dt = Math.min((now - last) / 1000, 0.1);
        last = now;

        const u = stage.clientWidth / REF_W;

        cols.forEach(c => {
            c.pos = (c.pos + c.speed * dt) % c.setH;

            c.track.style.transform =
                `translate3d(0, ${-c.pos * u}px, 0)`;
        });

        requestAnimationFrame(tick);
    }

    if (matchMedia("(prefers-reduced-motion: reduce)").matches) {
        cols.forEach(c => {
            c.track.style.transform =
                `translate3d(0, ${-c.pos * stage.clientWidth / REF_W}px, 0)`;
        });
    } else {
        requestAnimationFrame(tick);
    }
</script>

<?php include 'footer.php'; ?>
```