@extends('layouts.DashboardLayout')

@section('title', 'Select Pembayaran')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Menu Pembayaran</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/pembayaran" class="p-4" method="post" >
            <!-- @csrf
            @method('PUT')  -->
            <!-- This indicates the method for updating -->

            <div class="mb-3">
                <label for="tahun" class="block">Tahun Pembayaran</label>
                <select name="tahun" id="tahun" class="w-full border border-blue-600 rounded-md p-2" required onchange="setMonthValue()">
                    <option value="semua">Semua</option> <!-- Add 'Semua' option here -->
                    @php
                        $currentYear = date('Y');
                        $startYear = $currentYear - 10; // Start 10 years back
                        $endYear = $currentYear + 1; // Optionally allow next year
                    @endphp
                    @for ($year = $endYear; $year >= $startYear; $year--) <!-- Reverse loop -->
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label for="bulan" class="block">Pembayaran untuk Bulan</label>
                <select name="bulan" id="bulan" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="-">-</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </select>
            </div>

            <script>
            function setMonthValue() {
                const tahunSelect = document.getElementById('tahun');
                const bulanSelect = document.getElementById('bulan');

                if (tahunSelect.value === 'semua') {
                    bulanSelect.value = '-'; // Set month to "-"
                    bulanSelect.disabled = true; // Disable the month dropdown
                } else {
                    bulanSelect.disabled = false; // Enable the month dropdown
                }
            }
            </script>


            

            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Lihat Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection
