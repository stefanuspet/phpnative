@extends('layouts.AnggotaLayout')

@section('title', 'Cabang-store')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Tambah Progres Latihan</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/latihan/update/{{$latihan->id}}" class="p-4" method="post">
            <div class="mb-3">
                <label for="progres" class="block">Progres</label>
                <input type="text" name="progres" id="progres" class="w-full border border-blue-600 rounded-md p-2" value="{{ $latihan->progres  }}" required>
            </div>
            <!-- input tanggal -->
            <div class="mb-3 relative">
                <label for="tanggal" class="block">Tanggal Latihan</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full border border-blue-600 rounded-md p-2" value="{{ $latihan->created_at->format('Y-m-d') }}" required disabled>
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection