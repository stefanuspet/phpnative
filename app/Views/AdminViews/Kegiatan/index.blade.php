@extends('layouts.DashboardLayout')

@section('title', 'Kegiatan')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Kegiatan/Event</h1>
        <a href="/dashboard/kegiatan/create" class="px-3 py-2 bg-green-600 rounded-md text-white">
            Tambah Kegiatan
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-md px-8 py-4">
        @forelse ($kegiatan as $items)
        <div class="flex items-center gap-5 mb-5"> <!-- Ensure vertical centering -->
            <!-- Image Section -->
            <div class="max-h-44 max-w-44 bg-slate-300 overflow-hidden flex justify-center items-center">
                @if($items->foto)
                    <img class="object-cover h-full w-full max-h-44 max-w-44" 
                         src="/uploads/{{$items->foto}}" 
                         alt="Kegiatan Photo">
                @endif
            </div>

            
            <!-- Table Section -->
            <div class="flex-1"> <!-- Use flexbox for vertical centering -->
                <table class="">
                    <tr>
                        <td class="font-semibold">Nama Kegiatan</td>
                        <td class="px-2">:</td>
                        <td>{{$items->nama}}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Lokasi</td>
                        <td class="px-2">:</td>
                        <td>{{$items->lokasi}}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Jumlah Pendaftar</td>
                        <td class="px-2">:</td>
                        <td>{{$items->count_peserta}}</td>
                    </tr>
                </table>
            </div>

            <!-- Actions and Stats Section -->
            <div class="h-full flex justify-end gap-x-5"> <!-- Flexbox for vertical centering -->
                <a href="/dashboard/kegiatan/show/{{$items->id}}" class="mt-5">
                    <div class="h-full bg-slate-300 p-5 rounded-md flex flex-col items-center justify-center"> <!-- Centering Stats -->
                        <h1 class="text-center font-bold text-2xl">{{$items->day}}</h1>
                        <p>{{$items->month}}</p>
                    </div>
                </a>

                <div class="flex flex-col justify-center gap-5">
                    <a href="/dashboard/kegiatan/edit/{{$items->id}}" class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500 rounded-md text-white mt-5">Edit</a>
                    <form action="/dashboard/kegiatan/delete/{{ $items->id }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="{{ $items->id }}">
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
@endsection
