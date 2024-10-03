@extends('layouts.DashboardLayout')

@section('title', 'Anggota')
@section('content')
<div class="w-full">
    <div class="p-4 bg-white shadow-lg rounded-md">
        <h1 class="text-3xl font-bold">{{ $anggota->nama }}</h1>
        <div class="rounded-md px-12 py-14 grid grid-cols-4 items-center gap-6">
            <div class="bg-slate-100 w-52 h-52 rounded-full overflow-hidden flex justify-center">
                <?php
                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                $host = $_SERVER['SERVER_NAME'];
                $port = $_SERVER['SERVER_PORT'];
                $baseUrl = $protocol . $host . ':' . $port;
                ?>
                <img class="w-full object-cover" src="{{ $baseUrl }}/uploads/{{ $anggota->foto }}" alt="foto_profile">
            </div>
            <div class="flex justify-between col-span-3">
                <table class="font-semibold table-auto max-w-full">
                    <tr>
                        <td>Dojo</td>
                        <td class="px-4">:</td>
                        <td>{{ $anggota->dojo->nama }}</td>
                    </tr>
                    <tr>
                        <td>TTL</td>
                        <td class="px-4">:</td>
                        @if ($anggota->tempat_lahir == null)
                            <td>{{ $anggota->tanggal_lahir }}</td>
                        @elseif ($anggota->tanggal_lahir == '00-00-0000' && $anggota->tempat_lahir != null)
                            <td>{{ $anggota->tempat_lahir }}</td>
                        @elseif ($anggota->tanggal_lahir == '00-00-0000' && $anggota->tempat_lahir == null)
                            <td>-</td>
                        @else
                            <td>{{ $anggota->tempat_lahir }}, {{ $anggota->tanggal_lahir }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td class="px-4">:</td>
                        <td>{{ $anggota->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td class="px-4">:</td>
                        <td>{{ $anggota->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Tahun Bergabung</td>
                        <td class="px-4">:</td>
                        <td>{{ $anggota->tahun_gabung == 0 ? '-' : $anggota->tahun_gabung }}</td>
                    </tr>
                    <tr>
                        <td>Tingkat Sabuk</td>
                        <td class="px-4">:</td>
                        <td>{{ $anggota->tingkat_sabuk }}</td>
                    </tr>
                    <tr>
                        <td>Nomor</td>
                        <td class="px-4">:</td>
                        <td>{{ $anggota->nomor }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td class="px-4">:</td>
                        <td>{{ $anggota->status }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Induk</td>
                        <td class="px-4">:</td>
                        <td>{{ $anggota->nomor_induk }}</td>
                    </tr>
                </table>
                <div class="flex flex-col justify-end items-end">
                    @if ($anggota->status == 'Atlet')
                    
                    <div class="p-5 text-center bg-slate-300 rounded-md shadow-sm">
                        <h1 class="text-2xl font-bold">{{ $anggota->count_prestasi }}</h1>
                        <p>Prestasi</p>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                    <a href="/dashboard/latihan/show/{{ $anggota->nid }}" class="px-3 py-2 w-40 hover:bg-blue-600 bg-blue-500 rounded-md text-white text-center mt-2.5">Progres Latihan</a>

                        <a href="/dashboard/pembayaran/show/{{ $anggota->nid }}" class="px-3 py-2 w-40 hover:bg-blue-600 bg-blue-500 rounded-md text-white text-center">Pembayaran</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <div class="flex justify-between items-center mt-5">
            <h1 class="text-xl font-bold">Prestasi</h1>
            <a href="/dashboard/prestasi/create/{{ $anggota->nid }}" class="px-3 py-2 hover:bg-green-600 bg-green-500 rounded-md text-white">Tambah Prestasi</a>
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
                @forelse ($prestasi as $items)
                <tr>
                    <td class="px-6 py-4">{{ $items->nama }}</td>
                    <td class="px-6 py-4">{{ $items->tingkat }}</td>
                    <td class="px-6 py-4">{{ $items->peringkat }}</td>
                    <td class="px-6 py-4">{{ $items->waktu_dapat }}</td>
                    <td class="px-6 py-4 flex justify-center gap-x-4">
                        <a href="/dashboard/prestasi/edit/{{ $items->id }}/{{ $anggota->nid }}" class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500 rounded-md text-white">Edit</a>
                        <form action="/dashboard/prestasi/delete/{{ $items->id }}/{{ $anggota->nid }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $items->id }}">
                            <button type="submit" class="px-3 py-1 hover:bg-red-600 bg-red-500 rounded-md text-white">Delete</button>
                        </form>
                    </td>
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
