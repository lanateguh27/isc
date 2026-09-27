<?php
require_once '../config.php';
require_once 'auth_check.php';

$pending = $pdo->query("SELECT * FROM registrations WHERE apply = 'Pending' ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Review - DIGITS 2026</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .menu-item,
        .table-row,
        .action-btn {
            transition: all 0.25s ease;
        }

        .menu-item:hover {
            background: #f3f4f6;
            color: #00073e;
            transform: translateX(3px);
        }

        .table-row:hover {
            background: #f9fafb;
        }

        .action-btn:hover {
            transform: translateY(-1px);
        }

        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c7c9d1;
            border-radius: 10px;
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
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 text-sm font-medium">
                    <i class="fas fa-chart-pie w-5 text-center"></i>
                    Dashboard
                </a>

                <a href="belum_setuju.php"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#00073e] text-white text-sm font-semibold">
                    <i class="fas fa-clock w-5 text-center"></i>
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


    <!-- MAIN -->
    <main class="md:ml-64 min-h-screen">

        <!-- TOP BAR -->
        <header class="bg-white border-b border-gray-200 px-6 md:px-10 py-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs text-gray-400 mb-1">
                        Registration Management
                    </p>

                    <h2 class="text-xl md:text-2xl font-bold text-[#00073e]">
                        Pending Review
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

            <!-- PAGE INTRO -->
            <div class="mb-7">

                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">

                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">
                            Registration Review
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Review submitted registrations before approving them.
                        </p>
                    </div>

                    <div class="inline-flex items-center gap-2 self-start lg:self-auto bg-orange-50 border border-orange-100 text-orange-600 px-4 py-2 rounded-xl text-sm font-semibold">
                        <i class="fas fa-clock"></i>
                        <?= count($pending) ?> Pending
                    </div>

                </div>

            </div>


            <!-- TABLE CARD -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                <!-- Table Header -->
                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                            <i class="fas fa-list-check"></i>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-800">
                                Pending Registrations
                            </h4>

                            <p class="text-xs text-gray-400 mt-0.5">
                                Data awaiting administrator approval
                            </p>
                        </div>

                    </div>

                </div>


                <!-- Responsive Table -->
                <div class="overflow-x-auto">

                    <table class="w-full min-w-[900px] text-left">

                        <thead class="bg-gray-50 border-b border-gray-200">

                            <tr class="text-[11px] font-bold text-gray-500">

                                <th class="px-6 py-4">
                                    ID
                                </th>

                                <th class="px-6 py-4">
                                    Type
                                </th>

                                <th class="px-6 py-4">
                                    Email
                                </th>

                                <th class="px-6 py-4">
                                    Author
                                </th>

                                <th class="px-6 py-4">
                                    Documents
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            <?php if(empty($pending)): ?>

                                <tr>

                                    <td colspan="6" class="px-6 py-20 text-center">

                                        <div class="flex flex-col items-center">

                                            <div class="w-14 h-14 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center mb-4">
                                                <i class="fas fa-inbox text-xl"></i>
                                            </div>

                                            <h4 class="font-semibold text-gray-600">
                                                No Pending Registrations
                                            </h4>

                                            <p class="text-sm text-gray-400 mt-1">
                                                There are currently no registrations waiting for review.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            <?php endif; ?>


                            <?php foreach($pending as $row): ?>

                                <tr class="table-row">

                                    <!-- ID -->
                                    <td class="px-6 py-5">

                                        <span class="text-sm font-bold text-[#00073e]">
                                            #<?= $row['id'] ?>
                                        </span>

                                    </td>


                                    <!-- TYPE -->
                                    <td class="px-6 py-5">

                                        <span class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg text-xs font-semibold border border-blue-100">
                                            <?= $row['type'] ?>
                                        </span>

                                    </td>


                                    <!-- EMAIL -->
                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-2">

                                            <i class="fas fa-envelope text-gray-400 text-xs"></i>

                                            <span class="text-sm text-gray-600">
                                                <?= $row['email'] ?>
                                            </span>

                                        </div>

                                    </td>


                                    <!-- AUTHOR -->
                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-2">

                                            <div class="w-8 h-8 rounded-full bg-[#00073e] text-white flex items-center justify-center text-xs font-bold">
                                                <?= strtoupper(substr($row['author1'], 0, 1)) ?>
                                            </div>

                                            <span class="text-sm font-semibold text-gray-700">
                                                <?= $row['author1'] ?>
                                            </span>

                                        </div>

                                    </td>


                                    <!-- FILES -->
                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-2">

                                            <?php if (!empty($row['abstract_file'])): ?>

                                                <a href="../uploads/abstracts/<?= $row['abstract_file'] ?>"
                                                   download="<?= $row['abstract_file'] ?>"
                                                   target="_blank"
                                                   title="Open & Download Abstract"
                                                   class="action-btn w-9 h-9 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white border border-blue-100">

                                                    <i class="fas fa-file-pdf text-sm"></i>

                                                </a>

                                            <?php else: ?>

                                                <div title="No Abstract Uploaded"
                                                     class="w-9 h-9 bg-gray-100 text-gray-300 rounded-lg flex items-center justify-center">

                                                    <i class="fas fa-file-pdf text-sm"></i>

                                                </div>

                                            <?php endif; ?>


                                            <?php if (!empty($row['payment_receipt'])): ?>

                                                <a href="../uploads/receipts/<?= $row['payment_receipt'] ?>"
                                                   target="_blank"
                                                   title="View Receipt Picture"
                                                   class="action-btn w-9 h-9 bg-red-50 text-[#fe0000] rounded-lg flex items-center justify-center hover:bg-[#fe0000] hover:text-white border border-red-100">

                                                    <i class="fas fa-receipt text-sm"></i>

                                                </a>

                                            <?php else: ?>

                                                <div title="No Receipt"
                                                     class="w-9 h-9 bg-gray-100 text-gray-300 rounded-lg flex items-center justify-center">

                                                    <i class="fas fa-receipt text-sm"></i>

                                                </div>

                                            <?php endif; ?>

                                        </div>

                                    </td>


                                    <!-- ACTIONS -->
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-2">

                                            <button
                                                onclick="openDetail(<?= htmlspecialchars(json_encode($row)) ?>)"
                                                class="action-btn inline-flex items-center gap-2 bg-[#00073e] hover:bg-[#fe0000] text-white px-4 py-2.5 rounded-lg text-xs font-semibold">

                                                <i class="fas fa-eye"></i>
                                                Detail

                                            </button>


                                            <a
                                                href="actions.php?delete=<?= $row['id'] ?>&from=belum"
                                                onclick="return confirm('Hapus Permanen?')"
                                                title="Delete Registration"
                                                class="action-btn w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:bg-red-50 hover:text-[#fe0000]">

                                                <i class="fas fa-trash-alt text-sm"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- INFORMATION -->
            <div class="mt-6 bg-[#00073e] rounded-2xl p-5 md:p-6 text-white">

                <div class="flex flex-col md:flex-row md:items-center gap-4">

                    <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                        <i class="fas fa-circle-info"></i>
                    </div>

                    <div>

                        <h4 class="font-semibold text-sm">
                            Review Information
                        </h4>

                        <p class="text-xs md:text-sm text-white/60 mt-1">
                            Check the participant information and submitted documents carefully before verification.
                        </p>

                    </div>

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


    <!-- DETAIL MODAL -->
    <div id="modalDetail"
         class="fixed inset-0 bg-[#00073e]/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4 md:p-6">

        <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto relative">

            <!-- Modal Header -->
            <div class="px-6 md:px-8 py-6 border-b border-gray-100 flex items-center justify-between sticky top-0 bg-white z-10">

                <div>

                    <p class="text-xs text-gray-400 mb-1">
                        Registration Information
                    </p>

                    <h3 class="text-xl md:text-2xl font-bold text-[#00073e]">
                        Registration Detail
                    </h3>

                </div>

                <button
                    onclick="closeModal()"
                    class="w-9 h-9 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-50 hover:text-[#fe0000] transition-colors">

                    <i class="fas fa-times"></i>

                </button>

            </div>


            <!-- Modal Body -->
            <div id="modalBody" class="p-6 md:p-8 space-y-7"></div>


            <!-- Modal Footer -->
            <div id="modalFooter"
                 class="px-6 md:px-8 py-5 border-t border-gray-100 flex justify-end gap-3 bg-gray-50">
            </div>

        </div>

    </div>


<script>
function openDetail(data) {

    const body = document.getElementById('modalBody');
    const footer = document.getElementById('modalFooter');

    body.innerHTML = `

        <!-- GENERAL + INSTITUTION -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div class="border border-gray-200 rounded-xl p-5">

                <div class="flex items-center gap-2 mb-4">

                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#00073e] flex items-center justify-center">
                        <i class="fas fa-circle-info text-xs"></i>
                    </div>

                    <h4 class="text-sm font-bold text-gray-800">
                        General Information
                    </h4>

                </div>

                <div class="space-y-3 text-sm">

                    <p class="text-gray-500">
                        Participant ID:
                        <span class="text-gray-800 font-semibold ml-1">
                            #${data.id}
                        </span>
                    </p>

                    <p class="text-gray-500">
                        Participation:
                        <span class="text-[#00073e] font-semibold ml-1">
                            ${data.type}
                        </span>
                    </p>

                    <p class="text-gray-500">
                        Category:
                        <span class="text-gray-800 font-semibold ml-1">
                            ${data.category}
                        </span>
                    </p>

                    <p class="text-gray-500">
                        Email:
                        <span class="text-gray-800 font-semibold ml-1 break-all">
                            ${data.email}
                        </span>
                    </p>

                </div>

            </div>


            <div class="border border-gray-200 rounded-xl p-5">

                <div class="flex items-center gap-2 mb-4">

                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#00073e] flex items-center justify-center">
                        <i class="fas fa-university text-xs"></i>
                    </div>

                    <h4 class="text-sm font-bold text-gray-800">
                        Institution Details
                    </h4>

                </div>

                <div class="space-y-3 text-sm">

                    <p class="text-gray-500">
                        Institution:
                        <span class="text-gray-800 font-semibold ml-1">
                            ${data.institution}
                        </span>
                    </p>

                    <p class="text-gray-500">
                        Country:
                        <span class="text-gray-800 font-semibold ml-1">
                            ${data.country}
                        </span>
                    </p>

                    <p class="text-gray-500">
                        WhatsApp:
                        <span class="text-gray-800 font-semibold ml-1">
                            ${data.phone}
                        </span>
                    </p>

                    <p class="text-gray-500">
                        Group:
                        <span class="text-gray-800 font-semibold ml-1">
                            ${data.group_name || '-'}
                        </span>
                    </p>

                </div>

            </div>

        </div>


        <!-- AUTHORS -->
        <div class="border border-gray-200 rounded-xl p-5">

            <div class="flex items-center gap-2 mb-4">

                <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#00073e] flex items-center justify-center">
                    <i class="fas fa-users text-xs"></i>
                </div>

                <h4 class="text-sm font-bold text-gray-800">
                    Authors Team
                </h4>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                <div class="bg-gray-50 rounded-lg p-4">
                    <span class="text-[10px] text-gray-400 block mb-1">
                        Author 1
                    </span>
                    <span class="text-sm font-semibold text-gray-700">
                        ${data.author1}
                    </span>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <span class="text-[10px] text-gray-400 block mb-1">
                        Author 2
                    </span>
                    <span class="text-sm font-semibold text-gray-700">
                        ${data.author2 || '-'}
                    </span>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <span class="text-[10px] text-gray-400 block mb-1">
                        Author 3
                    </span>
                    <span class="text-sm font-semibold text-gray-700">
                        ${data.author3 || '-'}
                    </span>
                </div>

            </div>

        </div>


        <!-- PAPER TITLE -->
        <div class="bg-[#00073e] rounded-xl p-5 text-white">

            <p class="text-[10px] font-semibold text-white/50 mb-2">
                SCIENTIFIC PAPER TITLE
            </p>

            <p class="text-lg font-semibold leading-relaxed">
                "${data.paper_title}"
            </p>

        </div>


        <!-- DOCUMENTS + STATUS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div class="border border-gray-200 rounded-xl p-5">

                <h4 class="text-sm font-bold text-gray-800 mb-4">
                    Documents
                </h4>

                <div class="flex flex-col sm:flex-row gap-3">

                    ${
                        data.abstract_file
                        ? `<a href="../uploads/abstracts/${data.abstract_file}"
                             download="${data.abstract_file}"
                             target="_blank"
                             class="flex-1 py-3 bg-[#00073e] hover:bg-[#fe0000] text-white rounded-lg text-xs font-semibold text-center transition">
                             <i class="fas fa-file-pdf mr-2"></i>
                             Abstract
                           </a>`
                        : `<span class="flex-1 py-3 bg-gray-100 text-gray-400 rounded-lg text-xs font-semibold text-center">
                             No Abstract
                           </span>`
                    }

                    ${
                        data.payment_receipt
                        ? `<a href="../uploads/receipts/${data.payment_receipt}"
                             target="_blank"
                             class="flex-1 py-3 bg-red-50 hover:bg-[#fe0000] text-[#fe0000] hover:text-white rounded-lg text-xs font-semibold text-center transition border border-red-100">
                             <i class="fas fa-receipt mr-2"></i>
                             Receipt
                           </a>`
                        : `<span class="flex-1 py-3 bg-gray-100 text-gray-400 rounded-lg text-xs font-semibold text-center">
                             No Receipt
                           </span>`
                    }

                </div>

            </div>


            <div class="border border-gray-200 rounded-xl p-5">

                <h4 class="text-sm font-bold text-gray-800 mb-4">
                    Current Status
                </h4>

                <div class="inline-flex items-center gap-2 px-4 py-2.5 bg-orange-50 border border-orange-100 rounded-lg">

                    <i class="fas fa-clock text-orange-500 text-sm"></i>

                    <span class="text-orange-600 text-xs font-semibold">
                        Waiting Approval
                    </span>

                </div>

            </div>

        </div>
    `;


    footer.innerHTML = `
        <button
            onclick="closeModal()"
            class="px-5 py-2.5 rounded-lg text-sm font-semibold text-gray-500 hover:bg-gray-100 transition">

            Close

        </button>
    `;


    if(data.apply === 'Pending') {

        footer.innerHTML += `
            <a
                href="actions.php?approve=${data.id}"
                class="px-5 py-2.5 bg-[#fe0000] hover:bg-[#d90000] text-white rounded-lg text-sm font-semibold transition">

                <i class="fas fa-check mr-2"></i>
                Verify & Approve

            </a>
        `;

    }


    document.getElementById('modalDetail').classList.remove('hidden');
}


function closeModal() {
    document.getElementById('modalDetail').classList.add('hidden');
}


document.addEventListener('keydown', (e) => {

    if(e.key === 'Escape') {
        closeModal();
    }

});
</script>

</body>
</html>