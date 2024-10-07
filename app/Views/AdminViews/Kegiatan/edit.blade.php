@extends('layouts.DashboardLayout')

@section('title', 'Kegiatan-Edit')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Edit Kegiatan</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/kegiatan/update/{{$kegiatan->id}}" class="p-4" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="block">Nama kegiatan</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" value="{{ $kegiatan->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="block">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="w-full border border-blue-600 rounded-md p-2" value="{{ $kegiatan->lokasi}}" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="block">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full border border-blue-600 rounded-md p-2" value="{{ $kegiatan->tanggal }}" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="block">Foto Poster</label>
                <input type="file" name="foto" id="foto" class="w-full border border-blue-600 rounded-md p-2" accept="image/*">
                @if($kegiatan->foto)
                <div class="mt-3">
                    <img src="/uploads/{{$kegiatan->foto}}" alt="Foto Poster" class="max-h-44 max-w-44 bg-slate-300 overflow-hidden flex justify-center items-center">
                </div>
                @endif
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>


@endsection