@extends('layouts.MajelisLayout')

@section('title', 'Anggota')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Data Anggota</h1>
        <a href="/dashboard-majelis/anggota/create" class="px-3 py-2 bg-green-600 rounded-md text-white">
            Tambah Anggota
        </a>
    </div>
    <!-- check error form session -->
    <div class="w-full py-5">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            @forelse ($anggota as $items )
            <div class="grid grid-cols-6">
                <div class="col-span-1" style="margin-top: 15px;">
                    <img src="/uploads/{{$items->foto}}" alt="{{$items->foto}}" class="w-40 h-40 rounded-full">
                </div>

                <table class="w-fit mt-2 col-span-4">
                    <tr>
                        <td>Nama</td>
                        <td class="px-2">:</td>
                        <td>{{$items->nama}}</td>
                    </tr>
                    <tr>
                        <td>Dojo</td>
                        <td class="px-2">:</td>
                        <td>{{$items->dojo->nama}}</td>
                    </tr>
                    <tr>
                        <td>Tahun Bergabung</td>
                        <td class="px-2">:</td>
                        <td>{{$items->tahun_gabung}}</td>
                    </tr>
                </table>
                <div class="h-full flex w-full justify-center items-center">
                    <div class="grid grid-cols-1 gap-y-2">
                        <a href="/dashboard-majelis/anggota/show/{{$items->nid}}" class="px-3 py-1 hover:bg-blue-600 bg-blue-500  rounded-md text-white">Detail</a>
                        <a href="/dashboard-majelis/anggota/edit/{{$items->nid}}" class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500  rounded-md text-white">Edit</a>
                        <form action="/dashboard/anggota/delete/{{ $items->nid }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="{{ $items->nid }}">
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