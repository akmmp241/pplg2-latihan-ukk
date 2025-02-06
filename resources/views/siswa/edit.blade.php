@extends('layouts.main')

@section('content')
    <h1>halaman edit</h1>
    <form action="{{ route('siswa.update', $siswa->nis) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="nis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIS</label>
                <input type="text" id="nis" name="nis" value="{{ $siswa->nis }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

                @error('nis')
                    <p style="color: red;">{{ $message }}</p>
                @enderror

            </div>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                <input type="text" id="name" name="name" value="{{ $siswa->nama }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

                @error('name')
                    <p style="color: red;">{{ $message }}</p>
                @enderror

            </div>
            <div>
                <label for="class" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                <input type="text" id="class" name="class" value="{{ $siswa->kelas }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

                @error('class')
                    <p style="color: red;">{{ $message }}</p>
                @enderror

            </div>
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                <input type="text" id="address" name="address" value="{{ $siswa->alamat }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

                @error('address')
                    <p style="color: red;">{{ $message }}</p>
                @enderror

            </div>
            <button type="submit"
                class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>

    
@endsection
