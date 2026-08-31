<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Futsal Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center px-4 selection:bg-emerald-500 selection:text-white">

    <div class="max-w-md w-full bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl p-8">
        <div class="text-center mb-8">
            <span
                class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 text-xs font-semibold px-3 py-1 rounded-full mb-3 border border-emerald-500/20">
                <i class="fa-solid fa-lock text-[10px]"></i> Admin Area
            </span>
            <h1 class="text-2xl font-black text-white">Login ke Beranda</h1>
            <p class="text-slate-400 text-sm mt-1">Masukkan akun pengelola akademi</p>
        </div>

        @if ($errors->any())
            <div
                class="flex items-center gap-2 bg-red-500/10 border border-red-500/20 text-red-400 p-3 rounded-xl mb-6 text-xs">
                <i class="fa-solid fa-circle-exclamation shrink-0"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500 text-sm">
                        <i class="fa-regular fa-envelope"></i>
                    </span>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        placeholder="nama@domain.com"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-10 pr-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500 text-sm">
                        <i class="fa-solid fa-key"></i>
                    </span>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-10 pr-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition">
                </div>
            </div>
            <button type="submit"
                class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-3 rounded-xl transition shadow-lg shadow-emerald-900/30 text-sm mt-2 flex items-center justify-center gap-2">
                <span>Masuk Beranda</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="/"
                class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-slate-300 transition">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Landing Page
            </a>
        </div>
    </div>

</body>

</html>
