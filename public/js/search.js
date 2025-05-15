// Ambil data dari layer global (misal: json_TANAHTERLANTAR_1.features)
const features = json_TANAHTERLANTAR_1.features;

// Ambil elemen dropdown
const kecamatanSelect = document.getElementById("kecamatan");
const nibSelect = document.getElementById("nib");
const cariBtn = document.getElementById("cari");

// Untuk menyimpan marker hasil pencarian
let searchMarker = null;

// 1. Isi dropdown kecamatan
const kecamatanList = [...new Set(features.map(f => f.properties.KECAMATAN))];
kecamatanList.sort();
kecamatanList.forEach(kec => {
    const option = document.createElement("option");
    option.value = kec;
    option.text = kec;
    kecamatanSelect.appendChild(option);
});

// 2. Kosongkan dropdown NIB di awal
nibSelect.innerHTML = "<option value=''>Pilih NIB</option>";

// 3. Isi dropdown NIB saat kecamatan berubah
kecamatanSelect.addEventListener("change", function () {
    const selectedKec = kecamatanSelect.value;

    // Kosongkan dulu NIB
    nibSelect.innerHTML = "<option value=''>Pilih NIB</option>";

    if (!selectedKec) return;

    const filtered = features.filter(f => f.properties.KECAMATAN === selectedKec);
    const nibList = [...new Set(filtered.map(f => f.properties.NIB))];
    nibList.sort();

    nibList.forEach(nib => {
        const option = document.createElement("option");
        option.value = nib;
        option.text = nib;
        nibSelect.appendChild(option);
    });
});

// 4. Event saat tombol cari ditekan
cariBtn.addEventListener("click", function () {
    const selectedNIB = nibSelect.value;

    if (!selectedNIB) {
        alert("Pilih NIB terlebih dahulu!");
        return;
    }

    const selectedKec = kecamatanSelect.value;

    // Cari feature yang sesuai kecamatan dan NIB
    const targetFeature = features.find(f => 
        f.properties.NIB == selectedNIB && 
        f.properties.KECAMATAN === selectedKec
    );

    if (targetFeature) {
        // Hapus marker lama jika ada
        if (searchMarker) {
            map.removeLayer(searchMarker);
        }

        // Tambahkan layer dengan popup yang menampilkan semua properti
        const highlightLayer = L.geoJSON(targetFeature, {
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

        // Zoom ke area
        map.fitBounds(highlightLayer.getBounds());

        // Tambahkan marker di tengah area
        const center = highlightLayer.getBounds().getCenter();
        searchMarker = L.marker(center).addTo(map);
    } else {
        alert("Data tidak ditemukan.");
    }
});
