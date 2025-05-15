<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login & Signup</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .flip-card {
      perspective: 1000px;
    }

    .flip-inner {
      position: relative;
      width: 100%;
      height: 100%;
      transition: transform 0.8s;
      transform-style: preserve-3d;
    }

    .flip-card.flipped .flip-inner {
      transform: rotateY(180deg);
    }

    .flip-front, .flip-back {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      backface-visibility: hidden;
    }

    .flip-back {
      transform: rotateY(180deg);
    }
  </style>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex flex-col-reverse md:flex-row min-h-screen">
    <!-- Kiri -->
        <!-- Gambar di bawah saat mobile, kiri saat desktop -->
        <div class="w-full md:w-1/2 relative">
          <img src="{{ asset('picture/bg3.png') }}" alt="Temple" class="w-full h-64 md:h-full object-cover" />
          <div class="absolute top-4 left-4">
            <img src="{{ asset('picture/logo4.png') }}" class="w-24 h-auto" alt="Logo" />
          </div>
        </div>

    <!-- Kanan -->
    <div class="w-full md:w-1/2 min-h-screen flex items-center justify-center bg-gradient-to-r from-yellow-300/60 via-yellow-300/90 to-yellow-300 p-4">
      <div class="flip-card relative w-full max-w-md h-[500px]">
        <div class="flip-inner">

          <!-- LOGIN -->
          <div class="flip-front bg-white/90 backdrop-blur-md p-8 rounded-xl shadow-lg">
            <div class="flex justify-end mb-4">
              <img src="{{ asset('picture/logo5.png') }}" class="w-14 lg:w-16 h-auto" alt="Logo" />
            </div>
            <h2 class="text-2xl font-bold text-center mb-4">LOGIN TO YOUR ACCOUNT</h2>

            @if(session('success'))
              <div class="mb-4 text-green-600 text-sm text-center">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
              <div class="mb-4 text-red-500 text-sm">
                <ul class="list-disc pl-5">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
              @csrf
              <input type="email" name="email" placeholder="Email"
                     value="{{ old('email') }}"
                     class="w-full px-4 py-2 rounded-full text-sm shadow border focus:outline-none" required>

              <input type="password" name="password" placeholder="Password"
                     class="w-full px-4 py-2 rounded-full text-sm shadow border focus:outline-none" required>

              <button type="submit" class="w-full bg-black text-white font-bold py-2 rounded-full shadow hover:bg-gray-800 transition">
                LOGIN
              </button>
            </form>

            <div class="flex items-center my-4 text-gray-700 text-sm">
              <div class="flex-grow h-px bg-gray-300"></div>
              <span class="mx-3">OR</span>
              <div class="flex-grow h-px bg-gray-300"></div>
            </div>

            <p class="text-sm text-center">
              Don’t have an account?
              <button type="button" onclick="flipCard()" class="font-semibold text-blue-600 underline">Sign up for free</button>
            </p>
          </div>

          <!-- SIGNUP -->
          <div class="flip-back bg-white/90 backdrop-blur-md p-8 rounded-xl shadow-lg">
            <div class="flex justify-end mb-4">
              <img src="{{ asset('picture/logo5.png') }}" class="w-14 lg:w-16 h-auto" alt="Logo" />
            </div>
            <h2 class="text-2xl font-bold text-center mb-4">CREATE AN ACCOUNT</h2>

            @if ($errors->any())
              <div class="mb-4 text-red-500 text-sm">
                <ul class="list-disc pl-5">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('signup') }}" class="space-y-4">
              @csrf
          
              <input type="text" name="name" placeholder="Full Name"
                     value="{{ old('name') }}"
                     class="w-full px-4 py-2 rounded-full text-sm shadow border focus:outline-none" required>
          
              <input type="email" name="email" placeholder="Email"
                     value="{{ old('email') }}"
                     class="w-full px-4 py-2 rounded-full text-sm shadow border focus:outline-none" required>
          
              <input type="password" name="password" placeholder="Password"
                     class="w-full px-4 py-2 rounded-full text-sm shadow border focus:outline-none" required>                
              
              <input type="password" name="token" placeholder="Token" class="w-full px-4 py-2 rounded-full text-sm shadow border focus:outline-none">
          
              <button type="submit"
                      class="w-full bg-black text-white font-bold py-2 rounded-full shadow hover:bg-gray-800 transition">
                  SIGN UP
              </button>
          </form>
          

            <p class="text-sm text-center mt-4">
              Already have an account?
              <button type="button" onclick="flipCard()" class="font-semibold text-blue-600 underline">Login here</button>
            </p>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script>
    function flipCard() {
      document.querySelector('.flip-card').classList.toggle('flipped');
    }
  </script>

</body>
</html>
