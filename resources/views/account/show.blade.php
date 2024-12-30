<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Akun') }}
            </h2>
            <a href="{{ route('account.index') }}"
                class="font-bold py-1 px-8 bg-indigo-700 hover:bg-indigo-600 text-white rounded-full flex items-center transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Header Section with Quick Actions -->
                <div class="border-b border-gray-200 bg-gray-50 p-6">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="h-16 w-16 bg-indigo-100 rounded-full flex items-center justify-center">
                                <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                                <p class="text-sm text-gray-500">{{ $user->position }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('account.edit',$user) }}" 
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-md transition duration-300">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <form action="" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-500 text-white rounded-md transition duration-300"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Details Section -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h3>
                            <div class="space-y-4">
                                <div class="flex border-b border-gray-100 pb-3">
                                    <span class="text-gray-500 w-1/3">NIP</span>
                                    <span class="text-gray-900 font-medium">{{ $user->identity_no }}</span>
                                </div>
                                <div class="flex border-b border-gray-100 pb-3">
                                    <span class="text-gray-500 w-1/3">Nama Lengkap</span>
                                    <span class="text-gray-900 font-medium">{{ $user->name }}</span>
                                </div>
                                <div class="flex border-b border-gray-100 pb-3">
                                    <span class="text-gray-500 w-1/3">Jabatan</span>
                                    <span class="text-gray-900 font-medium">{{ $user->position }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kontak</h3>
                            <div class="space-y-4">
                                <div class="flex border-b border-gray-100 pb-3">
                                    <span class="text-gray-500 w-1/3">Email</span>
                                    <span class="text-gray-900 font-medium">{{ $user->email }}</span>
                                </div>
                                <div class="flex border-b border-gray-100 pb-3">
                                    <span class="text-gray-500 w-1/3">Nomor Ponsel</span>
                                    <span class="text-gray-900 font-medium">{{ $user->phone }}</span>
                                </div>
                                <div class="flex border-b border-gray-100 pb-3">
                                    <span class="text-gray-500 w-1/3">Dibuat pada</span>
                                    <span class="text-gray-900 font-medium">{{ $user->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>