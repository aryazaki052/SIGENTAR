<style>
  .noto-serif-balinese-regular {
  font-family: "Noto Serif Balinese";
  font-weight: 400;
  font-style: normal;
}
</style>

<div class="min-h-screen flex flex-col bg-cover bg-center bg-no-repeat opacity-200" style="background-image: url('/picture/bg2.jpg');" x-data="{ mobileMenuOpen: false }">
  <div class="bg-[rgba(220,190,121,0.53)]  rounded-lg p-4 min-h-screen">
    <!-- Hero section -->
    <div class="relative isolate px-6 pt-14 lg:px-8">
      <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] w-[36.125rem] rotate-[30deg] bg-gradient-to-tr from-pink-300 to-indigo-400 opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
      <div class="mx-auto max-w-6xl py-32 sm:py-48 lg:py-35 text-center" >
        <div class="text-center">
          <!-- Judul Latin -->
          <h1 class="text-4xl sm:text-7xl noto-serif-balinese-regular font-semibold tracking-tight text-gray-900 leading-tight">
            Sistem Informasi Geospasial<br>Tanah Terlantar
          </h1>
      
          <!-- Judul Aksara Bali -->
          <h1 class="text-4xl sm:text-5xl noto-serif-balinese-regular text-gray-900 mt-10 leading-tight">
            ᬲᬶᬲ᭄ᬢᭂᬫ᭄ ᬇᬦ᭄ᬧᬭᬶᬲ<br>ᬕᭂᬱ᭄ᬧᬲᬮᬶ ᬢᬦᬸᬂ ᬢᬾᬃᬮᬦ᭄ᬢᬭ᭄
          </h1>
      
          <div class="mt-10 flex justify-center gap-x-6">
            <!-- Tombol atau CTA di sini jika ada -->
          </div>
        </div>
      </div>
      
      <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-pink-300 to-indigo-400 opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
    </div>
  </div>
</div>

{{-- <script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('typingText', () => ({
      fullText: 'Tanah terlantar adalah tanah yang tidak digunakan sesuai dengan peruntukannya. Laporkan tanah terlantar yang anda temui untuk pengawasan dan penertiban.',
      displayText: '',
      index: 0,
      init() {
        this.type()
      },
      type() {
        if (this.index < this.fullText.length) {
          this.displayText += this.fullText[this.index];
          this.index++;
          setTimeout(() => this.type(), 70); // kecepatan ngetik
        }
      }
    }));
  });
</script> --}}
