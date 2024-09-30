@extends('layouts.DashboardLayout')

@section('title', 'Latihan')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Kegiatan/Event</h1>
        <a href="/dashboard/kegiatan/create" class="px-3 py-2 bg-green-600 rounded-md text-white">
            Tambah Kegiatan
        </a>
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
                        <td>Jumlah Pendaftar</td>
                        <td class="px-2">:</td>
                        <td>{{$items->count_peserta}}</td>
                    </tr>
                </table>
                <div class="h-full">
                </div>
                <div class="h-full flex justify-end gap-x-5">
                    <a href="/dashboard/kegiatan/show/{{$items->id}}">
                        <div class="h-full bg-slate-300 p-5 rounded-md">
                            <h1 class="text-center font-bold text-2xl">{{$items->day}}</h1>
                            <p>{{$items->month}}</p>
                        </div>
                    </a>
                    <div class="flex flex-col justify-center gap-5">
                        <a href="/dashboard/kegiatan/edit/{{$items->id}}" class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500  rounded-md text-white">Edit</a>
                        <form action="/dashboard/kegiatan/delete/{{ $items->id }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="{{ $items->id }}">
                            <button type="submit" class="px-3 py-1 hover:bg-red-700 bg-red-600 rounded-md text-white">Hapus</button>
                        </form>
                    </div>
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