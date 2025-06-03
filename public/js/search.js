// Ambil data dari layer global
const features = json_TANAHTERLANTAR_1.features;

// Ambil elemen-elemen HTML
const kecamatanSelect = document.getElementById("kecamatan");
const nibSelect = document.getElementById("nib");
const kelurahanSelect = document.getElementById("kelurahan");   // baru
const nohakSelect = document.getElementById("nohak");           // baru
const cariBtn = document.getElementById("cari");
const infoBox = document.getElementById("info-kecamatan");

// Untuk menyimpan marker hasil pencarian
let searchMarker = null;

// Data tetap yang sudah pasti
const fixedData = {
    "PANGKUNG TIBAH": { tanah_terlantar: 25, jumlah_bidang: 2188 },
    "ANTAP": { tanah_terlantar: 58, jumlah_bidang: 3544 },
    "BERABAN": { tanah_terlantar: 25, jumlah_bidang: 2154 }
};

// 1. Isi dropdown kecamatan
const kecamatanList = [...new Set(features.map(f => f.properties.KECAMATAN?.trim()))];
kecamatanList.sort();
kecamatanList.forEach(kec => {
    const option = document.createElement("option");
    option.value = kec;
    option.text = kec;
    kecamatanSelect.appendChild(option);
});

// 2. Kosongkan dropdown NIB, Kelurahan, dan NOHAK di awal
nibSelect.innerHTML = "<option value=''>Pilih NIB</option>";
kelurahanSelect.innerHTML = "<option value=''>Pilih Kelurahan</option>";
nohakSelect.innerHTML = "<option value=''>Pilih NO HAK</option>";

// 3. Isi dropdown NIB, Kelurahan, dan NOHAK saat kecamatan berubah
kecamatanSelect.addEventListener("change", function () {
    const selectedKec = kecamatanSelect.value.trim();

    // Kosongkan dulu NIB, Kelurahan, NOHAK
    nibSelect.innerHTML = "<option value=''>Pilih NIB</option>";
    kelurahanSelect.innerHTML = "<option value=''>Pilih Kelurahan</option>";
    nohakSelect.innerHTML = "<option value=''>Pilih NO HAK</option>";

    if (!selectedKec) return;

    const filtered = features.filter(f => f.properties.KECAMATAN?.trim() === selectedKec);

    // Isi NIB
    const nibList = [...new Set(filtered.map(f => f.properties.NIB))].filter(n => n).sort();
    nibList.forEach(nib => {
        const option = document.createElement("option");
        option.value = nib;
        option.text = nib;
        nibSelect.appendChild(option);
    });

    // Isi Kelurahan
    const kelurahanList = [...new Set(filtered.map(f => f.properties.KELURAHAN?.trim()))].filter(k => k).sort();
    kelurahanList.forEach(kel => {
        const option = document.createElement("option");
        option.value = kel;
        option.text = kel;
        kelurahanSelect.appendChild(option);
    });

    // Isi NOHAK_FULL
    const nohakList = [...new Set(filtered.map(f => f.properties.NOHAK_FULL))].filter(h => h).sort();
    nohakList.forEach(nohak => {
        const option = document.createElement("option");
        option.value = nohak;
        option.text = nohak;
        nohakSelect.appendChild(option);
    });
});

// 4. Event saat tombol cari ditekan
cariBtn.addEventListener("click", function () {
    const selectedKec = kecamatanSelect.value.trim();
    const selectedNIB = nibSelect.value.trim();
    const selectedKel = kelurahanSelect.value.trim();
    const selectedNohak = nohakSelect.value.trim();

    // Minimal satu filter harus dipilih agar search valid
    if (!selectedKec && !selectedNIB && !selectedKel && !selectedNohak) {
        alert("Pilih minimal satu kriteria pencarian!");
        return;
    }

    // Filter fitur dengan semua kriteria yang dipilih (jika ada)
    const filteredFeatures = features.filter(f => {
        const props = f.properties;
        return (
            (selectedKec ? props.KECAMATAN?.trim() === selectedKec : true) &&
            (selectedNIB ? props.NIB == selectedNIB : true) &&
            (selectedKel ? props.KELURAHAN?.trim() === selectedKel : true) &&
            (selectedNohak ? props.NOHAK_FULL == selectedNohak : true)
        );
    });

    if (filteredFeatures.length > 0) {
        if (searchMarker) {
            map.removeLayer(searchMarker);
        }

        const highlightLayer = L.geoJSON(filteredFeatures, {
            style: {
                color: "blue",
                weight: 3,
                fillOpacity: 0
            },
            onEachFeature: function (feature, layer) {
                let props = feature.properties;
                let popupContent = "";

                for (let key in props) {
                    if (props.hasOwnProperty(key)) {
                        const value = props[key];
                        const displayValue = (value === null || value === "" || value === 0) ? "-" : value;
                        popupContent += `<strong>${key}</strong>: ${displayValue}<br>`;
                    }
                }

                layer.bindPopup(popupContent).openPopup();
            }
        }).addTo(map);

        map.fitBounds(highlightLayer.getBounds());
        const center = highlightLayer.getBounds().getCenter();
        searchMarker = L.marker(center).addTo(map);

 // Tampilkan info dari data tetap sesuai kecamatan saja (tidak diubah)
const fixed = fixedData[selectedKel];  // pakai key langsung tanpa lowercase

if (fixed) {
    infoBox.innerHTML = `
        <strong>Kelurahan:</strong> ${selectedKel}<br>
        <strong>Bidang Tanah Terindikasi Terlantar:</strong> ${fixed.tanah_terlantar} bidang<br>
        <strong>Jumlah Bidang:</strong> ${fixed.jumlah_bidang}
    `;
} else {
    infoBox.innerHTML = "<em>Data tidak tersedia untuk kelurahan ini.</em>";
}}
}); 

