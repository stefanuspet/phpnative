@extends('layouts.DashboardLayout')

@section('title', 'Pengurus')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Data Pengurus</h1>
        <a href="/dashboard/pengurus/create" class="px-3 py-2 bg-green-600 rounded-md text-white">
            Tambah Pengurus
        </a>
    </div>
    <div class="w-full py-5">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <table class="w-full mt-2 text-center border">
                <thead>
                    <tr class="border">
                        <th scope="col" class="px-6 py-3">Jabatan</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                    </tr>

                </thead>
                <tbody>
                    @forelse ($pengurus as $items )
                    <tr>
                        @if(in_array($items->jabatan, ['Ketua Dewan Pembina', 'Anggota Dewan Pembina', 'Ketua umum', 'Sekretaris umum', 'Bendahara umum', 'Ketua staf pelatih', 'Ketua majelis sabuk hitam','Bidang Prestasi', 'Perwasitan', 'Usaha dan dana', 'Humas']))

                        <td class="px-6 py-4">{{$items->jabatan}}</td>
                        <td class="px-6 py-4">{{$items->nama}}</td>
                        <td class="px-6 py-4 flex justify-center gap-x-4">
                            <a href="/dashboard/pengurus/edit/{{$items->id}}" class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500  rounded-md text-white">Edit</a>
                            <form action="/dashboard/pengurus/delete/{{$items->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$items->id}}">
                                <button type="submit" class="px-3 py-1 hover:bg-red-600 bg-red-500 rounded-md text-white">Delete</button>
                            </form>
                        </td>
                        @endif
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
</div>
@endsection