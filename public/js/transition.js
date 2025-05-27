// transition.js - File untuk mengatur transisi antar halaman

// Fungsi untuk transisi dari index ke Ravia
function navigateToRavia() {
    // Tambahkan kelas animasi keluar pada index
    const heroSection = document.getElementById("hero");
    heroSection.classList.add("fade-out");

    // Delay sebelum pindah halaman
    setTimeout(function () {
        window.location.href = "ravia";
    }, 300); // Sesuaikan dengan durasi transisi
}

// Deteksi halaman yang sedang dimuat
document.addEventListener("DOMContentLoaded", function () {
    // Tambahkan kelas untuk animasi masuk
    document.body.classList.add("fade-in");

    // Hapus kelas animasi setelah transisi selesai
    setTimeout(function () {
        document.body.classList.remove("fade-in");
    }, 300);

    // Jika ada tombol undangan di halaman index
    const inviteButton = document.querySelector(".invite-btn");
    if (inviteButton) {
        // Ubah default behavior dari link
        inviteButton.addEventListener("click", function (e) {
            e.preventDefault();
            navigateToRavia();
        });
    }
});
