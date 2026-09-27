<?php
require_once 'config.php';

try {
    // 1. Total Seluruh Peserta
    $count_participants = $pdo->query("SELECT COUNT(*) FROM registrations")->fetchColumn();

    // 2. Total Artikel (Hanya yang mendaftar sebagai Presenter)
    $count_articles = $pdo->query("SELECT COUNT(*) FROM registrations WHERE type = 'Presenter'")->fetchColumn();

    // 3. Total Universitas (Menghitung institusi unik/berbeda)
    $count_universities = $pdo->query("SELECT COUNT(DISTINCT institution) FROM registrations")->fetchColumn();

    // 4. Total Negara (Menghitung negara unik/berbeda)
    $count_countries = $pdo->query("SELECT COUNT(DISTINCT country) FROM registrations")->fetchColumn();

    // 5. Total Non-Presenter
    $count_non_presenter = $pdo->query("SELECT COUNT(*) FROM registrations WHERE type = 'Non Presenter'")->fetchColumn();

    } catch (PDOException $e) {
        // Jika error, set default ke 0
        $count_participants = $count_articles = $count_universities = $count_countries = $count_non_presenter = 0;
    }
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>International Student Conference</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* Smooth scroll agar perpindahan antar section halus */
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <nav x-data="{ mobileMenu: false, downloadDrop: false }" 
     style="background-color: #070620;"
     class="fixed top-0 left-0 w-full z-50 py-4 shadow-lg border-b border-white border-opacity-10 transition-all duration-300 ease-in-out">
     
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <div class="flex items-center gap-4">
                <img src="img/logocohost/ubhinus_logo.png" alt="UBHINUS Logo" class="h-11 w-auto object-contain"> 
                <img src="img/logocohost/logo_isc.png" alt="isc logo" class="h-11 w-auto object-contain">
            </div>

            <div class="hidden lg:flex space-x-5 items-center">
                <a href="#home" class="text-sm font-medium text-white hover:text-blue-400 transition">Home</a>
                <a href="#about" class="text-sm font-medium text-white hover:text-blue-400 transition">About</a>
                <a href="#speakers" class="text-sm font-medium text-white hover:text-blue-400 transition">Speakers</a>
                <a href="#statistic" class="text-sm font-medium text-white hover:text-blue-400 transition">Statistics</a>
                <a href="#important-dates" class="text-sm font-medium text-white hover:text-blue-400 transition">Dates</a>
                <a href="#contact" class="text-sm font-medium text-white hover:text-blue-400 transition">Contact</a>
                
                <div class="relative" @click.away="downloadDrop = false">
                    <button @click="downloadDrop = !downloadDrop" class="flex items-center text-sm font-medium text-white hover:text-blue-400 focus:outline-none transition">
                        Download
                        <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="downloadDrop" x-transition class="absolute mt-2 w-48 bg-white rounded-md shadow-xl py-2 text-gray-800 border border-gray-100">
                        <a href="https://drive.google.com/drive/folders/1x53iQEM67SGcZZJ0k4aAbhxaNxAdkG17?usp=sharing" class="block px-4 py-2 text-xs hover:bg-gray-100 transition">Guidebook & Abstract</a>
                    </div>
                </div>
                
                <div x-data="{ archiveDrop: false }" class="relative">
                    <button @click="archiveDrop = !archiveDrop" class="flex items-center text-sm font-medium text-white hover:text-blue-400 focus:outline-none">
                        Archive
                        <svg class="ml-1 w-3 h-3 transition-transform duration-200" :class="{ 'rotate-180': archiveDrop }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="archiveDrop" @click.outside="archiveDrop = false" x-transition class="absolute left-0 mt-2 w-44 bg-white rounded-md shadow-lg border border-gray-200 py-1 z-50">
                        <a href="https://isc.ubhinus.ac.id/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600">ISC 2025</a>
                    </div>
                </div>
               
                <a href="registration.php" class="bg-[#fe0000] border border-[#fe0000] text-white px-5 py-2 rounded-full text-xs font-semibold hover:bg-[#c90000] hover:border-[#c90000] transition-all duration-300">
                    Register
                </a>
            </div>

            <div class="lg:hidden">
                <button @click="mobileMenu = !mobileMenu" class="text-white focus:outline-none transition">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        <path x-show="mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenu" 
         style="background-color: #070620;"
         class="lg:hidden shadow-xl text-white px-4 py-8 space-y-4 border-t border-white border-opacity-10 absolute w-full left-0 top-full">
        <a href="#home" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">Home</a>
        <a href="#about" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">About</a>
        <a href="#speakers" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">Speakers</a>
        <a href="#statistic" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">Statistics</a>
        <a href="#important-dates" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">Dates</a>
        <a href="#contact" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">Contact</a>
        
        <div x-data="{ mobDownloadDrop: false }" class="space-y-2">
            <button @click="mobDownloadDrop = !mobDownloadDrop" class="flex items-center text-sm font-medium hover:text-blue-400 focus:outline-none w-full text-left">
                Download
                <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="mobDownloadDrop" class="pl-4 space-y-2 border-l border-white border-opacity-20">
                <a href="#" class="block text-xs hover:text-blue-400 py-1">Guidebook & Abstract</a>
            </div>
        </div>

        <a href="#archive" class="block text-sm font-medium hover:text-blue-400">Archive</a>
        <a href="registration.php" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full text-xs font-semibold mt-4 w-full text-center">Register</a>
    </div>
</nav>
    <!-- Section Home -->
    
    <section id="home" class="relative w-full h-screen flex items-center overflow-hidden bg-gray-900 mt-[70px]"> 
        <div class="absolute inset-0 z-0">
            <img src="img/coverhalaman/isc_cover.png" 
                alt="ICoBITS Cover" 
                class="w-full h-full object-cover object-center" />
            <div class="absolute inset-0 bg-blue-900 bg-opacity-10"></div>
        </div>

        <div class="relative z-10 px-6 md:px-8 lg:px-14 w-full">
            <div class="max-w-3xl text-left">
                <h1 class="text-5xl md:text-7xl font-bold text-white tracking-tight mb-6 drop-shadow-md">
                    Call For Papers!
                </h1>
                
                <div class="space-y-2 mb-10">
                    <p class="text-xl md:text-2xl text-gray-100 font-light tracking-wide">
                        The 5<sup>st</sup>
                    </p>
                    <p class="text-2xl md:text-4xl font-bold text-white uppercase leading-tight">
                        International Student <br class="hidden md:block"> Conference
                    </p>
                    <p class="text-lg md:text-xl text-gray-200 font-reguler leading-tight">
                        Navigating Global Uncertainty: Empowering Youth, <br> Advancing Innovation, and Building a Resilient Future
                    </p>
                </div>

                <a href="registration.php" class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-4 px-10 rounded-md transition-all transform hover:scale-105 shadow-xl uppercase text-sm tracking-widest">
                    Register Now !
                </a>
            </div>
        </div>

        <a href="#about" class="absolute bottom-10 left-10 z-10 flex flex-col items-center text-white opacity-40 hover:opacity-100 transition animate-bounce">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7-7-7"></path>
            </svg>
        </a>
    </section>

    <?php if (false): ?> //tinggal ganti true saja untuk mengaktifkan section berikut
    <!-- Section pre conference -->
    <section id="briefing" class="py-24 relative overflow-hidden border-b border-white/5 bg-[#05041a]">
    <!-- Efek Cahaya Latar Belakang (Glow Effect) -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <div class="space-y-8 text-center sm:text-left">
            
            <!-- Header Informasi -->
            <div class="space-y-4">
                <div class="inline-block px-4 py-1 bg-green-500/10 border border-green-500/20 rounded-full text-green-400 text-[10px] font-black uppercase tracking-[0.2em]">
                    Upcoming Event
                </div>
                
                <h2 class="text-4xl md:text-5xl font-black uppercase tracking-tight leading-none text-white">
                    Pre-Conference <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">Briefing Session</span>
                </h2>
                
                <p class="text-gray-400 font-medium text-sm md:text-base max-w-2xl mx-auto sm:mx-0">
                    Ikuti sesi sosialisasi dan pengarahan awal untuk mempersiapkan segala kebutuhan presentasi serta administrasi teknis sebelum konferensi utama dimulai.
                </p>
            </div>

            <!-- Grid Informasi Waktu & Tempat -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2 text-left">
                <!-- Tanggal -->
                <div class="glass-bg p-5 rounded-2xl flex items-center gap-4 bg-white/5 border border-white/10 backdrop-blur-md">
                    <div class="w-12 h-12 bg-green-500/20 text-green-400 rounded-xl flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">Date</p>
                        <p class="text-white font-bold text-sm">July 20, 2026</p>
                    </div>
                </div>

                <!-- Jam -->
                <div class="glass-bg p-5 rounded-2xl flex items-center gap-4 bg-white/5 border border-white/10 backdrop-blur-md">
                    <div class="w-12 h-12 bg-blue-500/20 text-blue-400 rounded-xl flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">Time</p>
                        <p class="text-white font-bold text-sm">10.00 - 11.00 AM</p>
                    </div>
                </div>

                <!-- Platform -->
                <div class="glass-bg p-5 rounded-2xl flex items-center gap-4 bg-white/5 border border-white/10 backdrop-blur-md">
                    <div class="w-12 h-12 bg-purple-500/20 text-purple-400 rounded-xl flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-video"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">Platform</p>
                        <p class="text-white font-bold text-sm">Zoom & YouTube</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<?php endif; ?>

    <!-- Section countdown -->
