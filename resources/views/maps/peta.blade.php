<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peta Interaktif</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Leaflet and plugins CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-compass@1.5.6/dist/leaflet-compass.min.css">
    <link rel="stylesheet" href="{{ asset('/css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/L.Control.Layers.Tree.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/L.Control.Locate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/qgis2web.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/leaflet-search.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/leaflet-control-geocoder.Geocoder.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/leaflet-measure.css') }}">

    <style>

    </style>
</head>

<body class="h-screen w-screen">

    
    <!-- Navbar -->
    <x-layout></x-layout>

    <!-- Container utama: Sidebar & Map -->
    <div class="flex flex-col md:flex-row  " style="height: 100%">


        <!-- Sidebar -->
        <div class="w-full md:w-1/3 bg-amber-100 p-4 space-y-4 overflow-y-auto mt-26">

            <!-- Dropdown Kecamatan -->
            <div>
                <label for="kecamatan" class="block font-semibold mb-1">Kecamatan</label>
                <select id="kecamatan" class="w-full border rounded px-2 py-1">
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>

            <!-- Dropdown NIB -->
            <div>
                <label for="nib" class="block font-semibold mb-1">NIB</label>
                <select id="nib" class="w-full border rounded px-2 py-1">
                    <option value="">Pilih NIB</option>
                </select>
            </div>

            <!-- Tombol Cari -->
            <button id="cari" class="bg-orange-300 text-black px-4 py-2 rounded hover:bg-orange-400 w-full">
                Cari
            </button>

            <!-- Info -->
            <div id="info-kecamatan" class="p-3 400 border rounded shadow text-sm"></div>

            <!-- Navigasi + Legenda -->
            <div class="flex md:flex-col flex-row items-start space-x-4">
                <!-- Navigasi Zoom -->
                <div>
                    <p class="font-semibold mb-2">Navigasi</p>
                    <div class="flex space-x-2">
                        <button onclick="map.zoomIn()"
                            class="bg-gray-200 px-3 py-2 rounded hover:bg-gray-300">+</button>
                        <button onclick="map.zoomOut()"
                            class="bg-gray-200 px-3 py-2 rounded hover:bg-gray-300">−</button>
                    </div>
                </div>

                <!-- Legenda -->
                <div>
                    <div class="flex flex-col space-y-2 md:mt-8">
                        <div class="flex items-center space-x-2">
                            <div class="w-4 h-4 bg-red-600 border border-black"></div>
                            <span class="text-sm">Tanah Terindikasi Terlantar</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-4 h-4 bg-green-600 border border-black"></div>
                            <span class="text-sm">Tanah Tidak Terindikasi Terlantar</span>
                        </div>
                    </div>
                    {{-- <div id="fixed-scale" class="absolute bottom-2 left-2 bg-white px-3 py-1 text-sm shadow rounded">
                        Skala 1:20.000
                    </div> --}}

                </div>

            </div>

        </div>

        <!-- Peta -->
        <div class="flex-1 relative md:mt-26">
            <div id="map" class="absolute inset-0 z-0"></div>
        </div>

    </div>


    <script src="js/qgis2web_expressions.js"></script>
    <script src="js/leaflet.js"></script>
    <script src="js/L.Control.Layers.Tree.min.js"></script>
    <script src="js/L.Control.Locate.min.js"></script>
    <script src="js/leaflet.rotatedMarker.js"></script>
    <script src="js/leaflet.pattern.js"></script>
    <script src="js/leaflet-hash.js"></script>
    <script src="js/Autolinker.min.js"></script>
    <script src="js/rbush.min.js"></script>
    <script src="js/labelgun.min.js"></script>
    <script src="js/labels.js"></script>
    <script src="js/leaflet-control-geocoder.Geocoder.js"></script>
    <script src="js/leaflet-measure.js"></script>
    <script src="js/leaflet-search.js"></script>
    <script src="data/TANAHTERLANTAR_1.js"></script>
    <script src="js/search.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-compass@1.5.6/dist/leaflet-compass.min.js"></script>
    <script>
        var highlightLayer;

        function highlightFeature(e) {
            highlightLayer = e.target;

            if (e.target.feature.geometry.type === 'LineString' || e.target.feature.geometry.type ===
                'MultiLineString') {
                highlightLayer.setStyle({
                    color: '#ffff00',
                });
            } else {
                highlightLayer.setStyle({
                    fillColor: '#ffff00',
                    fillOpacity: 1
                });
            }
            highlightLayer.openPopup();
        }
        var map = L.map('map', {
            zoomControl: false,
            maxZoom: 28,
            minZoom: 1
        }).fitBounds([
            [-8.62297534836386, 114.96054183327041],
            [-8.48860453264476, 115.16408644293833]
        ]);
        var hash = new L.Hash(map);
        map.attributionControl.setPrefix(
            '<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>'
        );
        var autolinker = new Autolinker({
            truncate: {
                length: 30,
                location: 'smart'
            }
        });
        // remove popup's row if "visible-with-data"
        function removeEmptyRowsFromPopupContent(content, feature) {
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = content;
            var rows = tempDiv.querySelectorAll('tr');
            for (var i = 0; i < rows.length; i++) {
                var td = rows[i].querySelector('td.visible-with-data');
                var key = td ? td.id : '';
                if (td && td.classList.contains('visible-with-data') && feature.properties[key] == null) {
                    rows[i].parentNode.removeChild(rows[i]);
                }
            }
            return tempDiv.innerHTML;
        }
        // add class to format popup if it contains media
        function addClassToPopupIfMedia(content, popup) {
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = content;
            if (tempDiv.querySelector('td img')) {
                popup._contentNode.classList.add('media');
                // Delay to force the redraw
                setTimeout(function () {
                    popup.update();
                }, 10);
            } else {
                popup._contentNode.classList.remove('media');
            }
        }




        // var zoomControl = L.control.zoom({
        //     position: 'topleft'
        // }).addTo(map);
        // L.control.locate({locateOptions: {maxZoom: 19}}).addTo(map);
        // // var measureControl = new L.Control.Measure({
        // //     position: 'topleft',
        // //     primaryLengthUnit: 'feet',
        // //     secondaryLengthUnit: 'miles',
        // //     primaryAreaUnit: 'sqfeet',
        // //     secondaryAreaUnit: 'sqmiles'
        // // });
        // measureControl.addTo(map);
        // document.getElementsByClassName('leaflet-control-measure-toggle')[0].innerHTML = '';
        // document.getElementsByClassName('leaflet-control-measure-toggle')[0].className += ' fas fa-ruler';
        var bounds_group = new L.featureGroup([]);

        function setBounds() {}

        // compas
        var compass = new L.Control.Compass({
            autoActive: true,
            showDigit: true,
            position: 'topright'
        });
        map.addControl(compass);

     // Fungsi untuk menghitung skala saat ini
