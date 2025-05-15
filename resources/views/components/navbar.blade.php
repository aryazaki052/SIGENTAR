<header class="absolute inset-x-0 top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="/" class="-m-1.5 p-1.5 flex items-center">
          <img class="h-auto w-15" src="/picture/logo5.png" alt="Logo">
          <span class="ml-2 font-bold text-2xl text-gray-200">SIGENTAR</span>
        </a>
      </div>
  
      <!-- Mobile menu button -->
      <div class="flex lg:hidden">
        <button type="button" @click="mobileMenuOpen = true" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white">
          <span class="sr-only">Open main menu</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
  
      <!-- Desktop menu -->
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="/" class="text-xl font-semibold text-white hover:text-stone-200">Beranda</a>
        <a href="#tentang" class="text-xl font-semibold text-white hover:text-stone-200">Tentang</a>
        <a href="/peta" class="text-xl font-semibold text-white hover:text-stone-200">Peta</a>
        {{-- <a href="#laporan" class="text-xl font-semibold text-white hover:text-stone-200">Laporan Masyarakat</a> --}}
      </div>
  
      <!-- Desktop login/logout -->
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        @auth
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-2 text-xl font-semibold text-white hover:text-stone-200">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
              </svg>
              Logout
            </button>
          </form>
        @else
          {{-- <span class="text-white text-xl mr-4">Hi, {{ Auth::user()->name }}</span> --}}
          <a href="{{ route('login') }}" class="text-xl font-semibold text-white hover:text-stone-200">
            Log in <span aria-hidden="true">&rarr;</span>
          </a>
        @endauth
      </div>
      
    </nav>
  
    <!-- Mobile menu -->
    <div class="lg:hidden" x-show="mobileMenuOpen" @click.outside="mobileMenuOpen = false" x-transition role="dialog" aria-modal="true">
      <div class="fixed inset-0 z-50 bg-black/25"></div>
      <div class="fixed inset-y-0 right-0 z-50 w-full max-w-sm bg-white px-6 py-6 overflow-y-auto sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <a href="/" class="-m-1.5 p-1.5">
            <img class="h-8 w-auto" src="/picture/logo4.png" alt="Logo">
          </a>
          <button type="button" @click="mobileMenuOpen = false" class="-m-2.5 rounded-md p-2.5 text-gray-700">
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
  
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="/" class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Beranda</a>
              <a href="#tentang" class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Tentang</a>
              <a href="/peta" class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Peta</a>
              {{-- <a href="#laporan" class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Laporan Masyarakat</a> --}}
            </div>
            <div class="py-6">
              @auth
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="block rounded-lg px-3 py-2.5 text-base font-semibold text-gray-900 hover:bg-gray-50 w-full text-left">Logout</button>
                </form>
              @else
                <a href="{{ route('login') }}" class="block rounded-lg px-3 py-2.5 text-base font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
              @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  