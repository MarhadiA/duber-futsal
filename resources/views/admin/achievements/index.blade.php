<x-admin-layout>
    <x-slot:header>Kelola Data Prestasi</x-slot:header>

    <div class="space-y-6">
        <!-- Tombol Tambah Prestasi -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <p class="text-slate-400 text-sm">Daftar seluruh prestasi dan penghargaan akademi.</p>
            <a href="{{ route('achievements.create') }}"
                class="bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-bold px-4 py-2.5 rounded-xl transition shadow-lg flex items-center gap-2">
                <!-- Flowbite Plus Icon -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah Prestasi</span>
            </a>
        </div>

        <!-- Tabel Data Prestasi -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="border-b border-slate-800 text-slate-400 text-xs uppercase tracking-wider bg-slate-950/50">
                            <th class="p-4">Judul & Deskripsi</th>
                            <th class="p-4">Galeri Foto</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80 text-sm text-white">
                        @forelse($achievements as $index => $item)
                            <tr class="hover:bg-slate-800/40 transition">
                                <td class="p-4 align-top w-full md:w-1/3">
                                    <div class="font-bold text-base mb-1">{{ $item->title }}</div>
                                    <div class="text-xs text-slate-400 line-clamp-2">{{ $item->description ?? '-' }}
                                    </div>
                                </td>
                                <td class="p-4 align-top">
                                    @if ($item->photos && is_array($item->photos))
                                        <!-- SLIDER DI TABEL ADMIN -->
                                        <div class="relative group w-full sm:w-40">
                                            <div id="admin-slider-{{ $index }}"
                                                class="flex gap-2 overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar rounded-xl bg-slate-950 border border-slate-800 p-1">
                                                @foreach ($item->photos as $photo)
                                                    <div class="flex-shrink-0 w-32 sm:w-36 h-24 snap-center rounded-lg overflow-hidden relative cursor-pointer"
                                                        onclick="openLightbox('{{ asset('storage/' . $photo) }}', '{{ $item->title }}')">
                                                        <img src="{{ asset('storage/' . $photo) }}"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Tombol Navigasi Kecil (Hanya muncul saat di-hover pada layar md ke atas) -->
                                            @if (count($item->photos) > 1)
                                                <button
                                                    onclick="scrollAdminSlider('admin-slider-{{ $index }}', -1)"
                                                    class="absolute left-1 top-1/2 -translate-y-1/2 bg-slate-900/80 hover:bg-emerald-600 text-white text-xs p-1 rounded-full shadow backdrop-blur-md hidden sm:group-hover:flex items-center justify-center transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                    </svg>
                                                </button>
                                                <button
                                                    onclick="scrollAdminSlider('admin-slider-{{ $index }}', 1)"
                                                    class="absolute right-1 top-1/2 -translate-y-1/2 bg-slate-900/80 hover:bg-emerald-600 text-white text-xs p-1 rounded-full shadow backdrop-blur-md hidden sm:group-hover:flex items-center justify-center transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                        <span class="text-[10px] text-slate-500 mt-1 block">Total:
                                            {{ count($item->photos) }} Foto (Geser/Klik)</span>
                                    @else
                                        <span class="text-xs text-slate-500">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="p-4 align-top text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('achievements.edit', $item->id) }}"
                                            class="bg-amber-500/10 text-amber-400 p-2 rounded-xl border border-amber-500/20 hover:bg-amber-500 hover:text-white transition"
                                            title="Edit">
                                            <!-- Flowbite Edit Icon -->
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('achievements.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500/10 text-red-400 p-2 rounded-xl border border-red-500/20 hover:bg-red-500 hover:text-white transition"
                                                title="Hapus">
                                                <!-- Flowbite Trash Icon -->
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-12 text-slate-500">
                                    Belum ada data prestasi yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL LIGHTBOX UNTUK FULLSCREEN FOTO DI ADMIN -->
    <div id="photoLightbox"
        class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden items-center justify-center p-4">
        <button onclick="closeLightbox()"
            class="absolute top-6 right-6 text-white text-3xl hover:text-emerald-400 transition">&times;</button>
        <div class="max-w-4xl max-h-[90vh] flex flex-col items-center">
            <img id="lightboxImage" src="" alt="Fullscreen Photo"
                class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl border border-slate-800">
            <p id="lightboxTitle" class="text-white text-base font-bold mt-4 text-center"></p>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT KHUSUS ADMIN -->
    <script>
        function scrollAdminSlider(sliderId, direction) {
            const slider = document.getElementById(sliderId);
            const scrollAmount = 150 * direction;
            slider.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }

        function openLightbox(imageSrc, title) {
            const lightbox = document.getElementById('photoLightbox');
            const lightboxImage = document.getElementById('lightboxImage');
            const lightboxTitle = document.getElementById('lightboxTitle');

            lightboxImage.src = imageSrc;
            lightboxTitle.textContent = title;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('photoLightbox');
            lightbox.classList.remove('flex');
            lightbox.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('photoLightbox').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });
    </script>

    <!-- CSS Hide Scrollbar -->
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-admin-layout>
