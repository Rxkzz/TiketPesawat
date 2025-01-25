<div>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-sky-400 via-blue-400 to-indigo-400 py-12 px-4 sm:px-6 lg:px-8">
        <div class="absolute inset-0 z-0 bg-pattern opacity-10"></div>
        
        <div class="max-w-md w-full backdrop-blur-sm bg-white/80 rounded-2xl shadow-2xl p-8 space-y-6 relative z-10 animate-fadeIn">
            <div class="text-center space-y-2">
                <div class="flex justify-center mb-4 animate-float">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 animate-slideDown">Selamat Datang</h2>
                <p class="text-gray-500 animate-slideUp">Silakan login untuk melanjutkan perjalanan Anda</p>
            </div>
            
            <form wire:submit="login" class="space-y-6 animate-fadeIn">
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="username">
                        Email / Username
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <input wire:model="username" 
                            class="pl-10 w-full rounded-lg border border-gray-300 bg-white/90 px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500" 
                            id="username" 
                            type="text" 
                            placeholder="Masukkan email atau username"
                            required>
                    </div>
                    @error('username') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
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
                            class="pl-10 w-full rounded-lg border border-gray-300 bg-white/90 px-4 py-2.5 text-gray-700 focus:border-blue-500 focus:ring-blue-500" 
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
                    @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="flex items-center justify-between pt-2">
                    <button class="bg-blue-600 text-white font-semibold py-2.5 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200" type="submit">
                        Masuk
                    </button>
                    <div class="text-sm">
                        <span class="text-gray-600">Belum punya akun?</span>
                        <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-700 ml-1">
                            Daftar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%239C92AC' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        @keyframes slideDown {
            0% { transform: translateY(-20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @keyframes slideUp {
            0% { transform: translateY(20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-slideDown {
            animation: slideDown 0.5s ease-out;
        }

        .animate-slideUp {
            animation: slideUp 0.5s ease-out;
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</div> 