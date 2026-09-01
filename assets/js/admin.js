/**
 * Backend Admin Global Scripts - Maryvit Chainat School
 */
document.addEventListener('DOMContentLoaded', () => {
    // 1. ซ่อนกล่องแจ้งเตือน Alert (Success / Error) อัตโนมัติหลังจาก 4 วินาที
    const alerts = document.querySelectorAll('.alert-success, .alert-error');
    if (alerts.length > 0) {
        setTimeout(() => {
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 500);
            });
        }, 4000);
    }

    // 2. จัดการปุ่มลบข้อมูล (Delete Confirmation) ป้องกันการเผลอกดลบ
    const deleteButtons = document.querySelectorAll('.btn-del');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const confirmed = confirm('⚠️ ยืนยันว่าต้องการลบรายการนี้ใช่หรือไม่? การกระทำนี้ไม่สามารถย้อนกลับได้');
            if (!confirmed) {
                e.preventDefault();
            }
        });
    });
});