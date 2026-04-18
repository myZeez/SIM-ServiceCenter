<div class="animate-fade-in space-y-6">

    <!-- Header & Tabs -->
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-4 mb-6">
        <div class="flex space-x-4">
            <button wire:click="$set('activeTab', 'general')"
                class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ $activeTab === 'general' ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/50 dark:text-primary-300' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400' }}">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Konfigurasi Omset
                </div>
            </button>
            <button wire:click="$set('activeTab', 'users')"
                class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ $activeTab === 'users' ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/50 dark:text-primary-300' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400' }}">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    Data Teknisi & Admin
                </div>
            </button>
            <button wire:click="$set('activeTab', 'brands')"
                class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ $activeTab === 'brands' ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/50 dark:text-primary-300' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400' }}">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                    Manajemen Brand
                </div>
            </button>
        </div>
    </div>

    <!-- CONFIGURATION TAB -->
    @if($activeTab === 'general')
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Parameter Perhitungan Omset</h3>

        @if (session()->has('message'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="saveSettings" class="space-y-6 max-w-2xl">
            <!-- Admin Fee -->
            <div class="p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl border border-gray-200 dark:border-gray-700">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Fee Admin per Nota (Rp)
                </label>
                <p class="text-xs text-gray-500 mb-2">Nominal rupiah yang didapat admin dari setiap nota servis yang Selesai.</p>
                <div class="flex rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 bg-white dark:bg-gray-800 focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary-500 overflow-hidden">
                    <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm bg-gray-50 dark:bg-gray-700/50 px-3 border-r border-gray-300 dark:border-gray-600">Rp</span>
                    <input type="number" wire:model="adminFee" class="block flex-1 border-0 bg-transparent py-2.5 pl-3 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Contoh: 20000">
                </div>
                @error('adminFee') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Tech Commission -->
            <div class="p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl border border-gray-200 dark:border-gray-700">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Persentase Bagi Hasil Teknisi (%)
                </label>
                <p class="text-xs text-gray-500 mb-2">Persentase dari <b>Biaya Jasa</b> (tidak termasuk sparepart) yang menjadi hak teknisi.</p>
                <div class="relative">
                    <input type="number" wire:model="techCommission" class="pr-10 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-primary-500" placeholder="Contoh: 50">
                    <span class="absolute right-3 top-2.5 text-gray-500">%</span>
                </div>
                @error('techCommission') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Target -->
            <div class="p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl border border-gray-200 dark:border-gray-700">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Target Omset Bulanan Teknisi (Rp)
                </label>
                <p class="text-xs text-gray-500 mb-2">Target minimal pendapatan jasa teknisi per bulan.</p>
                <div class="flex rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 bg-white dark:bg-gray-800 focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary-500 overflow-hidden">
                    <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm bg-gray-50 dark:bg-gray-700/50 px-3 border-r border-gray-300 dark:border-gray-600">Rp</span>
                    <input type="number" wire:model="techTarget" class="block flex-1 border-0 bg-transparent py-2.5 pl-3 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Contoh: 3000000">
                </div>
                @error('techTarget') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Logo -->
            <div class="p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl border border-gray-200 dark:border-gray-700">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Logo Sistem (Opsional)
                </label>
                <p class="text-xs text-gray-500 mb-2">Upload untuk mengganti logo aplikasi (Format: PNG, JPG, maks 1MB).</p>
                
                @if ($currentLogo)
                    <div class="mb-3">
                        <img src="{{ Storage::url($currentLogo) }}" alt="Current Logo" class="h-12 w-auto object-contain rounded">
                    </div>
                @endif
                
                <input type="file" wire:model="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 dark:file:bg-primary-900/30 dark:file:text-primary-300 hover:file:bg-primary-100 mb-2">
                
                <div wire:loading wire:target="logo" class="text-xs text-blue-500 mt-1">Mengunggah logo...</div>
                
                @if ($logo)
                    <div class="mt-2">
                        <span class="text-xs text-green-600">Preview logo baru:</span>
                        <img src="{{ $logo->temporaryUrl() }}" class="h-12 w-auto mt-1 rounded shadow-sm">
                    </div>
                @endif
                @error('logo') <span class="text-red-500 text-xs truncate">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-primary-600 text-white font-bold py-3 rounded-xl hover:bg-primary-700 transition">
                Simpan Konfigurasi
            </button>
        </form>
    </div>
    @endif

    <!-- USERS TAB -->
    @if($activeTab === 'users')
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Manajemen Tim</h3>
            <button wire:click="openUserModal" class="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-bold hover:bg-primary-700 shadow-lg">
                + Tambah Anggota
            </button>
        </div>

        @if (session()->has('user_message'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                {{ session('user_message') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-bold uppercase">
                    <tr>
                        <th class="px-4 py-3 rounded-tl-lg">Nama</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition">
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-md text-xs font-bold {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($user->role === 'teknisi')
                                <span class="text-xs text-gray-400 italic">Tanpa akun login</span>
                            @else
                                {{ $user->email }}
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <button wire:click="toggleStatus({{ $user->id }})"
                                class="px-2 py-1 rounded-full text-xs font-bold transition-colors {{ $user->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                                {{ $user->is_active ? 'Aktif' : 'Non-Aktif' }}
                            </button>
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <button wire:click="editUser({{ $user->id }})" class="text-blue-600 hover:text-blue-800">Edit</button>
                            @if($user->id !== auth()->id())
                                <button wire:click="deleteUser({{ $user->id }})"
                                    wire:confirm="Yakin ingin menghapus user ini?"
                                    class="text-red-600 hover:text-red-800">
                                    Hapus
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- BRANDS TAB -->
    @if($activeTab === 'brands')
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">Manajemen Brand Laptop</h3>
                <p class="text-xs text-gray-500 mt-1">Brand yang tersedia untuk servis garansi (Authorized).</p>
            </div>
            <button wire:click="openBrandModal()" class="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-bold hover:bg-primary-700 shadow-lg">
                + Tambah Brand
            </button>
        </div>

        @if (session()->has('brand_message'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                {{ session('brand_message') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-bold uppercase">
                    <tr>
                        <th class="px-4 py-3 rounded-tl-lg">Nama Brand</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($brands as $brand)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition">
                        <td class="px-4 py-3 font-semibold text-gray-900 dark:text-white">{{ $brand->name }}</td>
                        <td class="px-4 py-3">
                            <button wire:click="toggleBrand({{ $brand->id }})"
                                class="px-2 py-1 rounded-full text-xs font-bold transition-colors {{ $brand->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                                {{ $brand->is_active ? 'Aktif' : 'Non-Aktif' }}
                            </button>
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <button wire:click="openBrandModal({{ $brand->id }})" class="text-blue-600 hover:text-blue-800 text-sm">Edit</button>
                            <button wire:click="deleteBrand({{ $brand->id }})"
                                wire:confirm="Yakin ingin menghapus brand {{ $brand->name }}?"
                                class="text-red-600 hover:text-red-800 text-sm">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-gray-400">Belum ada brand. Klik "+ Tambah Brand" untuk menambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Brand Modal -->
    @if($showBrandModal)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-2xl max-w-sm w-full p-6 animate-fade-in-up">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold dark:text-white">{{ $editBrandId ? 'Edit Brand' : 'Tambah Brand Baru' }}</h3>
                <button wire:click="$set('showBrandModal', false)" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <form wire:submit.prevent="saveBrand" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1 dark:text-gray-300">Nama Brand</label>
                    <input type="text" wire:model="brandName" placeholder="Contoh: ASUS, Lenovo, HP..."
                        class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('brandName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" wire:click="$set('showBrandModal', false)"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg font-bold hover:bg-primary-700 text-sm">
                        Simpan Brand
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- User Modal -->
    @if($showUserModal)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-2xl max-w-md w-full p-6 animate-fade-in-up">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold dark:text-white">{{ $isEdit ? 'Edit User' : 'Tambah User Baru' }}</h3>
                <button wire:click="$set('showUserModal', false)" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <form wire:submit.prevent="saveUser" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1 dark:text-gray-300">Nama Lengkap</label>
                    <input type="text" wire:model="name" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 dark:text-gray-300">Role</label>
                    <select wire:model.live="role" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="teknisi">Teknisi</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                @if($role === 'teknisi')
                    <div class="flex items-start gap-2 rounded-lg bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-3">
                        <svg class="w-4 h-4 text-blue-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-xs text-blue-700 dark:text-blue-300">Teknisi tidak memerlukan akun login. Hanya nama yang diperlukan sebagai identitas di data servis.</p>
                    </div>
                @else
                    <div>
                        <label class="block text-sm font-medium mb-1 dark:text-gray-300">Email</label>
                        <input type="email" wire:model="email" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 dark:text-gray-300">Password {{ $isEdit ? '(Isi jika ingin ubah)' : '' }}</label>
                        <input type="password" wire:model="password" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                @endif

                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg font-bold hover:bg-primary-700">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
