document.addEventListener("DOMContentLoaded", function () {
    // Form submission
    const wishesForm = document.getElementById("wishesForm");

    wishesForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Dapatkan nilai input
        const name = document.getElementById("name").value;
        const relationship = document.getElementById("relationship").value;
        const message = document.getElementById("message").value;

        // Di sini Anda dapat menambahkan kode untuk mengirim data ke server
        // Contoh sederhana: menampilkan ucapan baru (dalam aplikasi nyata, gunakan AJAX)

        alert("Terima kasih! Ucapan Anda telah terkirim.");
        wishesForm.reset();
    });

    // Load more button (contoh sederhana)
    const loadMoreBtn = document.getElementById("loadMore");

    // Tambahkan efek hover berwarna pink
    loadMoreBtn.addEventListener("mouseover", function () {
        this.style.backgroundColor = "pink";
        this.style.color = "white";
        this.style.borderColor = "pink";
    });

    loadMoreBtn.addEventListener("mouseout", function () {
        this.style.backgroundColor = "transparent";
        this.style.color = "pink";
        this.style.borderColor = "pink";
    });

    loadMoreBtn.addEventListener("click", function () {
        // Di sini Anda dapat menambahkan kode untuk memuat lebih banyak ucapan
        alert("Fitur memuat lebih banyak ucapan akan ditambahkan di sini.");
    });
});
