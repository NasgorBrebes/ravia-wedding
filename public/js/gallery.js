document.addEventListener("DOMContentLoaded", function () {
    // Inisialisasi AOS
    AOS.init({
        duration: 800,
        easing: "ease-in-out",
        once: true,
    });

    // Inisialisasi Lightbox
    document
        .querySelectorAll('[data-toggle="lightbox"]')
        .forEach(function (el) {
            el.addEventListener("click", function (e) {
                e.preventDefault();
                // Jika Anda menggunakan lightbox, tambahkan kode inisialisasi di sini
            });
        });

    // Button View More
    document
        .querySelector(".btn-view-more")
        .addEventListener("click", function () {
            // Implementasi fungsi untuk menampilkan lebih banyak gambar
            // Bisa dengan Ajax load atau menampilkan gambar yang tersembunyi
            alert(
                "Fitur ini dapat diimplementasikan untuk menampilkan lebih banyak gambar"
            );
        });
});
