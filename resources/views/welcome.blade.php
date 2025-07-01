<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Rekrutmen Coffee Kane</title> {{-- Ubah Judul Halaman --}}

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        Poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS setelah DOM dimuat
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                once: true, // Animasi hanya berjalan sekali saat di-scroll
                duration: 800, // Durasi animasi
            });

            // Script untuk scroll halus
            document.querySelectorAll('a[data-scroll]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('data-scroll');
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        // Menggunakan scroll-padding-top di CSS adalah cara paling bersih
                        // Anda bisa menambahkan ini di <style> jika navbar fixed/sticky:
                        // html { scroll-padding-top: 64px; }
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>

    <style>
        /* Scrollbar minimalis */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(107, 114, 128, 0.5);
            /* gray-500 semi transparan */
            border-radius: 3px;
        }

        /* Penting untuk Alpine.js x-cloak (jika Anda masih menggunakan Alpine untuk fitur lain) */
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-white font-[Poppins]">
    {{-- Navbar --}}
    <nav
        class="absolute w-full px-6 md:px-20 py-3 pt-8 h-16 flex items-center justify-between top-0 z-50
            bg-transparent shadow-none transition-all duration-300">

        <a href="{{ route('welcome') }}"
            class="text-xl font-bold text-white hover:text-blue-200 transition-colors duration-300">
            Coffee Kane
        </a>

        <div class="flex-grow flex justify-center">
            <div class="flex items-center space-x-6 text-white text-lg font-medium">
                <a href="#beranda" data-scroll="beranda"
                    class="hover:text-blue-200 transition-colors duration-300">Beranda</a>
                <a href="#tentang" data-scroll="tentang"
                    class="hover:text-blue-200 transition-colors duration-300">Tentang Kami</a>
                <a href="#lowongan" data-scroll="lowongan"
                    class="hover:text-blue-200 transition-colors duration-300">Lowongan</a>
                <a href="#alur" data-scroll="alur" class="hover:text-blue-200 transition-colors duration-300">Alur
                    Rekrutmen</a>
            </div>
        </div>

        <div class="flex items-center space-x-2">
            @guest
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-white border border-white rounded-lg hover:bg-white hover:text-gray-800 transition-colors duration-300">Login</a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 text-white border border-white rounded-lg hover:bg-white hover:text-gray-800 transition-colors duration-300">Register</a>
            @else
                <a href="{{ url('/dashboard') }}"
                    class="px-4 py-2 text-white border border-white rounded-lg hover:bg-white hover:text-gray-800 transition-colors duration-300">
                    Dashboard
                </a>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="px-4 py-2 text-white border border-white rounded-lg hover:bg-white hover:text-gray-800 transition-colors duration-300">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @endguest
        </div>
    </nav>

    {{-- Section Hero --}}
    <section id="beranda" class="relative bg-cover bg-center min-h-[100vh] text-white"
        style="background-image: url('/images/coffeshop.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>

        <div class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center px-6 md:px-20">
            <h1 class="text-3xl md:text-5xl font-bold mb-4" data-aos="fade-up">
                SISTEM REKRUTMEN COFFEE KANE
            </h1>
            <p class="text-md md:text-xl mb-6 max-w-xl" data-aos="fade-up" data-aos-delay="200">
                Coffee Kane membuka kesempatan bagi Anda untuk bertumbuh dan meraih puncak karier yang Anda impikan.
            </p>
            <a href="{{ route('login') }}" {{-- Link langsung ke halaman login --}}
                class="inline-flex items-center gap-2 px-8 py-3 bg-blue-900 hover:bg-blue-800 text-white font-semibold rounded-full text-lg transition-all duration-300"
                data-aos="fade-up" data-aos-delay="400">
                Lamar Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </section>

    {{-- Section Tentang Perusahaan --}}
    <section id="tentang" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-24 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <div data-aos="fade-right">
                <h4 class="text-blue-600 font-semibold text-sm uppercase tracking-widest mb-3">Profil Kami</h4>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800 leading-tight">
                    Tentang <span class="text-black">Perusahaan</span>
                </h2>
                <p class="text-gray-700 text-lg leading-relaxed mb-4 text-justify">
                    PT <span class="text-blue-600 font-semibold">Coffee Kane</span> adalah sebuah destinasi, tempat
                    setiap biji kopi dikurasi dengan hati, di-roast dengan <span
                        class="text-blue-600 font-semibold">keahlian</span> dan disajikan dengan passion untuk
                    menciptakan pengalaman yang tak terlupakan."
                </p>
                <p class="text-gray-700 text-lg leading-relaxed text-justify">
                    Coffee Kane lebih dari sekadar kedai kopi, ini adalah hub komunitas tempat inovasi bertemu
                    kenyamanan, dan setiap secangkir kopi menjadi
                    <span class="text-blue-600 font-semibold">katalis untuk koneksi</span> dan ide-ide baru
                </p>
                <a href="{{ route('login') }}" {{-- Link langsung ke halaman login --}}
                    class="inline-block mt-8 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition">
                    Jadilah Bagian dari Kami
                </a>
            </div>

            <div data-aos="fade-left" class="flex justify-center">
                <img src="/images/coffeshop1.jpg" alt="Tentang Perusahaan"
                    class="rounded-2xl shadow-lg w-3/4 md:w-full">
            </div>
        </div>
    </section>

    {{-- Section Keunggulan --}}
    <section id="keunggulan" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-24 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-gray-800" data-aos="fade-up">
                Kenapa Bergabung dengan Kami?
            </h2>
            <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3">

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="text-5xl mb-4">✨</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Lingkungan Kerja Nyaman</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Kami menciptakan suasana kerja yang positif,
                        kolaboratif, dan
                        mendukung pengembangan pribadi.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="text-5xl mb-4">🎓</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Kesempatan Pengembangan Karier</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Kami menyediakan pelatihan, sertifikasi, dan jalur
                        karier
                        yang jelas untuk menunjang pertumbuhan Anda.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition" data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="text-5xl mb-4">📈</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Stabilitas dan Tunjangan</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Coffee Kane menawarkan kompensasi kompetitif,
                        tunjangan
                        kesehatan,
                        dan program kesejahteraan karyawan.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Lowongan --}}
    <section id="lowongan" class="py-24 bg-white scroll-mt-24">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-24 text-center">

            <h4 class="text-blue-600 font-semibold text-sm uppercase tracking-widest mb-3" data-aos="fade-up">
                Posisi yang Tersedia
            </h4>

            <h2 class="text-4xl md:text-5xl font-bold mb-12 text-gray-800 leading-tight" data-aos="fade-up"
                data-aos-delay="100">
                Lowongan Pekerjaan
            </h2>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">

                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between h-full"
                    data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="text-5xl mb-4 text-blue-600">📂</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Akuntan</h3>
                        <p class="text-sm text-gray-600 mb-4">Coffee Kane</p>
                        <span
                            class="inline-block bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full mb-4">Fulltime</span>
                    </div>
                    <a href="{{ route('login') }}" {{-- Link langsung ke halaman login --}}
                        class="mt-4 inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-xl transition">
                        Lamar Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between h-full"
                    data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="text-5xl mb-4 text-blue-600">💻</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Admin</h3>
                        <p class="text-sm text-gray-600 mb-4">Coffee Kane</p>
                        <span
                            class="inline-block bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full mb-4">Fulltime</span>
                    </div>
                    <a href="{{ route('login') }}" {{-- Link langsung ke halaman login --}}
                        class="mt-4 inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-xl transition">
                        Lamar Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between h-full"
                    data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="text-5xl mb-4 text-blue-600">👨‍💼</div> {{-- Emot untuk Manajer Operasional --}}
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Manajer Operasional</h3>
                        <p class="text-sm text-gray-600 mb-4">Coffee Kane</p>
                        <span
                            class="inline-block bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full mb-4">Fulltime</span>
                    </div>
                    <a href="{{ route('login') }}" {{-- Link langsung ke halaman login --}}
                        class="mt-4 inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-xl transition">
                        Lamar Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between h-full"
                    data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="text-5xl mb-4 text-blue-600">☕ </div> {{-- Emot untuk Barista --}}
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Barista</h3>
                        <p class="text-sm text-gray-600 mb-4">Coffee Kane</p>
                        <span
                            class="inline-block bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full mb-4">Fulltime</span>
                    </div>
                    <a href="{{ route('login') }}" {{-- Link langsung ke halaman login --}}
                        class="mt-4 inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-xl transition">
                        Lamar Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

            </div>

        </div>
    </section>

    {{-- Section Alur Rekrutmen --}}
    <section id="alur" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-24 text-center">

            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-gray-800" data-aos="fade-up">
                Alur Rekrutmen
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
                {{-- step1 --}}
                <div class="bg-gray-100 p-6 rounded-2xl shadow-md flex flex-col justify-between h-full"
                    data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="text-4xl font-bold text-blue-600 mb-4">1</div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Daftar Online</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Kandidat mengisi formulir pendaftaran dan
                            mengunggah
                            dokumen yang dibutuhkan secara online.</p>
                    </div>
                </div>
                {{-- step2 --}}
                <div class="bg-gray-100 p-6 rounded-2xl shadow-md flex flex-col justify-between h-full"
                    data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="text-4xl font-bold text-blue-600 mb-4">2</div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Seleksi Administrasi</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Tim HR melakukan verifikasi berkas dan seleksi
                            administrasi
                            awal.</p>
                    </div>
                </div>

                {{-- step3 --}}
                <div class="bg-gray-100 p-6 rounded-2xl shadow-md flex flex-col justify-between h-full"
                    data-aos="fade-up" data-aos-delay="400">
                    <div>
                        <div class="text-4xl font-bold text-blue-600 mb-4">3</div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Tes Online</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Kandidat mengikuti tes kemampuan dasar dan
                            psikotes secara
                            online.</p>
                    </div>
                </div>
                {{-- step4 --}}
                <div class="bg-gray-100 p-6 rounded-2xl shadow-md flex flex-col justify-between h-full"
                    data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <div class="text-4xl font-bold text-blue-600 mb-4">4</div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Wawancara</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Wawancara langsung dengan HRD dan user terkait
                            posisi yang
                            dilamar.</p>
                    </div>
                </div>
                {{-- step5 --}}
                <div class="bg-gray-100 p-6 rounded-2xl shadow-md flex flex-col justify-between h-full"
                    data-aos="fade-up" data-aos-delay="500">
                    <div>
                        <div class="text-4xl font-bold text-blue-600 mb-4">5</div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Offering</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Jika lolos, kandidat akan menerima penawaran
                            kerja resmi
                            dari perusahaan.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-200 mt-auto p-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} PT Coffee Kane. All rights reserved. {{-- Perbaiki nama perusahaan --}}
    </footer>

</body>

</html>
