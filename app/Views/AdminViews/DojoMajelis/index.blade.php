@extends('layouts.DashboardLayout')

@section('title', 'Anggota')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Data Dojo Majelis</h1>
        <button id="openModalBtn" class="bg-blue-600 text-white px-4 py-2 rounded-md">Tambah Data</button>
    </div>
    @if (isset($_SESSION['error']))
    <div class="bg-red-500 w-full py-2 text-center text-white rounded-md mb-4">
        {{ $_SESSION['error'] }}
    </div>
    <?php unset($_SESSION['error']); ?> <!-- Hapus pesan error setelah ditampilkan -->
    @endif
    <table class="w-full border">
        <thead>
            <tr class="border font-bold text-center">
                <td class="border py-2">Nama Dojo</td>
                <td class="border">Pelatih</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($dojoMajelis as $dj )
            <tr class="text-center">
                <td class="border py-1">{{$dj->dojo->nama}}</td>
                <td class="border py-1">{{$dj->majelis->nama}}</td>
                <td class="border">
                    <div class="inline-flex py-2 gap-x-2">
                        <!-- <button class="px-3 py-1 hover:bg-yellow-600 bg-yellow-500  rounded-md text-white">Edit</button> -->
                        <form action="/dashboard/dojoMajelis/delete" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id_dojo" value="{{ $dj->dojo->id }}">
                            <input type="hidden" name="id_majelis" value="{{ $dj->majelis->nit }}">
                            <button type="submit" class="px-3 py-1 hover:bg-red-700 bg-red-600 rounded-md text-white">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-1/2">
        <h2 class="text-2xl font-bold mb-4">Tambah Pelatih</h2>
        <form action="/dashboard/dojoMajelis/store" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_majelis" class="block text-sm font-medium text-gray-700">Nama Pelatih</label>
                <select name="id_majelis" id="id_majelis" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    @foreach ($majelisall as $m)
                    <option value="{{ $m->nit }}">{{ $m->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label for="id_dojo" class="block text-sm font-medium text-gray-700">Nama Dojo</label>
                <select name="id_dojo" id="id_dojo" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    @foreach ($dojoall as $dojo)
                    <option value="{{ $dojo->id }}">{{ $dojo->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeModalBtn" class="bg-red-600 text-white px-4 py-2 rounded-md mr-2">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Simpan</button>
            </div>

        </form>
    </div>
</div>

<script>
    // Get elements
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('modal');

    // Show modal
    openModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    // Hide modal
    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>
@endsection