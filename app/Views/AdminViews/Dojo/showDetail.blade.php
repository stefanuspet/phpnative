@extends('layouts.DashboardLayout')

@section('title', 'Cabang-store')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">{{$dojo->nama}}</h1>
    <div class="w-full">
        <table class="w-fit">
            <tr>
                <td>Lokasi</td>
                <td class="px-2">:</td>
                <td>{{$dojo->lokasi}}</td>
            </tr>
            <tr>
                <td>Cabang</td>
                <td class="px-2">:</td>
                <td>{{$dojo->cabang}}</td>
            </tr>
            <!-- jumlah anggota -->
            <tr>
                <td>Jumlah Anggota</td>
                <td class="px-2">:</td>
                <td>{{$dojo->count_anggota}}</td>
            </tr>
            <tr>
                <td>Pelatih</td>
                <td class="px-2">:</td>
                <td class="flex justify-start w-full">
                    <div>
                        @foreach ($majelis as $index => $m)
                        {{$m->nama}},
                        @endforeach
                    </div>
                </td>
            </tr>
        </table>

        <hr class="mt-5 border border-blue-900" />
        <h1 class="text-xl font-bold pt-10 pb-5 text-blue-950">Data Anggota</h1>
        <table class="w-full text-sm text-center border">
            <thead class="uppercase bg-blue-500 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 border">Foto</th> <!-- New Photo Column -->
                    <th scope="col" class="px-6 py-3 border">Nama</th>
                    <th scope="col" class="px-6 py-3 border">Tempat Tanggal Lahir</th>
                    <th scope="col" class="px-6 py-3 border">Alamat</th>
                    <th scope="col" class="px-6 py-3 border">Tahun Bergabung</th>
                    <th scope="col" class="px-6 py-3"></th>
                </tr>
            </thead>
            @foreach ($anggota as $index => $a)
            <tr>
                <td class="px-6 py-4 border">
                <div class="rounded-full h-44 w-44 bg-slate-300 overflow-hidden flex justify-center items-center mt-5">
                    <img class="object-cover h-full w-full" src="/uploads/{{$a->foto}}" alt="Anggota Photo">
                </div>
                </td>
                <td class="px-6 py-4 border">{{ $a->nama }}</td>
                <td class="px-6 py-4 border">{{ $a->tempat_lahir }}, {{$a->tanggal_lahir}}</td>
                <td class="px-6 py-4 border">{{ $a->alamat }}</td>
                <td class="px-6 py-4 border">{{ $a->tahun_gabung }}</td>
                <td class="px-6 py-4 border">
                    <a href="/dashboard-majelis/anggota/show/{{$a->nid}}" class="px-3 py-2 hover:bg-blue-600 bg-blue-500 my-1 rounded-md text-white text-center" title="View details of {{ $a->nama }}">Detail</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
