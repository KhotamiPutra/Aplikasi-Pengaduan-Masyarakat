<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengaduan Masyarakat</title>
    @vite('resources/css/app.css')
    <style>
        @tailwind base;
        @tailwind components;
        @tailwind utilities;
        .slideshow-container {
            max-width: 100%;
            position: relative;
            margin: auto;
        }
        .slide {
            display: none;
            position: relative;
        }
        .slide img {
            width: 100%;
            height: 600px;
            object-fit: cover;
        }
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(0,0,0,0.8);
        }
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }
        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.9);
        }
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }
        .active, .dot:hover {
            background-color: #717171;
        }
        .slide-content {
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            color: white;
        }
        .slide-content h2 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .slide-content p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .slide-content a {
            background-color: #D97757;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .slide-content a:hover {
            background-color: #C86646;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold text-gray-800">Suara Masyarakat</div>
                <div class="space-x-4">
                    <button class="bg-[#D97757]  hover:bg-[#c26a4c] text-white font-bold py-2 px-4 rounded"><a href="/login">Masuk</a></button>
                    <button class="text-[#D97757]"><a href="/register">Daftar</a></button>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- Slideshow Section -->
        <div class="slideshow-container">
            <div class="slide">
                <img src="{{ asset('asset/images/pexels-tomfisk-2450218.jpg') }}" alt="Slide 1">
                <div class="slide-content">
                    <h2>Selamat Datang di Aplikasi Pengaduan Masyarakat</h2>
                    <p>Kami mendengarkan suara Anda. Suarakan aspirasi Anda sekarang!</p>
                    <a href="/login">Mulai Sekarang</a>
                </div>
            </div>
            <div class="slide">
                <img src="{{ asset('asset/images/pexels-tomfisk-2116716.jpg') }}" alt="Slide 2">
                <div class="slide-content">
                    <h2>Laporkan dengan Aman</h2>
                    <p>Kerahasiaan identitas Anda adalah prioritas kami.</p>
                    <a href="/login">Mulai Sekarang</a>
                </div>
            </div>
            <div class="slide">
                <img src="{{ asset('asset/images/pexels-tomfisk-2116721.jpg') }}" alt="Slide 3">
                <div class="slide-content">
                    <h2>Aman, Terpercaya, dan Mudah </h2>
                    <p>Aplikasi Pengaduan Masyarakat yang aman, terpercaya, dan mudah digunakan.</p>
                    <a href="/login">Mulai Sekarang</a>
                </div>
            </div>
        </div>
        <div style="text-align:center">
            <span class="dot" onclick="Putra_currentSlide(1)"></span>
            <span class="dot" onclick="Putra_currentSlide(2)"></span>
            <span class="dot" onclick="Putra_currentSlide(3)"></span>
        </div>

        <section class="container mx-auto px-6 py-16 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800">Suarakan Aspirasi Anda</h1>
            <p class="text-xl mb-12 text-gray-600">Bersama-sama kita bangun masyarakat yang lebih baik melalui pengaduan yang konstruktif.</p>
        </section>

        <section class="bg-gray-50 py-16">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Fitur Utama</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4 text-[#D97757]">Mudah Digunakan</h3>
                        <p class="text-gray-600">Interface yang intuitif untuk memudahkan pelaporan.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4 text-[#D97757]">Respons Cepat</h3>
                        <p class="text-gray-600">Tim kami siap menindaklanjuti setiap laporan dengan cepat.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4 text-[#D97757]">Anonim & Aman</h3>
                        <p class="text-gray-600">Kerahasiaan identitas pelapor terjamin.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2024 Aplikasi Pengaduan Masyarakat. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <script>
        let slideIndex = 1;
        Putra_showSlides(slideIndex);

        function putra_plusSlides(n) {
            Putra_showSlides(slideIndex += n);
        }

        function Putra_currentSlide(n) {
            Putra_showSlides(slideIndex = n);
        }

        function Putra_showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slide");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }

        setInterval(() => {
            putra_plusSlides(1);
        }, 5000);
    </script>
</body>
</html>
