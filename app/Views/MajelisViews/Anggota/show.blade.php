@extends('layouts.MajelisLayout')

@section('title', 'Anggota')
@section('content')
<div class="w-full">
    <!-- <div class="flex justify-between items-center pb-10"> -->
    <div class="p-4 bg-white shadow-lg rounded-md">
        <h1 class="text-3xl font-bold">{{$anggota->nama}}</h1>
        <div class="rounded-md px-12 py-14 grid grid-cols-4 items-center">
            <div class="bg-slate-100 w-52 h-52 rounded-full overflow-hidden flex justify-center">
                <!-- get current localhost -->
                <?php
                // Mendapatkan protokol (http atau https)
                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

                // Mendapatkan hostname (misalnya localhost)
                $host = $_SERVER['SERVER_NAME'];

                // Mendapatkan port (misalnya 8080)
                $port = $_SERVER['SERVER_PORT'];

                // Menggabungkan semuanya untuk mendapatkan localhost:8080
                $baseUrl = $protocol . $host . ':' . $port;
                ?>
                <img class="w-full object-cover" src="{{$baseUrl}}/uploads/{{$anggota->foto}}" alt="foto_profile">
            </div>
            <div class="flex justify-between col-span-3">
                <table class="font-semibold table-auto">
                    <tr>
                        <td>Dojo</td>
                        <td class="px-4">:</td>
                        <td>{{$anggota->dojo->nama}}</td>
                    </tr>
                    <!-- tempat tanggal lahir -->
                    <tr>
                        <td>TTL</td>
                        <td class="px-4">:</td>
                        @if ($anggota->tempat_lahir == null)
                        <td>{{$anggota->tanggal_lahir}}</td>
                        @elseif ($anggota->tanggal_lahir == 00-00-0000 && $anggota->tempat_lahir != null)
                        <td>{{$anggota->tempat_lahir}}</td>
                        @elseif ($anggota->tanggal_lahir == 00-00-0000 && $anggota->tempat_lahir == null)
                        <td>-</td>
                        @else
                        <td>{{$anggota->tempat_lahir}}, {{$anggota->tanggal_lahir}}</td>
                        @endif
                    </tr>
                    <!-- jenis kelamin -->
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td class="px-4">:</td>
                        <td>{{$anggota->jenis_kelamin}}</td>
                    </tr>
                    <!-- alamat -->
                    <tr>
                        <td>Alamat</td>
                        <td class="px-4">:</td>
                        <td>{{$anggota->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Tahun Bergabung</td>
                        <td class="px-4">:</td>
                        @if ($anggota->tahun_gabung == 0)
                        <td>-</td>
                        @else
                        <td>{{$anggota->tahun_gabung}}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Tingkat Sabuk</td>
                        <td class="px-4">:</td>
                        <td>{{$anggota->tingkat_sabuk}}</td>
                    </tr>
                    <tr>
                        <td>Nomor</td>
                        <td class="px-4">:</td>
                        <td>{{$anggota->nomor}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td class="px-4">:</td>
                        <td>{{$anggota->status}}</td>
                    </tr>
                    <tr>
                        <td>NID</td>
                        <td class="px-4">:</td>
                        <td>{{$anggota->nid}}</td>
                    </tr>
                </table>
                <div class="w-fit h-fit justify-between flex self-end">
                    <div class="flex gap-4">
                        @if ($anggota->status == 'Atlet')
                        <div class="grid grid-cols-1 ">
                            <a href="/dashboard-majelis/latihan/show/{{$anggota->nid}}" class="px-3 py-2 hover:bg-blue-600 bg-blue-500 my-1  rounded-md text-white text-center">Progres latihan</a>
                            <a href="/dashboard-majelis/pembayaran/show/{{$anggota->nid}}" class="px-3 py-2 hover:bg-blue-600 bg-blue-500 my-1  rounded-md text-white text-center">Pembayaran</a>
                        </div>
                        <div class="p-5 text-center bg-slate-300 rounded-md shadow-sm">
                            <h1 class="text-2xl font-bold">{{$anggota->count_prestasi}}</h1>
                            <p class="">Prestasi</p>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="flex justify-between items-center mt-5">
            <h1 class="text-xl font-bold">Prestasi</h1>
        </div>
        <table class="w-full mt-2 text-center border">
            <thead>
                <tr class="border">
                    <th scope="col" class="px-6 py-3">Nama Prestasi</th>
                    <th scope="col" class="px-6 py-3">Tingkat</th>
                    <th scope="col" class="px-6 py-3">Peringkat atau Medali</th>
                    <th scope="col" class="px-6 py-3">Waktu</th>
                </tr>

            </thead>
            <tbody>
                @forelse ($prestasi as $items )
                <tr>
                    <td class="px-6 py-4">{{$items->nama}}</td>
                    <td class="px-6 py-4">{{$items->tingkat}}</td>
                    <td class="px-6 py-4">{{$items->peringkat }}</td>
                    <td class="px-6 py-4">{{$items->waktu_dapat}}</td>

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