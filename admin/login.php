<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - DIGITS 2026</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .login-bg {
            background:
                radial-gradient(circle at 10% 20%, rgba(254, 0, 0, 0.08), transparent 30%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.06), transparent 30%),
                #00073e;
        }

        .input-field {
            transition: all 0.25s ease;
        }

        .input-field:focus {
            border-color: #fe0000;
            box-shadow: 0 0 0 3px rgba(254, 0, 0, 0.08);
        }
    </style>
</head>

<body class="login-bg min-h-screen flex items-center justify-center px-5 py-10">

    <div class="w-full max-w-[420px]">

        <!-- Header -->
        <div class="text-center mb-8">

            <h1 class="text-3xl font-bold text-white tracking-tight">
                ISC <span class="text-[#fe0000]">2026</span>
            </h1>

            <p class="text-blue-100/60 text-sm mt-2">
                Administrator Sign In
            </p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-7 sm:p-9">

            <div class="mb-7">
                <h2 class="text-xl font-bold text-[#00073e]">
                    Welcome back
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    Sign in to access the administration panel.
                </p>
            </div>

            <form action="auth.php" method="POST" class="space-y-5">

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Email Address
                    </label>

                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>

                        <input
                            type="email"
                            name="email"
                            required
                            placeholder="admin@digits.com"
                            class="input-field w-full h-12 bg-gray-50 border border-gray-200 rounded-xl pl-11 pr-4 text-sm text-gray-800 placeholder-gray-400 outline-none"
                        >
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>

                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>

                        <input
                            type="password"
                            name="password"
                            required
                            placeholder="Enter your password"
                            class="input-field w-full h-12 bg-gray-50 border border-gray-200 rounded-xl pl-11 pr-4 text-sm text-gray-800 placeholder-gray-400 outline-none"
                        >
                    </div>
                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full h-12 bg-[#fe0000] hover:bg-[#d90000] text-white rounded-xl font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg mt-2"
                >
                    <i class="fas fa-arrow-right-to-bracket mr-2"></i>
                    Sign In
                </button>

            </form>

            <!-- Back -->
            <div class="mt-7 pt-6 border-t border-gray-100 text-center">
                <a
                    href="../index.php"
                    class="inline-flex items-center text-sm text-gray-500 hover:text-[#fe0000] transition-colors"
                >
                    <i class="fas fa-arrow-left mr-2 text-xs"></i>
                    Back to ISC 2026
                </a>
            </div>

        </div>

        <!-- Footer -->
        <div class="text-center mt-7">
            <p class="text-white/40 text-xs">
                © 2026 Universitas Bhinneka Nusantara
            </p>
        </div>

    </div>

</body>
</html>