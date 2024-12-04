<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Tabel Rincian Pembayaran --}}
             @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 relative"
                    role="alert">
                    <span class="font-medium">{{ session('success') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button"
                        class="absolute top-0 right-0 p-4 rounded-md text-green-600 hover:bg-green-300 hover:text-green-800"
                        aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @elseif (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400 relative"
                    role="alert">
                    <span class="font-medium">{{ session('error') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button"
                        class="absolute top-0 right-0 p-4 rounded-md text-red-600 hover:bg-red-300 hover:text-red-800"
                        aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 mt-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Rincian Pembayaran</h3>
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
                                        @elseif ($transaction->status == 'Approved')
                                            <span class="bg-green-100 text-green-800 font-medium mr-2 px-2.5 py-0.5 rounded">Berhasil</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 font-medium mr-2 px-2.5 py-0.5 rounded">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($transaction->status == 'pending' && !$transaction->proof_image)
                                            <a href="{{ route('client.transaction.show',$transaction) }}" class="font-bold py-2 px-6 bg-indigo-700 text-white rounded-full hover:bg-indigo-300">
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
            </div>
        </div>
    </div>
</x-app-layout>