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
                    <h3 class="text-2xl font-semibold text-indigo-700 mb-2">{{ $class->grade }} {{ $class->name }} / {{ $academicYear->start_year }} - {{ $academicYear->end_year }}</h3>
                    <p class="text-gray-600"><strong>Jurusan:</strong> {{ $class->major->name }}</p>
                    <p class="text-gray-600"><strong>Maksimal Siswa:</strong> {{ $class->max_student }}</p>
                    {{-- <p class="text-gray-600"><strong>Deskripsi:</strong> {{ $major->description }}</p> --}}
                </div>
            </div>

            <!-- Related Classes Section -->
            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Siswa 
                        <span class="ml-2 text-sm text-gray-500">(Total: {{ count($studentClass) }})</span>
                    </h3>
                    <div class="flex items-center space-x-2">
                        <input type="text" placeholder="Cari siswa..." class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @include('components.modal-add-student')
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full bg-white rounded-lg overflow-hidden shadow-md">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Identitas</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($studentClass as $index => $student)
                                <tr class="hover:bg-gray-50 transition duration-200 ease-in-out">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $student->name }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $student->identity_no }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('student.show', $student->id) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                                Detail
                                            </a>
                                            <a href="{{ route('student.edit', $student->id) }}" 
                                               class="text-green-600 hover:text-green-900 text-sm font-medium">
                                                Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                        Tidak ada siswa dalam kelas ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function submitSelectedStudents() {
        // Kirim data siswa yang dipilih ke server
        if (this.selectedStudents.length > 0) {
            axios.post('{{ route("school-class.index", $class->id) }}', {
                students: this.selectedStudents
            }).then(response => {
                // Refresh halaman atau update list siswa
                location.reload();
            }).catch(error => {
                // Tangani error
                alert('Gagal menambahkan siswa');
            });
        }
    }
</script>