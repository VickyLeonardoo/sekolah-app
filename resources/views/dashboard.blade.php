<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Kartu Total Transaksi --}}
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 transform transition-all hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Total Transaksi</h3>
                            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalPendingTransactionCount }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-500">
                        {{-- <span class="text-green-500 font-semibold">+12.5%</span> dari bulan lalu --}}
                    </div>
                </div>

                {{-- Kartu Pembayaran Mendatang --}}
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 transform transition-all hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Transaksi Hari ini</h3>
                            <p class="text-3xl font-bold text-green-600 mt-2">{{ $todayTransactionsCount }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M13 5.5a4 4 0 11-8 0 4 4 0 018 0zM5 11a4 4 0 100-8 4 4 0 000 8z" />
                            </svg>
                        </div>
                    </div>
                    
                </div>

                {{-- Kartu Riwayat Pembayaran --}}
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 transform transition-all hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Guru</h3>
                            <p class="text-3xl font-bold text-purple-600 mt-2">{{ $teachersCount }}</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-500">
                        {{-- <span class="text-purple-500 font-semibold">Sudah Lunas</span> --}}
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 mt-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Pembayaran hari ini</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Tanggal Pembayaran</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">@formatDob($transaction->created_at)</td>
                                    <td class="px-6 py-4">@rupiah($transaction->amount)</td>
                                    <td class="px-6 py-4">
                                        @if ($transaction->status == 'pending' && $transaction->proof_image == false)
                                            <span class="bg-yellow-100 text-yellow-800 font-medium mr-2 px-2.5 py-0.5 rounded">Belum upload bukti pembayaran</span>
                                        @elseif ($transaction->status == 'pending' && $transaction->proof_image == true)
                                            <span class="bg-indigo-100 text-indigo-800 font-medium mr-2 px-2.5 py-0.5 rounded">Menunggu Konfirmasi</span>
                                        @elseif ($transaction->status == 'approved')
                                            <span class="bg-green-100 text-green-800 font-medium mr-2 px-2.5 py-0.5 rounded">Berhasil</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 font-medium mr-2 px-2.5 py-0.5 rounded">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($transaction->status == 'pending' && !$transaction->proof_image)
                                            <a href="{{ route('client.transaction.show',$transaction) }}" class="font-bold py-2 px-6 bg-yellow-500 text-white rounded-full hover:bg-yellow-300">
                                                Upload Bukti Pembayaran
                                            </a>
                                        @else
                                        <a href="{{ route('client.transaction.show',$transaction) }}" class="font-bold py-2 px-6 bg-indigo-700 text-white rounded-full hover:bg-indigo-300">
                                            Lihat Selengkapnya
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        
                    </table>
                </div>
                <div class="mt-3">
                    {{ $transactions->links() }}
                </divc>
            </div>
        </div>
    </div>
</x-app-layout>