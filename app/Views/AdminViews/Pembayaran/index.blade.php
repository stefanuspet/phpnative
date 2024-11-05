@extends('layouts.DashboardLayout')

@section('title', 'Pembayaran')
@section('content')
<div class="w-full">

@php
    $heading = 'Data Pembayaran'; // Default heading

    if ($tahun !== 'semua') {
        if ($bulan !== '-') {
            // Year and month selected
            $heading .= " $bulan $tahun";
        } else {
            // Only year selected
            $heading .= " $tahun";
        }
    }
@endphp

<h1 class="text-4xl font-bold text-blue-950 pb-10">{{ $heading }}</h1>

@if($pembayaran->isNotEmpty())
    <form action="/dashboard/pembayaran/print" method="POST" class="inline">
        @csrf
        <input type="hidden" name="tahun" id="tahun" value="{{ $tahun }}">
        <input type="hidden" name="bulan" id="bulan" value="{{ $bulan }}">
        <button type="submit" class="flex bg-blue-600 w-fit px-2 py-1 rounded-md items-center justify-center">
        <svg class="w-5 h-5" viewBox="0 0 600 600" version="1.1" fill="#ffffff">
            <path d="M 170 0 A 40.00405 40.00405 0 0 0 130 40 L 130 150 L 40 150 C 17.909591 150.002 0.0022087134 167.90958 0 190 L 0 410 C 0.0022087134 432.09042 17.909591 449.99779 40 450 L 130 450 L 130 320 C 130.00224 297.90958 147.90958 280.002 170 280 L 430 280 C 452.09042 280.00224 469.998 297.90958 470 320 L 470 450 L 560 450 C 582.09042 449.998 599.99779 432.09042 600 410 L 600 190 C 599.998 167.90958 582.09042 150.00221 560 150 L 470 150 L 470 40 A 40.00405 40.00405 0 0 0 430 0 L 170 0 z M 210 80 L 390 80 L 390 150 L 210 150 L 210 80 z M 430 200 L 530 200 A 20 20 0 0 1 550 220 A 20 20 0 0 1 530 240 L 430 240 A 20 20 0 0 1 410 220 A 20 20 0 0 1 430 200 z"></path>
            <rect width="260" height="260" x="310" y="-430" transform="rotate(90)" style="fill:none;stroke:#ffffff;stroke-width:80;stroke-linecap:round;stroke-linejoin:round"></rect>
            <path d="m 250,380 a 20,20 0 0 0 -20,20 20,20 0 0 0 20,20 h 100 a 20,20 0 0 0 20,-20 20,20 0 0 0 -20,-20 z" fill="#ffffff"></path>
            <path d="m 250,460 a 20,20 0 0 0 -20,20 20,20 0 0 0 20,20 h 100 a 20,20 0 0 0 20,-20 20,20 0 0 0 -20,-20 z" fill="#ffffff"></path>
        </svg>
        <span class="text-white px-2">
            Print PDF
        </span>
        </button>
    </form>
@endif

<div class="w-full py-5">
    <h2 class="text-2xl font-bold text-blue-900">Atlet yang Sudah Membayar</h2>
    <table class="w-full mt-2 text-center border">
        <thead>
            <tr class="border text-center">
                <th scope="col" class="px-6 py-3">Dojo Asal</th>
                <th scope="col" class="px-6 py-3">Nama</th>
                <th scope="col" class="px-6 py-3">Tanggal Bukti Diunggah</th>
                <th scope="col" class="px-6 py-3">Pembayaran Bulan</th>
                <th scope="col" class="px-6 py-3">Nominal</th>
                <th scope="col" class="px-6 py-3">Foto Bukti</th>
                <th scope="col" class="px-6 py-3">Catatan Admin</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembayaran as $items)
                <tr>
                    <td class="px-6 py-4">{{ $items->anggota->dojo->nama }}</td>
                    <td class="px-6 py-4">{{ $items->anggota->nama }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($items->created_at)->format('d-m-Y') }}</td>
                    <td class="px-6 py-4">{{ $items->bulan }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($items->nominal, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <a href="/uploads/{{ $items->bukti_pembayaran }}" class="w-44">
                            <img class="object-fill w-44 mx-auto" src="/uploads/{{ $items->bukti_pembayaran }}" alt="{{ $items->bukti_pembayaran }}">
                        </a>
                    </td>
                    <td class="px-6 py-4 max-w-[150px]">{{ $items->catatan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($tahun !== 'semua' && $bulan !== '-')
    <div class="w-full py-5">
        <h2 class="text-2xl font-bold text-red-900">Atlet yang Belum membayar</h2>
        <table class="w-full mt-2 text-center border">
            <thead>
                <tr class="border text-center">
                    <th scope="col" class="px-6 py-3">Dojo Asal</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Pembayaran Bulan</th>
                    <th scope="col" class="px-6 py-3">Status Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($unpaidMembers as $unpaid)
                    <tr>
                        <td class="px-6 py-4">{{ $unpaid->dojo->nama }}</td>
                        <td class="px-6 py-4">{{ $unpaid->nama }}</td>
                        <td class="px-6 py-4">{{ $bulan . '-' . $tahun }}</td>
                        <td class="px-6 py-4 text-red-500">Belum Membayar</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada anggota yang belum membayar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endif

</div>
@endsection
