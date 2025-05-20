    // Ambil data dari layer global
    const features = json_TANAHTERLANTAR_1.features;

    // Ambil elemen-elemen HTML
    const kecamatanSelect = document.getElementById("kecamatan");
    const nibSelect = document.getElementById("nib");
    const cariBtn = document.getElementById("cari");
    const infoBox = document.getElementById("info-kecamatan");

    // Untuk menyimpan marker hasil pencarian
    let searchMarker = null;

    // Data tetap yang sudah pasti
    const fixedData = {
        "kediri": { tanah_terlantar: 25, jumlah_bidang: 2188 },
        "selemadeg": { tanah_terlantar: 58, jumlah_bidang: 3544 },
        "selemadeg timur": { tanah_terlantar: 25, jumlah_bidang: 2154 }
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

    // 2. Kosongkan dropdown NIB di awal
    nibSelect.innerHTML = "<option value=''>Pilih NIB</option>";

    // 3. Isi dropdown NIB saat kecamatan berubah
    kecamatanSelect.addEventListener("change", function () {
        const selectedKec = kecamatanSelect.value.trim();

        // Kosongkan dulu NIB
        nibSelect.innerHTML = "<option value=''>Pilih NIB</option>";

        if (!selectedKec) return;

        const filtered = features.filter(f => f.properties.KECAMATAN?.trim() === selectedKec);
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
        const selectedKec = kecamatanSelect.value.trim();
        const selectedNIB = nibSelect.value;

        if (!selectedKec || !selectedNIB) {
            alert("Pilih Kecamatan dan NIB terlebih dahulu!");
            return;
        }

        const targetFeature = features.find(f =>
            f.properties.NIB == selectedNIB &&
            f.properties.KECAMATAN?.trim() === selectedKec
        );

        if (targetFeature) {
            if (searchMarker) {
                map.removeLayer(searchMarker);
            }

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

            map.fitBounds(highlightLayer.getBounds());
            const center = highlightLayer.getBounds().getCenter();
            searchMarker = L.marker(center).addTo(map);

            // Tampilkan info dari data tetap
            const cleanedKec = selectedKec.toLowerCase(); // Format agar cocok dengan fixedData
            const fixed = fixedData[cleanedKec];

            if (fixed) {
                infoBox.innerHTML = `
                    <strong>Kecamatan:</strong> ${selectedKec}<br>
                    <strong>Bidang Tanah Terlantar:</strong> ${fixed.tanah_terlantar} bidang<br>
                    <strong>Jumlah Bidang:</strong> ${fixed.jumlah_bidang}
                `;
            } else {
                infoBox.innerHTML = "<em>Data tidak tersedia untuk kecamatan ini.</em>";
            }
        } else {
            alert("Data tidak ditemukan.");
        }
    });
