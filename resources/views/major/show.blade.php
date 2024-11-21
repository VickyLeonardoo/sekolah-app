<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Jurusan') }}
            </h2>
            <a href="{{ route('major.index') }}" class="font-bold py-1 px-8 bg-indigo-700 text-white rounded-full flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Major Information Section -->
            <div class="bg-white shadow sm:rounded-lg p-6 mb-6 flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-semibold text-indigo-700 mb-2">{{ $major->name }}</h3>
                    <p class="text-gray-600"><strong>Kode:</strong> {{ $major->code }}</p>
                    <p class="text-gray-600"><strong>Deskripsi:</strong> {{ $major->description }}</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('major.edit', $major->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg flex items-center hover:bg-blue-700">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    <form action="{{ route('major.destroy', $major->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus jurusan ini?');">
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
    
                @if($major->class->isEmpty())
                    <p class="text-gray-600">Belum ada kelas pada jurusan ini.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Grade 10 -->
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Kelas 10</h4>
                            @forelse($major->class->filter(fn($class) => $class->grade == 10) as $class)
                                <div class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg shadow flex justify-between items-center mt-2">
                                    <span class="text-gray-900 font-medium">{{ $class->name }}</span>
                                    <a href="{{ route('school-class.show', $class->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                        Lihat Detail
                                    </a>
                                </div>
                            @empty
                                <p class="text-gray-600">Tidak ada kelas.</p>
                            @endforelse
                        </div>
    
                        <!-- Grade 11 -->
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Kelas 11</h4>
                            @forelse($major->class->filter(fn($class) => $class->grade == 11) as $class)
                                <div class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg shadow flex justify-between items-center mt-2">
                                    <span class="text-gray-900 font-medium">{{ $class->name }}</span>
                                    <a href="{{ route('school-class.show', $class->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                        Lihat Detail
                                    </a>
                                </div>
                            @empty
                                <p class="text-gray-600">Tidak ada kelas.</p>
                            @endforelse
                        </div>
    
                        <!-- Grade 12 -->
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Kelas 12</h4>
                            @forelse($major->class->filter(fn($class) => $class->grade == 12) as $class)
                                <div class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg shadow flex justify-between items-center mt-2">
                                    <span class="text-gray-900 font-medium">{{ $class->name }}</span>
                                    <a href="{{ route('school-class.show', $class->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                        Lihat Detail
                                    </a>
                                </div>
                            @empty
                                <p class="text-gray-600">Tidak ada kelas.</p>
                            @endforelse
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
