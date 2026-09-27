<?php
require_once '../config.php';
require_once 'auth_check.php';

$stats = [
    'total' => $pdo->query("SELECT COUNT(*) FROM registrations")->fetchColumn(),
    'presenter' => $pdo->query("SELECT COUNT(*) FROM registrations WHERE type = 'Presenter'")->fetchColumn(),
    'non_presenter' => $pdo->query("SELECT COUNT(*) FROM registrations WHERE type = 'Non Presenter'")->fetchColumn(),
    'verified' => $pdo->query("SELECT COUNT(*) FROM registrations WHERE apply = 'Verified'")->fetchColumn()
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - DIGITS 2026</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .menu-item {
            transition: all 0.25s ease;
        }

        .menu-item:hover {
            background: #f3f4f6;
            color: #00073e;
            transform: translateX(3px);
        }

        .stat-card {
            transition: all 0.25s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(0, 7, 62, 0.08);
        }
    </style>
</head>

<body class="bg-[#f5f6f8] text-gray-800 min-h-screen">

    <!-- SIDEBAR -->
    <aside class="fixed left-0 top-0 bottom-0 w-64 bg-white border-r border-gray-200 z-30 hidden md:flex flex-col">

        <!-- Logo -->
        <div class="px-7 py-7 border-b border-gray-100">
            <div class="flex items-center gap-3">

                <div>
                    <h1 class="text-lg font-bold text-[#00073e] leading-none">
                        ISC
                    </h1>

                    <p class="text-xs text-[#fe0000] font-semibold mt-1">
                        Admin Panel
                    </p>
                </div>

            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6">

            <p class="px-3 mb-3 text-[10px] font-bold text-gray-400 tracking-wider">
                MENU
            </p>

            <div class="space-y-1">

                <a href="index.php"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#00073e] text-white text-sm font-semibold">
                    <i class="fas fa-chart-pie w-5 text-center"></i>
                    Dashboard
                </a>

                <a href="belum_setuju.php"
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 text-sm font-medium">
                    <i class="fas fa-clock w-5 text-center text-orange-500"></i>
                    Pending Review
                </a>

                <a href="sudah_setuju.php"
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 text-sm font-medium">
                    <i class="fas fa-circle-check w-5 text-center text-green-600"></i>
                    Verified Data
                </a>

            </div>

        </nav>

        <!-- Logout -->
        <div class="px-4 py-5 border-t border-gray-100">

            <a href="logout.php"
               onclick="return confirm('Apakah Anda yakin ingin keluar?')"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:text-[#fe0000] text-sm font-medium">

                <i class="fas fa-right-from-bracket w-5 text-center"></i>
                Logout

            </a>

        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="md:ml-64 min-h-screen">

        <!-- TOP BAR -->
        <header class="bg-white border-b border-gray-200 px-6 md:px-10 py-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs text-gray-400 mb-1">
                        Administration
                    </p>

                    <h2 class="text-xl md:text-2xl font-bold text-[#00073e]">
                        Dashboard
                    </h2>
                </div>

                <div class="hidden sm:flex items-center gap-3">

                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-700">
                            Administrator
                        </p>

                        <p class="text-xs text-gray-400">
                            ISC 2026
                        </p>
                    </div>

                    <div class="w-10 h-10 rounded-full bg-[#00073e] flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>

                </div>

            </div>

        </header>


        <!-- CONTENT -->
        <div class="p-6 md:p-10">

            <!-- Welcome -->
            <div class="mb-8">

                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3">

                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">
                            Conference Overview
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Monitor registration activity and participant information.
                        </p>
                    </div>

                    <div class="text-sm text-gray-400">
                        <?= date('l, d F Y') ?>
                    </div>

                </div>

            </div>


            <!-- STATISTICS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

                <!-- Total -->
                <div class="stat-card bg-white rounded-2xl border border-gray-200 p-6">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-xs font-semibold text-gray-400">
                                Total Registrants
                            </p>

                            <h3 class="text-3xl font-bold text-[#00073e] mt-3">
                                <?= $stats['total'] ?>
                            </h3>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-blue-50 text-[#00073e] flex items-center justify-center">
                            <i class="fas fa-users"></i>
                        </div>

                    </div>

                    <div class="mt-5 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400">
                            All registered participants
                        </p>
                    </div>

                </div>


                <!-- Presenter -->
                <div class="stat-card bg-white rounded-2xl border border-gray-200 p-6">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-xs font-semibold text-gray-400">
                                Presenters
                            </p>

                            <h3 class="text-3xl font-bold text-[#00073e] mt-3">
                                <?= $stats['presenter'] ?>
                            </h3>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-red-50 text-[#fe0000] flex items-center justify-center">
                            <i class="fas fa-microphone"></i>
                        </div>

                    </div>

                    <div class="mt-5 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400">
                            Registered as presenters
                        </p>
                    </div>

                </div>


                <!-- Non Presenter -->
                <div class="stat-card bg-white rounded-2xl border border-gray-200 p-6">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-xs font-semibold text-gray-400">
                                Non-Presenters
                            </p>

                            <h3 class="text-3xl font-bold text-[#00073e] mt-3">
                                <?= $stats['non_presenter'] ?>
                            </h3>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center">
                            <i class="fas fa-user"></i>
                        </div>

                    </div>

                    <div class="mt-5 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400">
                            Registered participants
                        </p>
                    </div>

                </div>


                <!-- Verified -->
                <div class="stat-card bg-white rounded-2xl border border-gray-200 p-6">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-xs font-semibold text-gray-400">
                                Verified
                            </p>

                            <h3 class="text-3xl font-bold text-green-600 mt-3">
                                <?= $stats['verified'] ?>
                            </h3>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-green-50 text-green-600 flex items-center justify-center">
                            <i class="fas fa-check"></i>
                        </div>

                    </div>

                    <div class="mt-5 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400">
                            Verified registration data
                        </p>
                    </div>

                </div>

            </div>


            <!-- INFORMATION PANEL -->
            <div class="mt-8 bg-[#00073e] rounded-2xl p-6 md:p-7 text-white">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                    <div class="flex items-start gap-4">

                        <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                            <i class="fas fa-shield-halved text-white"></i>
                        </div>

                        <div>
                            <h4 class="font-semibold text-base">
                                Administration Area
                            </h4>

                            <p class="text-sm text-white/60 mt-1 max-w-2xl">
                                Registration information is managed through this administration panel.
                                Please review participant data carefully before verification.
                            </p>
                        </div>

                    </div>

                    <a href="belum_setuju.php"
                       class="shrink-0 inline-flex items-center justify-center gap-2 px-5 py-3 bg-[#fe0000] hover:bg-[#d90000] rounded-xl text-sm font-semibold transition-all">

                        Review Pending
                        <i class="fas fa-arrow-right text-xs"></i>

                    </a>

                </div>

            </div>


            <!-- FOOTER -->
            <div class="mt-8 text-center">

                <p class="text-xs text-gray-400">
                    © 2026 Universitas Bhinneka Nusantara · DIGITS 2026
                </p>

            </div>

        </div>

    </main>

</body>
</html>