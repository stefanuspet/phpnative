@extends('layouts.DashboardLayout')

@section('title', 'Cabang-store')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Tambah Kegiatan/Event</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/kegiatan/store" class="p-4" method="post">
            <div class="mb-3">
                <label for="nama" class="block">Nama Kegiatan</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="block">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <!-- input tanggal -->
            <div class="mb-3 relative">
                <label for="tanggal" class="block">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Simpan</button>
            </div>

        </form>
    </div>
</div>
@endsection