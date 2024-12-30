<x-app-layout>
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
                <form action="{{ route('report.store') }}" method="POST">
                    @csrf
                    
                    <div class="mt-4">
                        <x-input-label for="school_class_id" :value="__('Kelas')" />
                        <select name="school_class_id" id="school_class_id" class="rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" selected disabled>{{ __('Pilih Kelas') }}</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->grade }} {{ $class->name }}</option>    
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('school_class_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="start_month" :value="__('Bulan Mulai')" />
                        <x-text-input id="start_month" class="block mt-1 w-full" type="month" name="start_month"
                            :value="old('start_month', request('start_month'))" required autofocus autocomplete="start_month" />
                        <x-input-error :messages="$errors->get('start_month')" class="mt-2" />
                    </div>
                
                    <div class="mt-4">
                        <x-input-label for="end_month" :value="__('Bulan Akhir')" />
                        <x-text-input id="end_month" class="block mt-1 w-full" type="month" name="end_month"
                            :value="old('end_month', request('end_month'))" required autocomplete="end_month" />
                        <x-input-error :messages="$errors->get('end_month')" class="mt-2" />
                    </div>
                
                    <div class="mt-4">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
