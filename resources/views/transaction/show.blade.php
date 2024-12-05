<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto bg-white shadow-2xl rounded-xl overflow-hidden" x-data="{ showRejectModal: false }">
            {{-- Status Ribbon --}}
            <div class="relative mb-8">
                @if ($transaction->status == 'pending')
                    <div class="absolute top-4 right-4 bg-yellow-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                        Menunggu Konfirmasi
                    </div>
                @elseif($transaction->status == 'cancelled')
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                        Dibatalkan
                    </div>
                @elseif($transaction->status == 'approved')
                    <div class="absolute top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                        Berhasil
                    </div>
                @else
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                        Ditolak
                    </div>
                @endif
            </div>

            {{-- Header --}}
            <div class="px-6 py-8 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h1 class="text-4xl font-bold text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        Detail Pembayaran SPP
                    </h1>
                    <div class="flex space-x-3">
                        @if ($transaction->status == 'pending')
                            <form action="{{ route('transaction.approve',$transaction) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-5 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Terima
                                </button>
                            </form>
                            <button 
                                @click="showRejectModal = true" 
                                class="px-5 py-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors flex items-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                Tolak
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Student and Transaction Details --}}
            <div class="grid md:grid-cols-2 gap-8 p-6">
                {{-- Student Information --}}
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Informasi Siswa
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama</span>
                            <span class="font-semibold">{{ $transaction->student->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">NIS</span>
                            <span class="font-semibold">{{ $transaction->student->identity_no }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kelas</span>
                            <span class="font-semibold">{{ $transaction->student->grade }} {{ $transaction->student->major->name }}</span>
                        </div>
                    </div>
                </div>

                {{-- Payment Details --}}
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Detail Pembayaran
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya per Bulan</span>
                            <span class="font-semibold">{{ 'Rp. ' . number_format($academic_year->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Pembayaran</span>
                            <span class="font-semibold">{{ 'Rp. ' . number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Transaksi</span>
                            <span class="font-semibold">{{ $transaction->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Paid Months Section --}}
            <div class="p-6 bg-gray-50 border-t border-gray-200">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Bulan Dibayar
                </h3>
                <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
                    @foreach ($selectedMonths as $month)
                        <div class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:bg-indigo-50 transition-colors">
                            <span class="text-gray-700 font-medium">{{ $month->student_fee->month_name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Payment Proof --}}
            @if ($transaction->proof_image)
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Bukti Pembayaran
                    </h3>
                    <div class="flex justify-center">
                        <img src="{{ Storage::url($transaction->proof_image) }}" alt="Bukti Pembayaran"
                            class="max-w-full h-auto rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
            @endif
            {{-- Rejection Modal --}}
            <div 
                x-show="showRejectModal" 
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                x-cloak
            >
                <div class="bg-white rounded-xl shadow-2xl w-96 p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Alasan Penolakan</h2>
                    <form action="{{ route('transaction.reject', $transaction) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <textarea 
                            name="description" 
                            rows="4" 
                            class="w-full border border-gray-300 rounded-lg p-3 mb-4 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Masukkan alasan penolakan..."
                            required
                        ></textarea>
                        <div class="flex justify-end space-x-3">
                            <button 
                                type="button" 
                                @click="showRejectModal = false" 
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300"
                            >
                                Batal
                            </button>
                            <button 
                                type="submit" 
                                class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600"
                            >
                                Tolak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>