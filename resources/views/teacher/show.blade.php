<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center px-4">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                {{ __('Detail Guru') }}: {{ $teacher->user->name }}
            </h2>
            <a href="{{ route('teacher.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 text-sm rounded-md transition duration-300">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">
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
            @endif
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-4">
                    <!-- Profile Header with Photo Upload -->
                    <div class="flex items-start space-x-4 mb-4">
                        <div class="flex-shrink-0 relative group">
                            <img src="{{ Storage::url($teacher->photo) }}" 
                                 alt="Foto {{ $teacher->user->name }}" 
                                 class="h-26 w-40 rounded-lg shadow-sm object-cover">
                            
                            <!-- Photo Upload Overlay -->
                            <form action="{{ route('teacher.update-photo', $teacher->id) }}" 
                                  method="POST" 
                                  enctype="multipart/form-data" 
                                  id="photoForm">
                                @csrf
                                @method('PUT')
                                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <label for="photo" class="cursor-pointer">
                                        <span class="sr-only">Ubah foto</span>
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </label>
                                    <input type="file" 
                                           id="photo" 
                                           name="photo" 
                                           class="hidden" 
                                           accept="image/*"
                                           onchange="document.getElementById('photoForm').submit()">
                                </div>
                            </form>
                        </div>

                        <div class="flex-1 min-w-0 pt-1">
                            <h3 class="text-lg font-medium text-gray-900 truncate">{{ $teacher->user->name }}</h3>
                            <p class="text-gray-500 text-sm">{{ $teacher->user->email }}</p>
                            
                            <!-- Quick Actions -->
                            <div class="mt-3 flex space-x-2">
                                <a href="{{ route('teacher.edit', $teacher->id) }}" 
                                   class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Edit
                                </a>
                                <form action="{{ route('teacher.destroy', $teacher->id) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Information Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="bg-gray-50 rounded-md p-3 hover:bg-gray-100">
                            <h4 class="font-medium text-gray-800 text-sm mb-2">Informasi Tambahan</h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center text-gray-600">
                                    <span class="w-32 flex-shrink-0">Nomor Telepon:</span>
                                    <span class="font-medium">{{ $teacher->user->phone }}</span>
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <span class="w-32 flex-shrink-0">Nomor Identitas:</span>
                                    <span class="font-medium">{{ $teacher->user->identity_no }}</span>
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <span class="w-32 flex-shrink-0">Terdaftar Sejak:</span>
                                    <span class="font-medium">{{ $teacher->created_at->format('d M Y') }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-gray-50 rounded-md p-3 hover:bg-gray-100">
                            <h4 class="font-medium text-gray-800 text-sm mb-2">Tentang</h4>
                            <p class="text-sm text-gray-600">
                                {{ $teacher->user->about ?? 'Belum ada informasi.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Optional: Add preview before upload
        document.getElementById('photo').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                if (confirm('Apakah Anda ingin mengupload foto ini?')) {
                    document.getElementById('photoForm').submit();
                }
            }
        });
    </script>
    @endpush
</x-app-layout>