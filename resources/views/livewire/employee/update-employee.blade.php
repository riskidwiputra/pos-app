<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="container-xxl w-full">
        
        <!-- Header with Back Button -->
        <div class="mb-8">
            <a href="{{ route('karyawan.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold mb-6 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>

        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-8 py-6 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-900">Edit Data Karyawan</h2>
                </div>
            </div>

            <!-- Form Content -->
            <form wire:submit.prevent="update" class="p-8 space-y-6">
                
                <!-- Nama Lengkap -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nama Lengkap <span class="text-red-500 font-bold">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            wire:model="nama_lengkap" 
                            placeholder="Nama Lengkap Karyawan"
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('nama_lengkap') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                    </div>
                    @error('nama_lengkap') 
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Grid: Jenis Kelamin & Tanggal Lahir -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Jenis Kelamin -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Jenis Kelamin <span class="text-red-500 font-bold">*</span>
                        </label>
                        <select 
                            wire:model="jenis_kelamin"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 cursor-pointer @error('jenis_kelamin') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                            <option value="{{ $jenis_kelamin}}"selected disabled readonly>{{ $jenis_kelamin}}</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Tanggal Lahir <span class="text-red-500 font-bold">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input 
                                type="date" 
                                wire:model="tanggal_lahir"
                                class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('tanggal_lahir') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                            >
                        </div>
                        @error('tanggal_lahir') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Alamat -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Alamat <span class="text-red-500 font-bold">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-4 left-0 pl-4 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <textarea 
                            wire:model="alamat" 
                            rows="4"
                            placeholder="Jl. Raya No. 123, Jakarta Pusat"
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 resize-none @error('alamat') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        ></textarea>
                    </div>
                    @error('alamat') 
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Grid: No Telepon & Posisi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- No Telepon -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            No Telepon <span class="text-red-500 font-bold">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 00.948-.684l1.498-4.493a1 1 0 011.502-.684l1.498 4.493a1 1 0 00.948.684H19a2 2 0 012 2v2M3 5v12a2 2 0 002 2h14a2 2 0 002-2V5m-5 8a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                wire:model="no_telepon" 
                                placeholder="081234567890"
                                class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('no_telepon') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                            >
                        </div>
                        @error('no_telepon') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Posisi -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Posisi <span class="text-red-500 font-bold">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                wire:model="posisi" 
                                placeholder="Manager, Kasir, Staff, dll"
                                class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('posisi') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                            >
                        </div>
                        @error('posisi') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Grid: Tanggal Masuk & Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tanggal Masuk -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Tanggal Masuk <span class="text-red-500 font-bold">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input 
                                type="date" 
                                wire:model="tanggal_masuk"
                                class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('tanggal_masuk') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                            >
                        </div>
                        @error('tanggal_masuk') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Status Pekerjaan -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Status Pekerjaan <span class="text-red-500 font-bold">*</span>
                        </label>
                        <select 
                            wire:model="status_pekerjaan"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 cursor-pointer @error('status_pekerjaan') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                            <option value="Cuti">Cuti</option>
                        </select>
                        @error('status_pekerjaan') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Gaji -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Gaji (Rp) <span class="text-red-500 font-bold">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <input 
                            type="number" 
                            wire:model="gaji" 
                            placeholder="5000000"
                            
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('gaji') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                    </div>
                    @error('gaji') 
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <!-- Button Section -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <a 
                        href="{{ route('karyawan.index') }}"
                        class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                    <button 
                        type="submit"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Edit Data Karyawan
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>