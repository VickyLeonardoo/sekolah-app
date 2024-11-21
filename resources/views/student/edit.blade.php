<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Department') }}
            </h2>
            <a href="{{ route('student.show',$student) }}"
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
                <form method="POST" action="{{ route('student.update',$student) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <x-input-label for="identity_no" :value="__('Nomor Induk Siswa Nasional (NISN)')" />
                        <x-text-input id="identity_no" class="block mt-1 w-full" type="text" name="identity_no"
                            value="{{ $student->identity_no }}" required autofocus autocomplete="identity_no" />
                        <x-input-error :messages="$errors->get('identity_no')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Nama Siswa')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            value="{{ $student->name }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="dob" :value="__('Tanggal Lahir')" />
                        <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob"
                            value="{{ $student->dob }}" required autofocus autocomplete="dob" />
                        <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="major_id" :value="__('Jurusan')" />
                        <select name="major_id" id="major_id" class="rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" disabled selected>Pilih Jurusan</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}"{{ $major->id == $student->major_id ? 'selected':'' }}>{{ $major->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('major_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                        <select name="gender" id="gender" class="rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki - Laki" {{ $student->gender == 'Laki - Laki' ? 'selected':'' }} >Laki - Laki</option>
                            <option value="Perempuan" {{ $student->gender == 'Perempuan' ? 'selected':'' }} >Perempuan</option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="religion" :value="__('Agama')" />
                        <select name="religion" id="religion" class="rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" disabled selected>Pilih Agama</option>
                            <option value="Islam" {{ $student->religion == 'Islam' ? 'selected':'' }}>Islam</option>
                            <option value="Protestan" {{ $student->religion == 'Protestan' ? 'selected':'' }}>Protestan</option>
                            <option value="Katolik" {{ $student->religion == 'Katolik' ? 'selected':'' }}>Katolik</option>
                            <option value="Hindu" {{ $student->religion == 'Hindu' ? 'selected':'' }}>Hindu</option>
                            <option value="Buddha" {{ $student->religion == 'Buddha' ? 'selected':'' }}>Buddha</option>
                            <option value="Konghucu" {{ $student->religion == 'Konghucu' ? 'selected':'' }}>Konghucu</option>
                        </select>
                        <x-input-error :messages= "$errors->get('religion')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Nomor Telepon Siswa')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            value="{{ $student->phone }}" autofocus autocomplete="phone" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="address" :value="__('Alamat')" />
                        <textarea id="address" name="address" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ $student->address }}</textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="father_name" :value="__('Nama Ayah')" />
                        <x-text-input id="father_name" class="block mt-1 w-full" type="text" name="father_name"
                            value="{{ $student->father_name }}" required autofocus autocomplete="father_name" />
                        <x-input-error :messages="$errors->get('father_name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="father_phone" :value="__('Nomor Telepon Ayah')" />
                        <x-text-input id="father_phone" class="block mt-1 w-full" type="text" name="father_phone"
                            value="{{ $student->father_phone }}" autofocus autocomplete="father_phone" />
                        <x-input-error :messages="$errors->get('father_phone')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="mother_name" :value="__('Nama Ibu')" />
                        <x-text-input id="mother_name" class="block mt-1 w-full" type="text" name="mother_name"
                            value="{{ $student->mother_name }}" required autofocus autocomplete="mother_name" />
                        <x-input-error :messages="$errors->get('mother_name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="mother_phone" :value="__('Nomor Telepon Ibu')" />
                        <x-text-input id="mother_phone" class="block mt-1 w-full" type="text" name="mother_phone"
                            value="{{ $student->mother_phone }}" autofocus autocomplete="mother_phone" />
                        <x-input-error :messages="$errors->get('mother_phone')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="photo" :value="__('Foto')" />
                        <x-text-input id="photo" class="block mt-1 w-full border-2 border-gray-100 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200" type="file" name="photo" autofocus autocomplete="photo" />
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
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
