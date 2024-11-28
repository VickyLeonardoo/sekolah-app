<div x-data="{ 
    showModal: false, 
    selectedStudents: [], 
    selectAll: false, 
    students: {{ Js::from($students) }},
    get maleCount() {
        return this.selectedStudents.filter(id => this.students.find(s => s.id === id && s.gender === 'Male')).length;
    },
    get femaleCount() {
        return this.selectedStudents.filter(id => this.students.find(s => s.id === id && s.gender === 'Female')).length;
    },
    submitSelectedStudents() {
        if (this.selectedStudents.length > 0) {
            axios.post('{{ route("school-class.store.student", [$class->id, $academicYear->id]) }}', {
                students: this.selectedStudents
            }).then(response => {
                // Refresh halaman atau update list siswa
                location.reload();
            }).catch(error => {
                // Tangani error
                alert('Gagal menambahkan siswa');
            });
        } else {
            alert('Tidak ada siswa yang dipilih.');
        }
    }
}">
    <!-- Tombol Tambah Siswa -->
    <button @click="showModal = true"
        class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700 transition duration-300">
        Tambah Siswa
    </button>

    <!-- Modal -->
    <div x-show="showModal" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
        <div class="relative w-full max-w-4xl mx-auto my-6">
            <div
                class="relative flex flex-col w-full bg-white border-0 rounded-lg shadow-lg outline-none focus:outline-none">
                <!-- Modal Header -->
                <div class="flex items-start justify-between p-5 border-b border-solid rounded-t border-blueGray-200">
                    <h3 class="text-xl font-semibold">Tambah Siswa ke Kelas</h3>
                    <button @click="showModal = false"
                        class="float-right p-1 ml-auto text-3xl font-semibold leading-none text-black bg-transparent border-0 outline-none opacity-5 focus:outline-none">
                        <span
                            class="block w-6 h-6 text-2xl text-black bg-transparent opacity-5 outline-none focus:outline-none">
                            ×
                        </span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="relative p-6 flex-auto">
                    <div class="flex items-center mb-4">
                        <input type="checkbox" x-model="selectAll"
                            @change="selectedStudents = selectAll ? students.map(s => s.id) : []"
                            class="mr-2 rounded text-indigo-600 focus:ring-indigo-500">
                        <label class="text-sm">Pilih Semua Siswa</label>
                    </div>

                    <div class="overflow-x-auto max-h-96 overflow-y-auto">
                        <table class="w-full bg-white rounded-lg overflow-hidden shadow-md">
                            <thead class="bg-gray-100 border-b border-gray-200 sticky top-0">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <input type="checkbox" x-model="selectAll"
                                            @change="selectedStudents = selectAll ? students.map(s => s.id) : []"
                                            class="rounded text-indigo-600 focus:ring-indigo-500">
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nomor Identitas</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jenis Kelamin</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <template x-for="student in students" :key="student.id">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-4">
                                            <input type="checkbox" :value="student.id" x-model="selectedStudents"
                                                class="rounded text-indigo-600 focus:ring-indigo-500">
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900"
                                            x-text="student.name"></td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"
                                            x-text="student.identity_no"></td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"
                                            x-text="{
                                            'Male': 'Laki - Laki',
                                            'Female': 'Perempuan'
                                        }[student.gender] || 'Tidak Diketahui'">
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-between p-6 border-t border-solid rounded-b border-blueGray-200">
                    <!-- Bagian Kiri: Jumlah Gender -->
                    <div class="flex space-x-4 text-sm">
                        <p>Total Laki-laki: <span class="font-semibold" x-text="maleCount"></span></p>
                        <p>Total Perempuan: <span class="font-semibold" x-text="femaleCount"></span></p>
                    </div>
                
                    <!-- Bagian Kanan: Tombol -->
                    <div class="flex space-x-4">
                        <button @click="showModal = false"
                            class="px-6 py-2 text-sm font-bold text-gray-600 uppercase transition-all duration-150 ease-linear focus:outline-none hover:bg-red-600 hover:text-white rounded">
                            Batal
                        </button>
                        <button @click="submitSelectedStudents()"
                            class="bg-indigo-600 text-white active:bg-indigo-700 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg focus:outline-none ease-linear transition-all duration-150">
                            Tambah Siswa (<span x-text="selectedStudents.length"></span>)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submitSelectedStudents() {
        // Kirim data siswa yang dipilih ke server
        if (this.selectedStudents.length > 0) {
            axios.post('{{ route("school-class.store.student", [$class->id,$academicYear->id]) }}', {
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