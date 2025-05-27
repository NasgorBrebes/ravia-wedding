function copyToClipboard(elementId, successId, failedId) {
    // Dapatkan text dari elemen
    const text = document.getElementById(elementId).innerText;
    const inputId = elementId.split("-")[0] + "-input";
    const inputElem = document.getElementById(inputId);

    // Perbarui nilai pada textarea tersembunyi
    inputElem.value = text;

    // Coba menggunakan Clipboard API (modern browsers)
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard
            .writeText(text)
            .then(() => showFeedback(successId, failedId, true))
            .catch(() => tryLegacyCopy(inputElem, successId, failedId));
    } else {
        // Fallback ke metode lama jika Clipboard API tidak tersedia
        tryLegacyCopy(inputElem, successId, failedId);
    }
}

function tryLegacyCopy(inputElem, successId, failedId) {
    try {
        // Fokus dan pilih teks pada elemen input
        inputElem.style.display = "block";
        inputElem.focus();
        inputElem.select();

        // Eksekusi perintah copy
        const successful = document.execCommand("copy");

        // Sembunyikan kembali input
        inputElem.style.display = "none";

        // Tampilkan feedback
        showFeedback(successId, failedId, successful);
    } catch (err) {
        // Jika gagal, tampilkan pesan error
        showFeedback(successId, failedId, false);
    }
}

function showFeedback(successId, failedId, isSuccess) {
    const successElement = document.getElementById(successId);
    const failedElement = document.getElementById(failedId);

    if (isSuccess) {
        // Tampilkan pesan berhasil
        successElement.style.display = "block";
        failedElement.style.display = "none";

        // Hilangkan pesan setelah 3 detik
        setTimeout(function () {
            successElement.style.display = "none";
        }, 3000);
    } else {
        // Tampilkan pesan gagal
        failedElement.style.display = "block";
        successElement.style.display = "none";

        // Hilangkan pesan setelah 5 detik
        setTimeout(function () {
            failedElement.style.display = "none";
        }, 5000);
    }
}
