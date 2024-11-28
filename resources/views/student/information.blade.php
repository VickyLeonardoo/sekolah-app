<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
                {{-- Header Section --}}
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6">
                    <h1 class="text-2xl font-bold text-white text-center">
                        Cek Informasi Siswa
                    </h1>
                </div>

                {{-- Search Form --}}
                <form method="GET" action="{{ route('student.information') }}" class="p-6 space-y-6">
                    @csrf
                    <div>
                        <label for="identity_no" class="block text-sm font-medium text-gray-700">
                            Masukkan NISN
                        </label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <input 
                                type="text" 
                                name="identity_no" 
                                id="identity_no" 
                                required
                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                placeholder="Contoh: 1234567890"
                                value="{{ old('identity_no') }}"
                            >
                            <button 
                                type="submit" 
                                class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Cari
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Student Result Section --}}
                @isset($student)
                <div class="px-6 pb-6">
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 shadow-inner">
                        <div class="grid grid-cols-3 gap-4">
                            {{-- Foto Profil --}}
                            <div class="col-span-1">
                                <img 
                                    src="{{ $student->photo ? asset('storage/'.$student->photo) : 'https://ui-avatars.com/api/?name='.urlencode($student->name) }}" 
                                    alt="{{ $student->name }}" 
                                    class="w-full h-auto rounded-lg object-cover shadow-md"
                                >
                            </div>

                            {{-- Informasi Siswa --}}
                            <div class="col-span-2 space-y-3">
                                <h2 class="text-xl font-semibold text-gray-800">{{ $student->name }}</h2>
                                <div class="grid grid-cols-2 gap-2 text-sm text-gray-600">
                                    <p><strong>NISN:</strong> {{ $student->identity_no }}</p>
                                    <p><strong>Jenis Kelamin:</strong> {{ $student->gender }}</p>
                                    <p><strong>Tanggal Lahir:</strong> {{ $student->dob }}</p>
                                    <p><strong>Agama:</strong> {{ $student->religion }}</p>
                                    <p><strong>Kelas:</strong> {{ $student->grade }}</p>
                                    <p><strong>Jurusan:</strong> {{ $student->major->name }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Orangtua --}}
                        <div class="mt-6 bg-white p-4 rounded-lg border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi Orangtua</h3>
                            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                                <div>
                                    <p><strong>Ayah:</strong> {{ $student->father_name }}</p>
                                    <p><strong>No. Telepon Ayah:</strong> {{ $student->father_phone ?? '-' }}</p>
                                </div>
                                <div>
                                    <p><strong>Ibu:</strong> {{ $student->mother_name }}</p>
                                    <p><strong>No. Telepon Ibu:</strong> {{ $student->mother_phone ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">
                                <strong>Alamat:</strong> {{ $student->address }}
                            </p>
                        </div>
                    </div>
                </div>
                @endisset

                {{-- Error or No Result Section --}}
                @if(session('error'))
                <div class="px-6 pb-6">
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>