<section id="countdown" class="py-20 md:py-24 relative overflow-hidden bg-white">

    <!-- Background Image - TETAP DIPERTAHANKAN -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <img 
            src="img/coverhalaman/isc_countdown.svg" 
            alt="Countdown Background" 
            class="w-full h-full object-cover opacity-100"
        >
    </div>

    <!-- Overlay putih agar tampilan tetap bersih seperti desain referensi -->
    <div class="absolute inset-0 bg-white/80 z-0 pointer-events-none"></div>

    <!-- Dekorasi garis orange bagian atas -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-44 md:w-48 h-2 bg-gradient-to-r from-orange-400 to-orange-500 z-10"></div>

    <div class="max-w-5xl mx-auto px-6 relative z-10">

        <!-- TITLE -->
        <div class="text-center mb-8 md:mb-10">

            <h2 class="font-black text-3xl md:text-4xl lg:text-5xl tracking-tight leading-tight">
                <span class="bg-gradient-to-r from-[#24113f] via-[#6d003b] to-[#ef1111] bg-clip-text text-transparent">
                    Submit Your Paper Until
                </span>
            </h2>

        </div>


        <!-- COUNTDOWN -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5 md:gap-8 max-w-3xl mx-auto">

            <!-- DAYS -->
            <div class="relative rounded-2xl p-[1.5px] bg-gradient-to-br from-[#32104f] via-[#8d174b] to-[#ff1717]">
                <div class="bg-white rounded-[14px] p-5 md:p-7 flex flex-col items-center justify-center">

                    <span 
                        id="days" 
                        class="text-5xl md:text-7xl font-black leading-none
                            bg-gradient-to-r from-[#32104f] to-[#d10b20]
                            bg-clip-text text-transparent">
                        00
                    </span>

                    <span class="mt-4 text-[#35123f] text-base md:text-lg font-medium">
                        Days
                    </span>

                </div>
            </div>


            <!-- HOURS -->
            <div class="relative rounded-2xl p-[1.5px] bg-gradient-to-br from-[#32104f] via-[#8d174b] to-[#ff1717]">
                <div class="bg-white rounded-[14px] p-5 md:p-7 flex flex-col items-center justify-center">

                    <span 
                        id="hours" 
                        class="text-5xl md:text-7xl font-black leading-none
                            bg-gradient-to-r from-[#32104f] to-[#d10b20]
                            bg-clip-text text-transparent">
                        00
                    </span>

                    <span class="mt-4 text-[#35123f] text-base md:text-lg font-medium">
                        Hours
                    </span>

                </div>
            </div>


            <!-- MINUTES -->
            <div class="relative rounded-2xl p-[1.5px] bg-gradient-to-br from-[#32104f] via-[#8d174b] to-[#ff1717]">
                <div class="bg-white rounded-[14px] p-5 md:p-7 flex flex-col items-center justify-center">

                    <span 
                        id="minutes" 
                        class="text-5xl md:text-7xl font-black leading-none
                            bg-gradient-to-r from-[#32104f] to-[#d10b20]
                            bg-clip-text text-transparent">
                        00
                    </span>

                    <span class="mt-4 text-[#35123f] text-base md:text-lg font-medium">
                        Minutes
                    </span>

                </div>
            </div>


            <!-- SECONDS -->
            <div class="relative rounded-2xl p-[1.5px] bg-gradient-to-br from-[#32104f] via-[#8d174b] to-[#ff1717]">
                <div class="bg-white rounded-[14px] p-5 md:p-7 flex flex-col items-center justify-center">

                    <span 
                        id="seconds" 
                        class="text-5xl md:text-7xl font-black leading-none
                            bg-gradient-to-r from-[#32104f] to-[#d10b20]
                            bg-clip-text text-transparent">
                        00
                    </span>

                    <span class="mt-4 text-[#35123f] text-base md:text-lg font-medium">
                        Seconds
                    </span>

                </div>
            </div>

        </div>


        <!-- DEADLINE -->
        <div class="mt-7 md:mt-8 text-center">

            <p class="text-base md:text-lg italic font-medium text-[#35123f]">
                Don’t miss the deadline!
                <span class="text-[#ed1111]">
                    Oct 14, 2026
                </span>
            </p>

        </div>

    </div>

</section>

    <!-- Section About Us -->

    <section id="about" class="relative w-full min-h-screen flex items-center overflow-hidden bg-[#070620] py-24 md:py-32">
    
    <div class="absolute inset-0 z-0">
        <img src="img/coverhalaman/isc_aboutus.svg" 
             alt="About Us Background" 
             class="w-full h-full object-cover object-center" />
    </div>

    <div class="relative z-10 px-6 md:px-16 lg:px-24 w-full max-w-7xl mx-auto">
        <div class="max-w-4xl text-left">
            
            <h4 class="text-white font-bold uppercase tracking-widest text-sm mb-3 drop-shadow-lg">
                About Us
            </h4>

            <h2 class="text-4xl md:text-5xl font-extrabold text-white leading-tight tracking-tight mb-2 drop-shadow-xl">
                The 5<sup>st</sup>
            </h2>
            <h3 class="text-3xl md:text-4xl font-bold text-white uppercase leading-tight mb-10 drop-shadow-xl">
                International Student <br class="hidden md:block"> Conference
            </h3>
            
            <div class="w-20 h-1.5 bg-gradient-to-r from-[#fca105] to-[#fe6102] rounded-full mb-10 shadow-lg"></div>

            <div class="space-y-6 text-white text-base md:text-lg leading-relaxed font-normal text-justify drop-shadow-md w-full md:w-[80%]">
                <p>
                    The 5th International Student Conference (ISC) 2026 is an annual international academic forum that brings together undergraduate and postgraduate students, researchers, and young professionals from diverse disciplines. Hosted by Universitas Bhinneka Nusantara, Malang, Indonesia, the conference serves as a platform to present research, exchange ideas, and foster collaboration under the theme “Navigating Global Uncertainty: Empowering Youth, Advancing Innovation, and Building a Resilient Future”
                </p>
                <p>
                    ISC 2026 aims to empower students to contribute to global discussions, showcase innovative research, and build networks that transcend borders. With opportunities for paper presentations, keynote sessions, and interactive workshops, the conference encourages active engagement and interdisciplinary dialogue to address today’s pressing global issues.
                </p>
            </div>

        </div>
    </div>
</section>

    <!-- Section Tema -->
    <section id="theme" class="relative overflow-hidden bg-orange-500 py-16 md:py-20 text-center">

        <!-- Background Image - TETAP DIPERTAHANKAN -->
        <div class="absolute inset-0 z-0">
            <img 
                src="img/coverhalaman/isc_theme.png" 
                alt="Theme Background" 
                class="w-full h-full object-cover"
            >
        </div>

        <!-- Content -->
        <div class="max-w-5xl mx-auto px-6 sm:px-8 relative z-10 flex flex-col items-center">

            <!-- Label THEME -->
            <span class="inline-flex items-center justify-center bg-[#ef233c] text-white font-bold px-12 py-1.5
                        rounded-md text-xs md:text-sm shadow-md mb-5 tracking-wide">Theme</span>

            <!-- Theme Title -->
            <h2 class="max-w-4xl text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white
                    leading-[1.05] tracking-tight drop-shadow-md"> "Navigating Global Uncertainty: Empowering Youth, Advancing Innovation, and Building a Resilient Future" </h2>
        </div>
    </section>

    <!-- Section Registration Process -->
    <section id="registration" class="py-14 md:py-16 relative overflow-hidden bg-[#65002d]">

        <!-- Background Image - TETAP DIPERTAHANKAN -->
        <div class="absolute inset-0 z-0">
            <img 
                src="img/coverhalaman/isc_registrationproses.png" 
                alt="Registration Process Background" 
                class="w-full h-full object-cover"
            >
        </div>

        <!-- Overlay tipis agar card dan teks tetap jelas -->
        <div class="absolute inset-0 bg-[#65002d]/10 z-0 pointer-events-none"></div>


        <div class="max-w-6xl mx-auto px-6 sm:px-8 relative z-10">

            <!-- TITLE -->
            <h2 class="text-3xl md:text-4xl font-black text-white text-center mb-12 md:mb-14 tracking-tight drop-shadow-lg">
                Registration Process
            </h2>


            <!-- PROCESS GRID -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-x-10 gap-y-7 md:gap-y-8">


                <!-- ==================== 01 ==================== -->
                <div class="relative order-1">

                    <div class="bg-white rounded-md min-h-[82px] px-5 py-4 flex items-center justify-center text-center shadow-lg">

                        <div class="absolute -top-1 left-1 bg-[#fca105] text-white font-bold text-xs px-2 py-1 rounded-sm shadow-md">
                            01
                        </div>

                        <p class="text-[11px] md:text-xs text-[#681333] leading-[1.15] font-medium">
                            Click Download to get the<br>
                            abstract template.
                        </p>

                    </div>

                    <!-- Arrow -->
                    <div class="hidden md:flex absolute top-1/2 -right-8 -translate-y-1/2
                                w-7 h-7 rounded-full border border-white/80
                                items-center justify-center text-white text-lg">
                        →
                    </div>

                </div>


                <!-- ==================== 02 ==================== -->
                <div class="relative order-2">

                    <div class="bg-white rounded-md min-h-[82px] px-5 py-4 flex items-center justify-center text-center shadow-lg">

                        <div class="absolute -top-1 left-1 bg-[#fca105] text-white font-bold text-xs px-2 py-1 rounded-sm shadow-md">
                            02
                        </div>

                        <p class="text-[11px] md:text-xs text-[#681333] leading-[1.15] font-medium">
                            Register at<br>
                            <span class="font-black italic">
                                isc.ubhinus.ac.id/
                                <br>Register
                            </span>
                        </p>

                    </div>

                    <!-- Arrow -->
                    <div class="hidden md:flex absolute top-1/2 -right-8 -translate-y-1/2
                                w-7 h-7 rounded-full border border-white/80
                                items-center justify-center text-white text-lg">
                        →
                    </div>

                </div>


                <!-- ==================== 03 ==================== -->
                <div class="relative order-3">

                    <div class="bg-white rounded-md min-h-[82px] px-5 py-4 flex items-center justify-center text-center shadow-lg">

                        <div class="absolute -top-1 left-1 bg-[#fca105] text-white font-bold text-xs px-2 py-1 rounded-sm shadow-md">
                            03
                        </div>

                        <p class="text-[10px] md:text-[11px] text-[#681333] leading-[1.15] font-medium">
                            Fill in the form, upload your<br>
                            abstract and proof of payment,<br>
                            then click Submit Registration.
                        </p>

                    </div>

                    <!-- Arrow -->
                    <div class="hidden md:flex absolute top-1/2 -right-8 -translate-y-1/2
                                w-7 h-7 rounded-full border border-white/80
                                items-center justify-center text-white text-lg">
                        →
                    </div>
                </div>


                <!-- ==================== 04 ==================== -->
                <div class="relative order-4">

                    <div class="bg-white rounded-md min-h-[82px] px-5 py-4 flex items-center justify-center text-center shadow-lg">

                        <div class="absolute -top-1 left-1 bg-[#fca105] text-white font-bold text-xs px-2 py-1 rounded-sm shadow-md">
                            04
                        </div>

                        <p class="text-[10px] md:text-[11px] text-[#681333] leading-[1.15] font-medium">
                            Check your email for the<br>
                            abstract acceptance<br>
                            notification.
                        </p>

                    </div>

                </div>


                <!-- ==================== 05 ==================== -->
                <div class="relative order-5">

                    <div class="bg-white rounded-md min-h-[82px] px-5 py-4 flex items-center justify-center text-center shadow-lg">

                        <div class="absolute -top-1 left-1 bg-[#fca105] text-white font-bold text-xs px-2 py-1 rounded-sm shadow-md">
                            05
                        </div>

                        <p class="text-[11px] md:text-xs text-[#681333] leading-[1.15] font-medium">
                            Upload your full paper at <br>
                            <span class="font-black">
                                icobits.ubhinus.ac.id
                            </span>
                        </p>

                    </div>

                    <!-- Arrow -->
                    <div class="hidden md:flex absolute top-1/2 -right-8 -translate-y-1/2
                                w-7 h-7 rounded-full border border-white/80
                                items-center justify-center text-white text-lg">
                        →
                    </div>

                </div>


                <!-- ==================== 06 ==================== -->
                <div class="relative order-6">

                    <div class="bg-white rounded-md min-h-[82px] px-5 py-4 flex items-center justify-center text-center shadow-lg">

                        <div class="absolute -top-1 left-1 bg-[#fca105] text-white font-bold text-xs px-2 py-1 rounded-sm shadow-md">
                            06
                        </div>

                        <p class="text-[11px] md:text-xs text-[#681333] leading-[1.15] font-medium">
                            Socialization Session <br>
                            <span class="font-black">
                                11 December 2026
                            </span>
                        </p>

                    </div>

                    <!-- Arrow -->
                    <div class="hidden md:flex absolute top-1/2 -right-8 -translate-y-1/2
                                w-7 h-7 rounded-full border border-white/80
                                items-center justify-center text-white text-lg">
                        →
                    </div>

                </div>


                <!-- ==================== 07 ==================== -->
                <div class="relative order-7">

                    <div class="bg-white rounded-md min-h-[82px] px-5 py-4 flex items-center justify-center text-center shadow-lg">

                        <div class="absolute -top-1 left-1 bg-[#fca105] text-white font-bold text-xs px-2 py-1 rounded-sm shadow-md">
                            07
                        </div>

                        <p class="text-[11px] md:text-xs text-[#681333] leading-[1.15] font-medium">
                            Full Paper Acceptance Announcement
                        </p>

                    </div>

                    <!-- Arrow -->
                    <div class="hidden md:flex absolute top-1/2 -right-8 -translate-y-1/2
                                w-7 h-7 rounded-full border border-white/80
                                items-center justify-center text-white text-lg">
                        →
                    </div>

                </div>


                <!-- ==================== 08 ==================== -->
                <div class="relative order-8">

                    <div class="bg-white rounded-md min-h-[82px] px-5 py-4 flex items-center justify-center text-center shadow-lg">

                        <div class="absolute -top-1 left-1 bg-[#fca105] text-white font-bold text-xs px-2 py-1 rounded-sm shadow-md">
                            08
                        </div>

                        <p class="text-[10px] md:text-[11px] text-[#681333] leading-[1.1] font-medium">
                            The 5th International<br>
                            Student Conference<br>
                            <span class="font-black italic">
                                16 December 2026
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Section Keynote Speaker -->
    <section id="speakers" class="py-16 md:py-20 relative overflow-hidden bg-[#f8f8f8]">
        <div class="absolute inset-0 z-0">
            <img src="img/coverhalaman/cover_theme.png" alt="Keynote Speakers Background" class="w-full h-full object-cover opacity-[0.08]">
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="text-center mb-10 md:mb-12">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-black tracking-tight">
                    <span class="bg-gradient-to-r from-[#32104f] via-[#7b0038] to-[#ef1111] bg-clip-text text-transparent">Keynote Speakers</span>
                </h2>
            </div>

            <!-- CAROUSEL -->
            <div class="relative">
                <!-- Previous -->
                <button id="speakerPrev" type="button" aria-label="Previous speakers" class="absolute left-0 md:-left-5 top-1/2 -translate-y-1/2 z-30 w-10 h-10 rounded-full bg-gray-500/80 hover:bg-[#ef1111] text-white text-xl flex items-center justify-center shadow-lg transition-all duration-300">←</button>

                <!-- Speaker Carousel -->
                <div id="speakerCarousel" tabindex="0" class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-6 scrollbar-hide">

                    <!-- Speaker 1 -->
                    <div class="group relative flex-none w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-21px)] snap-start overflow-hidden rounded-3xl border-2 border-white/30 bg-transparent shadow-xl transition-all duration-300 hover:-translate-y-2 hover:border-[#ffb000] hover:shadow-2xl flex flex-col">
                        <div class="relative w-full aspect-square flex-none overflow-hidden">
                            <img src="img/keynotespeaker/isc_sugiyono.png" alt="Prof. Dr. Sugiyono, M.Pd." class="w-full h-full object-contain object-center transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="relative z-20 bg-white min-h-[90px] px-3 py-3 text-center flex flex-col justify-center">
                            <h4 class="text-sm md:text-base font-black text-[#42103e] leading-tight">Prof. Dr. Sugiyono, M.Pd.</h4>
                            <p class="mt-1 text-[8px] md:text-[9px] text-gray-600 leading-[1.1]">Recognized with 4 MURI Records in Research Methodology Indonesia</p>
                        </div>
                    </div>

                    <!-- Speaker 2 -->
                    <div class="group relative flex-none w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-21px)] snap-start overflow-hidden rounded-3xl border-2 border-white/30 bg-transparent shadow-xl transition-all duration-300 hover:-translate-y-2 hover:border-[#ffb000] hover:shadow-2xl flex flex-col">
                        <div class="relative w-full aspect-square flex-none overflow-hidden">
                            <img src="img/keynotespeaker/isc_wanirham.png" alt="Dr. Wan Irham bin Ishak" class="w-full h-full object-contain object-center transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="relative z-20 bg-white min-h-[90px] px-3 py-3 text-center flex flex-col justify-center">
                            <h4 class="text-sm md:text-base font-black text-[#42103e] leading-tight">Dr. Wan Irham bin Ishak</h4>
                            <p class="mt-1 text-[8px] md:text-[9px] text-gray-600 leading-[1.1]">Senior Lecturer Department of English and Linguistics Akademi Pengajian Bahasa, Universiti Teknologi MARA, Kedah, Malaysia</p>
                        </div>
                    </div>

                    <!-- Speaker 3 -->
                    <div class="group relative flex-none w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-21px)] snap-start overflow-hidden rounded-3xl border-2 border-white/30 bg-transparent shadow-xl transition-all duration-300 hover:-translate-y-2 hover:border-[#ffb000] hover:shadow-2xl flex flex-col">
                        <div class="relative w-full aspect-square flex-none overflow-hidden">
                            <img src="img/keynotespeaker/isc_zoezheyi.png" alt="Dr. Zoe Che Yi" class="w-full h-full object-contain object-center transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="relative z-20 bg-white min-h-[90px] px-3 py-3 text-center flex flex-col justify-center">
                            <h4 class="text-sm md:text-base font-black text-[#42103e] leading-tight">Dr. Zoe Che Yi</h4>
                            <p class="mt-1 text-[8px] md:text-[9px] text-gray-600 leading-[1.1]">Vice President of Geely Talent Development Group, China</p>
                        </div>
                    </div>

                    <!-- Speaker 4 -->
                    <div class="group relative flex-none w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-21px)] snap-start overflow-hidden rounded-3xl border-2 border-white/30 bg-transparent shadow-xl transition-all duration-300 hover:-translate-y-2 hover:border-[#ffb000] hover:shadow-2xl flex flex-col">
                        <div class="relative w-full aspect-square flex-none overflow-hidden">
                            <img src="img/keynotespeaker/isc_caroline.png" alt="Dr. Nurdiyana Nazihah Zainal" class="w-full h-full object-contain object-center transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="relative z-20 bg-white min-h-[90px] px-3 py-3 text-center flex flex-col justify-center">
                            <h4 class="text-sm md:text-base font-black text-[#42103e] leading-tight">Caroline Nazareno Gabis, MAEd</h4>
                            <p class="mt-1 text-[8px] md:text-[9px] text-gray-600 leading-[1.1]">Tarlac Agricultural University, Philippines</p>
                        </div>
                    </div>

                </div>

                <!-- Next -->
                <button id="speakerNext" type="button" aria-label="Next speakers" class="absolute right-0 md:-right-5 top-1/2 -translate-y-1/2 z-30 w-10 h-10 rounded-full bg-gray-500/80 hover:bg-[#ef1111] text-white text-xl flex items-center justify-center shadow-lg transition-all duration-300">→</button>
            </div>
        </div>
    </section>

    <!-- CSS Carousel -->
    <style>
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    #speakerCarousel {
        scroll-behavior: smooth;
    }
    </style>

    <!-- Section Co-Host -->
    <section id="co-hosts" class="py-10 md:py-12 relative overflow-hidden bg-[#a50024]">

        <!-- Background Decoration -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-[#d90429] opacity-20 rounded-full blur-[100px] -ml-40 -mt-40"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-[#7f001c] opacity-30 rounded-full blur-[100px] -mr-40 -mb-40"></div>

        <div class="max-w-5xl mx-auto px-5 md:px-8 relative z-10">

            <!-- Title -->
            <div class="text-center mb-6 md:mb-8">
                <h2 class="text-white font-black text-xl md:text-2xl leading-tight">
                    Our Strategic Partners
                </h2>

                <p class="text-white text-[8px] md:text-[9px] font-bold leading-none mt-0.5">
                    Collaborate with ISC 2026
                </p>
            </div>

            <!-- Partner Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">

                <!-- International Co-Host -->
                <div class="bg-white rounded-md p-3 md:p-4 h-32 md:h-36 shadow-lg text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="mb-3">
                        <span class="inline-block bg-[#ef233c] text-white font-black px-8 md:px-8 py-1.5 md:py-2 rounded-md shadow-sm text-xs md:text-sm leading-none">
                            International Co-Host
                        </span>
                    </div>

                    <div class="h-[75px] md:h-[85px] flex flex-wrap justify-center items-center gap-4">
                        <!-- <img src="img/logocohost/Logo_yunan.png" alt="STIP Jakarta"
                            class="h-14 md:h-16 w-auto object-contain transition-all duration-300 ease-in-out hover:scale-110 cursor-pointer"> -->
                        <div class="border-2 border-dashed border-blue-200 rounded-2xl p-5 flex flex-col items-center justify-center min-w-[220px] bg-blue-50/30">
                            <p class="text-[10px] font-red text-red-600 uppercase tracking-widest leading-tight italic">Inviting Co-Hosts</p>
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter mt-1">Join Our Global Network</p>
                        </div>
                    </div>
                </div>

                <!-- Domestic Co-Host -->
                <div class="bg-white rounded-md p-3 md:p-4 h-32 md:h-36 shadow-lg text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="mb-3">
                        <span class="inline-block bg-[#ef233c] text-white font-black px-5 md:px-8 py-1 md:py-1.5 rounded-md shadow-sm text-xs md:text-sm leading-none">
                            Domestic Co-Host
                        </span>
                    </div>

                    <div class="h-[75px] md:h-[85px] flex flex-wrap justify-center items-center gap-4 md:gap-5">
                        <!-- <img src="img/logocohost/Logo_STIP_Jakarta.png" alt="STIP Jakarta"
                            class="h-12 md:h-14 w-auto object-contain transition-all duration-300 ease-in-out hover:scale-110 cursor-pointer"> -->
                        <div class="border-2 border-dashed border-blue-200 rounded-2xl p-5 flex flex-col items-center justify-center min-w-[220px] bg-blue-50/30">
                            <p class="text-[10px] font-red text-red-600 uppercase tracking-widest leading-tight italic">Inviting Domestic Co-Hosts</p>
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter mt-1">Join Our Global Network</p>
                        </div>

                    </div>
                </div>

                <!-- Sponsorship -->
                <div class="bg-white rounded-md p-3 md:p-4 h-32 md:h-36 shadow-lg text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="mb-3">
                        <span class="inline-block bg-[#ef233c] text-white font-black px-5 md:px-8 py-1 md:py-1.5 rounded-md shadow-sm text-xs md:text-sm leading-none">
                            Sponsorship
                        </span>
                    </div>

                    <div class="h-[75px] md:h-[85px] flex flex-wrap justify-center items-center gap-4">
                        <!-- <img src="img/logocohost/Logo_STIP_Jakarta.png" alt="STIP Jakarta"
                            class="h-12 md:h-14 w-auto object-contain transition-all duration-300 ease-in-out hover:scale-110 cursor-pointer"> -->
                        <div class="border-2 border-dashed border-blue-200 rounded-2xl p-5 flex flex-col items-center justify-center min-w-[220px] bg-blue-50/30">
                            <p class="text-[10px] font-red text-red-600 uppercase tracking-widest leading-tight italic">Inviting Sponsorship</p>
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter mt-1">Join Our Global Network</p>
                        </div>
                    </div>
                </div>

                <!-- Media Partner -->
                <div class="bg-white rounded-md p-3 md:p-4 h-32 md:h-36 shadow-lg text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="mb-3">
                        <span class="inline-block bg-[#ef233c] text-white font-black px-5 md:px-8 py-1 md:py-1.5 rounded-md shadow-sm text-xs md:text-sm leading-none">
                            Media Partner
                        </span>
                    </div>

                    <div class="h-[75px] md:h-[85px] flex flex-wrap justify-center items-center gap-4">
                        <!-- <img src="img/logocohost/Logo_STIP_Jakarta.png" alt="STIP Jakarta"
                            class="h-12 md:h-14 w-auto object-contain transition-all duration-300 ease-in-out hover:scale-110 cursor-pointer"> -->
                        <div class="border-2 border-dashed border-blue-200 rounded-2xl p-5 flex flex-col items-center justify-center min-w-[220px] bg-blue-50/30">
                            <p class="text-[10px] font-red text-red-600 uppercase tracking-widest leading-tight italic">Inviting Media Partner</p>
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter mt-1">Join Our Global Network</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Statistic -->
    <section id="statistic" class="py-24 relative overflow-hidden bg-slate-900 text-center">
        <div class="absolute inset-0 z-0">
            <img src="img/coverhalaman/isc_participant.png" alt="Statistic Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/20"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            
            <h2 class="text-2xl md:text-5xl font-black text-white mb-4 tracking-wider drop-shadow-lg">
                Current Participation Overview
            </h2>
            <p class="text-gray-200 font-medium mb-16 tracking-wide drop-shadow-md">
                Join the growing number of participants making an impact today!
            </p>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-10">
                
                <div class="flex flex-col items-center group">
                    <div class="text-white mb-6 text-5xl md:text-6xl transition-transform group-hover:scale-110 duration-300">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="text-5xl md:text-6xl font-black text-white drop-shadow-xl"><?= $count_participants ?></span>
                    <div class="w-12 h-1 bg-white/40 my-4 rounded-full"></div>
                    <p class="text-[10px] md:text-xs font-bold text-white uppercase tracking-widest px-2 opacity-90">Number of Participants</p>
                </div>

                <div class="flex flex-col items-center group">
                    <div class="text-white mb-6 text-5xl md:text-6xl transition-transform group-hover:scale-110 duration-300">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <span class="text-5xl md:text-6xl font-black text-white drop-shadow-xl"><?= $count_articles ?></span>
                    <div class="w-12 h-1 bg-white/40 my-4 rounded-full"></div>
                    <p class="text-[10px] md:text-xs font-bold text-white uppercase tracking-widest px-2 opacity-90">Number of Articles Submitted</p>
                </div>

                <div class="flex flex-col items-center group">
                    <div class="text-white mb-6 text-5xl md:text-6xl transition-transform group-hover:scale-110 duration-300">
                        <i class="fas fa-university"></i>
                    </div>
                    <span class="text-5xl md:text-6xl font-black text-white drop-shadow-xl"><?= $count_universities ?></span>
                    <div class="w-12 h-1 bg-white/40 my-4 rounded-full"></div>
                    <p class="text-[10px] md:text-xs font-bold text-white uppercase tracking-widest px-2 opacity-90">Number of Universities</p>
                </div>

                <div class="flex flex-col items-center group">
                    <div class="text-white mb-6 text-5xl md:text-6xl transition-transform group-hover:scale-110 duration-300">
                        <i class="fas fa-globe"></i>
                    </div>
                    <span class="text-5xl md:text-6xl font-black text-white drop-shadow-xl"><?= $count_countries ?></span>
                    <div class="w-12 h-1 bg-white/40 my-4 rounded-full"></div>
                    <p class="text-[10px] md:text-xs font-bold text-white uppercase tracking-widest px-2 opacity-90">Number of Countries Involved</p>
                </div>

                <div class="flex flex-col items-center col-span-2 md:col-span-1 group">
                    <div class="text-white mb-6 text-5xl md:text-6xl transition-transform group-hover:scale-110 duration-300">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <span class="text-5xl md:text-6xl font-black text-white drop-shadow-xl"><?= $count_non_presenter ?></span>
                    <div class="w-12 h-1 bg-white/40 my-4 rounded-full"></div>
                    <p class="text-[10px] md:text-xs font-bold text-white uppercase tracking-widest px-2 opacity-90">Non Presenter Participants</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Scope Paper -->
<section id="scope" class="py-8 md:py-10 relative overflow-hidden bg-[#f8f8f8]">

    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-40 h-40 bg-[#a50024]/5 rounded-full blur-3xl"></div>

    <div class="max-w-6xl mx-auto px-5 md:px-8 relative z-10">

        <div class="text-center mb-5 md:mb-6">
            <h2 class="text-2xl md:text-3xl font-black tracking-tight bg-gradient-to-r from-[#7f001c] to-[#d90429] bg-clip-text text-transparent">Paper Scope</h2>
            <p class="text-[#29235c] text-xs md:text-sm font-medium mt-1">Explore our areas of interest <span class="text-[#ef233c]">(but not limited to)</span></p>
        </div>

        <div class="relative group">

            <button id="prevBtn" class="absolute left-0 md:-left-3 top-1/2 -translate-y-1/2 z-30 w-8 h-8 md:w-9 md:h-9 bg-gray-500/80 hover:bg-gray-600 text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-md">
                <i class="fas fa-arrow-left text-xs md:text-sm"></i>
            </button>

            <div id="sliderWrapper" class="flex overflow-x-hidden scroll-smooth gap-3 md:gap-4 px-10 md:px-12 py-3 snap-x snap-mandatory">

                <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[30%] snap-center bg-white border border-[#ff9d00] rounded-2xl h-36 md:h-40 px-5 py-4 flex flex-col items-center justify-center text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ef233c]">
                    <div class="text-[#ef233c] text-4xl md:text-5xl mb-2"><i class="fas fa-brain"></i></div>
                    <h4 class="text-[#ef233c] font-medium text-xs md:text-sm leading-[1.05]">Artificial Intelligence,<br>Machine Learning &<br>Data Science</h4>
                </div>

                <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[30%] snap-center bg-white border border-[#ff9d00] rounded-2xl h-36 md:h-40 px-5 py-4 flex flex-col items-center justify-center text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ef233c]">
                    <div class="text-[#ef233c] text-4xl md:text-5xl mb-2"><i class="fas fa-cloud"></i></div>
                    <h4 class="text-[#ef233c] font-medium text-xs md:text-sm leading-[1.05]">Big Data &<br>Cloud Computing</h4>
                </div>

                <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[30%] snap-center bg-white border border-[#ff9d00] rounded-2xl h-36 md:h-40 px-5 py-4 flex flex-col items-center justify-center text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ef233c]">
                    <div class="text-[#ef233c] text-4xl md:text-5xl mb-2"><i class="fas fa-shield-halved"></i></div>
                    <h4 class="text-[#ef233c] font-medium text-xs md:text-sm leading-[1.05]">Cybersecurity &<br>Internet of Things<br>(IoT)</h4>
                </div>

                <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[30%] snap-center bg-white border border-[#ff9d00] rounded-2xl h-36 md:h-40 px-5 py-4 flex flex-col items-center justify-center text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ef233c]">
                    <div class="text-[#ef233c] text-4xl md:text-5xl mb-2"><i class="fas fa-graduation-cap"></i></div>
                    <h4 class="text-[#ef233c] font-medium text-xs md:text-sm leading-[1.05]">Digital Learning,<br>EdTech & Future Skills</h4>
                </div>

                <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[30%] snap-center bg-white border border-[#ff9d00] rounded-2xl h-36 md:h-40 px-5 py-4 flex flex-col items-center justify-center text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ef233c]">
                    <div class="text-[#ef233c] text-4xl md:text-5xl mb-2"><i class="fas fa-cart-shopping"></i></div>
                    <h4 class="text-[#ef233c] font-medium text-xs md:text-sm leading-[1.05]">Digital Business,<br>E-Commerce &<br>Entrepreneurship</h4>
                </div>

                <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[30%] snap-center bg-white border border-[#ff9d00] rounded-2xl h-36 md:h-40 px-5 py-4 flex flex-col items-center justify-center text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ef233c]">
                    <div class="text-[#ef233c] text-4xl md:text-5xl mb-2"><i class="fas fa-chart-line"></i></div>
                    <h4 class="text-[#ef233c] font-medium text-xs md:text-sm leading-[1.05]">Digital Marketing &<br>Global Competitiveness</h4>
                </div>

                <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[30%] snap-center bg-white border border-[#ff9d00] rounded-2xl h-36 md:h-40 px-5 py-4 flex flex-col items-center justify-center text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ef233c]">
                    <div class="text-[#ef233c] text-4xl md:text-5xl mb-2"><i class="fas fa-city"></i></div>
                    <h4 class="text-[#ef233c] font-medium text-xs md:text-sm leading-[1.05]">Smart City,<br>Smart Tourism &<br>Green Technology</h4>
                </div>

                <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[30%] snap-center bg-white border border-[#ff9d00] rounded-2xl h-36 md:h-40 px-5 py-4 flex flex-col items-center justify-center text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ef233c]">
                    <div class="text-[#ef233c] text-4xl md:text-5xl mb-2"><i class="fas fa-users"></i></div>
                    <h4 class="text-[#ef233c] font-medium text-xs md:text-sm leading-[1.05]">Digital Society,<br>Ethics & Human-Centered<br>Technology</h4>
                </div>

                <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[30%] snap-center bg-white border border-[#ff9d00] rounded-2xl h-36 md:h-40 px-5 py-4 flex flex-col items-center justify-center text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ef233c]">
                    <div class="text-[#ef233c] text-4xl md:text-5xl mb-2"><i class="fas fa-globe"></i></div>
                    <h4 class="text-[#ef233c] font-medium text-xs md:text-sm leading-[1.05]">Cross-Cultural Communication<br>& Global Collaboration</h4>
                </div>

                <div class="min-w-[85%] sm:min-w-[45%] md:min-w-[30%] snap-center bg-white border border-[#ff9d00] rounded-2xl h-36 md:h-40 px-5 py-4 flex flex-col items-center justify-center text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ef233c]">
                    <div class="text-[#ef233c] text-4xl md:text-5xl mb-2"><i class="fas fa-gears"></i></div>
                    <h4 class="text-[#ef233c] font-medium text-xs md:text-sm leading-[1.05]">IT/IS Governance,<br>Audit & Technology Adoption</h4>
                </div>

            </div>

            <button id="nextBtn" class="absolute right-0 md:-right-3 top-1/2 -translate-y-1/2 z-30 w-8 h-8 md:w-9 md:h-9 bg-gray-500/80 hover:bg-gray-600 text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-md">
                <i class="fas fa-arrow-right text-xs md:text-sm"></i>
            </button>

        </div>

        <div class="mt-3 md:mt-4 text-center">
            <p class="text-[#111] text-[10px] md:text-xs font-medium leading-tight max-w-4xl mx-auto">
                Accepted papers will be published in the <span class="font-semibold">International Conference on Business,<br class="md:hidden"> Innovation, Technology, and Science (ICoBITS)</span> - icobits.ubhinus.ac.id
            </p>
        </div>

    </div>
</section>
    
    <!-- Section Benefit -->
    <section id="benefits" class="py-24 relative overflow-hidden bg-[#070620]">
    <div class="absolute inset-0 z-0">
            <img src="img/coverhalaman/isc_benefits.png" alt="Statistic Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/20"></div>
        </div>
    <div class="max-w-6xl mx-auto px-6 relative z-10">
        
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-black text-white tracking-widest">
                Benefits
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">

            <div class="flex flex-col items-center group bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-10 shadow-2xl transition-all duration-300 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-2">
                <div class="w-28 h-28 mb-8 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                    <img src="img/icon/icon_grandprize.png" alt="Prize Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="font-bold text-white text-base md:text-lg leading-tight tracking-wide">
                    Grand Prize 50 USD for #1 Best Paper
                </h3>
            </div>

            <div class="flex flex-col items-center group bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-10 shadow-2xl transition-all duration-300 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-2">
                <div class="w-28 h-28 mb-8 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                    <img src="img/icon/icon_sertifikat.png" alt="Certificate Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="font-bold text-white text-base md:text-lg leading-tight tracking-wide">
                    E-Certificate
                </h3>
            </div>

        </div>

    </div>
</section>

    <!-- Important Dates -->
    <section id="important-dates" class="py-24 relative overflow-hidden bg-black">

        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="img/coverhalaman/isc_date.png" 
                alt="Important Dates Background" 
                class="w-full h-full object-cover opacity-100">
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/20 z-0"></div>

        <!-- Content -->
        <div class="max-w-6xl mx-auto px-6 relative z-10">

            <!-- Section Title -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-white tracking-wider">
                    Important Dates
                </h2>
            </div>

            <!-- Dates Grid -->
            <div class="dates-grid grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">

                <!-- Date 1 -->
                <div class="date-card flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-all duration-300 hover:scale-[1.03]">

                    <div class="date-box bg-gradient-to-b from-[#fca105] to-[#fe6102] text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[150px]">
                        <span class="text-xl md:text-2xl font-black">
                            Nov 14
                        </span>
                        <span class="text-lg md:text-xl font-bold">
                            2026
                        </span>
                    </div>

                    <div class="bg-white flex-grow flex items-center px-6 py-5">
                        <p class="text-[#070620] font-bold text-sm md:text-lg leading-tight">
                            Deadline for Abstract Submission and Payment
                        </p>
                    </div>

                </div>


                <!-- Date 2 -->
                <div class="date-card flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-all duration-300 hover:scale-[1.03]">

                    <div class="date-box bg-gradient-to-b from-[#fca105] to-[#fe6102] text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[150px]">
                        <span class="text-xl md:text-2xl font-black">
                            Nov 21
                        </span>
                        <span class="text-lg md:text-xl font-bold">
                            2026
                        </span>
                    </div>

                    <div class="bg-white flex-grow flex items-center px-6 py-5">
                        <p class="text-[#070620] font-bold text-sm md:text-lg leading-tight">
                            Abstract Acceptance Announcement
                        </p>
                    </div>

                </div>


                <!-- Date 3 -->
                <div class="date-card flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-all duration-300 hover:scale-[1.03]">

                    <div class="date-box bg-gradient-to-b from-[#fca105] to-[#fe6102] text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[150px]">
                        <span class="text-xl md:text-2xl font-black">
                            Nov 28
                        </span>
                        <span class="text-lg md:text-xl font-bold">
                            2026
                        </span>
                    </div>

                    <div class="bg-white flex-grow flex items-center px-6 py-5">
                        <p class="text-[#070620] font-bold text-sm md:text-lg leading-tight">
                            Full Paper Submission Deadline
                        </p>
                    </div>

                </div>


                <!-- Date 4 -->
                <div class="date-card flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-all duration-300 hover:scale-[1.03]">

                    <div class="date-box bg-gradient-to-b from-[#fca105] to-[#fe6102] text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[150px]">
                        <span class="text-xl md:text-2xl font-black">
                            Des 5
                        </span>
                        <span class="text-lg md:text-xl font-bold">
                            2026
                        </span>
                    </div>

                    <div class="bg-white flex-grow flex items-center px-6 py-5">
                        <p class="text-[#070620] font-bold text-sm md:text-lg leading-tight">
                            Full Paper Acceptance Announcement
                        </p>
                    </div>

                </div>


                <!-- Date 5 -->
                <div class="date-card flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-all duration-300 hover:scale-[1.03]">

                    <div class="date-box bg-gradient-to-b from-[#fca105] to-[#fe6102] text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[150px]">
                        <span class="text-xl md:text-2xl font-black">
                            Des 11
                        </span>
                        <span class="text-lg md:text-xl font-bold">
                            2026
                        </span>
                    </div>

                    <div class="bg-white flex-grow flex items-center px-6 py-5">
                        <p class="text-[#070620] font-bold text-sm md:text-lg leading-tight">
                            Socialization and Briefing for Presenters
                        </p>
                    </div>

                </div>

                <!-- Date 6 -->
                <div class="date-card flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-all duration-300 hover:scale-[1.03]">

                    <div class="date-box bg-gradient-to-b from-[#fca105] to-[#fe6102] text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[150px]">
                        <span class="text-xl md:text-2xl font-black">
                            Des 16
                        </span>
                        <span class="text-lg md:text-xl font-bold">
                            2026
                        </span>
                    </div>

                    <div class="bg-white flex-grow flex items-center px-6 py-5">
                        <p class="text-[#070620] font-bold text-sm md:text-lg leading-tight">
                            The 5th International Student Conference 2026
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- Style untuk Important Dates -->
    <style>

        /* =========================================
        IMPORTANT DATES
        ========================================= */

        .dates-grid {width: 100%;}
        .date-card {min-height: 90px;}

        @media (min-width: 768px) {

            .dates-grid > .date-card:last-child:nth-child(odd) {
                grid-column: 1 / -1;
                width: 50%;
                justify-self: center;
            }

        }

        /* Efek hover tanggal */
        .date-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
        }

        /* Responsive mobile */
        @media (max-width: 767px) {

            .date-card {
                width: 100%;
            }

            .date-box {
                min-width: 105px !important;
            }

        }

    </style>

    <!-- Important Fee -->
    <section id="registration-fee" class="py-20 relative overflow-hidden bg-white">

    <!-- Background Image - TETAP DIPERTAHANKAN -->
    <div class="absolute inset-0 z-0">
        <img src="img/coverhalaman/cover_prosesregis.png"
             alt="Fee Background"
             class="w-full h-full object-cover opacity-[0.08]">

        <!-- White Overlay -->
        <div class="absolute inset-0 bg-white/90"></div>
    </div>


    <!-- Content -->
    <div class="max-w-6xl mx-auto px-6 relative z-10">

        <!-- Title -->
        <div class="text-center mb-8">

            <h2 class="text-3xl md:text-4xl font-black text-[#18004f] tracking-tight">
                Registration Fee
            </h2>

        </div>


        <!-- Registration Fee Table -->
        <div class="w-full overflow-x-auto">
            <div class="min-w-[620px]">
                <table class="w-full border-collapse border border-gray-300 text-sm md:text-base">
                    <thead>
                        <tr class="bg-[#17104f] text-white">
                            <th class="border border-gray-300 px-4 py-2.5 text-left font-bold">Category</th>
                            <th class="border border-gray-300 px-4 py-2.5 text-center font-bold">Early Bird</th>
                            <th class="border border-gray-300 px-4 py-2.5 text-center font-bold">Regular</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <tr class="bg-[#f3f0ff]">
                            <td colspan="3" class="border border-gray-300 px-4 py-2 font-black text-[#17104f]">Domestic</td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2 font-medium text-[#18004f]">Student</td>
                            <td class="border border-gray-300 px-4 py-2 text-center text-[#18004f]">300.000 IDR</td>
                            <td class="border border-gray-300 px-4 py-2 text-center text-[#18004f]">350.000 IDR</td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2 font-medium text-[#18004f]">Non-Student</td>
                            <td class="border border-gray-300 px-4 py-2 text-center text-[#18004f]">350.000 IDR</td>
                            <td class="border border-gray-300 px-4 py-2 text-center text-[#18004f]">400.000 IDR</td>
                        </tr>

                        <tr class="bg-[#f3f0ff]">
                            <td colspan="3" class="border border-gray-300 px-4 py-2 font-black text-[#17104f]">International</td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2 font-medium text-[#18004f]">Student</td>
                            <td colspan="2" class="border border-gray-300 px-4 py-2 text-center text-[#18004f]">40 USD</td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2 font-medium text-[#18004f]">Non-Student</td>
                            <td colspan="2" class="border border-gray-300 px-4 py-2 text-center text-[#18004f]">50 USD</td>
                        </tr>

                        <tr class="bg-[#f3f0ff]">
                            <td colspan="3" class="border border-gray-300 px-4 py-2 font-black text-[#17104f]">Participant</td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2 font-medium text-[#18004f]">Domestic</td>
                            <td colspan="2" class="border border-gray-300 px-4 py-2 text-center text-[#18004f]">50.000 IDR</td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2 font-medium text-[#18004f]">International</td>
                            <td colspan="2" class="border border-gray-300 px-4 py-2 text-center text-[#18004f]">9 USD</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Information -->
        <div class="mt-8 text-center">
            <p class="text-sm text-[#18004f]/70 font-medium">
                Registration fee includes E-Certificate and Publication in Conference Proceedings.
            </p>
        </div>
    </div>

</section>        

    <!-- Section CQuotes -->
    <section id="quote-section" class="relative py-12 md:py-16 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="img/coverhalaman/isc_quotes.png" alt="Conference Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/65"></div>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="flex items-center justify-center min-h-[220px]">
                <div class="w-full max-w-5xl text-center">
                    <blockquote class="relative">
                        <br><br><br><br>
                        
                        <!-- Quote Text -->
                        <p class="text-white text-sm md:text-base lg:text-lg font-medium italic leading-relaxed max-w-4xl mx-auto">
                            "Innovation is the ability to see change as an opportunity, not a threat. In the rapidly evolving world of technology, those who can embrace and harness the power of change will shape the future."
                        </p>

                        <!-- Author -->
                        <footer class="mt-6 text-center">
                            <div class="flex items-center justify-center gap-3 mb-2">
                                <div class="h-px w-8 bg-white/60"></div>
                                <span class="text-white text-sm md:text-base font-medium italic">
                                    Steve Jobs
                                </span>
                                <div class="h-px w-8 bg-white/60"></div>
                            </div>
                            <span class="text-white text-xs md:text-sm font-medium italic">
                                CEO of Apple.
                            </span>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Contact -->
<section id="contact" class="py-24 relative overflow-hidden bg-[#0747b9]">
    <div class="absolute inset-0 z-0">
        <img src="img/coverhalaman/isc_contactus.png"alt="Conference Background"
             class="w-full h-full object-cover">
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10 text-center">

        <div class="mb-16">
            <div class="inline-block bg-gradient-to-r from-[#00073e] via-[#3a164e] to-[#fe0000] text-white font-black px-12 py-3 rounded-sm shadow-xl uppercase tracking-widest text-lg md:text-2xl mb-6">
                Get In Touch With Us
            </div>
            <p class="text-white font-medium text-lg md:text-xl tracking-wide">
                Still have Questions? Contact Us using the Form below
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-24">
            <div class="relative border border-white/50 rounded-2xl p-8 pt-16 bg-white/10 backdrop-blur-sm transition-all hover:bg-white/20 group">
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-full flex items-center justify-center text-[#0747b9] shadow-2xl transition-transform group-hover:scale-110">
                    <i class="fas fa-map-marker-alt text-3xl"></i>
                </div>
                <h4 class="text-white font-black text-lg uppercase tracking-tight mb-4">
                    Our Headquarters
                </h4>
                <p class="text-white text-sm leading-relaxed font-medium">
                    Bhinneka Nusantara University
                </p>
            </div>


            <div class="relative border border-white/50 rounded-2xl p-8 pt-16 bg-white/10 backdrop-blur-sm transition-all hover:bg-white/20 group">
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-full flex items-center justify-center text-[#0747b9] shadow-2xl transition-transform group-hover:scale-110">
                    <i class="fab fa-whatsapp text-4xl"></i>
                </div>
                <h4 class="text-white font-black text-lg uppercase tracking-tight mb-4">
                    Ask Us
                </h4>
                <div class="text-white text-sm font-bold space-y-1">
                    <p>+62 813-3260-2997 <span class="font-normal">(Icha)</span></p>
                </div>
            </div>


            <div class="relative border border-white/50 rounded-2xl p-8 pt-16 bg-white/10 backdrop-blur-sm transition-all hover:bg-white/20 group">
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-full flex items-center justify-center text-[#0747b9] shadow-2xl transition-transform group-hover:scale-110">
                    <i class="fas fa-envelope text-3xl"></i>
                </div>
                <h4 class="text-white font-black text-lg uppercase tracking-tight mb-4">
                    Mail Us
                </h4>
                <p class="text-white text-sm font-bold break-all">
                    conference@ubhinus.ac.id
                </p>
            </div>


            <div class="relative border border-white/50 rounded-2xl p-8 pt-16 bg-white/10 backdrop-blur-sm transition-all hover:bg-white/20 group">
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-full flex items-center justify-center text-[#0747b9] shadow-2xl transition-transform group-hover:scale-110">
                    <i class="fab fa-instagram text-3xl"></i>
                </div>
                <h4 class="text-white font-black text-lg uppercase tracking-tight mb-4">
                    Our Instagram
                </h4>
                <p class="text-white text-sm font-bold">
                    @conference.ubhinus
                </p>
            </div>

        </div>
    </div>
</section>

        <footer class="bg-black pt-16 pb-12 relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none z-0 opacity-20">
        <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-blue-900 rounded-full blur-[100px]"></div>
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-blue-900 rounded-full blur-[100px]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-12">
            
            <div class="flex flex-col items-center md:items-start">
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 mb-8">
                    <img src="img/logocohost/ubhinus_logo.png" alt="University Logo" class="h-8 md:h-11 w-auto object-contain">
                    <img src="img/logocohost/logo_uic_putih.png" alt="Digits Logo" class="h-8 md:h-11 w-auto object-contain">
                    <img src="img/logocohost/logo_isc.png" alt="Digits Logo" class="h-8 md:h-11 w-auto object-contain">
                </div>
                <p class="text-white text-[10px] md:text-xs italic tracking-wide opacity-90">
                    Copyrights & copy; 2026 All Rights Reserved by UBHINUS International Student Conference.
                </p>
            </div>

            <div class="flex flex-col items-center md:items-end w-full md:w-auto">
                <nav class="mb-8">
                    <ul class="flex flex-wrap justify-center md:justify-end gap-1 text-white text-xs md:text-sm font-medium">
                        <li><a href="#home" class="hover:text-blue-400 transition-colors">Home</a> /</li>
                        <li><a href="#about" class="hover:text-blue-400 transition-colors">About</a> /</li>
                        <li><a href="#speakers" class="hover:text-blue-400 transition-colors">Speakers</a> /</li>
                        <li><a href="#statistic" class="hover:text-blue-400 transition-colors">Statistics</a> /</li>
                        <li><a href="#important-dates" class="hover:text-blue-400 transition-colors">Dates</a> /</li>
                        <li><a href="#contact" class="hover:text-blue-400 transition-colors">Contact</a></li>
                    </ul>
                </nav>

                <div class="flex gap-4">
                    <a href="https://www.facebook.com/conference.ubhinus/" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-black hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-xl">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="https://www.instagram.com/conference.ubhinus/" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-black hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-xl">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="mailto:conference@ubhinus.ac.id" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-black hover:bg-blue-400 hover:text-white transition-all duration-300 shadow-xl">
                        <i class="fas fa-envelope text-lg"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</footer>

<script>
document.addEventListener("DOMContentLoaded", function () {


    // =========================================================
    // 1. LOGIKA COUNTDOWN
    // Deadline: November 14, 2026
    // =========================================================

    const submissionDeadline = new Date("Oct 24, 2026 23:59:59").getTime();
    const countdownSubmission = setInterval(function () {

        const now = new Date().getTime();
        const distance = submissionDeadline - now;


        // Jika deadline sudah lewat
        if (distance <= 0) {

            clearInterval(countdownSubmission);


            // Ubah label countdown
            const countdownLabel = document.getElementById("countdown-label");

            if (countdownLabel) {
                countdownLabel.innerHTML = "Submission Closed";
            } 
            // Reset countdown
            const daysElement = document.getElementById("days");
            const hoursElement = document.getElementById("hours");
            const minutesElement = document.getElementById("minutes");
            const secondsElement = document.getElementById("seconds");

            if (daysElement) {
                daysElement.innerHTML = "00";
            }

            if (hoursElement) {
                hoursElement.innerHTML = "00";
            }

            if (minutesElement) {
                minutesElement.innerHTML = "00";
            }

            if (secondsElement) {
                secondsElement.innerHTML = "00";
            }

            // Nonaktifkan tombol Submit
            const btnSubmit = document.querySelector(
                'a[href="registration.php"]'
            );


            if (btnSubmit) {
                btnSubmit.innerHTML = "Submission Closed";
                btnSubmit.classList.remove(
                    "bg-blue-600",
                    "hover:bg-yellow-400",
                    "hover:text-slate-900",
                    "hover:scale-105"
                );

                btnSubmit.classList.add(
                    "bg-gray-500",
                    "cursor-not-allowed"
                );

                // Kunci akses tombol
                btnSubmit.setAttribute(
                    "onclick",
                    "return false;"
                );
            }
            return;
        }


        // =====================================================
        // Hitung waktu yang tersisa
        // =====================================================

        const days = Math.floor(
            distance / (1000 * 60 * 60 * 24)
        );

        const hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24))
            / (1000 * 60 * 60)
        );

        const minutes = Math.floor(
            (distance % (1000 * 60 * 60))
            / (1000 * 60)
        );

        const seconds = Math.floor(
            (distance % (1000 * 60))
            / 1000
        );


        // =====================================================
        // Render countdown
        // =====================================================

        const daysElement = document.getElementById("days");
        const hoursElement = document.getElementById("hours");
        const minutesElement = document.getElementById("minutes");
        const secondsElement = document.getElementById("seconds");
        const countdownLabel = document.getElementById("countdown-label");


        if (daysElement) {daysElement.innerHTML = days < 10 ? "0" + days : days;}
        if (hoursElement) {hoursElement.innerHTML = hours < 10 ? "0" + hours : hours;}
        if (minutesElement) {minutesElement.innerHTML = minutes < 10 ? "0" + minutes : minutes;}
        if (secondsElement) {secondsElement.innerHTML = seconds < 10 ? "0" + seconds : seconds;}
        if (countdownLabel) {countdownLabel.innerHTML = "Paper Submission Deadline";}

    }, 1000);



    // =========================================================
    // 2. SLIDER SCOPE
    // =========================================================

    const wrapper = document.getElementById("sliderWrapper");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");


    if (wrapper && nextBtn && prevBtn) {

        nextBtn.addEventListener("click", function () {

            const firstCard = wrapper.querySelector("div");

            if (!firstCard) {
                return;
            }


            const cardWidth =
                firstCard.offsetWidth + 32;

            wrapper.scrollBy({
                left: cardWidth,
                behavior: "smooth"
            });
        });


        prevBtn.addEventListener("click", function () {
            const firstCard = wrapper.querySelector("div");
            if (!firstCard) {
                return;}
            const cardWidth =firstCard.offsetWidth + 32; 
                wrapper.scrollBy({left: -cardWidth,behavior: "smooth"});
        });
    }



    // =========================================================
    // 3. CAROUSEL KEYNOTE SPEAKERS
    // =========================================================

    const speakerCarousel = document.getElementById("speakerCarousel");
    const speakerPrev = document.getElementById("speakerPrev");
    const speakerNext = document.getElementById("speakerNext");

    if (speakerCarousel && speakerPrev && speakerNext) {

        // Menentukan jarak geser = lebar kartu + gap
        function getSpeakerScrollAmount() {
            const speakerCard = speakerCarousel.querySelector(".snap-start");
            if (!speakerCard) return 300;

            const styles = window.getComputedStyle(speakerCarousel);
            const gap = parseFloat(styles.columnGap || styles.gap) || 0;

            return speakerCard.offsetWidth + gap;
        }

        // NEXT
        speakerNext.addEventListener("click", function () {
            speakerCarousel.scrollBy({
                left: getSpeakerScrollAmount(),
                behavior: "smooth"
            });
        });

        // PREVIOUS
        speakerPrev.addEventListener("click", function () {
            speakerCarousel.scrollBy({
                left: -getSpeakerScrollAmount(),
                behavior: "smooth"
            });
        });

        // KEYBOARD ARROW
        speakerCarousel.addEventListener("keydown", function (event) {
            if (event.key === "ArrowRight") {
                event.preventDefault();
                speakerCarousel.scrollBy({
                    left: getSpeakerScrollAmount(),
                    behavior: "smooth"
                });
            }

            if (event.key === "ArrowLeft") {
                event.preventDefault();
                speakerCarousel.scrollBy({
                    left: -getSpeakerScrollAmount(),
                    behavior: "smooth"
                });
            }
        });
    }
});
</script>
</body>
</html>