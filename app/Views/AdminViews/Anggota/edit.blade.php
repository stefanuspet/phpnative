@extends('layouts.DashboardLayout')

@section('title', 'Edit Anggota')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Edit Anggota</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/anggota/update/{{$anggota->nid}}" class="p-4" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nid" class="block">Nid</label>
                <input type="number" name="nid" id="nid" class="w-full border border-blue-600 rounded-md p-2" required value="{{ $anggota->nid }}">
            </div>
            <div class="mb-3">
                <label for="nama" class="block">Nama Anggota</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" required value="{{ $anggota->nama }}">
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="block">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full border border-blue-600 rounded-md p-2" required value="{{ $anggota->tempat_lahir }}">
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="block">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full border border-blue-600 rounded-md p-2" required value="{{ $anggota->tanggal_lahir }}">
            </div>
            <div class="mb-3">
                <label for="id_dojo" class="block">Dojo</label>
                <select name="id_dojo" id="id_dojo" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose</option>
                    @foreach($dojos as $dojo)
                    <option value="{{$dojo->id}}" {{ $anggota->id_dojo == $dojo->id ? 'selected' : '' }}>{{$dojo->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="block">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose</option>
                    <option value="Laki-laki" {{ $anggota->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $anggota->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="block">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full border border-blue-600 rounded-md p-2" required value="{{ $anggota->alamat }}">
            </div>
            <div class="mb-3">
                <label for="tahun_gabung" class="block">Tahun Gabung</label>
                <input type="number" name="tahun_gabung" id="tahun_gabung" class="w-full border border-blue-600 rounded-md p-2" required value="{{ $anggota->tahun_gabung }}">
            </div>
            <div class="mb-3">
                <label for="nomor" class="block">Nomor</label>
                <input type="number" name="nomor" id="nomor" class="w-full border border-blue-600 rounded-md p-2" required value="{{ $anggota->nomor }}">
            </div>
            <div class="mb-3">
                <label for="tingkat_sabuk" class="block">Tingkat Sabuk</label>
                <input type="text" name="tingkat_sabuk" id="tingkat_sabuk" class="w-full border border-blue-600 rounded-md p-2" required value="{{ $anggota->tingkat_sabuk }}">
            </div>
            <div class="mb-3">
                <label for="status" class="block">Status</label>
                <div class="flex items-center">
                    <input type="radio" name="status" id="status_atlet" value="Atlet" class="mr-2" {{ $anggota->status == 'Atlet' ? 'checked' : '' }}>
                    <label for="status_atlet" class="mr-4">Atlet</label>
                    <input type="radio" name="status" id="status_anggota_biasa" value="Anggota Biasa" class="mr-2" {{ $anggota->status == 'Anggota Biasa' ? 'checked' : '' }}>
                    <label for="status_anggota_biasa">Anggota Biasa</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="foto" class="block">Foto</label>
                <input type="file" name="foto" id="foto" class="w-full border border-blue-600 rounded-md p-2">
                @if($anggota->foto)
                <div class="mt-3">
                    <img src="/uploads/{{$anggota->foto}}" alt="Foto Anggota" class="w-32 h-32 object-cover rounded-md">
                </div>
                @endif
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection