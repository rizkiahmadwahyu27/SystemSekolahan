<x-app-layout>
    <div class=" w-full h-fit bg-white rounded-lg p-4">
        <div class="grid grid-cols-3 gap-2 justify-center items-center">
            <div class="shadow-xl flex justify-center items-center p-2">
                <div>
                    <h1 class="text-2xl">Import Data Siswa</h1>
                    <form action="{{ route('import_siswa') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-2 mb-2">
                            <input type="file" name="file" required>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Import</button>
                    </form>
                </div>
            </div>
            <div class="shadow-xl flex justify-center items-center p-2">
                <div>
                    <h1 class="text-2xl">Import Data Pegawai</h1>
                    <form action="{{ route('import_pegawai') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-2 mb-2">
                            <input type="file" name="file" required>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Import</button>
                    </form>
                </div>
            </div>
            <div class="shadow-xl flex justify-center items-center p-2">
                <div>
                    <h1 class="text-2xl">Import Data Kelas</h1>
                    <form action="{{ route('import_kelas') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-2 mb-2">
                            <select name="nama_kelas" class="kelasSelect form-select mt-1 block w-full rounded border-gray-300 shadow-sm">
                                @foreach ($data_kelas as $kelas)
                                    <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2 mb-2">
                            <select name="keterangan" class="kelasSelect form-select mt-1 block w-full rounded border-gray-300 shadow-sm" >
                            <option value="Siswa Baru">Siswa Baru</option>
                            <option value="Naik Kelas">Naik Kelas</option>
                            <option value="Tinggal Kelas">Tinggal Kelas</option>
                            <option value="Pindahan">Pindahan</option>
                            <option value="Pindah">Pindah</option>
                            <option value="Keluar">Keluar</option>
                            <option value="Lainnya...">Lainnya...</option>
                        </select>
                        </div>
                        <div class="mt-2 mb-2">
                            <input type="file" name="file" required>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>