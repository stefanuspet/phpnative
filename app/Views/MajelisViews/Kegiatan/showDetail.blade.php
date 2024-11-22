@extends('layouts.MajelisLayout')

@section('title', 'Kegiatan')
@section('content')
<div class="w-full">
    <div class="bg-white shadow-xl rounded-md px-8 py-4">
        <h1 class="text-4xl font-bold text-blue-950 pb-4">{{$kegiatan->nama}}</h1>
        <table class="mb-4">
            <tr>
                <td>Lokasi</td>
                <td class="px-2">:</td>
                <td>{{$kegiatan->lokasi}}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td class="px-2">:</td>
                <td>{{$kegiatan->date}}</td>
            </tr>
            <tr>
                <td>Jumlah Pendaftar</td>
                <td class="px-2">:</td>
                <td>{{$kegiatan->count_peserta}}</td>
            </tr>
        </table>
        <hr>
        <h1 class="text-xl font-bold text-blue-950 pb-4 mt-2">Daftar Peserta Kegiatan</h1>
        <table class="w-full mt-2 text-center border">
            <thead>
                <tr class="border">
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Tempat Tanggal Lahir</th>
                    <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">Tahun Bergabung</th>
                    <th scope="col" class="px-6 py-3">Status Pendaftaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peserta as $items)
                <tr>
                    <td class="px-6 py-4">{{$items->anggota->nama}}</td>
                    <td class="px-6 py-4">{{$items->anggota->tempat_lahir}}, {{$items->anggota->tanggal_lahir}}</td>
                    <td class="px-6 py-4">{{$items->anggota->jenis_kelamin }}</td>
                    <td class="px-6 py-4">{{$items->anggota->alamat}}</td>
                    <td class="px-6 py-4">{{$items->anggota->tahun_gabung}}</td>
                    <td class="px-6 py-4">{{$items->status}}</td>
                    <td>
                        <form action="/dashboard/peserta/update" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$items->id}}">
                            <input type="hidden" name="kegiatan_id" id="kegiatan_id" value="{{$kegiatan->id}}">
                            <button type="submit" class="px-3 py-2 hover:bg-green-600 bg-green-500 my-1 rounded-md text-white text-center">Terima</button>
                        </form>
                        <button 
                                class="px-3 py-2 hover:bg-red-600 bg-red-500 my-1 rounded-md text-white text-center editButton" 
                                data-id="{{ $items->id }}"
                                data-kegiatan="{{ $kegiatan->id }}"
                                >Tolak</button>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-1/2">
        <h2 class="text-2xl font-bold mb-4">Berikan Catatan</h2>
        <form id="editForm" action="/dashboard/peserta/update" method="POST">
            @csrf
            <input type="hidden" name="id" id="editId">
            <input type="hidden" name="kegiatan_id" id="kegiatanId">
            <div class="mb-3">
                <label for="catatan" class="block">Catatan</label>
                <input type="text" name="catatan" id="catatan" class="w-full border border-blue-600 rounded-md p-2" value="{{ $latihan->catatan  }}" required>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeEditModalBtn" class="bg-red-600 text-white px-4 py-2 rounded-md mr-2">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    const editModal = document.getElementById('editModal');
    const closeEditModalBtn = document.getElementById('closeEditModalBtn');
    const editButtons = document.querySelectorAll('.editButton');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const kegiatan = button.dataset.kegiatan;

            document.getElementById('editId').value = id;
            document.getElementById('kegiatanId').value = kegiatan;

            editModal.classList.remove('hidden');
        });
    });

    closeEditModalBtn.addEventListener('click', () => {
        editModal.classList.add('hidden');
    });
</script>
@endsection
