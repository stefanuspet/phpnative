@extends('layouts.MajelisLayout')

@section('title', 'Latihan')
@section('content')
<div class="w-full bg-white p-5">
    <div class="flex justify-between items-center pb-2">
        <h1 class="text-4xl font-bold text-blue-950">{{$anggota->nama}}</h1>
    </div>
    <hr>
    <h1 class="text-xl font-bold text-blue-950 py-5">Progres Latihan</h1>
    <div>
        <table class="w-full mt-2 text-center border">
            <thead>
                <tr class="border">
                    <th scope="col" class="px-6 py-3">Tanggal Latihan</th>
                    <th scope="col" class="px-6 py-3">Progres</th>
                    <th scope="col" class="px-6 py-3">Catatan Pelatih</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>

            </thead>
            <tbody>
                @forelse ($latihan as $items )
                <tr>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($items->created_at)->format('d-m-Y') }}</td>

                    <td class="px-6 py-4">{{$items->progres}}</td>
                    <td class="px-6 py-4">{{$items->catatan }}</td>
                    <!-- form delete -->
                    <td class="px-6 py-4 inline-flex gap-x-5">
                        @if ($items->catatan != null)
                        <a href="/dashboard-majelis/latihan/edit/{{$items->id}}" class="bg-yellow-500 text-white p-2 rounded-md">Edit</a>
                        @else
                        <a href="/dashboard-majelis/latihan/edit/{{$items->id}}" class="bg-blue-600 text-white p-2 rounded-md">Tambah Catatan</a>
                        @endif
                        <form action="/dashboard/latihan/reset/{{$items->id}}" method="POST">
                            <button type="submit" class="bg-red-500 text-white p-2 rounded-md">Delete Catatan</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection