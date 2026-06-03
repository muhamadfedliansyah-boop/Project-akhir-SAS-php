console.log('✓ script.js loaded');

window.addEventListener("DOMContentLoaded", () => {
    console.log('✓ DOMContentLoaded fired');

    if (typeof strukData === "undefined") return;

    const card = document.getElementById("strukCard");
    const isi = document.getElementById("isiStruk");

    card.style.display = "block";

    isi.innerHTML = `
        <div class="row">
            <span>Nama Pelanggan</span>
            <span>${strukData.nama}</span>
        </div>

        <div class="row">
            <span>No HP</span>
            <span>${strukData.noHp}</span>
        </div>

        <div class="row">
            <span>Status</span>
            <span>${strukData.status}</span>
        </div>

        <hr>

        <div class="row">
            <span>Jenis Layanan</span>
            <span>${strukData.layanan}</span>
        </div>

        <div class="row">
            <span>Metode Pembayaran</span>
            <span>${strukData.pembayaran}</span>
        </div>

        <div class="row">
            <span>Jarak Tempuh</span>
            <span>${strukData.jarak} KM</span>
        </div>

        <div class="row">
            <span>Tarif / KM</span>
            <span>Rp ${strukData.tarif}</span>
        </div>

        <hr>

        <div class="row">
            <span>Subtotal</span>
            <span>Rp ${strukData.subtotal}</span>
        </div>

        <div class="row">
            <span>Diskon</span>
            <span>Rp ${strukData.diskon}</span>
        </div>

        <div class="row">
            <span>Biaya Admin</span>
            <span>Rp ${strukData.admin}</span>
        </div>

        <div class="row total">
            <span>Total Pembayaran</span>
            <span>Rp ${strukData.total}</span>
        </div>
    `;
});