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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <input wire:model="username" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/90 px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
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
                            <div class="relative" x-data="{ showPassword: false }">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                                <input wire:model="password" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/90 px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                    id="password" 
                                    :type="showPassword ? 'text' : 'password'"
                                    placeholder="Masukkan password"
                                    required>
                                <button type="button" 
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none transition-colors duration-200">
                                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                    <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </span>
                                <input wire:model="nama_penumpang" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/90 px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </span>
                                <textarea wire:model="alamat_penumpang" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/90 px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <input wire:model="tanggal_lahir" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/90 px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <select wire:model="jenis_kelamin" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/90 px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </span>
                                <input wire:model="telp" 
                                    class="pl-10 w-full rounded-lg border border-gray-300/50 bg-white/90 px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
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