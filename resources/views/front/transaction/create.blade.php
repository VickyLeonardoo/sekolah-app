<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($existTransaction)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Kamu masih memiliki transaksi yang sedang berlangsung. 
                                <a href="{{ route('client.transaction.show', $existTransaction->id) }}" 
                                   class="font-medium underline text-yellow-700 hover:text-yellow-600">
                                    Periksa disini
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                        Pembayaran SPP Tahun {{ $academic_year->start_year }}/{{ $academic_year->end_year }}
                    </h2>

                    <form action="{{ route('client.transaction.store') }}" method="POST">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="fee_id" :value="__('Bulan Pembayaran')" />
                            <select name="fee_id[]" id="fee_id"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                multiple required>
                                <option value="" disabled>Pilih bulan yang ingin dibayarkan</option>
                                @foreach ($student_fee as $fee)
                                    <option value="{{ $fee->id }}">{{ $fee->month_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('fee_id')" class="mt-2" />
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="mt-4">
                                <x-input-label for="amount_all" :value="__('Biaya Perbulan')" />
                                <x-text-input id="amount_all" class="block mt-1 w-full" type="text" name="amount_all"
                                    value="{{ 'Rp. ' . number_format($academic_year->price, 0, ',', '.') }}" required
                                    autofocus autocomplete="amount_all" />
                                <x-input-error :messages="$errors->get('amount_all')" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="month_count" :value="__('Bulan Dipilih')" />
                                <x-text-input id="month_count" class="block mt-1 w-full" type="text" name="month_count"
                                    value="" readonly required autofocus autocomplete="month_count" />
                                <x-input-error :messages="$errors->get('month_count')" class="mt-2" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Total Pembayaran</label>
                            <input type="text" id="total_payment" readonly
                                class="w-full p-2 bg-white border border-gray-300 rounded-lg font-bold">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="font-bold py-3 px-6 bg-indigo-700 text-white rounded-full">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const amountAll = parseInt("{{ $academic_year->price }}", 10); // Ambil harga per bulan
            const totalPaymentInput = document.getElementById('total_payment');
            const monthCountInput = document.getElementById('month_count');

            // Inisialisasi Select2
            $('#fee_id').select2({
                placeholder: 'Pilih bulan pembayaran',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "Data tidak ditemuka karena tahun ajaran belum dimulai"; // Pesan yang ditampilkan saat tidak ada hasil
                    }
                }
            });

            // Validasi Custom
            $('#fee_id').on('select2:select', function(e) {
                const selectedValues = $(this).val().map(Number); // Nilai yang dipilih
                const options = $(this).find('option:not(:disabled)').map((_, opt) => Number(opt.value))
                    .get(); // Semua opsi dalam urutan

                // Pastikan pilihan sesuai urutan
                for (let i = 0; i < selectedValues.length; i++) {
                    if (selectedValues[i] !== options[i]) {
                        alert('Kamu harus membayar dari bulan pertama dan harus berurutan.');
                        const removedValue = e.params.data.id; // Nilai yang salah
                        // Hapus pilihan yang salah
                        $(this).find(`option[value="${removedValue}"]`).prop('selected', false);
                        $(this).trigger('change'); // Trigger ulang perubahan select2
                        return; // Menghentikan eksekusi lebih lanjut
                    }
                }

                // Hitung bulan dipilih dan total pembayaran hanya jika urutannya benar
                updatePayment(selectedValues);
            });

            $('#fee_id').on('change', function() {
                const selectedValues = $(this).val().map(Number); // Nilai yang dipilih
                // Hitung bulan dipilih dan total pembayaran hanya jika urutannya benar
                updatePayment(selectedValues);
            });

            function updatePayment(selectedValues) {
                const monthCount = selectedValues.length;
                monthCountInput.value = monthCount; // Update bulan dipilih

                // Hitung total pembayaran
                const totalPayment = monthCount * amountAll;
                totalPaymentInput.value = 'Rp. ' + totalPayment.toLocaleString('id-ID'); // Format total pembayaran
            }
        });
    </script>

</x-app-layout>
