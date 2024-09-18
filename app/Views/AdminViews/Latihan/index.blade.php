@extends('layouts.DashboardLayout')

@section('title', 'Latihan')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Data Latihan</h1>
        <form action="/dashboard/search-anggota" method="GET" class="flex items-center">
            <input type="text" name="query" placeholder="Search Anggota" class="border border-blue-500 rounded-md p-2">
            <button type="submit" class="ml-2 bg-blue-600 text-white p-2 rounded-md">Search</button>
        </form>
    </div>
    <div>
        <table class="w-full mt-2 text-center border">
            <thead>
                <tr class="border">
                    <th scope="col" class="px-6 py-3">Nama Anggota</th>
                    <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                    <th scope="col" class="px-6 py-3">Tingkat Sabuk</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>

            </thead>
            <tbody>
                @forelse ($anggota as $items )
                <tr>
                    <td class="px-6 py-4">{{$items->nama}}</td>
                    <td class="px-6 py-4">{{$items->jenis_kelamin}}</td>
                    <td class="px-6 py-4">{{$items->tingkat_sabuk }}</td>
                    <td class="px-6 py-4">{{$items->status}}</td>
                    <td class="px-6 py-4">
                        <a href="/dashboard/latihan/show/{{$items->nid}}" class="bg-blue-500 text-white p-2 rounded-md">Detail</a>
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