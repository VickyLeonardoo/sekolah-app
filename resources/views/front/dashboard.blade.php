<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Kartu Total Transaksi --}}
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 transform transition-all hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Total Transaksi</h3>
                            <p class="text-3xl font-bold text-blue-600 mt-2">Rp 5.250.000</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-500">
                        <span class="text-green-500 font-semibold">+12.5%</span> dari bulan lalu
                    </div>
                </div>

                {{-- Kartu Pembayaran Mendatang --}}
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 transform transition-all hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Pembayaran Mendatang</h3>
                            <p class="text-3xl font-bold text-green-600 mt-2">Rp 1.500.000</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M13 5.5a4 4 0 11-8 0 4 4 0 018 0zM5 11a4 4 0 100-8 4 4 0 000 8z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-500">
                        Jatuh tempo dalam 30 hari
                    </div>
                </div>

                {{-- Kartu Riwayat Pembayaran --}}
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 transform transition-all hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Riwayat Pembayaran</h3>
                            <p class="text-3xl font-bold text-purple-600 mt-2">5 Transaksi</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-500">
                        <span class="text-purple-500 font-semibold">Sudah Lunas</span>
                    </div>
                </div>
            </div>
            
            {{-- Student Profile Section --}}
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 mt-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Profil Siswa</h3>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Photo and Basic Info --}}
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0">
                            <img 
                                src="/api/placeholder/200/200" 
                                alt="Foto Siswa" 
                                class="w-32 h-32 rounded-full object-cover border-4 border-gray-200"
                            >
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-gray-800">Muhammad Rizky</h4>
                            <div class="text-sm text-gray-600 space-y-1 mt-2">
                                <p><strong>NIS:</strong> 2024001</p>
                                <p><strong>Kelas:</strong> 11 RPL</p>
                                <p><strong>Jurusan:</strong> Rekayasa Perangkat Lunak</p>
                            </div>
                        </div>
                    </div>

                    {{-- Detailed Student Info --}}
                    <div>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="font-semibold text-gray-600">Jenis Kelamin</p>
                                <p class="text-gray-800">Laki-laki</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-600">Tanggal Lahir</p>
                                <p class="text-gray-800">15 Maret 2006</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-600">Agama</p>
                                <p class="text-gray-800">Islam</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-600">No. Telepon</p>
                                <p class="text-gray-800">0812-3456-7890</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Orang Tua Section --}}
                <div class="mt-6 border-t pt-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Informasi Orang Tua</h4>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <h5 class="font-semibold text-gray-700 mb-2">Ayah</h5>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p><strong>Nama:</strong> Budi Santoso</p>
                                <p><strong>No. Telepon:</strong> 0811-2345-6789</p>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-700 mb-2">Ibu</h5>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p><strong>Nama:</strong> Sri Rahayu</p>
                                <p><strong>No. Telepon:</strong> 0822-3456-7890</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tabel Rincian Pembayaran --}}
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 mt-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Rincian Pembayaran</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Bulan</th>
                                <th scope="col" class="px-6 py-3">Tanggal</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">Januari 2024</td>
                                <td class="px-6 py-4">15 Jan 2024</td>
                                <td class="px-6 py-4">Rp 750.000</td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Lunas</span>
                                </td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">Desember 2023</td>
                                <td class="px-6 py-4">15 Des 2023</td>
                                <td class="px-6 py-4">Rp 750.000</td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Lunas</span>
                                </td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">November 2023</td>
                                <td class="px-6 py-4">15 Nov 2023</td>
                                <td class="px-6 py-4">Rp 750.000</td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Lunas</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>