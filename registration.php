<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - DIGITS 2026</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
            background: #f8f9fc;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #00073e 0%, #17104f 45%, #fe0000 100%);
        }

        .gradient-text {
            background: linear-gradient(90deg, #00073e, #fe0000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .input-modern {
            background: #ffffff;
            border: 1px solid #d9dce5;
            color: #00073e;
            transition: all 0.25s ease;
        }

        .input-modern::placeholder {
            color: #9ca3af;
        }

        .input-modern:focus {
            border-color: #fe0000;
            box-shadow: 0 0 0 3px rgba(254, 0, 0, 0.08);
            outline: none;
        }

        select.input-modern {
            color: #00073e;
        }

        select option {
            background: #ffffff;
            color: #00073e;
        }

        .section-line {
            height: 1px;
            background: linear-gradient(90deg, transparent, #d9dce5, transparent);
        }

        .upload-box {
            border: 1.5px dashed #cfd3df;
            background: #fafbfc;
            transition: all 0.25s ease;
        }

        .upload-box:hover {
            border-color: #fe0000;
            background: #fff5f5;
        }

        .upload-icon {
            background: linear-gradient(135deg, #00073e, #fe0000);
        }
    </style>
</head>

<body class="min-h-screen text-[#00073e]">

    <!-- Header -->
    <div class="gradient-bg">
        <div class="max-w-5xl mx-auto px-5 py-14 md:py-20 text-center text-white">

            <h1 class="text-4xl md:text-6xl font-black tracking-tight mb-4">
                Registration <span class="text-[#fe0000]">Form</span>
            </h1>

            <p class="text-white/75 text-sm md:text-base max-w-2xl mx-auto">
                Join the digital transformation movement. Please fill in your details.
            </p>
        </div>
    </div>

    <!-- Registration Form -->
    <main class="relative -mt-8 pb-16 md:pb-24 px-4">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white rounded-2xl shadow-[0_20px_60px_rgba(0,7,62,0.12)] border border-gray-100 p-6 md:p-10">

                <form action="process_registration.php" method="POST" enctype="multipart/form-data" class="space-y-8">

                    <!-- Participation -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-[10px] font-bold text-[#00073e] tracking-widest mb-2">
                                Participation Type
                            </label>

                            <select name="type" required class="input-modern w-full rounded-lg px-4 py-3.5 text-sm">
                                <option value="" disabled selected>Select Type</option>
                                <option value="Presenter">Presenter</option>
                                <option value="Non Presenter">Non Presenter</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-[#00073e] tracking-widest mb-2">
                                Participant Category
                            </label>

                            <select name="category" required class="input-modern w-full rounded-lg px-4 py-3.5 text-sm">
                                <option value="" disabled selected>Select Category</option>
                                <option value="Domestic Student Presenter">Domestic Student Presenter</option>
                                <option value="Domestic Non Student Presenter">Domestic Non Student Presenter</option>
                                <option value="Domestic Participant (Non-Presenter)">Domestic Participant (Non-Presenter)</option>
                                <option value="International Student Presenter">International Student Presenter</option>
                                <option value="International Non Student Presenter">International Non Student Presenter</option>
                                <option value="International Participant (Non-Presenter)">International Participant (Non-Presenter)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-[#00073e] tracking-widest mb-2">
                                Email Address
                            </label>

                            <input type="email" name="email" required
                                   placeholder="yourname@domain.com"
                                   class="input-modern w-full rounded-lg px-4 py-3.5 text-sm">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-[#00073e] tracking-widest mb-2">
                                WhatsApp Number
                            </label>

                            <input type="text" name="phone" required
                                   placeholder="+62 812..."
                                   class="input-modern w-full rounded-lg px-4 py-3.5 text-sm">
                        </div>

                    </div>

                    <div class="section-line"></div>

                    <!-- Author List -->
                    <div>
                        <div class="flex items-center gap-3 mb-5">
                            <span class="w-1 h-6 bg-[#fe0000] rounded-full"></span>
                            <h2 class="text-sm font-bold text-[#00073e]">
                                Author List
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <input type="text" name="author1" required placeholder="Main Author"
                                   class="input-modern rounded-lg px-4 py-3 text-sm">

                            <input type="text" name="author2" placeholder="Author 2"
                                   class="input-modern rounded-lg px-4 py-3 text-sm">

                            <input type="text" name="author3" placeholder="Author 3"
                                   class="input-modern rounded-lg px-4 py-3 text-sm">

                            <input type="text" name="author4" placeholder="Author 4"
                                   class="input-modern rounded-lg px-4 py-3 text-sm">

                            <input type="text" name="author5" placeholder="Author 5"
                                   class="input-modern rounded-lg px-4 py-3 text-sm">

                            <input type="text" name="group_name" placeholder="Team Name (Optional)"
                                   class="input-modern rounded-lg px-4 py-3 text-sm">
                        </div>
                    </div>

                    <!-- Paper Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-[#00073e] tracking-widest mb-2">
                                Full Paper Title
                            </label>

                            <input type="text" name="paper_title" required
                                   placeholder="Enter the complete title of your research"
                                   class="input-modern w-full rounded-lg px-4 py-3.5 text-sm">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-[#00073e] tracking-widest mb-2">
                                Institution / University
                            </label>

                            <input type="text" name="institution" required
                                   placeholder="e.g. UBHINUS University"
                                   class="input-modern w-full rounded-lg px-4 py-3.5 text-sm">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-[#00073e] tracking-widest mb-2">
                                Country
                            </label>

                            <input type="text" name="country" required
                                   placeholder="e.g. Indonesia"
                                   class="input-modern w-full rounded-lg px-4 py-3.5 text-sm">
                        </div>

                    </div>

                    <div class="section-line"></div>

                    <!-- Upload -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="group">
                            <label class="upload-box flex flex-col items-center justify-center p-7 rounded-xl cursor-pointer text-center">

                                <div class="upload-icon w-14 h-14 rounded-xl flex items-center justify-center text-white mb-4 group-hover:scale-105 transition-transform">
                                    <i class="fas fa-file-upload text-xl"></i>
                                </div>

                                <span class="text-xs font-bold text-[#00073e] mb-1">
                                    Abstract File
                                </span>

                                <span class="file-info text-[10px] text-gray-400">
                                    PDF (Max 2MB)
                                </span>

                                <input type="file" name="abstract_file" class="hidden file-input">
                            </label>
                        </div>

                        <div class="group">
                            <label class="upload-box flex flex-col items-center justify-center p-7 rounded-xl cursor-pointer text-center">
                                <div class="upload-icon w-14 h-14 rounded-xl flex items-center justify-center text-white mb-4 group-hover:scale-105 transition-transform">
                                    <i class="fas fa-receipt text-xl"></i>
                                </div>

                                <span class="text-xs font-bold text-[#00073e] mb-1">
                                    Payment Receipt
                                </span>

                                <span class="file-info text-[10px] text-gray-400">
                                    JPG, PNG, PDF (Required)
                                </span>

                                <input type="file" name="payment_receipt" required class="hidden file-input">
                            </label>

                            <!-- Payment Information -->
                            <div class="mt-3 bg-[#f8f9fc] border border-gray-200 rounded-xl px-4 py-3">
                                <p class="text-[11px] font-bold text-[#00073e] mb-1.5">
                                    Payment Information:
                                </p>

                                <p class="text-[10px] text-gray-600 leading-relaxed">
                                    <span class="font-semibold text-[#00073e]">Bank:</span>
                                    Bank Negara Indonesia (BNI) – 2679999265
                                    <br>
                                    <span class="font-semibold text-[#00073e]">Account Name:</span>
                                    UNIT KEMITRAAN GLOBAL DAN KOMUNIKASI PUBLIK
                                </p>
                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="apply" value="Pending">

                    <!-- Buttons -->
                    <div class="flex flex-col-reverse md:flex-row items-center justify-center gap-4 pt-4">

                        <a href="index.php"
                           class="w-full md:w-auto text-center border border-gray-200 text-[#00073e] hover:border-[#00073e] hover:bg-gray-50 font-semibold px-7 py-3.5 rounded-lg transition-all text-sm">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Home
                        </a>

                        <button type="submit"
                                class="w-full md:w-auto bg-gradient-to-r from-[#00073e] to-[#fe0000] text-white font-bold px-9 py-3.5 rounded-lg shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all text-sm">
                            Submit Registration
                            <i class="fas fa-paper-plane ml-2"></i>
                        </button>

                    </div>

                    <p class="text-center text-[10px] text-gray-400">
                        By submitting, you agree to the conference terms and data privacy policy.
                    </p>

                </form>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <span class="text-[10px] font-bold text-[#00073e]/40 tracking-[0.3em]">
                    ISC 2026 Organizing Committee
                </span>
            </div>

        </div>
    </main>

    <script>
        // =====================================================
        // 1. LOGIKA PREVIEW UPLOAD FILE
        // =====================================================

        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const fileName = this.files[0].name;
                    const infoSpan = this.parentElement.querySelector('.file-info');

                    infoSpan.innerHTML = "✓ " + fileName;
                    infoSpan.classList.remove('text-gray-400');
                    infoSpan.classList.add('text-[#fe0000]', 'font-bold');
                }
            });
        });

        // =====================================================
        // 2. LOGIKA NOTIFIKASI SUKSES
        // =====================================================

        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.get('status') === 'success') {
            Swal.fire({
                title: '<span style="color:#00073e;font-weight:800;">Congratulations!</span>',
                html: `
                    <div style="color:#374151;font-family:'Montserrat',Arial,sans-serif;font-size:13px;line-height:1.7;text-align:left;">
                        <div style="text-align:center;margin-bottom:20px;">
                            <div style="width:58px;height:58px;margin:0 auto 12px;background:#fff1f1;border:1px solid #ffd6d6;border-radius:50%;display:flex;align-items:center;justify-content:center;"><i class="fas fa-check" style="color:#fe0000;font-size:24px;"></i></div>
                            <p style="margin:0;color:#374151;">You have successfully completed your registration and payment for <b style="color:#00073e;"><br>ISC 2026</b>.</p>
                            <p style="margin:4px 0 0;color:#6b7280;font-size:12px;">Thank you for your participation!</p>
                        </div>

                        <div style="background:#f8f9fc;border:1px solid #e5e7eb;border-left:4px solid #fe0000;padding:16px 18px;border-radius:12px;margin-bottom:18px;">
                            <div style="color:#00073e;font-weight:800;font-size:11px;letter-spacing:.4px;margin-bottom:10px;">IMPORTANT DATES</div>
                            <div style="font-size:12px;color:#4b5563;">
                                <div style="padding:5px 0;border-bottom:1px solid #e5e7eb;"><b style="color:#00073e;">November 14, 2026</b><br>Deadline for Abstract Submission and Payment</div>
                                <div style="padding:5px 0;border-bottom:1px solid #e5e7eb;"><b style="color:#00073e;">November 21, 2026</b><br>Abstract Acceptance Announcement</div>
                                <div style="padding:5px 0;border-bottom:1px solid #e5e7eb;"><b style="color:#00073e;">November 28, 2026</b><br>Full Paper Submission Deadline</div>
                                <div style="padding:5px 0;border-bottom:1px solid #e5e7eb;"><b style="color:#00073e;">December 5, 2026</b><br>Full Paper Acceptance Announcement</div>
                                <div style="padding:5px 0;border-bottom:1px solid #e5e7eb;"><b style="color:#00073e;">December 9, 2026</b><br>Socialization and Briefing for Presenters</div>
                                <div style="padding:5px 0 0;"><b style="color:#fe0000;">December 16, 2026</b><br><b style="color:#00073e;">The 5th International Student Conference 2026</b></div>
                            </div>
                        </div>

                        <div style="background:#f8f9fc;border:1px solid #e5e7eb;padding:12px 15px;border-radius:10px;margin-bottom:18px;font-size:12px;">
                            <b style="color:#00073e;">Additional Information:</b><br>
                            Please check your registered email regularly for further information regarding the conference.
                        </div>

                        <div style="text-align:center;">
                            <p style="margin:0 0 10px;color:#6b7280;font-size:11px;">Join our coordination group:</p>
                            <a href="https://chat.whatsapp.com/EMbg9VZ4QpH0GJkl4TDK9r" target="_blank" style="display:inline-flex;align-items:center;justify-content:center;background:#00073e;color:#ffffff;padding:10px 18px;border-radius:8px;text-decoration:none;font-weight:700;font-size:12px;"><i class="fab fa-whatsapp" style="margin-right:7px;"></i>Join WhatsApp Group</a>
                        </div>

                        <p style="margin:18px 0 0;text-align:center;color:#9ca3af;font-size:10px;font-style:italic;">Best regards,<br>Conference Committee ISC 2026</p>
                    </div>
                `,
                background: '#ffffff',
                confirmButtonText: 'Great, I Got It!',
                confirmButtonColor: '#00073e',
                width: '600px',
                padding: '25px',
                allowOutsideClick: false,
                customClass: { popup: 'rounded-2xl', title: 'font-bold' }
            }).then((result) => {
                if (result.isConfirmed) window.location.href = 'index.php';
            });
        }

        // =====================================================
        // 3. NOTIFIKASI ERROR
        // =====================================================

        else if (urlParams.get('status') === 'error') {

            Swal.fire({
                title: 'Registration Failed',
                text: decodeURIComponent(
                    urlParams.get('message') || 'Please check your data.'
                ),
                icon: 'error',
                background: '#ffffff',
                color: '#00073e',
                confirmButtonColor: '#fe0000',
                borderRadius: '1rem'
            });

        }
    </script>

</body>
</html>