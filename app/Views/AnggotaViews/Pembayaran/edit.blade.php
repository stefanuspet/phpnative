@extends('layouts.AnggotaLayout')

@section('title', 'Edit Pembayaran')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Edit Pembayaran</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/pembayaran/update/{{ $pembayaran->id }}" class="p-4" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This indicates the method for updating -->

            <div class="mb-3">
                <label for="foto" class="block">Bukti Pembayaran</label>
                <input type="file" name="foto" id="foto" class="w-full border border-blue-600 rounded-md p-2" accept="image/*">
                @if($pembayaran->bukti_pembayaran)
                <div class="mt-3">
                    <img src="/uploads/{{$pembayaran->bukti_pembayaran}}" alt="Foto Pembayaran" class="w-32 h-32 object-cover rounded-md">
                </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="bulan" class="block">Pembayaran untuk Bulan</label>
                <select name="bulan" id="bulan" class="w-full border border-blue-600 rounded-md p-2" required>
                    @php
                        $months = [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 
                            'Juni', 'Juli', 'Agustus', 'September', 
                            'Oktober', 'November', 'Desember'
                        ];
                    @endphp
                    @foreach($months as $month)
                        <option value="{{ $month }}" {{ $month == explode('-', $pembayaran->bulan)[0] ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tahun" class="block">Tahun Pembayaran</label>
                <select name="tahun" id="tahun" class="w-full border border-blue-600 rounded-md p-2" required>
                    @php
                        $currentYear = date('Y');
                        $startYear = $currentYear - 10; // Adjust as needed
                    @endphp
                    @for ($year = $startYear; $year <= $currentYear + 1; $year++)
                        <option value="{{ $year }}" {{ $year == explode('-', $pembayaran->bulan)[1] ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>

            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
