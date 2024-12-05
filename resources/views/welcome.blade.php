<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Pembayaran SPP') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script defer src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-50 text-gray-800 font-sans">
    @include('layouts.front-navigation')

    <main>
        <!-- Hero Section dengan Glassmorphism -->
        <!-- Hero Section dengan Natural Overlay -->
        <section class="min-h-screen relative overflow-hidden">
            <!-- Background dengan natural gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/70 to-gray-800/70"></div>
            <div class="absolute inset-0">
                <div
                    class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2340&auto=format&fit=crop')] bg-cover bg-center mix-blend-overlay opacity-90">
                </div>
            </div>

            <!-- Content -->
            <div class="relative h-full min-h-screen flex items-center">
                <div class="container mx-auto px-4">
                    <div class="max-w-2xl backdrop-blur-sm bg-black/10 p-8 rounded-2xl" data-aos="fade-up">
                        <h1 class="text-5xl font-bold mb-6 text-white leading-tight">Sistem Pembayaran SPP <span
                                class="text-yellow-400">Digital</span></h1>
                        <p class="text-xl mb-8 text-gray-100">Nikmati kemudahan pembayaran SPP dengan sistem digital
                            yang aman, cepat, dan efisien.</p>
                        <div class="flex gap-4">
                            <a href="{{ route('client.transaction.create') }}"
                                class="bg-yellow-400 text-gray-900 px-8 py-3 rounded-xl text-lg font-semibold hover:bg-yellow-300 transition-all duration-300 inline-block shadow-lg hover:shadow-xl">
                                Bayar Sekarang
                            </a>
                            <a href="#layanan"
                                class="bg-white/10 backdrop-blur-sm border-2 border-white text-white px-8 py-3 rounded-xl text-lg font-semibold hover:bg-white/20 transition-all duration-300 inline-block">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Natural gradient fade -->
            <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-white to-transparent"></div>
        </section>

        <!-- Layanan Section dengan Card Modern -->
        <section id="layanan" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Proses Pembayaran Sederhana</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Selesaikan pembayaran SPP Anda hanya dalam
                        beberapa langkah mudah</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group"
                        data-aos="fade-up" data-aos-delay="100">
                        <div
                            class="bg-blue-500 text-white p-3 rounded-xl inline-block mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i data-feather="log-in" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Login ke Akun</h3>
                        <p class="text-gray-600">Masuk ke akun Anda menggunakan kredensial yang telah diberikan oleh
                            sekolah.</p>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group"
                        data-aos="fade-up" data-aos-delay="200">
                        <div
                            class="bg-blue-500 text-white p-3 rounded-xl inline-block mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i data-feather="upload" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Upload Bukti</h3>
                        <p class="text-gray-600">Upload bukti transfer pembayaran SPP Anda melalui sistem yang aman.</p>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group"
                        data-aos="fade-up" data-aos-delay="300">
                        <div
                            class="bg-blue-500 text-white p-3 rounded-xl inline-block mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i data-feather="check-circle" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Verifikasi Otomatis</h3>
                        <p class="text-gray-600">Sistem akan memverifikasi pembayaran Anda secara otomatis.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Keuntungan Section dengan Stats -->
        <section id="keuntungan" class="py-24 bg-gradient-to-br from-blue-600 to-indigo-600 text-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold mb-4">Keunggulan Sistem Kami</h2>
                    <p class="text-xl text-blue-100 max-w-2xl mx-auto">Nikmati berbagai keuntungan menggunakan sistem
                        pembayaran SPP digital</p>
                </div>

                <div class="grid md:grid-cols-4 gap-8">
                    <div class="text-center p-6 backdrop-blur-lg bg-white/10 rounded-2xl" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="bg-white/20 p-4 rounded-xl inline-block mb-4">
                            <i data-feather="clock" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-2">24/7</h3>
                        <p class="text-blue-100">Akses kapan saja dan dimana saja</p>
                    </div>

                    <div class="text-center p-6 backdrop-blur-lg bg-white/10 rounded-2xl" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="bg-white/20 p-4 rounded-xl inline-block mb-4">
                            <i data-feather="shield" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-2">100%</h3>
                        <p class="text-blue-100">Keamanan transaksi terjamin</p>
                    </div>

                    <div class="text-center p-6 backdrop-blur-lg bg-white/10 rounded-2xl" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="bg-white/20 p-4 rounded-xl inline-block mb-4">
                            <i data-feather="file-text" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-2">Real-time</h3>
                        <p class="text-blue-100">Pembaruan status pembayaran</p>
                    </div>

                    <div class="text-center p-6 backdrop-blur-lg bg-white/10 rounded-2xl" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="bg-white/20 p-4 rounded-xl inline-block mb-4">
                            <i data-feather="bell" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-2">Instan</h3>
                        <p class="text-blue-100">Notifikasi otomatis</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section dengan Modern Cards -->
        <section id="kontak" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto bg-gradient-to-r from-blue-500 to-indigo-500 rounded-2xl shadow-xl overflow-hidden"
                    data-aos="fade-up">
                    <div class="grid md:grid-cols-2 gap-8 p-12">
                        <div class="text-white">
                            <h2 class="text-3xl font-bold mb-6">Butuh Bantuan?</h2>
                            <p class="text-blue-100 mb-8">Tim support kami siap membantu Anda 24/7. Jangan ragu untuk
                                menghubungi kami.</p>
                            <div class="space-y-4">
                                <a href="tel:+6281234567890"
                                    class="flex items-center text-white hover:text-blue-200 transition-colors duration-300">
                                    <i data-feather="phone" class="mr-3 h-5 w-5"></i>
                                    0895629511226
                                </a>
                                <a href="mailto:support@school.com"
                                    class="flex items-center text-white hover:text-blue-200 transition-colors duration-300">
                                    <i data-feather="mail" class="mr-3 h-5 w-5"></i>
                                    support@school.com
                                </a>
                            </div>
                        </div>
                        <div class="bg-white p-8 rounded-xl shadow-lg">
                            <form class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text"
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email"
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                                    <textarea
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        rows="4"></textarea>
                                </div>
                                <button type="submit"
                                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors duration-300">
                                    Kirim Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer dengan Design Modern -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-12 mb-8">
                <div>
                    <div class="flex items-center mb-6">
                        <img src="https://www.svgrepo.com/show/501266/school.svg" alt="School Logo"
                            class="h-10 w-10 mr-3">
                        <span class="text-2xl font-bold">SMK NEGERI 01 BATANG ANGKOLA</span>
                    </div>
                    <p class="text-gray-400">Memberikan pendidikan berkualitas dan pelayanan terbaik untuk masa depan
                        yang lebih cerah.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Tentang Kami</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Fasilitas</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Akademik</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-6">Sosial Media</h3>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            <i data-feather="facebook" class="h-5 w-5"></i>
                        </a>
                        <a href="#"
                            class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            <i data-feather="instagram" class="h-5 w-5"></i>
                        </a>
                        <a href="#"
                            class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            <i data-feather="twitter" class="h-5 w-5"></i>
                        </a>
                        <a href="#"
                            class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            <i data-feather="youtube" class="h-5 w-5"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 mt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400">&copy; 2024 SMK NEGERI 01 BATANG ANGKOLA. All Rights Reserved.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#"
                            class="text-gray-400 hover:text-white transition-colors duration-300">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Terms
                            of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Feather Icons
        feather.replace();

        // Initialize AOS (Animate On Scroll)
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navigation menu toggle for mobile
        const userMenu = document.getElementById('userMenu');
        const userDropdown = document.getElementById('userDropdown');
        if (userMenu && userDropdown) {
            userMenu.addEventListener('click', () => {
                userDropdown.classList.toggle('hidden');
            });

            window.addEventListener('click', (e) => {
                if (!userMenu.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }

        // Intersection Observer for navbar background
        const header = document.querySelector('nav');
        const observer = new IntersectionObserver(
            ([e]) => {
                if (e.intersectionRatio < 1) {
                    header.classList.add('bg-white', 'shadow-md');
                    header.classList.remove('bg-transparent');
                } else {
                    header.classList.remove('bg-white', 'shadow-md');
                    header.classList.add('bg-transparent');
                }
            }, {
                threshold: [1]
            }
        );

        if (header) {
            observer.observe(header);
        }
    </script>
</body>

</html>
