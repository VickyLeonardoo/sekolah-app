<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Jurusan') }}
            </h2>
            <a href="{{ route('school-class.index') }}" class="font-bold py-1 px-8 bg-indigo-700 text-white rounded-full flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Class Information Section with Edit and Delete Buttons on Right -->
            <div class="bg-white shadow sm:rounded-lg p-6 mb-6 flex justify-between items-center">
                <!-- Left Side: Class Details -->
                <div>
                    <h3 class="text-2xl font-semibold text-indigo-700 mb-2">{{ $class->grade }} {{ $class->name }}</h3>
                    <p class="text-gray-600"><strong>Jurusan:</strong> {{ $class->major->name }}</p>
                    <p class="text-gray-600"><strong>Maksimal Siswa:</strong> {{ $class->max_student }}</p>
                    {{-- <p class="text-gray-600"><strong>Deskripsi:</strong> {{ $major->description }}</p> --}}
                </div>

                <!-- Right Side: Edit and Delete Buttons -->
                <div class="flex space-x-4">
                    <!-- Edit Class Button -->
                    <a href="{{ route('school-class.edit', $class) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg flex items-center hover:bg-blue-700">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    
                    <!-- Delete Class Button -->
                    <form action="{{ route('school-class.destroy', $class) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus jurusan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg flex items-center hover:bg-red-700">
                            <i class="fas fa-trash mr-2"></i> Hapus
                        </button> 
                    </form>
                </div>
            </div>

            <!-- Related Classes Section -->
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Kelas</h3>
                
                <div class="space-y-4">
                    @foreach($academicYears as $academicYear)
                        <div class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg flex justify-between items-center shadow
                            transform transition duration-200 ease-in-out hover:scale-101">
                            <span class="text-gray-900 font-medium">{{ $academicYear->start_year }}/{{ $academicYear->end_year }}</span>
                            <a href="{{ route('school-class.student',[$class,$academicYear]) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                Lihat Detail
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    {{ $academicYears->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
