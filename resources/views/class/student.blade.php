<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Jurusan') }}
            </h2>
            <a href="{{ route('school-class.index') }}"
                class="font-bold py-1 px-8 bg-indigo-700 text-white rounded-full flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <!-- Class Information Section with Edit and Delete Buttons on Right -->
            <!-- Tambahkan tombol edit di samping judul -->
            <div class="bg-white shadow sm:rounded-lg p-6 mb-6 flex justify-between items-center">
                <div>
                    <div class="flex items-center">
                        <h3 class="text-2xl font-semibold text-indigo-700 mb-2 mr-4">
                            {{ $class->grade }} {{ $class->name }} /
                            {{ $academicYear->start_year }} - {{ $academicYear->end_year }}
                        </h3>
                        <button onclick="openHomeroomTeacherModal()"
                            class="text-indigo-600 hover:bg-indigo-100 rounded-full p-2 transition duration-300"
                            title="Edit Wali Kelas">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-gray-600"><strong>Jurusan:</strong> {{ $class->major->name }}</p>
                    <p class="text-gray-600"><strong>Maksimal Siswa:</strong> {{ $class->max_student }}</p>
                    <p class="text-gray-600">
                        <strong>Wali Kelas:</strong>
                        <span id="currentHomeroomTeacher">
                            {{ $currentTeacher == null ? 'Belum ditentukan':$currentTeacher->teacher->user->name }}
                        </span>
                    </p>
                </div>
            </div>


            <!-- Related Classes Section -->
            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Siswa
                        <span class="ml-2 text-sm text-gray-500">(Total: {{ count($studentClass) }})</span>
                    </h3>
                    <div class="flex items-center space-x-2">
                        <input type="text" placeholder="Cari siswa di kelas..."
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button class="bg-indigo-300 px-4 py-2 rounded" onclick="openModal()">Tambah Siswa</button>
                        {{-- @include('components.modal-add-student') --}}
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full bg-white rounded-lg overflow-hidden shadow-md">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NISN</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($studentClass as $index => $student)
                                <tr class="hover:bg-gray-50 transition duration-200 ease-in-out">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $student->student->name }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $student->student->identity_no }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center space-x-2">
                                            <form action="{{ route('student-classes.destroy', $student) }}"
                                                method="POST" class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>
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
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg w-3/4 max-w-4xl shadow-2xl">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-5 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Daftar Siswa</h2>
                <button class="text-gray-500 hover:text-gray-700 transition duration-300" onclick="closeModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-5">
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" id="selectAll" class="form-checkbox text-indigo-600 rounded"
                            onclick="toggleSelectAll()" />
                        <span class="ml-2 text-gray-700">Pilih Semua</span>
                    </label>
                </div>
                <div class="mb-4">
                    <input type="text" id="studentSearch" placeholder="Cari siswa berdasarkan nama..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <form id="studentForm" method="POST"
                    action="{{ route('school-class.store.student', ['school_class_id' => $class->id, 'academic_year_id' => $academicYear->id]) }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-h-96 overflow-y-auto mb-3">
                        <!-- Tambahkan input search ini di dalam modal, tepat di atas grid student -->


                        <!-- Modifikasi di dalam grid student -->
                        @foreach ($students as $student)
                            <div
                                class="student-item bg-gray-50 rounded-lg p-3 hover:bg-indigo-50 transition duration-300 ease-in-out">
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox"
                                        class="form-checkbox student-checkbox text-indigo-600 rounded"
                                        name="students[]" value="{{ $student->id }}"
                                        data-gender="{{ $student->gender }}" onclick="updateSelectedCount()"
                                        @if (in_array($student->id, old('students', []))) checked @endif />
                                    <div class="flex-1">
                                        <div class="student-name font-semibold text-gray-800">
                                            {{ $student->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 flex items-center">
                                            <!-- Kode gender icon sebelumnya tetap sama -->
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Modal Footer -->
                    <div class="p-5 border-t border-gray-200 flex justify-between items-center">
                        <div id="selectionInfo" class="text-sm text-gray-600 mt-6">
                            Total Terpilih: 0 (Laki-laki: 0, Perempuan: 0)
                        </div>
                        <div class="flex space-x-2">
                            <button type="button"
                                class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400 transition duration-300"
                                onclick="closeModal()">Batal</button>
                            <button type="submit" id="saveButton"
                                class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 transition duration-300"
                                disabled>
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Modal Wali Kelas -->
    <div id="homeroomTeacherModal"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-2xl w-11/12 max-w-2xl">
            <!-- Modal Header -->
            <div class="bg-indigo-600 text-white px-6 py-4 rounded-t-xl flex justify-between items-center">
                <h2 class="text-xl font-bold">Pilih Wali Kelas</h2>
                <button onclick="closeHomeroomTeacherModal()"
                    class="hover:bg-indigo-500 rounded-full p-2 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form method="POST"
                action="{{ route('teacher-classes.store') }}" class="p-6">
                @csrf
                <!-- Search Input -->
                <div class="mb-4 relative">
                    <input type="text" id="teacherSearch" placeholder="Cari guru berdasarkan nama atau NIP"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-3 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="hidden" name="school_class_id" value="{{ $class->id }}">
                <input type="hidden" name="academic_year_id" value="{{ $academicYear->id }}">
                <!-- Teacher List -->
                <!-- Teacher Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-h-96 overflow-y-auto">
                    @foreach ($teachers as $teacher)
                        <label
                            class="teacher-item cursor-pointer hover:bg-indigo-50 transition duration-300 p-3 rounded-lg flex items-center">
                            <input type="radio" name="teacher_id" value="{{ $teacher->id }}"
                                class="form-radio text-indigo-600 mr-3">
                            <div>
                                <div class="font-semibold text-gray-800">Nama: {{ $teacher->user->name }}</div>
                                <div class="text-sm text-gray-500">NIP: {{ $teacher->user->identity_no }}</div>
                            </div>
                        </label>
                    @endforeach
                </div>

                <!-- Modal Footer -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeHomeroomTeacherModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-300">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Modal Functions
        function openHomeroomTeacherModal() {
            document.getElementById('homeroomTeacherModal').classList.remove('hidden');
        }
    
        function closeHomeroomTeacherModal() {
            document.getElementById('homeroomTeacherModal').classList.add('hidden');
        }
    
        // Teacher Search Function
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('teacherSearch');
            const teacherItems = document.querySelectorAll('.teacher-item');
    
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
    
                teacherItems.forEach(item => {
                    const teacherName = item.querySelector('.font-semibold').textContent.toLowerCase();
                    const teacherNIP = item.querySelector('.text-gray-500').textContent.toLowerCase();
    
                    if (teacherName.includes(searchTerm) || teacherNIP.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[placeholder="Cari siswa di kelas..."]');
            const studentRows = document.querySelectorAll('tbody tr');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();

                studentRows.forEach(row => {
                    const studentName = row.querySelector('td:nth-child(2)').textContent
                        .toLowerCase();
                    const studentNISN = row.querySelector('td:nth-child(3)').textContent
                        .toLowerCase();

                    // Sembunyikan/tampilkan baris berdasarkan pencarian
                    if (studentName.includes(searchTerm) || studentNISN.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Update jumlah siswa yang ditampilkan
                updateVisibleStudentCount();
            });

            function updateVisibleStudentCount() {
                const visibleRows = Array.from(studentRows).filter(row => row.style.display !== 'none');
                const totalSpan = document.querySelector('h3 span');

                if (totalSpan) {
                    totalSpan.textContent = `(Total: ${visibleRows.length})`;
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('studentSearch');
            const studentCheckboxes = document.querySelectorAll('.student-checkbox');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();

                studentCheckboxes.forEach(checkbox => {
                    const studentNameElement = checkbox.closest('.student-item');
                    const studentName = studentNameElement.querySelector('.student-name')
                        .textContent.toLowerCase();

                    if (studentName.includes(searchTerm)) {
                        studentNameElement.style.display = 'block';
                    } else {
                        studentNameElement.style.display = 'none';
                    }
                });

                // Update selection count for visible items
                updateSelectedCount();
            });
        });

        const openModal = () => document.getElementById('modal').classList.remove('hidden');
        const closeModal = () => document.getElementById('modal').classList.add('hidden');

        const toggleSelectAll = () => {
            const checkboxes = document.querySelectorAll('.student-checkbox');
            const selectAllCheckbox = document.getElementById('selectAll');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateSelectedCount();
            updateSaveButtonStatus(); // Memperbarui status tombol Simpan setelah memilih/menonaktifkan semua
        };

        const updateSelectedCount = () => {
            const checkboxes = document.querySelectorAll('.student-checkbox');
            const selectionInfo = document.getElementById('selectionInfo');
            const saveButton = document.getElementById('saveButton'); // Ambil tombol Simpan

            let totalSelected = 0;
            let maleSelected = 0;
            let femaleSelected = 0;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    totalSelected++;
                    checkbox.getAttribute('data-gender') === 'Male' ? maleSelected++ : femaleSelected++;
                }
            });

            selectionInfo.textContent =
                `Total Terpilih: ${totalSelected} (Laki-laki: ${maleSelected}, Perempuan: ${femaleSelected})`;

            // Jika tidak ada yang terpilih, disable tombol Simpan
            if (totalSelected === 0) {
                saveButton.disabled = true;
            } else {
                saveButton.disabled = false;
            }
        };

        // Fungsi untuk memperbarui status tombol "Simpan"
        const updateSaveButtonStatus = () => {
            const checkboxes = document.querySelectorAll('.student-checkbox:checked');
            const saveButton = document.getElementById('saveButton');

            if (checkboxes.length > 0) {
                saveButton.disabled = false; // Aktifkan tombol jika ada yang dipilih
            } else {
                saveButton.disabled = true; // Nonaktifkan tombol jika tidak ada yang dipilih
            }
        };

        // Menambahkan event listener pada checkbox individual
        document.querySelectorAll('.student-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });

        // Memanggil fungsi untuk memperbarui status tombol saat pertama kali dimuat
        updateSaveButtonStatus();
    </script>

</x-app-layout>
