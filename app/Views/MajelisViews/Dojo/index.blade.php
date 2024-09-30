@extends('layouts.MajelisLayout')

@section('title', 'Cabang')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Dojo</h1>
    <!-- <div class="flex justify-between">
        <a href="/dashboard/cabang/create" class="px-3 py-1 bg-green-600 rounded-md text-white">Tambah Dojo</a>
    </div> -->
    <div class="w-full py-5">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            @forelse ($dojos as $items )
            <div class="grid grid-cols-3">
                <table class="w-fit mt-2">
                    <tr>
                        <td>Nama Dojo</td>
                        <td class="px-2">:</td>
                        <td>{{$items->nama}}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td class="px-2">:</td>
                        <td>{{$items->lokasi}}</td>
                    </tr>
                    <tr>
                        <td>Cabang</td>
                        <td class="px-2">:</td>
                        <td>{{$items->cabang}}</td>
                    </tr>
                </table>
                <div class="h-full">
                </div>
                <div class="h-full flex justify-end gap-x-5">
                    <a href="/dashboard-majelis/cabang/show/{{$items->id}}">
                        <div class="h-full bg-slate-300 p-5 rounded-md">
                            <h1 class="text-center font-bold text-2xl">{{$items->count_anggota}}</h1>
                            <p>Jumlah Anggota</p>
                        </div>
                    </a>
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