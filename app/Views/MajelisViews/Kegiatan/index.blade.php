@extends('layouts.MajelisLayout')

@section('title', 'Kegiatan')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center py-5">
        <h1 class="text-4xl font-bold text-blue-950">Kegiatan/Event</h1>
    </div>
    <div class="w-full">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            @forelse ($kegiatan as $items )
            <div class="grid grid-cols-3">
                <table class="w-fit mt-2">
                    <tr>
                        <td>Nama Kegiatan</td>
                        <td class="px-2">:</td>
                        <td>{{$items->nama}}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td class="px-2">:</td>
                        <td>{{$items->lokasi}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Kegiatan</td>
                        <td class="px-2">:</td>
                        <td>{{$items->tanggal}}</td>
                    </tr>
                </table>
                <div class="h-full">
                </div>

            </div>
            <hr class="mt-4">
            @empty
            <p class="text-center text-blue-950 col-span-3">Data Masih Kosong !!!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection