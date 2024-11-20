@extends('layouts.DashboardLayout')

@section('title', 'Cabang')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Data Majelis Sabuk Hitam</h1>
        <a href="/dashboard/majelis/create" class="px-3 py-2 bg-green-600 rounded-md text-white">
            Tambah Majelis
        </a>
    </div>

    <div class="w-full py-5">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            @forelse ($majelis as $items)
            <div class="grid grid-cols-12 gap-8 items-center mb-8 border-b pb-4">
                <!-- Photo Section -->
                <div class="col-span-3 flex justify-center items-center">
                    <div class="rounded-full h-44 w-44 bg-slate-300 overflow-hidden">
                        <img class="object-cover h-full w-full" src="/uploads/{{$items->foto}}" alt="/storage/uploads/{{ htmlspecialchars($items->foto) }}">
                    </div>
                </div>

                <!-- Biodata Section -->
                <div class="col-span-7">
                    <table class="w-full">
                        <tr>
                            <td class="font-semibold w-40">Nama</td>
                            <td class="w-1 text-center">:</td>
                            <td>{{$items->nama}}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">NIT</td>
                            <td class="w-1 text-center">:</td>
                            <td>{{$items->nit}}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">TTL</td>
                            <td class="w-1 text-center">:</td>
                            <td>{{$items->tempat_lahir}}, {{$items->tanggal_lahir}}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Tahun Bergabung</td>
                            <td class="w-1 text-center">:</td>
                            <td>{{$items->tahun_gabung}}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Jenis Kelamin</td>
                            <td class="w-1 text-center">:</td>
                            <td>{{$items->jenis_kelamin}}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Alamat</td>
                            <td class="w-1 text-center">:</td>
                            <td>{{$items->alamat}}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Jabatan</td>
                            <td class="w-1 text-center">:</td>
                            <td>{{$items->jabatan}}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Tingkat Sabuk</td>
                            <td class="w-1 text-center">:</td>
                            <td>{{$items->tingkat_sabuk}}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Spesialis</td>
                            <td class="w-1 text-center">:</td>
                            <td>{{$items->spesialis}}</td>
                        </tr>
                    </table>
                </div>

                <!-- Action Section -->
                <div class="col-span-2 flex flex-col gap-4 items-start">
                    <a href="/dashboard/majelis/edit/{{$items->nit}}" class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500 rounded-md text-white">Edit</a>
                    <form action="/dashboard/majelis/delete/{{ $items->nit }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="{{ $items->nit }}">
                        <button type="submit" class="px-3 py-1 hover:bg-red-700 bg-red-600 rounded-md text-white">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-center text-blue-950">Data Masih Kosong !!!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
