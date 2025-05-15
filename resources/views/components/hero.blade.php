<div class="min-h-screen flex flex-col bg-cover bg-center bg-no-repeat opacity-200" style="background-image: url('/picture/bg2.jpg');" x-data="{ mobileMenuOpen: false }">
  <div class="bg-[rgba(220,190,121,0.53)]  rounded-lg p-4 min-h-screen">
    <!-- Hero section -->
    <div class="relative isolate px-6 pt-14 lg:px-8">
      <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] w-[36.125rem] rotate-[30deg] bg-gradient-to-tr from-pink-300 to-indigo-400 opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
      <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-40 text-center">
        <div class="text-center">
          <h1 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">Sistem Informasi Geospasial Tanah Terlantar</h1>
          {{-- <p x-data="typingText" class="mt-8 text-lg font-medium text-orange-950 sm:text-xl">
            <span x-text="displayText"></span><span class="animate-pulse">|</span>
          </p>         --}}
          <div class="mt-10 flex justify-center gap-x-6">
            {{-- <a href="#" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started</a>
            <a href="#" class="text-sm font-semibold text-gray-900">Learn more <span aria-hidden="true">→</span></a> --}}
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
