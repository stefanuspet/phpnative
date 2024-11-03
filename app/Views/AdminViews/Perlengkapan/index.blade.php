@extends('layouts.DashboardLayout')

@section('title', 'Perlengkapan')
@section('content')
<div class="w-full">
<div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Perlengkapan</h1>
        <a href="/dashboard/perlengkapan/create" class="px-3 py-2 bg-green-600 rounded-md text-white">
            Tambah Perlengkapan
        </a>
    </div>
    <div class="w-full">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <table class="w-full mt-2 text-center border">
                <thead>
                    <tr class="border">
                        <th scope="col" class="px-6 py-3">Foto Perlengkapan</th>
                        <th scope="col" class="px-6 py-3">Nama Perlengkapan</th>
                        <th scope="col" class="px-6 py-3">Ukuran</th>
                        <th scope="col" class="px-6 py-3">Jumlah</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($perlengkapan as $items)
                    <tr>
                        <td class="px-6 py-4 border">
                        <div class="h-44 w-44 bg-slate-300 overflow-hidden flex justify-center items-center mt-5">
                            <img class="object-cover h-full w-full" src="/uploads/{{$items->foto}}" alt="Foto Perlengkapan">
                        </div>
                        </td>
                        <td class="px-6 py-4 border">{{$items->nama}}</td>
                        <td class="px-6 py-4 border">{{$items->ukuran}}</td>
                        <td class="px-6 py-4 border">{{$items->jumlah}}</td>
                        <td class="px-6 py-4 border">{{$items->status}}</td>
                        <td class="px-6 py-4 flex justify-center gap-x-4">
                            <a href="/dashboard/perlengkapan/edit/{{$items->id}}" class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500  rounded-md text-white">Edit</a>
                            <form action="/dashboard/perlengkapan/delete/{{$items->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$items->id}}">
                                <button type="submit" class="px-3 py-1 hover:bg-red-600 bg-red-500 rounded-md text-white">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection