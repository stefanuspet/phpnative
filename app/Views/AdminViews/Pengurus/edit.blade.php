@extends('layouts.DashboardLayout')

@section('title', 'Pengurus')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Tambah Data Pengurus</h1>
    </div>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/pengurus/update/{{ $pengurus->id }}" class="p-4" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="block">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" value="{{ $pengurus->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="block">Jabatan</label>
                <select name="jabatan" id="jabatan" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose Jabatan</option>
                    <option value="Ketua Dewan Pembina" {{ $pengurus->jabatan == 'Ketua Dewan Pembina' ? 'selected' : '' }}>Ketua Dewan Pembina</option>
                    <option value="Anggota Dewan Pembina" {{ $pengurus->jabatan == 'Anggota Dewan Pembina' ? 'selected' : '' }}>Anggota Dewan Pembina</option>
                    <option value="Ketua umum" {{ $pengurus->jabatan == 'Ketua umum' ? 'selected' : '' }}>Ketua umum</option>
                    <option value="Serketaris umum" {{ $pengurus->jabatan == 'Serketaris umum' ? 'selected' : '' }}>Serketaris umum</option>
                    <option value="Bendahara umum" {{ $pengurus->jabatan == 'Bendahara umum' ? 'selected' : '' }}>Bendahara umum</option>
                    <option value="Ketua staf pelatih" {{ $pengurus->jabatan == 'Ketua staf pelatih' ? 'selected' : '' }}>Ketua staf pelatih</option>
                    <option value="Ketua majelis sabuk hitam" {{ $pengurus->jabatan == 'Ketua majelis sabuk hitam' ? 'selected' : '' }}>Ketua majelis sabuk hitam</option>
                    <option value="Bidang Prestasi" {{ $pengurus->jabatan == 'Bidang Prestasi' ? 'selected' : '' }}>Bidang Prestasi</option>
                    <option value="Perwasitan" {{ $pengurus->jabatan == 'Perwasitan' ? 'selected' : '' }}>Perwasitan</option>
                    <option value="Usaha dan dana" {{ $pengurus->jabatan == 'Usaha dan dana' ? 'selected' : '' }}>Usaha dan dana</option>
                    <option value="Humas" {{ $pengurus->jabatan == 'Humas' ? 'selected' : '' }}>Humas</option>
                </select>
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection