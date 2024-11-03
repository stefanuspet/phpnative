@extends('layouts.DashboardLayout')

@section('title', 'Perlengkapan-store')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Tambah Perlengkapan</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/perlengkapan/store" class="p-4" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="block">Nama Perlengkapan</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2"  required>
            </div>
            <div class="mb-3">
                <label for="ukuran" class="block">Ukuran</label>
                <select name="ukuran" id="ukuran" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">Xl</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="block">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="status" class="block">Status</label>
                <input type="text" name="status" id="status" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="block">Foto</label>
                <input type="file" name="foto" id="foto" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Simpan</button>
            </div>

        </form>
    </div>
</div>
@endsection