<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Tahun Ajaran') }}
            </h2>
            <a href="{{ route('academic-year.index') }}"
                class="font-bold py-1 px-8 bg-indigo-700 text-white rounded-full flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div> 
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="py-3 w-full bg-red-500 text-white font-bold mb-3">
                        <p class="ml-3">{{$error}}</p>
                    </div>
                @endforeach
            @endif
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <form method="POST" action="{{ route('academic-year.store') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- name, email, password, phone, identity_no --}}
                    <div class="mt-4">
                        <x-input-label for="start_year" :value="__('Tahun Mulai')" />
                        <x-text-input id="start_year" class="block mt-1 w-full" type="number" name="start_year"
                            :value="old('start_year')" required autofocus autocomplete="start_year" />
                        <x-input-error :messages="$errors->get('start_year')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="end_year" :value="__('Tahun Selesai')" />
                        <x-text-input id="end_year" class="block mt-1 w-full" type="number" name="end_year"
                            :value="old('end_year')" required autofocus autocomplete="end_year" />
                        <x-input-error :messages="$errors->get('end_year')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="start_month" :value="__('Bulan Mulai')" />
                        <x-text-input id="start_month" class="block mt-1 w-full" type="number" name="start_month"
                            :value="old('start_month')" required autofocus autocomplete="start_month" />
                        <x-input-error :messages="$errors->get('start_month')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="end_month" :value="__('Bulan Selesai')" />
                        <x-text-input id="end_month" class="block mt-1 w-full" type="number" name="end_month"
                            :value="old('end_month')" required autofocus autocomplete="end_month" />
                        <x-input-error :messages="$errors->get('end_month')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Biaya SPP')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                            :value="old('price')" required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
