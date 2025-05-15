<!DOCTYPE html>
<html class="h-full bg-gray-100 lang=" en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="css/slider.css">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>

<body class="h-full">

    <main>
        <div class="mx-auto max-w-7xl">
            <!--HTML CODE-->
            <div class="w-full relative">
                <div class="swiper default-carousel swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="bg-indigo-50 rounded-2xl h-96 flex justify-center items-center">
                                <span class="text-3xl font-semibold text-indigo-600">
                                    <img src="picture/slide1.jpg" alt="" width="auto">
                                </span>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-indigo-50 rounded-2xl h-96 flex justify-center items-center">
                                <span class="text-3xl font-semibold text-indigo-600">
                                    <img src="picture/slide2.jpg" alt="" width="auto">
                                </span>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-indigo-50 rounded-2xl h-96 flex justify-center items-center">
                                <span class="text-3xl font-semibold text-indigo-600">
                                    <img src="picture/slide1.jpg" alt="" width="auto">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-8 lg:justify-start justify-center">
                        <button id="slider-button-left"
                            class="swiper-button-prev group !p-2 flex justify-center items-center border border-solid border-indigo-600 !w-12 !h-12 transition-all duration-500 rounded-full !top-2/4 !-translate-y-8 !left-5 hover:bg-indigo-600 "
                            data-carousel-prev>
                            <svg class="h-5 w-5 text-indigo-600 group-hover:text-white"
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                fill="none">
                                <path d="M10.0002 11.9999L6 7.99971L10.0025 3.99719" stroke="currentColor"
                                    stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <button id="slider-button-right"
                            class="swiper-button-next group !p-2 flex justify-center items-center border border-solid border-indigo-600 !w-12 !h-12 transition-all duration-500 rounded-full !top-2/4 !-translate-y-8  !right-5 hover:bg-indigo-600"
                            data-carousel-next>
                            <svg class="h-5 w-5 text-indigo-600 group-hover:text-white"
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                fill="none">
                                <path d="M5.99984 4.00012L10 8.00029L5.99748 12.0028" stroke="currentColor"
                                    stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

        </div>
    </main>


    <!--JAVASCRIPT CODE-->
    <script>
        var swiper = new Swiper(".default-carousel", {
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

    </script>
</body>

</html>
