@extends("layouts.AuthLayout")
@section('title', 'Register')

@section('content')
<h1 class="text-center font-semibold text-xl">Register Atlet</h1>
<form action="/register/guest/anggota/create" class="p-4" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nomor_induk" class="block">Nomor Induk</label>
        <input type="number" name="nomor_induk" id="nomor_induk" class="w-full border border-blue-600 rounded-md p-2" required value="{{ $_SESSION['credential_id'] }}" readonly>
    </div>
    <div class="mb-3">
        <label for="nama" class="block">Nama</label>
        <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" required>
    </div>
    <div class="mb-3">
        <label for="id_dojo" class="block">Dojo</label>
        <select name="id_dojo" id="id_dojo" class="w-full border border-blue-600 rounded-md p-2" required>
            <option value="">Choose</option>
            @foreach($dojos as $dojo)
            <option value="{{$dojo->id}}">{{$dojo->nama}}</option>
            @endforeach
        </select>
    </div>
    <!-- <div class="mb-3">
        <label for="tanggal_lahir" class="block">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full border border-blue-600 rounded-md p-2" required>
    </div> -->
    <div class="mb-3">
        <label for="password" class="block">Password</label>
        <input type="password" name="password" id="password" class="w-full border border-blue-600 rounded-md p-2">
    </div>
    <div class="mb-3">
        <label for="confirm_password" class="block">Konfirmasi Password</label>
        <input type="password" name="confirm_password" id="confirm_password" class="w-full border border-blue-600 rounded-md p-2">
    </div>
    @if (isset($_SESSION['error']))
    <div style="color: red; text-align: center; margin-top: 12px">
        {{ $_SESSION['error'] }}
    </div>
    <?php unset($_SESSION['error']); ?> <!-- Hapus pesan error setelah ditampilkan -->
    @endif
    <div class="flex justify-end mt-10">
        <button type="submit" class="px-3 py-1 bg-green-600 rounded-md text-white">Buat Akun</button>
    </div>
</form>
@endsection