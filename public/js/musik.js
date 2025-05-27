// Mendapatkan elemen audio dan tombol
const bgMusic = document.getElementById("bgMusic");
const playPauseBtn = document.getElementById("playPauseBtn");

// Set volume musik
bgMusic.volume = 0.5; // Set volume ke 50%

// Fungsi untuk memutar/menjeda musik
function togglePlay() {
    if (bgMusic.paused) {
        bgMusic.play();
        playPauseBtn.innerHTML = "❚❚"; // Simbol pause
    } else {
        bgMusic.pause();
        playPauseBtn.innerHTML = "▶"; // Simbol play
    }
}

// Menambahkan event listener
playPauseBtn.addEventListener("click", togglePlay);

// Memastikan tombol tetap terlihat dan musik tetap berjalan saat halaman di-scroll
window.addEventListener("scroll", function () {
    // Tidak perlu mengubah apa pun karena posisi tombol sudah fixed
});
