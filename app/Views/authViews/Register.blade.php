@extends("layouts.AuthLayout")
@section('title', 'Register')

@section('content')
<h1 class="text-center font-semibold text-xl">Register</h1>
<form action="/register/create" method="POST" class="mt-5 w-full">
    <div class="mb-3">
        <input id="cred_id" name="cred_id" type="number" class="border w-full rounded-sm p-2" placeholder="ID" required>
    </div>
    <!-- Menampilkan pesan kesalahan jika ada -->
    @if (isset($_SESSION['error']))
    <div style="color: red; text-align: center; margin-top: 12px">
        {{ $_SESSION['error'] }}
    </div>
    @if ($_SESSION['error'] == 'Credential ID tidak ditemukan')
    <!-- Center the link using text-align and display block -->
    <!-- <div class="text-center mt-2">
        <p>Daftar sebagai?</p>
        <a href="/register/guest/anggota" class="inline-block px-4 py-2 text-blue-600">Anggota</a>
        <a href="/register/guest/pelatih" class="inline-block px-4 py-2 text-blue-600">Pelatih</a>
    </div> -->
    @endif
    <?php unset($_SESSION['error']); ?> <!-- Hapus pesan error setelah ditampilkan -->
    @endif
    <button type="submit" class="bg-blue-600 text-white w-full rounded-sm py-2 mt-5">Register</button>
</form>
@endsection