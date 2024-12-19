<x-app-layout>
    <div class="py-12 ">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($transaction->description)
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400 relative"
                    role="alert">
                    <span class="font-medium">{{ $transaction->description }}</span>
                </div>
            @endif
            <div class="bg-white shadow-2xl sm:rounded-xl overflow-hidden border-t-4 border-indigo-500">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 md:p-10 flex flex-col gap-y-6 relative">
                    {{-- Ribbon --}}
                    @if ($transaction->status == 'pending')
                        <div
                            class="absolute transform rotate-45 bg-green-600 text-center text-white font-semibold py-1 right-[-35px] top-[32px] w-[170px] shadow-lg">
                            Pending
                        </div>
                    @elseif($transaction->status == 'cancelled')
                        <div
                            class="absolute transform rotate-45 bg-red-600 text-center text-white font-semibold py-1 right-[-35px] top-[32px] w-[170px] shadow-lg">
                            Dibatalkan
                        </div>
                    @elseif($transaction->status == 'approved')
                        <div
                            class="absolute transform rotate-45 bg-green-600 text-center text-white font-semibold py-1 right-[-35px] top-[32px] w-[170px] shadow-lg">
                            Berhasil
                        </div>
                    @else
                        <div
                            class="absolute transform rotate-45 bg-red-600 text-center text-white font-semibold py-1 right-[-35px] top-[32px] w-[170px] shadow-lg">
                            Ditolak
                        </div>
                    @endif

                    {{-- Header Section --}}
                    <div class="flex justify-between items-center border-b pb-4 mb-2">
                        <h2 class="text-3xl font-extrabold text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            Detail Pembayaran SPP
                        </h2>
                        <div class="flex items-center space-x-3 mr-10">
                            @if ($transaction->status == 'pending')
                                <form action="{{ route('client.transaction.cancel', $transaction->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?');"
                                    class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Batalkan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    {{-- Month Selection Card --}}
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Bulan Dibayar
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach ($selectedMonths as $month)
                                <div
                                    class="bg-white border border-gray-200 rounded-md p-3 text-center hover:bg-indigo-50 transition-colors">
                                    <span class="text-gray-700 font-medium">{{ $month->student_fee->month_name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Payment Details --}}
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <label class="block text-gray-600 font-bold mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Biaya per Bulan
                            </label>
                            <input type="text" readonly
                                value="{{ 'Rp. ' . number_format($academic_year->price, 0, ',', '.') }}"
                                class="w-full bg-white border border-gray-300 rounded-md px-4 py-3 text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <label class="block text-gray-600 font-bold mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Total Pembayaran
                            </label>
                            <input type="text" readonly
                                value="{{ 'Rp. ' . number_format($transaction->amount, 0, ',', '.') }}"
                                class="w-full bg-white border border-gray-300 rounded-md px-4 py-3 text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    {{-- Uploaded Proof Image Section --}}
                    @if ($transaction->proof_image)
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Bukti Pembayaran
                            </h3>
                            <div class="flex justify-center">
                                <img src="{{ Storage::url($transaction->proof_image) }}" alt="Bukti Pembayaran"
                                    class="max-w-full h-auto rounded-lg shadow-lg hover:scale-105 transition-transform">
                            </div>
                        </div>
                    @endif

                    {{-- Upload Proof Section --}}
                    @if ($transaction->proof_image == '')
                   
                        <div class="mt-4">
                            <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-200 dark:bg-gray-800 dark:text-yellow-400 relative"
                            role="alert">
                            <span class="font-medium"><strong>Perhatian!</strong><br>
                                Sebelum menunggah bukti pembayaran pastikan bukti pembayaran yang dimasukkan valid, karna anda tidak dapat mengubahnya kembali jika sudah di upload! Jika terlanjur memasukkan bukti pembayaran yang valid, Anda dapat membatalkan transaksi dan membuat ulang transaksi. <br><u>Abaikan pesan ini jika bukti yang Anda upload sudah valid.</u>
                            </span>
                            <!-- Tombol silang dengan SVG -->
                            
                        </div>
                            <form action="{{ route('client.transaction.update', $transaction->id) }}" method="POST"
                                enctype="multipart/form-data" class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                                @csrf
                                @method('PUT')
                                <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Upload Bukti Pembayaran
                                </h3>

                                <div class="mb-4">
                                    <input type="file" name="proof_image" accept="image/*"
                                        class="block w-full text-sm text-gray-500 
                                            file:mr-4 file:py-2 file:px-4 
                                            file:rounded-full file:border-0 
                                            file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-indigo-700
                                            hover:file:bg-indigo-100
                                            focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    @error('proof_image')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="w-full bg-indigo-700 text-white py-3 rounded-full hover:bg-indigo-600 transition-colors flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-9.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Unggah Bukti
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
