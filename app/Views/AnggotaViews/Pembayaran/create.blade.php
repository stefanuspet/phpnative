@extends('layouts.AnggotaLayout')

@section('title', 'Pembayaran-store')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Tambah Pembayaran</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/pembayaran/store" class="p-4" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="foto" class="block">Bukti Pembayaran</label>
                <input type="file" name="foto" id="foto" class="w-full border border-blue-600 rounded-md p-2" accept="image/*" required>
            </div>
            <!-- input tanggal -->
            <div class="mb-3 relative">
                <label for="tanggal" class="block">Tanggal Latihan</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full border border-blue-600 rounded-md p-2" value="{{ date('Y-m-d') }}" disabled required>
            </div>
            <div class="mb-3">

                <label for="bulan" class="block">Bulan Latihan</label>
                <input type="text" name="bulan_display" id="bulan_display" class="w-full border border-blue-600 rounded-md p-2" value="{{ date('F') }}" disabled required>
                <!-- Hidden input to send the 'bulan' value -->
                <input type="hidden" name="bulan" value="{{ date('F') }}">
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Simpan</button>
            </div>

        </form>
    </div>
</div>
@endsection