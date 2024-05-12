document.addEventListener('DOMContentLoaded', function() {
    var scrollToBestSellingItemsBtn = document.getElementById('scrollToBestSellingItems');
    scrollToBestSellingItemsBtn.addEventListener('click', function(event) {
        event.preventDefault();
        var targetSection = document.getElementById('best-items'); 
        targetSection.scrollIntoView({ behavior: "smooth" }); 
    });
});
function checkUserRole() {
    const userRole = sessionStorage.getItem('role');
    const list = document.getElementById('menu-list');
    const themPhieuMuon = document.getElementById('themPhieuMuonBtn');
    const taoPhieuMuonBtn = document.getElementById('TaoPhieuMuonBtn');
    const themTaiLieuBtn = document.getElementById('themTaiLieuBtn');
    const themNhaCungCapBtn = document.getElementById('themNhaCungCapBtn');
    if (userRole === 'Role_Admin' || userRole === 'Role_LibraryManager') {
        themTaiLieuBtn.style.display = 'inline-block';
        themNhaCungCapBtn.style.display = 'inline-block';
        list.style.display = 'inline-block';
        taoPhieuMuonBtn.style.display = 'none';
        themPhieuMuon.style.display = 'none';
    } else {
        themTaiLieuBtn.style.display = 'none';
        themNhaCungCapBtn.style.display = 'none';
        list.style.display = 'none';
        taoPhieuMuonBtn.style.display = 'inline-block';
        themPhieuMuon.style.display = 'inline-block';
    }
}