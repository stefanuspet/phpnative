@extends('layouts.DashboardLayout')

@section('title', 'Cabang-store')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Tambah Anggota</h1>
    @if (isset($_SESSION['error']))
    <div class="bg-red-500 text-white p-3 rounded-md w-4/5 mb-4">
        {{$_SESSION['error']}}
    </div>
    <?php unset($_SESSION['error']); ?>
    @endif
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/anggota/store" class="p-4" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nid" class="block">NID</label>
                <input type="number" name="nid" id="nid" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="block">Nama Anggotas</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="block">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="block">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <!-- dojo select-->
            <div class="mb-3">
                <label for="id_dojo" class="block">Dojo</label>
                <select name="id_dojo" id="id_dojo" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose</option>
                    @foreach($dojos as $dojo)
                    <option value="{{$dojo->id}}">{{$dojo->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="block">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="block">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="tahun_gabung" class="block">Tahun Gabung</label>
                <input type="number" name="tahun_gabung" id="tahun_gabung" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="nomor" class="block">Nomor</label>
                <input type="number" name="nomor" id="nomor" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="tingkat_sabuk" class="block">Tingkat Sabuk</label>
                <input type="text" name="tingkat_sabuk" id="tingkat_sabuk" class="w-full border border-blue-600 rounded-md p-2" required>
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