<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div x-data="paymentSelection()">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Pembayaran SPP Tahun 2024</h2>
                    
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        @php
                            $months = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            $paidMonths = ['Januari', 'Februari']; // Contoh bulan yang sudah dibayar
                        @endphp
                
                        @foreach($months as $index => $month)
                            <div 
                                @click="toggleMonth('{{ $month }}')"
                                class="cursor-pointer p-4 text-center rounded-lg text-sm font-medium transition-all duration-300 ease-in-out"
                                :class="{
                                    'bg-indigo-300 text-white': selectedMonths.includes('{{ $month }}'),
                                    'bg-gray-200 text-gray-700': !selectedMonths.includes('{{ $month }}'),
                                    'opacity-50 cursor-not-allowed': {{ in_array($month, $paidMonths) ? 'true' : 'false' }}
                                }"
                            >
                                {{ $month }}
                            </div>
                        @endforeach
                    </div>

                    <form @submit.prevent="submitPayment" class="bg-gray-100 p-6 rounded-lg">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Bulan Dipilih</label>
                                <input 
                                    type="text" 
                                    x-model="selectedMonthsText" 
                                    readonly 
                                    class="w-full p-2 bg-white border border-gray-300 rounded-lg"
                                >
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah Bulan</label>
                                <input 
                                    type="number" 
                                    x-model="selectedMonths.length" 
                                    readonly 
                                    class="w-full p-2 bg-white border border-gray-300 rounded-lg"
                                >
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Biaya per Bulan</label>
                                <input 
                                    type="text" 
                                    value="Rp 135.000" 
                                    readonly 
                                    class="w-full p-2 bg-white border border-gray-300 rounded-lg"
                                >
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Total Pembayaran</label>
                                <input 
                                    type="text" 
                                    x-model="totalPayment" 
                                    readonly 
                                    class="w-full p-2 bg-white border border-gray-300 rounded-lg font-bold"
                                >
                            </div>
                        </div>

                        <button 
                            type="submit" 
                            class="mt-4 w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-300"
                            :disabled="selectedMonths.length === 0"
                        >
                            Bayar SPP
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function paymentSelection() {
            return {
                selectedMonths: [],
                monthCost: 135000,
                
                toggleMonth(month) {
                    if (this.selectedMonths.includes(month)) {
                        this.selectedMonths = this.selectedMonths.filter(m => m !== month);
                    } else {
                        this.selectedMonths.push(month);
                    }
                },
                
                get selectedMonthsText() {
                    return this.selectedMonths.join(', ');
                },
                
                get totalPayment() {
                    const total = this.selectedMonths.length * this.monthCost;
                    return total > 0 ? `Rp ${total.toLocaleString('id-ID')}` : 'Rp 0';
                },
                
                submitPayment() {
                    if (this.selectedMonths.length > 0) {
                        alert(`Membayar SPP untuk ${this.selectedMonthsText}`);
                        // Tambahkan logika submit form di sini
                    }
                }
            }
        }
    </script>
</x-app-layout>