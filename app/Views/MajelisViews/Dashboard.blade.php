@extends('layouts.DashboardLayout')

@section('title', 'Dashboard')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Dashboard</h1>
    <div class="w-4/5 grid grid-cols-1 gap-10 mb-10">
        <div class="bg-white shadow-xl rounded-md px-12 py-14 flex justify-start gap-x-24 items-center">
            <div class="bg-slate-100 w-52 h-52 rounded-full">
                <img src="{{$majelis->foto}}" alt="foto_profile">
            </div>
            <div>
                <table class="font-semibold table-auto">
                    <tr>
                        <td>NIT</td>
                        <td class="px-4">:</td>
                        <td>{{$majelis->nit}}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td class="px-4">:</td>
                        <td>{{$majelis->nama}}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td class="px-4">:</td>
                        <td>{{$majelis->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <td>TTL</td>
                        <td class="px-4">:</td>
                        <td>{{$majelis->tempat_lahir}}, {{$majelis->tanggal_lahir}}</td>
                    </tr>
                    <tr>
                        <td>Tahun bergabung</td>
                        <td class="px-4">:</td>
                        <td>{{$majelis->tahun_gabung}}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td class="px-4">:</td>
                        <td>{{$majelis->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td class="px-4">:</td>
                        <td>{{$majelis->jabatan}}</td>
                    </tr>
                    <tr>
                        <td>Spesialis</td>
                        <td class="px-4">:</td>
                        <td>{{$majelis->spesialis}}</td>
                    </tr>
                    <tr>
                        <td>Tingkat Sabuk</td>
                        <td class="px-4">:</td>
                        <td>{{$majelis->tingkat_sabuk}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="w-4/5 grid grid-cols-3 gap-10">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <p>Total Anggota</p>
            <p class="text-center text-2xl font-bold py-5">{{$count_anggota}}</p>
            <a href="#">
                <div class="w-full bg-blue-600 text-white hover:bg-blue-500 rounded-md py-2">

                    <p class="text-center">Lihat Prestasi</p>
                </div>
            </a>
        </div>
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <p>Total Kegiatan</p>
            <p class="text-center text-2xl font-bold py-5">{{$count_dojo}}</p>
            <a href="#">
                <div class="w-full bg-blue-600 text-white hover:bg-blue-500 rounded-md py-2">
                    <p class="text-center">Lihat Kegiatan</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection