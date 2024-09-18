@extends('layouts.DashboardLayout')

@section('title', 'Dashboard')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Dashboard</h1>
    <div class="w-4/5 grid grid-cols-3 gap-10">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <p>Total Anggota</p>
            <p class="text-center text-2xl font-bold py-5">{{$count_anggota}}</p>
            <a href="/dashboard/anggota">
                <div class="w-full bg-blue-600 text-white hover:bg-blue-500 rounded-md py-2">
                    <p class="text-center">Lihat Atlet</p>
                </div>
            </a>
        </div>
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <p>Total Prestasi</p>
            <p class="text-center text-2xl font-bold py-5">{{$count_prestasi}}</p>
            <a href="dashboard/prestasi">
                <div href="#" class="w-full bg-blue-600 text-white hover:bg-blue-500 rounded-md py-2">
                    <p class="text-center">Lihat Prestasi</p>
                </div>
            </a>
        </div>
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <p>Total Majelis</p>
            <p class="text-center text-2xl font-bold py-5">{{$count_majelis}}</p>
            <a href="/dashboard/majelis">
                <div href="#" class="w-full bg-blue-600 text-white hover:bg-blue-500 rounded-md py-2">
                    <p class="text-center">Lihat Majelis</p>
                </div>
            </a>
        </div>
    </div>
    <div class="w-4/5 grid grid-cols-1 gap-10 mt-10">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <p>Total Dojo</p>
            <p class="text-center text-2xl font-bold py-5">{{$count_dojo}}</p>
            <a href="/dashboard/cabang">
                <div href="#" class="w-full bg-blue-600 text-white hover:bg-blue-500 rounded-md py-2">
                    <p class="text-center">Lihat Dojo</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection