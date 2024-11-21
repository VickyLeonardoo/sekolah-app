<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Siswa') }}
            </h2>
            <div class="flex space-x-3">
                <form action="{{ route('student.destroy',$student) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mr-4 font-bold py-2 px-4 bg-red-700 text-white rounded-full">
                        Hapus
                    </button>
                </form>
                <a href="{{ route('student.edit', $student) }}" 
                   class="font-bold py-2 px-4 bg-blue-600 text-white rounded-full flex items-center hover:bg-blue-700 transition">
                    <i class="fas fa-edit mr-2"></i>
                    Edit
                </a>
                <a href="{{ route('student.index') }}"
                   class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full flex items-center hover:bg-indigo-800 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid md:grid-cols-3 gap-8 p-8">
                    {{-- Profile Photo and Basic Info Column --}}
                    <div class="md:col-span-1 flex flex-col items-center">
                        <div class="w-64 h-64 rounded-full overflow-hidden shadow-lg border-4 border-indigo-100 mb-6">
                            <img 
                                src="{{ $student->photo ? Storage::url($student->photo) : asset('default-avatar.png') }}" 
                                alt="{{ $student->name }}" 
                                class="w-full h-full object-cover"
                            >
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 text-center">{{ $student->name }}</h2>
                        <p class="text-indigo-600 font-semibold">{{ $student->major->name }}</p>
                    </div>

                    {{-- Detailed Information Column --}}
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-5 rounded-xl shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-2">Data Pribadi</h3>
                            <div class="space-y-2">
                                <p class="flex items-center">
                                    <i class="fas fa-id-card mr-3 text-indigo-600"></i>
                                    <span class="font-medium">NISN:</span>
                                    <span class="ml-2">{{ $student->identity_no }}</span>
                                </p>
                                <p class="flex items-center">
                                    <i class="fas fa-birthday-cake mr-3 text-indigo-600"></i>
                                    <span class="font-medium">Tanggal Lahir:</span>
                                    <span class="ml-2">{{ \Carbon\Carbon::parse($student->dob)->format('d M Y') }}</span>
                                </p>
                                <p class="flex items-center">
                                    <i class="fas fa-venus-mars mr-3 text-indigo-600"></i>
                                    <span class="font-medium">Jenis Kelamin:</span>
                                    <span class="ml-2">{{ $student->gender }}</span>
                                </p>
                                <p class="flex items-center">
                                    <i class="fas fa-pray mr-3 text-indigo-600"></i>
                                    <span class="font-medium">Agama:</span>
                                    <span class="ml-2">{{ $student->religion }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-5 rounded-xl shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-2">Kontak</h3>
                            <div class="space-y-2">
                                <p class="flex items-center">
                                    <i class="fas fa-phone mr-3 text-indigo-600"></i>
                                    <span class="font-medium">No. Telepon:</span>
                                    <span class="ml-2">{{ $student->phone ?? '-' }}</span>
                                </p>
                                <p class="flex items-center">
                                    <i class="fas fa-map-marker-alt mr-3 text-indigo-600"></i>
                                    <span class="font-medium">Alamat:</span>
                                    <span class="ml-2">{{ $student->address ?? '-' }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-5 rounded-xl shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-2">Data Ayah</h3>
                            <div class="space-y-2">
                                <p class="flex items-center">
                                    <i class="fas fa-user mr-3 text-indigo-600"></i>
                                    <span class="font-medium">Nama:</span>
                                    <span class="ml-2">{{ $student->father_name }}</span>
                                </p>
                                <p class="flex items-center">
                                    <i class="fas fa-phone mr-3 text-indigo-600"></i>
                                    <span class="font-medium">No. Telepon:</span>
                                    <span class="ml-2">{{ $student->father_phone ?? '-' }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-5 rounded-xl shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-2">Data Ibu</h3>
                            <div class="space-y-2">
                                <p class="flex items-center">
                                    <i class="fas fa-user mr-3 text-indigo-600"></i>
                                    <span class="font-medium">Nama:</span>
                                    <span class="ml-2">{{ $student->mother_name }}</span>
                                </p>
                                <p class="flex items-center">
                                    <i class="fas fa-phone mr-3 text-indigo-600"></i>
                                    <span class="font-medium">No. Telepon:</span>
                                    <span class="ml-2">{{ $student->mother_phone ?? '-' }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>