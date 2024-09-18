@extends('layouts.DashboardLayout')

@section('title', 'Cabang')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Data Majelis Sabuk Hitam</h1>
        <a href="/dashboard/majelis/create" class="px-3 py-2 bg-green-600 rounded-md text-white">
            Tambah Majelis
        </a>
    </div>
    <!-- check error form session -->
    <div class="w-full py-5">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            @forelse ($majelis as $items )
            <div class="grid grid-cols-6 justify-items-center">
                <div class="rounded-full h-44 w-44 bg-slate-300">
                    <img src="//storage/uploads/{{$items->foto}}" alt="/storage/uploads/<?php echo htmlspecialchars($items->foto); ?>">
                    <p>${{$items->foto}}</p>
                </div>
                <table class="w-fit mt-2  col-span-2">
                    <tr>
                        <td>Nama Dojo</td>
                        <td class="px-2">:</td>
                        <td>{{$items->nama}}</td>
                    </tr>
                    <tr>
                        <td>NIT</td>
                        <td class="px-2">:</td>
                        <td>{{$items->nit}}</td>
                    </tr>
                    <tr>
                        <td>TTL</td>
                        <td class="px-2">:</td>
                        <td>{{$items->tempat_lahir}},{{$items->tanggal_lahir}}</td>
                    </tr>
                    <tr>
                        <td>Tahun Bergabung</td>
                        <td class="px-2">:</td>
                        <td>{{$items->tahun_gabung}}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td class="px-2">:</td>
                        <td>{{$items->jenis_kelamin}}</td>
                    </tr>
                </table>
                <table class="w-fit mt-2  col-span-2">
                    <tr>
                        <td>Alamat</td>
                        <td class="px-2">:</td>
                        <td>{{$items->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td class="px-2">:</td>
                        <td>{{$items->jabatan}}</td>
                    </tr>
                    <tr>
                        <td>Tingkat Sabuk</td>
                        <td class="px-2">:</td>
                        <td>{{$items->tingkat_sabuk}}</td>
                    </tr>
                    <tr>
                        <td>Spesialis</td>
                        <td class="px-2">:</td>
                        <td>{{$items->spesialis}}</td>
                    </tr>
                </table>
                <div class="h-full flex justify-end gap-x-5   ">
                    <div class="flex flex-col justify-center gap-5">
                        <a href="/dashboard/majelis/edit/{{$items->nit}}" class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500  rounded-md text-white">Edit</a>
                        <form action="/dashboard/majelis/delete/{{ $items->nit }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="{{ $items->nit }}">
                            <button type="submit" class="px-3 py-1 hover:bg-red-700 bg-red-600 rounded-md text-white">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            <hr class="mt-4">
            @empty
            <p class="text-center text-blue-950">Data Masih Kosong !!!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection