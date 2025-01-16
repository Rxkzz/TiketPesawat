<div>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-sky-400 via-blue-400 to-indigo-400 py-12 px-4 sm:px-6 lg:px-8">
        <div class="absolute inset-0 z-0 bg-pattern opacity-10"></div>
        
        <div class="max-w-4xl w-full backdrop-blur-sm bg-white/80 rounded-2xl shadow-2xl p-8 space-y-6 relative z-10 animate-fadeIn">
            <div class="text-center space-y-2">
                <div class="flex justify-center mb-4 animate-float">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 animate-slideDown">Daftar Perjalanan</h2>
                <p class="text-gray-500 animate-slideUp">Bergabunglah untuk memulai petualangan Anda</p>
            </div>
            
            <form wire:submit="register" class="space-y-6 animate-fadeIn">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Kolom Kiri - Informasi Akun -->
                    <div class="space-y-4">
                        <h3 class="font-semibold text-lg text-gray-900 border-b pb-2">Informasi Akun</h3>
                        
                        <!-- Username field -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="username">
                                Username
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input wire:model="username" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/50 backdrop-blur-sm px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                    id="username" 
                                    type="text"
                                    placeholder="Masukkan username">
                            </div>
                            @error('username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Password field -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="password">
                                Password
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input wire:model="password" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/50 backdrop-blur-sm px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                    id="password" 
                                    type="password"
                                    placeholder="Masukkan password">
                                <button type="button" 
                                    onclick="togglePassword('password')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <!-- Kolom Kanan - Informasi Pribadi -->
                    <div class="space-y-4">
                        <h3 class="font-semibold text-lg text-gray-900 border-b pb-2">Informasi Pribadi</h3>
                        
                        <!-- Nama Lengkap field -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="nama_penumpang">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                    </svg>
                                </span>
                                <input wire:model="nama_penumpang" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/50 backdrop-blur-sm px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                    id="nama_penumpang" 
                                    type="text"
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            @error('nama_penumpang') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Alamat field -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="alamat_penumpang">
                                Alamat
                            </label>
                            <div class="relative">
                                <span class="absolute top-3 left-0 pl-3 flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <textarea wire:model="alamat_penumpang" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/50 backdrop-blur-sm px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                    id="alamat_penumpang"
                                    rows="3"
                                    placeholder="Masukkan alamat lengkap"></textarea>
                            </div>
                            @error('alamat_penumpang') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Tanggal Lahir field -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="tanggal_lahir">
                                Tanggal Lahir
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input wire:model="tanggal_lahir" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/50 backdrop-blur-sm px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                    id="tanggal_lahir" 
                                    type="date">
                            </div>
                            @error('tanggal_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Jenis Kelamin field -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                Jenis Kelamin
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <select wire:model="jenis_kelamin" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/50 backdrop-blur-sm px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            @error('jenis_kelamin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- No. Telepon field -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="telp">
                                No. Telepon
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                </span>
                                <input wire:model="telp" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/50 backdrop-blur-sm px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                    id="telp" 
                                    type="text"
                                    placeholder="Masukkan nomor telepon">
                            </div>
                            @error('telp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between pt-4 border-t">
                    <button class="bg-blue-600 text-white font-semibold py-2.5 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200" type="submit">
                        Daftar Sekarang
                    </button>
                    <div class="text-sm">
                        <span class="text-gray-600">Sudah punya akun?</span>
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-700 ml-1">
                            Masuk
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Existing styles... */
    </style>
</div>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script> 