@extends('layouts.DashboardLayout')

@section('title', 'Cabang-store')
@section('content')
<div class="w-full">
    <div class="bg-white shadow-xl rounded-md px-8 py-4">
        <h1 class="text-4xl font-bold text-blue-950 pb-4">{{$kegiatan->nama}}</h1>
        <table class="mb-4">
            <tr>
                <td>Lokasi</td>
                <td class="px-2">:</td>
                <td>{{$kegiatan->lokasi}}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td class="px-2">:</td>
                <td>{{$kegiatan->date}}</td>
            </tr>
            <tr>
                <td>Jumlah Pendaftar</td>
                <td class="px-2">:</td>
                <td>{{$kegiatan->count_peserta}}</td>
            </tr>
        </table>
        <hr>
        <h1 class="text-xl font-bold text-blue-950 pb-4 mt-2">Daftar Peserta Kegiatan</h1>
        <table class="w-full mt-2 text-center border">
            <thead>
                <tr class="border">
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Tempat Tanggal Lahir</th>
                    <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">Tahun Bergabung</th>
                </tr>

            </thead>
            <tbody>
                @forelse ($peserta as $items )
                <tr>
                    <td class="px-6 py-4">{{$items->anggota->nama}}</td>
                    <td class="px-6 py-4">{{$items->anggota->tempat_lahir}}, {{$items->anggota->tanggal_lahir}}</td>
                    <td class="px-6 py-4">{{$items->anggota->jenis_kelamin }}</td>
                    <td class="px-6 py-4">{{$items->anggota->alamat}}</td>
                    <td class="px-6 py-4">{{$items->anggota->tahun_gabung}}</td>
                    <!-- form delete -->
                    <td>
                        <form action="/dashboard/peserta/delete/{{$items->id}}/{{$kegiatan->id}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value="{{$items->id}}">
                            <button type="submit" class="px-3 py-2 hover:bg-red-600 bg-red-500 my-1  rounded-md text-white text-center">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection