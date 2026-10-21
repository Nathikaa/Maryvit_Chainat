
document.addEventListener("DOMContentLoaded", () => {
    const slider = document.getElementById("imageSlider");

    if (!slider) return;

    const track = slider.querySelector(".slider-track");
    const images = track.querySelectorAll("img");
    const prevBtn = slider.querySelector(".slider-prev");
    const nextBtn = slider.querySelector(".slider-next");
    const dotsContainer = slider.querySelector(".slider-dots");

    if (images.length === 0) return;

    let index = 0;
    let timer = null;

    const delay = 4000;
    const dots = [];

    // สร้างจุดเลือกภาพ
    if (dotsContainer) {
        images.forEach((image, i) => {
            const dot = document.createElement("button");

            dot.type = "button";
            dot.className = "slider-dot";
            dot.setAttribute("aria-label", `ดูภาพที่ ${i + 1}`);

            dot.addEventListener("click", () => {
                showImage(i);
                restartSlider();
            });

            dotsContainer.appendChild(dot);
            dots.push(dot);
        });
    }

    // แสดงภาพที่เลือก
    function showImage(newIndex) {
        index = newIndex;

        track.style.transform = `translateX(-${index * 100}%)`;

        dots.forEach((dot, i) => {
            const active = i === index;

            dot.classList.toggle("active", active);
            dot.setAttribute(
                "aria-current",
                active ? "true" : "false"
            );
        });
    }

    // ภาพถัดไป: ภาพสุดท้ายวนกลับภาพแรก
    function nextImage() {
        const nextIndex = (index + 1) % images.length;
        showImage(nextIndex);
    }

    // ภาพก่อนหน้า: ภาพแรกย้อนกลับภาพสุดท้าย
    function prevImage() {
        const prevIndex =
            (index - 1 + images.length) % images.length;

        showImage(prevIndex);
    }

    // เริ่มเลื่อนอัตโนมัติ
    function startSlider() {
        stopSlider();

        if (images.length > 1) {
            timer = setInterval(nextImage, delay);
        }
    }

    // หยุดเลื่อน
    function stopSlider() {
        if (timer !== null) {
            clearInterval(timer);
            timer = null;
        }
    }

    // เริ่มนับเวลาใหม่
    function restartSlider() {
        startSlider();
    }

    // ปุ่มถัดไป
    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            nextImage();
            restartSlider();
        });
    }

    // ปุ่มย้อนกลับ
    if (prevBtn) {
        prevBtn.addEventListener("click", () => {
            prevImage();
            restartSlider();
        });
    }

    // หยุดเมื่อเมาส์อยู่บนสไลด์
    slider.addEventListener("mouseenter", stopSlider);
    slider.addEventListener("mouseleave", startSlider);

    // เริ่มต้น
    showImage(0);
    startSlider();
});
