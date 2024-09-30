@extends('layouts.DashboardLayout')

@section('title', 'Anggota')
@section('content')
<div class="w-full">
    <!-- <div class="flex justify-between items-center pb-10"> -->
    <h1 class="text-4xl font-bold text-blue-950 pb-10">Data Anggota</h1>
    <div class="flex justify-between">
        <div class="flex items-center justify-start gap-x-5">
            @php
            // Mengambil segmen terakhir dari URL
            $segments = explode('/', $_SERVER['REQUEST_URI']);
            $lastSegment = end($segments);
            @endphp

            @if ($lastSegment == 'anggota-biasa')
            <a href="/dashboard/anggota" class="px-3 py-1 border border-blue-600 rounded-md text-blue-600 hover:bg-blue-600 hover:text-white cursor-pointer">
                Semua
            </a>
            <a href="/dashboard/anggota-biasa" class="px-3 py-1 bg-blue-600 rounded-md text-white cursor-pointer">
                Anggota
            </a>
            <a href="/dashboard/anggota-atlet" class="px-3 py-1 border border-blue-600 rounded-md text-blue-600 hover:bg-blue-600 hover:text-white cursor-pointer">
                Atlet
            </a>
            @elseif ($lastSegment == 'anggota-atlet')
            <a href="/dashboard/anggota" class="px-3 py-1 border border-blue-600 rounded-md text-blue-600 hover:bg-blue-600 hover:text-white cursor-pointer">
                Semua
            </a>
            <a href="/dashboard/anggota-biasa" class="px-3 py-1 border border-blue-600 rounded-md text-blue-600 hover:bg-blue-600 hover:text-white cursor-pointer">
                Anggota
            </a>
            <a href="/dashboard/anggota-atlet" class="px-3 py-1 bg-blue-600 rounded-md text-white cursor-pointer">
                Atlet
            </a>
            @else
            <a href="/dashboard/anggota" class="px-3 py-1 bg-blue-600 rounded-md text-white cursor-pointer">
                Semua
            </a>
            <a href="/dashboard/anggota-biasa" class="px-3 py-1 border border-blue-600 rounded-md text-blue-600 hover:bg-blue-600 hover:text-white cursor-pointer">
                Anggota
            </a>
            <a href="/dashboard/anggota-atlet" class="px-3 py-1 border border-blue-600 rounded-md text-blue-600 hover:bg-blue-600 hover:text-white cursor-pointer">
                Atlet
            </a>
            @endif
        </div>
        <a href="/dashboard/anggota/create" class="px-3 py-2 bg-green-600 rounded-md text-white">
            Tambah Anggota
        </a>
    </div>
    <!-- </div> -->
    <!-- check error form session -->
    <div class="w-full py-5">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            @forelse ($anggota as $items )
            <div class="grid grid-cols-3">
                <table class="w-fit mt-2">
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
                <div class="h-full">
                </div>
                <div class="h-full flex justify-end gap-x-5">
                    <a href="/dashboard/anggota/show/{{$items->nid}}">
                        <div class="h-full bg-slate-300 p-5 rounded-md">
                            <h1 class="text-center font-bold text-2xl">{{$items->count_prestasi}}</h1>
                            <p>Total Prestasi</p>
                        </div>
                    </a>
                    <div class="flex flex-col justify-center gap-5">
                        <a href="/dashboard/anggota/edit/{{$items->nid}}" class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500  rounded-md text-white">Edit</a>
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