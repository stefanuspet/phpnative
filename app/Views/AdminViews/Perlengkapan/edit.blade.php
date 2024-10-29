@extends('layouts.DashboardLayout')

@section('title', 'Perlengkapan-Edit')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Edit Perlengkapan</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/perlengkapan/update/{{$perlengkapan->id}}" class="p-4" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="block">Nama Perlengkapan</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" value="{{ $perlengkapan->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="block">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="w-full border border-blue-600 rounded-md p-2" value="{{ $perlengkapan->jumlah }}" required>
            </div>
            <div class="mb-3">
                <label for="ukuran" class="block">Ukuran</label>
                <select name="ukuran" id="ukuran" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose</option>
                    <option value="M" {{ $perlengkapan->ukuran == 'M' ? 'selected' : '' }}>M</option>
                    <option value="L" {{ $perlengkapan->ukuran == 'L' ? 'selected' : '' }}>L</option>
                    <option value="XL" {{ $perlengkapan->ukuran == 'XL' ? 'selected' : '' }}>XL</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="foto" class="block">Foto</label>
                <input type="file" name="foto" id="foto" class="w-full border border-blue-600 rounded-md p-2" accept="image/*">
                @if($perlengkapan->foto)
                <div class="mt-3">
                    <img src="/uploads/{{$perlengkapan->foto}}" alt="Foto Perlengkapan" class="w-32 h-32 object-cover rounded-md">
                </div>
                @endif
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>
</div>


@endsection