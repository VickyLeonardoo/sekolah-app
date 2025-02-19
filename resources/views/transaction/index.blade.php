<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Jurusan') }}
            </h2>
        </div>

    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 relative" role="alert">
                    <span class="font-medium">{{ session('success') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button" class="absolute top-0 right-0 p-4 rounded-md text-green-600 hover:bg-green-300 hover:text-green-800" aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <!-- Tombol Riwayat Transaksi -->
                    <a href="{{ route('transaction.history') }}"
                        class="border border-indigo-600 text-indigo-600 px-4 py-2 rounded-full hover:bg-indigo-600 hover:text-white transition duration-300">
                        Riwayat Transaksi
                    </a>
            
                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('transaction.index') }}" class="flex w-full md:w-auto ml-auto">
                        <input type="text" name="search" placeholder="Cari data transaksi"
                            class="rounded-l-full w-full md:w-64 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            value="{{ request('search') }}">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-r-full hover:bg-indigo-700 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="text-left">
                            <th
                                class="bg-indigo-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-indigo-600 font-bold tracking-wider uppercase text-xs">
                                Nomor Transaksi</th>
                            <th
                                class="bg-indigo-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-indigo-600 font-bold tracking-wider uppercase text-xs">
                                Nama</th>
                            <th
                                class="bg-indigo-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-indigo-600 font-bold tracking-wider uppercase text-xs">
                                Siswa</th>
                            <th
                                class="bg-indigo-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-indigo-600 font-bold tracking-wider uppercase text-xs">
                                Nominal</th>
                            <th
                                class="bg-indigo-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-indigo-600 font-bold tracking-wider uppercase text-xs">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body">
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td class="border-b border-gray-200 px-6 py-4">{{ $transaction->transaction_no }}</td>
                                <td class="border-b border-gray-200 px-6 py-4">{{ $transaction->user->name }}</td>
                                <td class="border-b border-gray-200 px-6 py-4">{{ $transaction->student->name }}</td>
                                <td class="border-b border-gray-200 px-6 py-4">@rupiah($transaction->amount)</td>
                                <td class="border-b border-gray-200 px-6 py-4">
                                    <a href="{{ route('transaction.show', $transaction) }}" class="font-bold py-2 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-lg">View</a>
                                </td>
                            <tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center border-b border-gray-200 px-6 py-4">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