function calculateScale(map) {
    const centerLat = map.getCenter().lat;
    const zoom = map.getZoom();
    const dpi = 96; // default DPI screen

    // Rumus berdasarkan skala Leaflet (Earth circumference at equator / (tile size * 2^zoom))
    const inchesPerMeter = 39.37;
    const metersPerPixel = 40075016.686 * Math.cos(centerLat * Math.PI / 180) / (256 * Math.pow(2, zoom));
    const scale = Math.round(metersPerPixel * dpi * inchesPerMeter);

    return `1:${scale.toLocaleString()}`;
}

// Kontrol skala 1:xxx
L.Control.MapScale = L.Control.extend({
    onAdd: function (map) {
        this._div = L.DomUtil.create('div', 'leaflet-control-scale-ratio');
        this._div.style.padding = '5px';
        this._div.style.background = 'rgba(255,255,255,0.8)';
        this._div.style.fontSize = '12px';
        this._div.style.borderRadius = '4px';

        this.update(map);
        map.on('zoomend moveend', () => this.update(map));

        return this._div;
    },

    update: function (map) {
        this._div.innerHTML = calculateScale(map);
    }
});

L.control.mapScale = function (opts) {
    return new L.Control.MapScale(opts);
};

// Tambahkan ke peta di pojok kiri bawah
L.control.mapScale({ position: 'topleft' }).addTo(map);


        map.createPane('pane_GoogleSatellite_0');
        map.getPane('pane_GoogleSatellite_0').style.zIndex = 400;
        var layer_GoogleSatellite_0 = L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            pane: 'pane_GoogleSatellite_0',
            opacity: 1.0,
            attribution: '',
            minZoom: 1,
            maxZoom: 28,
            minNativeZoom: 0,
            maxNativeZoom: 18
        });
        layer_GoogleSatellite_0;
        map.addLayer(layer_GoogleSatellite_0);

        function pop_TANAHTERLANTAR_1(feature, layer) {
            layer.on({
                mouseout: function (e) {
                    for (var i in e.target._eventParents) {
                        if (typeof e.target._eventParents[i].resetStyle === 'function') {
                            e.target._eventParents[i].resetStyle(e.target);
                        }
                    }
                    if (typeof layer.closePopup == 'function') {
                        layer.closePopup();
                    } else {
                        layer.eachLayer(function (feature) {
                            feature.closePopup()
                        });
                    }
                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table>\
                    <tr>\
                        <th scope="row">KECAMATAN</th>\
                        <td class="visible-with-data" id="KECAMATAN">' + (feature.properties['KECAMATAN'] !== null ?
                autolinker.link(String(feature.properties['KECAMATAN']).replace(/'/g, '\'').toLocaleString()) : ''
            ) + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">KELURAHAN</th>\
                        <td class="visible-with-data" id="KELURAHAN">' + (feature.properties['KELURAHAN'] !== null ?
                autolinker.link(String(feature.properties['KELURAHAN']).replace(/'/g, '\'').toLocaleString()) : ''
            ) + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">TIPEHAK</th>\
                        <td class="visible-with-data" id="TIPEHAK">' + (feature.properties['TIPEHAK'] !== null ?
                autolinker.link(String(feature.properties['TIPEHAK']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">TIPEPRODUK</th>\
                        <td class="visible-with-data" id="TIPEPRODUK">' + (feature.properties['TIPEPRODUK'] !== null ?
                autolinker.link(String(feature.properties['TIPEPRODUK']).replace(/'/g, '\'').toLocaleString()) : ''
            ) + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">NIB</th>\
                        <td class="visible-with-data" id="NIB">' + (feature.properties['NIB'] !== null ? autolinker
                .link(String(feature.properties['NIB']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">LUASPETA</th>\
                        <td class="visible-with-data" id="LUASPETA">' + (feature.properties['LUASPETA'] !== null ?
                autolinker.link(String(feature.properties['LUASPETA']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">NIBEL</th>\
                        <td class="visible-with-data" id="NIBEL">' + (feature.properties['NIBEL'] !== null ? autolinker
                .link(String(feature.properties['NIBEL']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">SU</th>\
                        <td class="visible-with-data" id="SU">' + (feature.properties['SU'] !== null ? autolinker.link(
                String(feature.properties['SU']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">PBT</th>\
                        <td class="visible-with-data" id="PBT">' + (feature.properties['PBT'] !== null ? autolinker
                .link(String(feature.properties['PBT']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">PRODUK</th>\
                        <td class="visible-with-data" id="PRODUK">' + (feature.properties['PRODUK'] !== null ?
                autolinker.link(String(feature.properties['PRODUK']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">TAHUNTERBI</th>\
                        <td class="visible-with-data" id="TAHUNTERBI">' + (feature.properties['TAHUNTERBI'] !== null ?
                autolinker.link(String(feature.properties['TAHUNTERBI']).replace(/'/g, '\'').toLocaleString()) : ''
            ) + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">PEMILIK</th>\
                        <td class="visible-with-data" id="PEMILIK">' + (feature.properties['PEMILIK'] !== null ?
                autolinker.link(String(feature.properties['PEMILIK']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">TIPEPEMILI</th>\
                        <td class="visible-with-data" id="TIPEPEMILI">' + (feature.properties['TIPEPEMILI'] !== null ?
                autolinker.link(String(feature.properties['TIPEPEMILI']).replace(/'/g, '\'').toLocaleString()) : ''
            ) + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">NOHAK_FULL</th>\
                        <td class="visible-with-data" id="NOHAK_FULL">' + (feature.properties['NOHAK_FULL'] !== null ?
                autolinker.link(String(feature.properties['NOHAK_FULL']).replace(/'/g, '\'').toLocaleString()) : ''
            ) + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['Shape_Leng'] !== null ? autolinker.link(String(feature
                .properties['Shape_Leng']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['Shape_Area'] !== null ? autolinker.link(String(feature
                .properties['Shape_Area']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">KETERANGAN</th>\
                        <td class="visible-with-data" id="KETERANGAN">' + (feature.properties['KETERANGAN'] !== null ?
                autolinker.link(String(feature.properties['KETERANGAN']).replace(/'/g, '\'').toLocaleString()) : ''
            ) + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['OBJECTID'] !== null ? autolinker.link(String(feature
                .properties['OBJECTID']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['Shape_Le_1'] !== null ? autolinker.link(String(feature
                .properties['Shape_Le_1']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
            var content = removeEmptyRowsFromPopupContent(popupContent, feature);
            layer.on('popupopen', function (e) {
                addClassToPopupIfMedia(content, e.popup);
            });
            layer.bindPopup(content, {
                maxHeight: 400
            });
        }

        function style_TANAHTERLANTAR_1_0(feature) {
            switch (String(feature.properties['KETERANGAN'])) {
                case 'TANAH TERINDIKASI TERLANTAR':
                    return {
                        pane: 'pane_TANAHTERLANTAR_1',
                            opacity: 1,
                            color: 'rgba(35,35,35,1.0)',
                            dashArray: '',
                            lineCap: 'butt',
                            lineJoin: 'miter',
                            weight: 1.0,
                            fill: true,
                            fillOpacity: 1,
                            fillColor: 'rgba(235,48,113,1.0)',
                            interactive: true,
                    }
                    break;
                default:
                    return {
                        pane: 'pane_TANAHTERLANTAR_1',
                            opacity: 1,
                            color: 'rgba(35,35,35,1.0)',
                            dashArray: '',
                            lineCap: 'butt',
                            lineJoin: 'miter',
                            weight: 1.0,
                            fill: true,
                            fillOpacity: 1,
                            fillColor: 'rgba(40,208,149,1.0)',
                            interactive: true,
                    }
                    break;
            }
        }
        map.createPane('pane_TANAHTERLANTAR_1');
        map.getPane('pane_TANAHTERLANTAR_1').style.zIndex = 401;
        map.getPane('pane_TANAHTERLANTAR_1').style['mix-blend-mode'] = 'normal';
        var layer_TANAHTERLANTAR_1 = new L.geoJson(json_TANAHTERLANTAR_1, {
            attribution: '',
            interactive: true,
            dataVar: 'json_TANAHTERLANTAR_1',
            layerName: 'layer_TANAHTERLANTAR_1',
            pane: 'pane_TANAHTERLANTAR_1',
            onEachFeature: pop_TANAHTERLANTAR_1,
            style: style_TANAHTERLANTAR_1_0,
        });
        bounds_group.addLayer(layer_TANAHTERLANTAR_1);
        map.addLayer(layer_TANAHTERLANTAR_1);
        // var osmGeocoder = new L.Control.Geocoder({
        //     collapsed: true,
        //     position: 'topleft',
        //     text: 'Search',
        //     title: 'Testing'
        // }).addTo(map);
        // document.getElementsByClassName('leaflet-control-geocoder-icon')[0]
        // .className += ' fa fa-search';
        // document.getElementsByClassName('leaflet-control-geocoder-icon')[0]
        // .title += 'Search for a place';
        setBounds();
        // map.addControl(new L.Control.Search({
        //     layer: layer_TANAHTERLANTAR_1,
        //     initial: false,
        //     hideMarkerOnCollapse: true,
        //     propertyName: 'NIB'}));
        // document.getElementsByClassName('search-button')[0].className +=
        //  ' fa fa-binoculars';

    </script>
</body>

</html>
