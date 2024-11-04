@extends('layouts.DashboardLayout')

@section('title', 'Pembayaran')
@section('content')
<div class="w-full bg-white p-5">
    <div class="flex justify-between items-center pb-2">
        <h1 class="text-4xl font-bold text-blue-950">{{$anggota->nama}}</h1>
    </div>
    <hr>
    <h1 class="text-xl font-bold text-blue-950 py-5">Pembayaran</h1>
    <div>
        <table class="w-full mt-2 text-center border">
            <thead>
                <tr class="border">
                    <th scope="col" class="px-6 py-3">Tanggal Pembayaran</th>
                    <th scope="col" class="px-6 py-3">Pembayaran Bulan</th>
                    <th scope="col" class="px-6 py-3">Foto Bukti</th>
                    <th scope="col" class="px-6 py-3">Catatan Admin</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>

            </thead>
            <tbody>
                @forelse ($pembayaran as $items )
                <tr>
                    <td class="px-6 py-4">{{ $items->created_at->format('d-m-Y') }}</td>
                    <td class="px-6 py-4">{{$items->bulan}}</td>
                    <td class="px-6 py-4">
                        <a href="/uploads/{{$items->bukti_pembayaran}}" class="w-44">
                            <img class="object-fill w-44 mx-auto" src="/uploads/{{$items->bukti_pembayaran}}" alt="{{$items->bukti_pembayaran}}">
                        </a>
                    </td>
                    <td class="px-6 py-4 max-w-[150px]">{{$items->catatan}}</td>
                    <!-- form delete -->
                    <!-- <td class="px-6 py-4">
                        <form action="/dashboard/pembayaran/delete/{{$items->id}}" method="POST">
                            <input type="hidden" name="id" value="{{ $items->id }}">
                            <button type="submit" class="bg-red-500 text-white p-2 rounded-md">Delete</button>
                        </form>
                    </td> -->
                    <td class="px-6 py-4 inline-flex gap-x-5">
                        @if (!is_null($items->catatan) && trim($items->catatan) !== "")
                        <a href="/dashboard/pembayaran/edit/{{$items->id}}" class="bg-yellow-500 text-white p-2 rounded-md">Edit</a>
                        <form action="/dashboard/pembayaran/delete-notes/{{$items->id}}" method="POST">
                            @csrf
                            <button type="submit" class="bg-yellow-500 text-white p-2 rounded-md">Delete Catatan</button>
                        </form>
                        @else
                        <a href="/dashboard/pembayaran/edit/{{$items->id}}" class="bg-blue-600 text-white p-2 rounded-md">Tambah Catatan</a>
                        @endif
                        <form action="/dashboard/pembayaran/delete/{{$items->id}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="nid" value="{{ $anggota->nid }}">
                            <input type="hidden" name="id" value="{{ $items->id }}">
                            <button type="submit" class="bg-red-500 text-white p-2 rounded-md">Delete Data</button>
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