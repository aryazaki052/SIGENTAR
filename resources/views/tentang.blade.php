
<x-layout>
</x-layout>


<section class="bg-white py-16 px-6 md:px-20">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12 mt-14 md:mt-18 lg:mt-22 xl:mt-26" >
            <h1 class="text-4xl font-bold text-yellow-800 mb-2" data-aos="fade-up" data-aos-duration="3000">Tentang <span class="text-yellow-600">SI GENTAR</span></h1>
            <p id="typed-text" class="text-xl text-gray-600 font-medium h-6"></p>
        </div>

        <!-- Deskripsi -->
        <p class="text-lg text-gray-700 leading-relaxed mb-12 text-center" data-aos="fade-in" data-aos-duration="3000">
            SI GENTAR adalah platform berbasis GIS untuk mendukung proses identifikasi dan klasifikasi tanah terlantar. Dikembangkan oleh Tim KKNP-PTLP STPN 2024/2025, sistem ini menjawab kebutuhan digitalisasi layanan pertanahan sesuai PP Nomor 21 Tahun 2020.
        </p>

        <!-- Fitur -->
        <div class="grid md:grid-cols-3 gap-6 mb-16" data-aos="fade-up">
            @php
                $features = [
                    ['icon' => '🗺️', 'title' => 'Identifikasi Tanah', 'desc' => 'Visualisasi status tanah: aktif, terindikasi telantar, atau terlantar.'],
                    ['icon' => '📍', 'title' => 'Inventarisasi Spasial', 'desc' => 'Pemetaan lokasi tanah berbasis GIS dan data digital.'],
                    ['icon' => '⚡', 'title' => 'Akses Real-Time', 'desc' => 'Akses data terkini oleh instansi terkait.'],
                    ['icon' => '📑', 'title' => 'Efisiensi Proses', 'desc' => 'Mempercepat pengambilan keputusan dengan digitalisasi.'],
                    ['icon' => '💻', 'title' => 'Transformasi Digital', 'desc' => 'Dukung sistem kerja paperless di Kantor Pertanahan.'],
                    ['icon' => '🎓', 'title' => 'Media Edukasi', 'desc' => 'Digunakan sebagai alat pelatihan teknis staf pertanahan.'],
                ];
            @endphp
@foreach ($features as $index => $feature)
<div 
    class="bg-amber-50 p-6 rounded-2xl shadow hover:scale-[1.02] transition-all duration-300"
    data-aos="flip-left"
    data-aos-duration="3000"
    data-aos-delay="{{ $index * 150 }}"
>
    <div class="text-4xl">{{ $feature['icon'] }}</div>
    <h3 class="text-xl font-semibold mt-4 mb-2 text-orange-300">{{ $feature['title'] }}</h3>
    <p class="text-gray-600">{{ $feature['desc'] }}</p>
</div>
@endforeach
        </div>

        <!-- Tabel Perbandingan -->
        <h2 class="text-2xl font-semibold text-amber-300 mb-4" data-aos="fade-right">📊 Perbandingan Status Tanah</h2>
        <div class="overflow-auto mb-12">
            <table class="w-full table-auto border border-gray-300 text-sm text-left" data-aos="fade-up">
                <thead class="bg-amber-50">
                    <tr>
                        <th class="border px-4 py-2">Aspek</th>
                        <th class="border px-4 py-2">Tanah Terindikasi Terlantar</th>
                        <th class="border px-4 py-2">Tanah Terlantar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">Status</td>
                        <td class="border px-4 py-2">Dalam pengamatan</td>
                        <td class="border px-4 py-2">Sudah ditetapkan resmi</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="border px-4 py-2">Dampak Hukum</td>
                        <td class="border px-4 py-2">Belum ada sanksi</td>
                        <td class="border px-4 py-2">Hak atas tanah dihapus</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Proses</td>
                        <td class="border px-4 py-2">Inventarisasi awal</td>
                        <td class="border px-4 py-2">Evaluasi & 3 peringatan</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- FAQ Interaktif -->
        <h2 class="text-2xl font-semibold text-amber-300 mb-4" data-aos="fade-right">📖 Tanya Jawab Umum</h2>
        <div x-data="{ open: null }" class="space-y-4" data-aos="fade-up">
            @php
                $faq = [
                    ['q' => 'Apa itu Tanah Terlantar?', 'a' => 'Tanah yang tidak dimanfaatkan selama 2 tahun sejak diberi hak dan kehilangan fungsi sosialnya.'],
                    ['q' => 'Apa itu Tanah Terindikasi Terlantar?', 'a' => 'Tanah yang sedang dalam tahap observasi, namun belum ditetapkan sebagai terlantar.'],
                    ['q' => 'Apa fungsi utama SI GENTAR?', 'a' => 'Untuk membantu proses identifikasi, inventarisasi, dan pendayagunaan tanah terlantar secara digital.'],
                ];
            @endphp
            @foreach($faq as $index => $item)
            <div class="border border-blue-200 rounded-lg">
                <button @click="open === {{ $index }} ? open = null : open = {{ $index }}" class="w-full text-left px-4 py-3 bg-amber-100 hover:bg-amber-50 font-semibold text-yellow-800 flex justify-between items-center">
                    {{ $item['q'] }}
                    <svg x-show="open !== {{ $index }}" class="w-4 h-4" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <svg x-show="open === {{ $index }}" class="w-4 h-4" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                </button>
                <div x-show="open === {{ $index }}" class="px-4 py-3 text-black bg-amber-50 border-t">
                    {{ $item['a'] }}
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>



