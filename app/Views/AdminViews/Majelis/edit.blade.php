@extends('layouts.DashboardLayout')

@section('title', 'Cabang-edit')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Edit Majelis</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/majelis/update/{{ $majelis->nit }}" class="p-4" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nit" class="block">NIT</label>
                <input type="number" name="nit" id="nit" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->nit }}" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="block">Nama Majelis</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="block">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->tempat_lahir }}" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="block">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->tanggal_lahir }}" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="block">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose</option>
                    <option value="Laki-laki" {{ $majelis->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $majelis->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="block">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->alamat }}" required>
            </div>
            <div class="mb-3">
                <label for="tahun_gabung" class="block">Tahun Gabung</label>
                <input type="number" name="tahun_gabung" id="tahun_gabung" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->tahun_gabung }}" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="block">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->jabatan }}" required>
            </div>
            <div class="mb-3">
                <label for="tingkat_sabuk" class="block">Tingkat Sabuk</label>
                <input type="text" name="tingkat_sabuk" id="tingkat_sabuk" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->tingkat_sabuk }}" required>
            </div>
            <div class="mb-3">
                <label for="spesialis" class="block">Spesialis</label>
                <input type="text" name="spesialis" id="spesialis" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->spesialis }}" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="block">Foto</label>
                <input type="file" name="foto" id="foto" class="w-full border border-blue-600 rounded-md p-2">

            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection