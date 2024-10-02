@extends("layouts.AuthLayout")
@section('title', 'Register')

@section('content')
<h1 class="text-center font-semibold text-xl">Register Guest</h1>
<form action="/register/guest/majelis/create" class="p-4" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nit" class="block">NIT</label>
        <input type="number" name="nit" id="nit" class="w-full border border-blue-600 rounded-md p-2" required value="{{ $_SESSION['credential_id'] }}" readonly>
    </div>
    <div class="mb-3">
        <label for="nama" class="block">Nama</label>
        <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" required>
    </div>
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
        <button class="px-3 py-1 bg-green-600 rounded-md text-white">Buat Akun</button>
    </div>
</form>
@endsection