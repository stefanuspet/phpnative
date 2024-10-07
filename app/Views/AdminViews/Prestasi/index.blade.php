@extends('layouts.DashboardLayout')

@section('title', 'Prestasi')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Prestasi</h1>
    </div>
    <div class="w-full">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <table class="w-full mt-2 text-center border">
                <thead>
                    <tr class="border">
                        <th scope="col" class="px-6 py-3">Foto Prestasi</th>
                        <th scope="col" class="px-6 py-3">Nama Anggota</th>
                        <th scope="col" class="px-6 py-3">Prestasi</th>
                        <th scope="col" class="px-6 py-3">Tingkat</th>
                        <th scope="col" class="px-6 py-3">Peringkat</th>
                        <th scope="col" class="px-6 py-3">Waktu Dapat</th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prestasi as $items)
                    <tr>
                        <td class="px-6 py-4 border">
                        <div class="h-44 w-44 bg-slate-300 overflow-hidden flex justify-center items-center mt-5">
                            <img class="object-cover h-full w-full" src="/uploads/{{$items->foto}}" alt="Foto Prestasi">
                        </div>
                        </td>
                        <td class="px-6 py-4 border">{{$items->anggota->nama}}</td>
                        <td class="px-6 py-4 border">{{$items->nama}}</td>
                        <td class="px-6 py-4 border">{{$items->tingkat}}</td>
                        <td class="px-6 py-4 border">{{$items->peringkat }}</td>
                        <td class="px-6 py-4 border">{{$items->waktu_dapat}}</td>
                        <td class="px-6 py-4 border">
                            <a href="/dashboard/anggota/show/{{$items->anggota->nid}}" class="px-3 py-2 hover:bg-blue-600 bg-blue-500 my-1  rounded-md text-white text-center">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection