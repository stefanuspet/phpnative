@extends('layouts.DashboardLayout')

@section('title', 'Prestasi-Edit')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Edit Prestasi</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/prestasi/update/{{$prestasi->id}}/{{$id_anggota}}" class="p-4" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="block">Nama Prestasi</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" value="{{ $prestasi->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="tingkat" class="block">Tingkat</label>
                <input type="text" name="tingkat" id="tingkat" class="w-full border border-blue-600 rounded-md p-2" value="{{ $prestasi->tingkat }}" required>
            </div>
            <div class="mb-3">
                <label for="peringkat" class="block">Peringkat</label>
                <input type="text" name="peringkat" id="peringkat" class="w-full border border-blue-600 rounded-md p-2" value="{{ $prestasi->peringkat }}" required>
            </div>
            <!-- input tanggal -->
            <div class="mb-3 relative">
                <label for="waktu_dapat" class="block">Waktu Dapat</label>
                <input type="date" name="waktu_dapat" id="waktu_dapat" class="w-full border border-blue-600 rounded-md p-2" value="{{ $prestasi->waktu_dapat }}" required>
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>
</div>


@endsection