@extends('layouts.AnggotaLayout')

@section('title', 'Latihan')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Data Latihan</h1>
        <!-- button add -->
        <a href="/dashboard-anggota/latihan/create" class="bg-blue-600 text-white p-2 rounded-md">Tambah Data</a>
    </div>
    <div>
        <table class="w-full mt-2 text-center border">
            <thead>
                <tr class="border text-center">
                    <th scope="col" class="px-6 py-3">Tanggal</th>
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
                    <td class="px-6 py-4 inline-flex gap-x-5">
                        <a href="/dashboard-anggota/latihan/edit/{{$items->id}}" class="bg-yellow-500 text-white p-2 rounded-md">Edit</a>
                        <form action="/dashboard/latihan/delete/{{$items->id}}" method="POST">
                            <input type="hidden" name="id" value="{{ $items->id }}">
                            <button type="submit" class="bg-red-500 text-white p-2 rounded-md">Delete</button>
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