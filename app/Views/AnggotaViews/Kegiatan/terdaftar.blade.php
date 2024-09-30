@extends('layouts.AnggotaLayout')

@section('title', 'kegiatan')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center py-5">
        <h1 class="text-4xl font-bold text-blue-950">Kegiatan/Event</h1>
    </div>
    @php
    // Mengambil segmen terakhir dari URL
    $segments = explode('/', $_SERVER['REQUEST_URI']);
    $lastSegment = end($segments);
    @endphp

    @if ($lastSegment == 'kegiatan-terdaftar')
    <div class="flex items-center justify-start gap-x-5 pb-5">
        <a href="/dashboard-anggota/kegiatan" class="px-3 py-1 border border-blue-600 hover:bg-blue-600 hover:text-white rounded-md text-blue-600 cursor-pointer">
            Semua
        </a>
        <a href="/dashboard-anggota/kegiatan-terdaftar" class="px-3 py-1 bg-blue-600 rounded-md text-white hover:bg-blue-600 hover:text-white cursor-pointer">
            Kegiatan Terdaftar
        </a>
    </div>
    @else
    <div class="flex items-center justify-start gap-x-5 pb-5">
        <a href="/dashboard-anggota/kegiatan" class="px-3 py-1 bg-blue-600 rounded-md text-white cursor-pointer">
            Semua
        </a>
        <a href="/dashboard-anggota/kegiatan-terdaftar" class="px-3 py-1 border border-blue-600 rounded-md text-blue-600 hover:bg-blue-600 hover:text-white cursor-pointer">
            Kegiatan Terdaftar
        </a>
    </div>
    @endif
    @if (isset($_SESSION['success']))
    <div style="background-color: green; text-align: center; margin-top: 12px; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
        {{ $_SESSION['success'] }}
    </div>
    <?php unset($_SESSION['success']); ?> <!-- Hapus pesan error setelah ditampilkan -->
    @endif
    @if (isset($_SESSION['error']))
    <div style="background-color: red; text-align: center; margin-top: 12px;color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
        {{ $_SESSION['error'] }}
    </div>
    <?php unset($_SESSION['error']); ?> <!-- Hapus pesan error setelah ditampilkan -->
    @endif
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
                <div class="h-full flex justify-end gap-x-5">
                    <div class="flex flex-col justify-center gap-5">
                        <!-- if user not register -->
                        @if ($items->peserta->where('id_anggota', $_SESSION['user']['id'])->count() == 0)
                        <form action="/dashboard/peserta/store" method="post">
                            @csrf
                            <input type="hidden" name="id_kegiatan" value="{{$items->id}}">
                            <input type="hidden" name="id_anggota" value="{{$_SESSION['user']['id']}}">
                            <button class="px-3 py-2 hover:bg-blue-600 bg-blue-500  rounded-md text-white">Daftar Kegiatan</button>
                        </form>
                        @else
                        <form action="/dashboard/peserta/delete" method="post">
                            @csrf
                            <input type="hidden" name="id_kegiatan" value="{{$items->id}}">
                            <input type="hidden" name="id_anggota" value="{{$_SESSION['user']['id']}}">
                            <button class="px-3 py-2 hover:bg-red-600 bg-red-500  rounded-md text-white">Batalkan Pendaftaran</button>
                        </form>
                        @endif
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