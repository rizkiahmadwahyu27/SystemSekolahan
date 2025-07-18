<div>
    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 mb-3 rounded">{{ session('message') }}</div>
    @endif
    <div class="w-full flex justify-center items-center">
        <div>
            <a href="{{route('scan_barcode')}}" class="bg-blue-600 hover:text-white rounded-md hover:bg-blue-800 p-2 text-slate-400">Scan Barcode</a>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-2 p-4">
        <div class="flex justify-center items-center">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-2">
                <input wire:model="nis" type="text" placeholder="NIS" class="border p-1 w-full">
                <input wire:model="nama" type="text" placeholder="Nama Siswa" class="border p-1 w-full">
                <input wire:model="kelas" type="text" placeholder="Kelas" class="border p-1 w-full">
                <input wire:model="guru" type="text" placeholder="Nama Guru" class="border p-1 w-full">
                <select wire:model="jenis_absen" class="border p-1 w-full">
                    <option value="">-- Pilih Absen --</option>
                    <option>Harian</option>
                    <option>Mapel</option>
                </select>
                <select wire:model="hari" class="border p-1 w-full">
                    <option value="">-- Pilih Hari --</option>
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                    <option>Kamis</option>
                    <option>Jum'at</option>
                </select>
                <input wire:model="tanggal" type="date" class="border p-1 w-full">
                <select wire:model="status" class="border p-1 w-full">
                    <option value="">-- Pilih Status --</option>
                    <option>Hadir</option>
                    <option>Izin</option>
                    <option>Sakit</option>
                    <option>Alpa</option>
                </select>
                <textarea wire:model="keterangan" cols="15" rows="3" class="border p-1 w-full"></textarea>
                <button type="submit" class="bg-blue-500 text-white px-3 py-1">
                    {{ $isEdit ? 'Update' : 'Simpan' }}
                </button>

                @if($isEdit)
                    <button wire:click="resetInput" type="button" class="bg-gray-500 text-white px-3 py-1">Batal</button>
                @endif
            </form>
        </div>
        <div>
            <table class="w-full border-collapse border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-2 py-1">Nama</th>
                        <th class="border px-2 py-1">Tanggal</th>
                        <th class="border px-2 py-1">Status</th>
                        <th class="border px-2 py-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absens as $absen)
                        <tr>
                            <td class="border px-2 py-1">{{ $absen->nama }}</td>
                            <td class="border px-2 py-1">{{ $absen->tanggal }}</td>
                            <td class="border px-2 py-1">{{ $absen->status }}</td>
                            <td class="border px-2 py-1">
                                <button wire:click="edit({{ $absen->id }})" class="text-blue-600">Edit</button>
                                <button wire:click="delete({{ $absen->id }})" class="text-red-600 ml-2">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
