@extends('layouts.MajelisLayout')

@section('title', 'Dashboard')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Dashboard</h1>
    <div class="w-4/5 grid grid-cols-1 gap-10 mb-10">
        <div class="bg-white shadow-xl rounded-md px-12 py-14 flex justify-start gap-x-24 items-center">
            <div class="bg-slate-300 max-h-72 max-w-80 overflow-hidden flex items-center justify-center">
                <img src="/uploads/{{$majelis->foto}}" alt="{{$majelis->foto}}" class="object-cover w-full h-full">
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
            <div class="flex-grow h-full grid justify-end content-end">
                <a href="dashboard-majelis/editBio" class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500  rounded-md text-white h-fit">Edit Biodata</a>
            </div>
        </div>
    </div>
    <div class="w-4/5 grid grid-cols-3 gap-10">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <p>Total Anggota</p>
            <p class="text-center text-2xl font-bold py-5">{{$count_anggota}}</p>
            <a href="/dashboard-majelis/anggota">
                <div class="w-full bg-blue-600 text-white hover:bg-blue-500 rounded-md py-2">

                    <p class="text-center">Lihat Anggota</p>
                </div>
            </a>
        </div>
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <p>Total Dojo</p>
            <p class="text-center text-2xl font-bold py-5">{{$count_dojo}}</p>
            <a href="/dashboard-majelis/cabang">
                <div class="w-full bg-blue-600 text-white hover:bg-blue-500 rounded-md py-2">
                    <p class="text-center">Lihat Dojo</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection