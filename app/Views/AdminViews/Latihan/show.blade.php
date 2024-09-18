@extends('layouts.DashboardLayout')

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
                    <td class="px-6 py-4">{{$items->created_at}}</td>
                    <td class="px-6 py-4">{{$items->progres}}</td>
                    <td class="px-6 py-4">{{$items->catatan }}</td>
                    <!-- form delete -->
                    <td class="px-6 py-4">
                        <form action="/dashboard/latihan/delete/{{$items->id}}" method="POST">
                            <input type="hidden" name="id" value="{{ $items->id }}">
                            <button type="submit" class="bg-red-500 text-white p-2 rounded-md">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection