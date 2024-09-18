@extends('layouts.DashboardLayout')

@section('title', 'Cabang-store')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Edit Dojo</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/cabang/update/{{$dojo->id}}" class="p-4" method="post">
            <div class="mb-3">
                <label for="nama" class="block">Nama Dojo</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" value="{{ $dojo->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="block">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="w-full border border-blue-600 rounded-md p-2" value="{{ $dojo->lokasi}}" required>
            </div>
            <div class="mb-3">
                <label for="cabang" class="block">Cabang</label>
                <select name="cabang" id="cabang" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose Cabang</option>
                    <option value="Gowa" {{ $dojo->cabang == 'Gowa' ? 'selected' : '' }}>Gowa</option>
                    <option value="Makasar" {{ $dojo->cabang == 'Makasar' ? 'selected' : '' }}>Makasar</option>
                    <option value="Bone" {{ $dojo->cabang == 'Bone' ? 'selected' : '' }}>Bone</option>
                </select>
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>


@endsection