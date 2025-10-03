
document.getElementById("searchInput").addEventListener("keyup", function() {
    const keyword = this.value.toLowerCase();
    const rows = document.querySelectorAll("#data_siswa tbody tr");

    rows.forEach(row => {
        const rowText = row.textContent.toLowerCase();
        row.style.display = rowText.includes(keyword) ? "" : "none";
    });

    const keywords = this.value.toLowerCase();
    const cards = document.querySelectorAll("#data_siswa > div"); // ambil setiap data siswa (satu siswa = satu div luar)

    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(keywords) ? "block" : "none";
    });

    const keyword1 = this.value.toLowerCase();
    const rows1 = document.querySelectorAll("#data_kelas tbody tr");

    rows1.forEach(row => {
        const rowText = row.textContent.toLowerCase();
        row.style.display = rowText.includes(keyword1) ? "" : "none";
    });

    const keywords1 = this.value.toLowerCase();
    const cards1 = document.querySelectorAll("#data_kelas > div"); // ambil setiap data siswa (satu siswa = satu div luar)

    cards1.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(keywords1) ? "block" : "none";
    });

    const keyword2 = this.value.toLowerCase();
    const rows2 = document.querySelectorAll("#data_absen tbody tr");

    rows2.forEach(row => {
        const rowText = row.textContent.toLowerCase();
        row.style.display = rowText.includes(keyword2) ? "" : "none";
    });

    const keywords2 = this.value.toLowerCase();
    const cards2 = document.querySelectorAll("#data_absen > div"); // ambil setiap data siswa (satu siswa = satu div luar)

    cards2.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(keywords2) ? "block" : "none";
    });

    const keyword3 = this.value.toLowerCase();
    const rows3 = document.querySelectorAll("#data_pegawai tbody tr");

    rows3.forEach(row => {
        const rowText = row.textContent.toLowerCase();
        row.style.display = rowText.includes(keyword3) ? "" : "none";
    });

    const keywords3 = this.value.toLowerCase();
    const cards3 = document.querySelectorAll("#data_pegawai > div"); // ambil setiap data siswa (satu siswa = satu div luar)

    cards3.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(keywords3) ? "block" : "none";
    });

    const keyword4 = this.value.toLowerCase();
    const rows4 = document.querySelectorAll("#data_absen_siswa tbody tr");

    rows4.forEach(row => {
        const rowText = row.textContent.toLowerCase();
        row.style.display = rowText.includes(keyword4) ? "" : "none";
    });

    const keywords4 = this.value.toLowerCase();
    const cards4 = document.querySelectorAll("#data_absen_siswa > div"); // ambil setiap data siswa (satu siswa = satu div luar)

    cards4.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(keywords4) ? "block" : "none";
    });

});
