document.addEventListener("DOMContentLoaded", function () {
    // Pilih semua elemen yang akan dianimasikan
    const sections = document.querySelectorAll(
        ".home, .mempelai, .info, .maps, .story, .gallery, .gift, .rsvp"
    );

    // Fungsi untuk mengecek apakah elemen sudah terlihat saat di-scroll
    function checkVisibility() {
        sections.forEach((section) => {
            // Mendapatkan posisi elemen relatif terhadap viewport
            const rect = section.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            // Jika elemen terlihat di viewport
            if (
                rect.top <= windowHeight - rect.height / 4 &&
                rect.bottom >= 0
            ) {
                section.classList.add("animate-in");
            } else {
                // Jika elemen tidak terlihat di viewport, hapus kelas animasi
                section.classList.remove("animate-in");
            }
        });
    }

    // Jalankan fungsi saat halaman dimuat untuk pertama kali
    checkVisibility();

    // Tambahkan event listener untuk scroll
    window.addEventListener("scroll", checkVisibility);
});
