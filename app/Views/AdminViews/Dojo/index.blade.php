@extends('layouts.DashboardLayout')

@section('title', 'Cabang')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Cabang</h1>

    <div class="flex justify-between">
        @php
        $currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($currentUrl, '/'));
        $lastSegment = end($segments);

        // Build URLs for each cabang with existing search query
        $baseUrl = '/dashboard/';
        $searchQuery = isset($_GET['search']) ? '?search=' . $_GET['search'] : '';
        @endphp

        <div class="flex items-center justify-start gap-x-5">
            <a href="/dashboard/cabang" class="{{ $lastSegment == 'cabang' ? 'bg-blue-600 text-white' : 'border border-blue-600 text-blue-600' }} px-3 py-1 rounded-md hover:bg-blue-600 hover:text-white cursor-pointer">
                Semua
            </a>
            <a href="/dashboard/cabang-gowa" class="{{ $lastSegment == 'cabang-gowa' ? 'bg-blue-600 text-white' : 'border border-blue-600 text-blue-600' }} px-3 py-1 rounded-md hover:bg-blue-600 hover:text-white cursor-pointer">
                Gowa
            </a>
            <a href="/dashboard/cabang-makasar" class="{{ $lastSegment == 'cabang-makasar' ? 'bg-blue-600 text-white' : 'border border-blue-600 text-blue-600' }} px-3 py-1 rounded-md hover:bg-blue-600 hover:text-white cursor-pointer">
                Makasar
            </a>
            <a href="/dashboard/cabang-bone" class="{{ $lastSegment == 'cabang-bone' ? 'bg-blue-600 text-white' : 'border border-blue-600 text-blue-600' }} px-3 py-1 rounded-md hover:bg-blue-600 hover:text-white cursor-pointer">
                Bone
            </a>
        </div>

        <a href="/dashboard/cabang/create" class="px-3 py-1 bg-green-600 rounded-md text-white">Tambah Dojo</a>
    </div>

    <!-- Search Form -->
    <div class="w-full py-5">
        <form method="GET" action="" class="flex gap-x-3 mb-5">
            <input 
                type="text" 
                name="search" 
                class="px-4 py-2 border rounded-md w-1/2" 
                placeholder="Cari nama dojo..." 
                value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" 
            />
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Cari</button>
        </form>

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
                    <a href="/dashboard/cabang/show/{{$items->id}}" class="mt-5">
                        <div class="h-full bg-slate-300 p-5 rounded-md">
                            <h1 class="text-center font-bold text-2xl">{{$items->count_anggota}}</h1>
                            <p>Jumlah Anggota</p>
                        </div>
                    </a>
                    <div class="flex flex-col justify-center gap-5">
                        <a href="/dashboard/cabang/edit/{{$items->id}}" class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500  rounded-md text-white  mt-5">Edit</a>
                        <form action="/dashboard/cabang/delete/{{ $items->id }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="{{ $items->id }}">
                            <button type="submit" class="px-3 py-1 hover:bg-red-700 bg-red-600 rounded-md text-white">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            <hr class="mt-4">
            @empty
            <p class="text-center text-blue-950">Tidak ada dojo yang ditemukan.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
