@extends('layouts.DashboardLayout')

@section('title', 'Forget Password')
@section('content')
<div class="w-full bg-white p-5">
    <div class="flex justify-between items-center pb-2">
        <h1 class="text-4xl font-bold text-blue-950">Lupa Password</h1>
    </div>
    <hr>
    <div>
        <table class="w-full mt-2 text-center border">
            <thead>
                <tr class="border">
                    <th scope="col" class="px-6 py-3">Credential ID</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Nomor</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($forgetpass as $f )
                <tr>
                    <td class="px-6 py-4">{{ $f->credential }}</td>
                    <td class="px-6 py-4">{{ $f->nama }}</td>
                    <td class="px-6 py-4">{{ $f->role }}</td>
                    <td class="px-6 py-4">{{ $f->nomor }}</td>
                    <td class="px-6 py-4">{{ $f->status }}</td>
                    <td class="px-6 py-4 flex gap-x-3 justify-center">
                        @if ($f->status === 'pending')
                        <form action="/forget-pass/update/{{ $f->id }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-3 py-2 rounded-md">Selesaikan</button>
                        </form>
                        @elseif ($f->status === 'selesai')
                        <form action="/forget-pass/update/{{ $f->id }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-yellow-500 text-white px-3 py-2 rounded-md">Batalkan</button>
                        </form>
                        @endif
                        <form action="/forget-pass/delete/{{ $f->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-md">Delete</button>
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
@endsection
